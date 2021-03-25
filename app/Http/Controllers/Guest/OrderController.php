<?php

namespace App\Http\Controllers\Guest;

use App\Dish;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Faker\Generator as Faker;


use App\Order;
use App\Restaurant;

class OrderController extends Controller
{
    public function index(Request $request) {
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
        
        $data = $request->all();
        // $finalPrice = $data["finalPrice"];
    
        $token = $gateway->ClientToken()->generate();
    
        // return view('guest.payment.hosted', [
        //     'token' => $token,
        //     'finalPrice' => $data["finalPrice"]
        // ]);
        return view('guest.payment.hosted', compact('token', 'data'));
    }

    public function payment(Request $request, Faker $faker) {
        $gateway = new \Braintree\Gateway([
            'environment' => config('services.braintree.environment'),
            'merchantId' => config('services.braintree.merchantId'),
            'publicKey' => config('services.braintree.publicKey'),
            'privateKey' => config('services.braintree.privateKey')
        ]);
    
        $amount = $request->amount;
        $nonce = $request->payment_method_nonce;
            
        $result = $gateway->transaction()->sale([
            'amount' => $amount,
            'paymentMethodNonce' => $nonce,
            
            'options' => [
                'submitForSettlement' => true
            ]
        ]);
        $data = $request->all();
        $data["dishesId"] = json_decode($data["dishesId"]);
        $data["numberOfDishes"] = json_decode($data["numberOfDishes"]);
        foreach ($data["dishesId"] as $key => $dishId) {
            $data["dishesId"][$key] = Dish::where('id', $dishId)->first();
            $data["dishesId"][$key]['quantity'] = $data["numberOfDishes"][$key];
        }
        $dishes = $data["dishesId"];

        $business_name = $data['business_name'];
        $address = $data['address'];

        if ($result->success) {
            $transaction = $result->transaction;
            // header("Location: transaction.php?id=" . $transaction->id);
            $newOrder = new Order();
            $newOrder->fill($data); 
            $newOrder->total_amount = $data["amount"];
            $newOrder->status = "In preparazione";
            $newOrder->date = $faker->dateTime($max = 'now', $timezone = 'GMT');
            $newOrder->save();
            for ($i=0; $i < count($data["numberOfDishes"]); $i++) { 
                $number = intval($data["numberOfDishes"][$i]);
                for ($j=1; $j <= $number; $j++) { 
                    $newOrder->dishes()->attach($data["dishesId"][$i]);
                }
            }
    
            return view('guest.payment.success', compact('newOrder', 'business_name', 'dishes', 'address'));
        } else {
            $errorString = "";
            
            foreach ($result->errors->deepAll() as $error) {
                $errorString .= 'Error: ' . $error->code . ": " . $error->message . "\n";
            }
    
            // $_SESSION["errors"] = $errorString;
            // header("Location: index.php");
            return back()->withErrors('An error occurred with the message: '.$result->message);
        }
        
    }
}
