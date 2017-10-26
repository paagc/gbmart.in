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

Route::group(['prefix' => 'admin', 'namespace'=>'Admin'], function() {
    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', 'AuthController@logout');
});


Route::group(['middleware'=>['admin.auth'], 'prefix' => 'admin', 'namespace'=>'Admin'],function () {

    Route::get('', 'DashboardController@getDashboard');

    Route::get('sub-categories', 'SubCategoryController@index');
    Route::get('sub-categories/create', 'SubCategoryController@getCreate');
    Route::post('sub-categories/create', 'SubCategoryController@postCreate');
    Route::get('sub-categories/{sub_category_id}/status/{status}', 'SubCategoryController@changeStatus');

    Route::get('products', 'ProductController@index');
    Route::get('products/create', 'ProductController@create');
    Route::post('products/create', 'ProductController@store');
    Route::get('products/{id}/edit', 'ProductController@edit');
    Route::put('products/{id}/edit', 'ProductController@update');
    Route::get('products/{product_id}/status/{status}', 'ProductController@changeStatus');

    Route::get('sellers', 'SellerController@index');
    Route::get('sellers/activate/{id}', 'SellerController@activate');
    Route::get('sellers/enable/{id}', 'SellerController@enable');
    Route::get('sellers/disable/{id}', 'SellerController@disable');

    Route::get('offers', 'OffersController@index');
    Route::get('offers/create', 'OffersController@create');
    Route::post('offers/create', 'OffersController@store');
    Route::get('offers/{id}/destroy', 'OffersController@destroy');
    Route::get('offers/{id}/active', 'OffersController@active');
    Route::get('offers/{id}/edit', 'OffersController@edit');
    Route::put('offers/{id}/edit', 'OffersController@update');

    Route::get('home-slide', 'SliderController@index');
    Route::get('home-slide/create', 'SliderController@create');
    Route::post('home-slide/create', 'SliderController@store');
    Route::get('home-slide/{id}/destroy', 'SliderController@destroy');
    Route::get('home-slide/{id}/active', 'SliderController@active');
    Route::get('home-slide/{id}/edit', 'SliderController@edit');
    Route::put('home-slide/{id}/edit', 'SliderController@update');

    Route::get('gift-coupon', 'GiftCouponsController@index');
    Route::get('gift-coupon/create', 'GiftCouponsController@create');
    Route::post('gift-coupon/create', 'GiftCouponsController@store');
    Route::get('gift-coupon/{id}/destroy', 'GiftCouponsController@destroy');
    Route::get('gift-coupon/{id}/active', 'GiftCouponsController@active');
    Route::get('gift-coupon/{id}/edit', 'GiftCouponsController@edit');
    Route::put('gift-coupon/{id}/edit', 'GiftCouponsController@update');

    Route::get('orders/pending', 'OrderManagementController@pendingOrders');
    Route::get('orders/approved', 'OrderManagementController@approvedOrders');
    Route::get('orders/packed', 'OrderManagementController@packedOrders');
    Route::get('orders/shipped', 'OrderManagementController@shippedOrders');
    Route::get('orders/delivered', 'OrderManagementController@deliveredOrders');
    Route::get('orders/cancelled', 'OrderManagementController@cancelledOrders');
    Route::get('orders/rejected', 'OrderManagementController@rejectedOrders');
});