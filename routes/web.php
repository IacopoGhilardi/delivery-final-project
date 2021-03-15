<?php

use App\Http\Controllers\Admin\DishController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')
    ->namespace('Admin')
    ->middleware('auth')
    ->name('admin.') 
    ->group(function () {
        Route::resource('deliverboo', 'RestaurantController');

        // Route::resource('menu', 'DishController');
        Route::get('menu/{slug}', 'DishController@index')->name('menu.index');
        Route::get('menu/create/{slug}', 'DishController@create')->name('menu.create');
        Route::post('menu/create/{slug}/store', 'DishController@store')->name('menu.store');
        // Route::get('menu/2/{id}', 'DishController@indexDishes')->name('menu.index');
        // Route::get('menu/2/{id}', 'DishController@indexDishes')->name('menu.index');
 });    