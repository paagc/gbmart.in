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

Route::get('/', function () {
    return view('store.home');
});

Route::get('/account', function () {
    return view('store.account');
});

Route::get('/cart', function () {
    return view('store.cart');
});

Route::get('/checkout', function () {
    return view('store.checkout');
});

Route::get('/detail', function () {
    return view('store.detail');
});

Route::get('/clogin', function () {
    return view('store.login');
});

Route::get('/offer', function () {
    return view('store.offer');
});

Route::get('/rlogin', function () {
    return view('store.rlogin');
});

Route::get('/sub-category', function () {
    return view('store.sub-category');
});

Route::get('/track', function () {
    return view('store.track');
});

Route::get('/wishlist', function () {
    return view('store.wishlist');
});

// Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::prefix('admin')->namespace('Admin')->group(function() {
    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', 'AuthController@logout');
    Route::middleware('admin.auth')->get('', 'DashboardController@getDashboard');
    Route::middleware('admin.auth')->get('/sub-categories', 'SubCategoryController@index');
    Route::middleware('admin.auth')->get('/sub-categories/create', 'SubCategoryController@getCreate');
    Route::middleware('admin.auth')->post('/sub-categories/create', 'SubCategoryController@postCreate');
    Route::middleware('admin.auth')->patch('/sub-categories/{sub_category_id}/status/{status}', 'SubCategoryController@changeStatus');
});

Route::prefix('seller')->namespace('Seller')->group(function() {
    Route::get('login', 'AuthController@getLogin');
    Route::post('login', 'AuthController@postLogin');
    Route::get('logout', 'AuthController@logout');
    Route::middleware('seller.auth')->get('', 'DashboardController@getDashboard');
});
