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
		if (Auth::check() && Auth::user()->type == 'customer') {
			return redirect('/');
		} else {
			return view('store.login');
		}
	}

	public function post(Request $request) {
		$email = "";
		$password = "";
		$remember = false;

		if ($request->has('email')) {
			$email = $request->get('email');
		}

		if ($request->has('password')) {
			$password = $request->get('password');
		}

		if ($request->has('remember')) {
			$remember = $request->get('remember');
		}

		$user = User::where('email', $email)->where('status', 'ACTIVE')->where('type', 'customer')->first();

		if (is_null($user)) {
			Session::flash('error', 'Invalid user.');
			return redirect()->back();
		}

		if (Auth::attempt([ 'email' => $email, 'password' => $password ], $remember)) {
			return redirect('/');
		} else {
			Session::flash('error', 'Login unsuccessful.');
			return redirect()->back();
		}
	}
}