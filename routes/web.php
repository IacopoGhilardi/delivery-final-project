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
    return view('guest.homepage');
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
        Route::match(['put', 'patch'],'menu/update/{id}', 'DishController@update')->name('menu.update');
        Route::get('menu/edit/{id}', 'DishController@edit')->name('menu.edit');
        Route::delete('menu/destroy/{id}', 'DishController@destroy')->name('menu.destroy');
 });    


 Route::prefix('guest')
    ->namespace('Guest')
    ->name('guest.') 
    ->group(function () {
        Route::get('deliverboo', 'GuestController@index')->name('homepage');
    });