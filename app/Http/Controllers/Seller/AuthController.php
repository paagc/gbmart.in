<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;

class AuthController extends Controller
{
	public function getLogin(Request $request) {
		if (Auth::check() && Auth::user()->hasRole('seller')) {
			return redirect('/seller');
		} else {
			return view('seller.login');
		}
	}

	public function postLogin(Request $request) {
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

		if (Auth::attempt([ 'email' => $email, 'password' => $password ], $remember)) {
			return redirect('/seller');
		} else {
			return redirect()->back();
		}
	}

	public function logout() {
		Auth::logout();
		return redirect('/seller/login');
	}
}