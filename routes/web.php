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

// ORDER MATTERS!
$route_partials = [

    // Admin
    'admin',

    // Seller
    'seller',

    // Store for customers
    'store'

];

/** Route Partial Loadup
 ** =================================================== */

foreach ($route_partials as $partial) {

    $file = base_path().'/routes/modules/'.$partial.'.php';

    if ( ! file_exists($file))
    {
        $msg = "Route partial [{$partial}] not found.";
        throw new \Illuminate\Filesystem\FileNotFoundException($msg);
    }

    require_once $file;
}
Route::resource('/track', 'Store\TrackOrderController');
Route::get('/home', 'HomeController@index')->name('home');

Route::group(['before' => 'force.ssl','middleware' => 'guestAccessOnly'], function () {

    Route::get('password/email', 'Auth\PasswordController@getEmail');
});
Route::group(['before' => 'force.ssl','middleware' => ['ValidatePasswordReset', 'guestAccessOnly']], function () {

    Route::post('password/email', 'Auth\PasswordController@postEmail');
});
Route::group(['before' => 'force.ssl','middleware' => ['passwordReset']], function () {
    Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
    Route::post('password/reset', 'Auth\PasswordController@postReset')->name('password.reset');
});

// Route::get('/', function () {
//     return view('store.home');
// });

// Route::get('/account', function () {
//     return view('store.account');
// });

// Route::get('/cart', function () {
//     return view('store.cart');
// });

// Route::get('/checkout', function () {
//     return view('store.checkout');
// });

// Route::get('/detail', function () {
//     return view('store.detail');
// });

// Route::get('/clogin', function () {
//     return view('store.login');
// });

// Route::get('/offer', function () {
//     return view('store.offer');
// });

// Route::get('/sub-category', function () {
//     return view('store.sub-category');
// });

// Route::get('/track', function () {
//     return view('store.track');
// });

// Route::get('/wishlist', function () {
//     return view('store.wishlist');
// });

// Auth::routes();