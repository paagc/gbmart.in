<?

<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use App\User;

class CheckoutController extends Controller
{
	public function get(Request $request) {
		return view('store.checkout');
	}

	public function post(Request $request) {
		
		return back()->with();
	}

	public function getCart(Request $request) {
		return view('store.cart');
	}

	public function postCart(Request $request) {
		return back()->with();
	}
}