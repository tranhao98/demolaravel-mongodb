<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/','SiteNewsController@index');
Route::get('/{slugcat}.html', 'SiteNewsController@viewcategory');
Route::get('/{slug}.html', 'SiteNewsController@viewcategory');
Route::get('/{slugcat}/{slug}.html', 'SiteNewsController@productview');
Route::get('/{id}.php', 'OrdersController@orderDetail');

Route::get('/admin','AdminController@index');

Route::post('/add-to-cart', 'CartController@addProduct');
Route::post('/delete-cart-item','CartController@deleteProduct');
Route::post('/update-cart-item','CartController@updateProduct');
Route::post('/place-order','checkOutController@placeOrder');


Route::middleware(['auth'])->group(function () {
    Route::get('/checkout','checkOutController@index');
    Route::get('/orders','OrdersController@index');

    Route::get('/cart','CartController@viewcart');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin','AdminController@index');
    Route::get('/admin/orders','OrdersController@ordersAdmin');
    Route::get('/admin/{id}.php','OrdersController@ordersDetails');
    Route::post('/admin/update-status','AdminController@updateStatus');
});

    

Auth::routes();

Route::get('/home', 'SiteNewsController@index');
