<?php

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

Route::group(['namespace'=>'Store'], function() {
    Route::get('/', 'HomeController@getHome');
    Route::get('/login', 'AuthController@getLogin');
    Route::post('/login', 'AuthController@postLogin');
    Route::post('/register', 'AuthController@postRegister');
    Route::get('/logout', 'AuthController@logout');

    Route::get('/test-mail', 'CheckoutController@testMail');

    Route::get('privacy', function () { return view('store.privacy'); });
    Route::get('cancellation', function () { return view('store.cancel'); });
    Route::get('disclaimer', function () { return view('store.disclaimer'); });
    Route::get('return-and-refund', function () { return view('store.return'); });
    Route::get('shipping-and-delivery', function () { return view('store.ship'); });
    Route::get('about-us', function () { return view('store.about'); });
    Route::get('write-to-us', function () { return view('store.write'); });
    Route::get('terms-and-conditions', function () { return view('store.terms'); });

    Route::get('/store/cart', 'CartController@get');
    Route::get('/store/checkout', 'CheckoutController@get')->middleware('store.auth');
	Route::post('/store/checkout', 'CheckoutController@post')->middleware('store.auth');
	Route::get('/store/checkout/delete-address/{address_id}', 'CheckoutController@deleteAddress')->middleware('store.auth');
    Route::get('/store/pay/request/{payment_reference}', 'PaymentController@request')->middleware('store.auth');
    Route::post('/store/pay/response/{payment_reference}', 'PaymentController@response');
    Route::get('/store/wishlist', 'WishlistController@getAll')->middleware('store.auth');
    Route::get('/store/wishlist/add/{product_id}', 'WishlistController@add')->middleware('store.auth');
    Route::get('/store/wishlist/remove/{product_id}', 'WishlistController@remove')->middleware('store.auth');
    Route::get('/store/my-account', 'MyAccountController@view')->middleware('store.auth');
    Route::get('/store/my-account/orders', 'MyAccountController@orders')->middleware('store.auth');
    Route::get('/store/my-account/user', 'MyAccountController@user')->middleware('store.auth');
    Route::get('/store/my-account/password', 'MyAccountController@password')->middleware('store.auth');
    Route::get('/store/cart/add/{seller_product_id}', 'CartController@addToCart');
    Route::get('/store/cart/remove/{seller_product_id}', 'CartController@removeFromCart');
    Route::get('/store/cart/buy-now/{seller_product_id}', 'CartController@buyNow');
    Route::get('/store/{category_name}/{sub_category_name}', 'SubCategoryController@getProducts');
    Route::get('/store/{category_name}/{sub_category_name}/{product_name_seller_product_id}', 'ProductDetailsController@getProductDetails');
});