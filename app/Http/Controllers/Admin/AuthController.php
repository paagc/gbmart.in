<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Session;

class AuthController extends Controller
{
	public function getLogin(Request $request) {
		if (Auth::check() && Auth::user()->hasRole('admin')) {
			return redirect('/admin');
		} else {
			return view('admin.login');
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
			return redirect('/admin');
		} else {
			Session::flash('error', 'Login unsuccessful.');
			return redirect()->back();
		}
	}

	public function logout() {
		Auth::logout();
		return redirect('/admin/login');
	}
}