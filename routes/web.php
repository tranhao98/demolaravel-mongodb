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
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');

//category
Route::get('/{slugcat}.html', 'HomeController@viewcategory');

//product
Route::get('/{slug}.html', 'HomeController@viewcategory');

//product by category
Route::get('/{slugcat}/{slug}.html', 'HomeController@productview');

//branch
Route::get('/{slug}-branch/', 'BranchController@branchDetail');

//blog
Route::get('/blog', 'BlogController@index');
Route::get('/blog/{slug}', 'BlogController@showPostDetail');

//admin
Route::get('/admin', 'AdminController@index');

//Email verify
Route::get('/verification/{id}', 'UserController@emailVerification');

//My Profile
Route::post('/update-basic', 'UserController@updateProfileBasic');
Route::post('/update-contact', 'UserController@updateProfileContact');

//Cart
Route::post('/add-to-cart', 'CartController@addProduct');
Route::post('/delete-cart-item', 'CartController@deleteProduct');
Route::post('/update-cart-item', 'CartController@updateProduct');

//Checkout
Route::post('/place-order', 'CheckoutController@placeOrder');

//apply coupon
Route::post('/apply-coupon', 'CheckoutController@applyCoupon');

//change coupon
Route::post('/change-coupon', 'CheckoutController@changeCoupon');

//post details
Route::post('/load-more-comment', 'BlogController@loadMoreComment');
Route::post('/save-comment', 'BlogController@saveComment');
Route::post('/form-edit-comment','BlogController@formEditComment');
Route::post('/edit-comment','BlogController@editComment' );
Route::post('/delete-comment','BlogController@deleteComment');

//contact form
Route::post('/quick-contact','HomeController@contactForm');

//Authenticate client
Route::middleware(['auth'])->group(function () {

    //Cart
    Route::get('/cart', 'CartController@viewcart');

    //checkout
    Route::get('/checkout', 'CheckoutController@index');


    //my profile
    Route::get('/update-basic-infor', 'UserController@formUpdateBasicInfor');
    Route::get('/update-contact-infor', 'UserController@formUpdateContactInfor');
    Route::get('/my-profile/order-{id}/', 'OrdersController@orderDetail');
    Route::get('/my-profile/profile', 'UserController@showProfile');
    Route::get('/my-profile/orders', 'OrdersController@index');
    Route::get('/my-profile', 'UserController@showProfile');
});

//Authenticate admin

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', 'AdminController@index');
    //Orders
    Route::get('/admin/orders', 'OrdersController@ordersAdmin');
    Route::get('/admin/order-detail-{id}', 'OrdersController@ordersDetailsAdmin');
    Route::post('/admin/update-order-status', 'OrdersController@updateOrderStatus');

    //Coupons
    Route::get('/admin/coupons', 'CouponsController@coupons');
    Route::post('/admin/update-coupon-status', 'CouponsController@updateCouponStatus');
    Route::match(['get', 'post'], '/admin/add-edit-coupon/{id?}', 'CouponsController@addEditCoupon');
    Route::post('/admin/delete-coupon', 'CouponsController@deleteCoupon');

    //Users
    Route::get('/admin/users', 'UserController@users');
    Route::post('/admin/update-user-status', 'UserController@updateUserStatus');

    //Posts
    Route::get('/admin/posts', 'BlogController@posts');
    Route::match(['get', 'post'], '/admin/add-edit-post/{id?}', 'BlogController@addEditPost');
    Route::post('/admin/delete-post', 'BlogController@deletePost');
});


//map
Route::get('/map', function () {
    return view('/map');
});
Route::get('/storelocator', function () {
    return view('/map');
});
Auth::routes();
Route::get('/home', 'HomeController@index');
