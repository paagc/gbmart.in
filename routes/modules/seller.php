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

Route::group(['prefix' => 'seller', 'namespace'=>'Seller'], function() {
    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', 'AuthController@logout');
    Route::get('register', 'AuthController@create');
    Route::post('register', 'AuthController@store');
});

Route::group(['middleware'=>['seller.auth'], 'prefix' => 'seller', 'namespace'=>'Seller'],function () {
    Route::get('', 'DashboardController@getDashboard');
    Route::get('seller-products', 'SellerProductController@index');
    Route::get('seller-products/create', 'SellerProductController@create');
    Route::post('seller-products/create', 'SellerProductController@store');
    Route::get('seller-products/{seller_product_id}/edit', 'SellerProductController@getEdit');
    Route::post('seller-products/{seller_product_id}/edit', 'SellerProductController@postEdit');
    Route::get('seller-products/{seller_product_id}/status/{status}', 'SellerProductController@changeStatus');
});