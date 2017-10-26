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
});