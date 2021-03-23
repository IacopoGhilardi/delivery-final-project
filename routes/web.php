<?php

use App\Http\Controllers\Admin\DishController;
use Illuminate\Support\Facades\Route;

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('guest.homepage');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin.') 
    ->group(function () {
        Route::resource('restaurant', 'RestaurantController');

        // Route::resource('menu', 'DishController');
        Route::get('menu/{slug}', 'DishController@index')->name('menu.index');
        Route::get('menu/create/{slug}', 'DishController@create')->name('menu.create');
        Route::post('menu/create/{slug}/store', 'DishController@store')->name('menu.store');
        Route::match(['put', 'patch'],'menu/update/{id}', 'DishController@update')->name('menu.update');
        Route::get('menu/edit/{id}', 'DishController@edit')->name('menu.edit');
        Route::delete('menu/destroy/{id}', 'DishController@destroy')->name('menu.destroy');
 });    


 Route::namespace('Guest')
    ->name('guest.')
    ->group(function () {
        Route::get('deliverboo', 'GuestController@index')->name('homepage');
        Route::post('deliverboo/restaurant', 'GuestController@show')->name('restaurant.show');
    });

Route::post('/checkout', function (Request $request) {
    $gateway = new Braintree\Gateway([
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
    
});



Route::get('/guest/payment/hosted', function () {
    $gateway = new Braintree\Gateway([
        'environment' => config('services.braintree.environment'),
        'merchantId' => config('services.braintree.merchantId'),
        'publicKey' => config('services.braintree.publicKey'),
        'privateKey' => config('services.braintree.privateKey')
    ]);

   

    $token = $gateway->ClientToken()->generate();

    return view('/guest/payment/hosted', [
        'token' => $token
    ]);
});