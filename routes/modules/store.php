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
    Route::get('/store/checkout', 'CheckoutController@get')->middleware('store.auth');
	Route::post('/store/checkout', 'CheckoutController@post')->middleware('store.auth');
    Route::get('/', 'HomeController@getHome');
    Route::get('/login', 'AuthController@getLogin');
    Route::post('/login', 'AuthController@postLogin');
    Route::post('/register', 'AuthController@postRegister');
    Route::get('/logout', 'AuthController@logout');
    Route::get('/store/cart', 'CartController@get');
    Route::get('/store/cart/add/{seller_product_id}', 'CartController@addToCart');
    Route::get('/store/cart/remove/{seller_product_id}', 'CartController@removeFromCart');
    Route::get('/store/{category_name}/{sub_category_name}', 'SubCategoryController@getProducts');
    Route::get('/store/{category_name}/{sub_category_name}/{product_name}', 'ProductDetailsController@getProductDetails');
});