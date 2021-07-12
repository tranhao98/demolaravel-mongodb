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

//home
Route::get('/','SiteNewsController@index');
Route::get('/home','SiteNewsController@index');
//category
Route::get('/{slugcat}.html', 'SiteNewsController@viewcategory');
//product
Route::get('/{slug}.html', 'SiteNewsController@viewcategory');
//product by category
Route::get('/{slugcat}/{slug}.html', 'SiteNewsController@productview');
//order
Route::get('/{id}-order/', 'OrdersController@orderDetail');
//branch
Route::get('/{slug}-branch/', 'BranchController@branchDetail');


//admin
Route::get('/admin','AdminController@index');
//Cart
Route::post('/add-to-cart', 'CartController@addProduct');
Route::post('/delete-cart-item','CartController@deleteProduct');
Route::post('/update-cart-item','CartController@updateProduct');
//checkout
Route::post('/place-order','checkOutController@placeOrder');
//apply coupon
Route::post('/apply-coupon','checkOutController@applyCoupon');
//change coupon
Route::post('/change-coupon','checkOutController@changeCoupon');


Route::middleware(['auth'])->group(function () {
    Route::get('/checkout','checkOutController@index');

    Route::get('/orders','OrdersController@index');

    Route::get('/cart','CartController@viewcart');
});

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin','AdminController@index');
    //Orders
    Route::get('/admin/orders','OrdersController@ordersAdmin');
    Route::get('/admin/{id}.html','OrdersController@ordersDetailsAdmin');
    Route::post('/admin/update-order-status','OrdersController@updateOrderStatus');
    //Coupons
    Route::get('/admin/coupons','CouponsController@coupons');
    Route::post('/admin/update-coupon-status','CouponsController@updateCouponStatus');
    Route::match(['get','post'],'/admin/add-edit-coupon/{id?}','CouponsController@addEditCoupon');
    Route::post('/admin/delete-coupon','CouponsController@deleteCoupon');
    
});

    

Auth::routes();

Route::get('/home', 'SiteNewsController@index');
//map
Route::get('/{any}', function(){
    return view('/map');
})->where('any', '.*');

