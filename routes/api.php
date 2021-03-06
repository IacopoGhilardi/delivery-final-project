<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('Api')->group(function() {
    Route::post('/restaurants/{type}', 'RestaurantController@index');
    Route::post('filter/{restaurant}', 'RestaurantController@filter');
    Route::post('allRestaurants', 'RestaurantController@allRestaurants');
    Route::get('statistic/{slug}', 'RestaurantController@order');
    Route::get('dish/{slug}', 'RestaurantController@dish');    
    Route::get('statistic/{slug}/{years}', 'RestaurantController@years');
    Route::get('statistic/{slug}/month-filter/{months}', 'RestaurantController@months');
});
