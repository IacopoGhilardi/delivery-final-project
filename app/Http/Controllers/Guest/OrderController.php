<?php

namespace App\Http\Controllers\Guest;

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
        // dd($data, $restaurant);
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

        if ($result->success) {
            $transaction = $result->transaction;
            // header("Location: transaction.php?id=" . $transaction->id);
            $data = $request->all();
            $newOrder = new Order();
            $newOrder->fill($data); 
            $newOrder->total_amount = $data["amount"];
            $newOrder->status = "In preparazione";
            $newOrder->date = $faker->dateTime($max = 'now', $timezone = 'GMT');
            $restaurant = Restaurant::where('id', $data['restaurantId'])->first();
            dd($restaurant);
            $newOrder->attach();
            $newOrder->save();
    
            return back()->with('success_message', 'Transaction successful. The ID is:'. $transaction->id);
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
