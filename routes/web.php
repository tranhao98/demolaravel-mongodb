<?php

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

Route::get('/','SiteNewsController@index');

Route::get('/{slugcat}.html', 'SiteNewsController@viewcategory');
Route::get('/{slug}.html', 'SiteNewsController@viewcategory');
Route::get('/{slugcat}/{slug}.html', 'SiteNewsController@productview');

Route::post('/add-to-cart', 'CartController@addProduct');
Route::post('/delete-cart-item','CartController@deleteProduct');
Route::post('/update-cart-item','CartController@updateProduct');
Route::middleware(['auth'])->group(function () {
    Route::get('/cart','CartController@viewcart');
});

    

Auth::routes();

Route::get('/home', 'SiteNewsController@index');
