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
Route::get('/', 'SiteNewsController@index');
Route::get('/home', 'SiteNewsController@index');
//category
Route::get('/{slugcat}.html', 'SiteNewsController@viewcategory');
//product
Route::get('/{slug}.html', 'SiteNewsController@viewcategory');
//product by category
Route::get('/{slugcat}/{slug}.html', 'SiteNewsController@productview');
//order
Route::get('/my-profile/order-{id}/', 'OrdersController@orderDetail');
//branch
Route::get('/{slug}-branch/', 'BranchController@branchDetail');


//admin
Route::get('/admin', 'AdminController@index');

//Cart
Route::post('/add-to-cart', 'CartController@addProduct');
Route::post('/delete-cart-item', 'CartController@deleteProduct');
Route::post('/update-cart-item', 'CartController@updateProduct');

//checkout
Route::post('/place-order', 'checkOutController@placeOrder');

//apply coupon
Route::post('/apply-coupon', 'checkOutController@applyCoupon');

//change coupon
Route::post('/change-coupon', 'checkOutController@changeCoupon');

//my profile
Route::get('/my-profile', 'UserController@showProfile');
Route::get('/update-basic-infor', 'UserController@formUpdateBasicInfor');
Route::get('/update-contact-infor', 'UserController@formUpdateContactInfor');
Route::post('/update-basic', 'UserController@updateProfileBasic');
Route::post('/update-contact', 'UserController@updateProfileContact');
Route::get('/my-profile/profile','UserController@showProfile');

//Authenticate client
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', 'checkOutController@index');

    Route::get('/my-profile/orders', 'OrdersController@index');

    Route::get('/cart', 'CartController@viewcart');
});
//Authenticate client and admin
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', 'AdminController@index');
    //Orders
    Route::get('/admin/orders', 'OrdersController@ordersAdmin');
    Route::get('/admin/{id}.html', 'OrdersController@ordersDetailsAdmin');
    Route::post('/admin/update-order-status', 'OrdersController@updateOrderStatus');

    //Coupons
    Route::get('/admin/coupons', 'CouponsController@coupons');
    Route::post('/admin/update-coupon-status', 'CouponsController@updateCouponStatus');
    Route::match(['get', 'post'], '/admin/add-edit-coupon/{id?}', 'CouponsController@addEditCoupon');
    Route::post('/admin/delete-coupon', 'CouponsController@deleteCoupon');

    //Users
    Route::get('/admin/users', 'UserController@users');
    Route::post('/admin/update-user-status', 'UserController@updateUserStatus');
});



Auth::routes();

Route::get('/home', 'SiteNewsController@index');
//map
Route::get('/map', function () {
    return view('/map');
});
Route::get('/storelocator', function () {
    return view('/map');
});
