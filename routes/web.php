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


Route::get('/{slug}.html', 'SiteNewsController@show');

Route::middleware(['auth'])->group(function () {
    Route::post('add-to-cart', 'CartController@addProduct');
});

    

Auth::routes();

Route::get('/home', 'SiteNewsController@index');
