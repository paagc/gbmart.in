<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{
    public function getLogin(Request $request)
    {
        if (Auth::check() && Auth::user()->hasRole('admin')) {
            return redirect('/admin');
        } else {
            return view('admin.login');
        }
    }

    public function postLogin(Request $request)
    {
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

        $user = User::where('email', $email)->where('status', 'ACTIVE')->where('type', 'admin')->first();

        if (is_null($user)) {
            \Session::flash('error', 'Invalid user.');
            return redirect()->back();
        }

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            return redirect('/admin');
        } else {
            \Session::flash('error', 'Login unsuccessful.');
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
}