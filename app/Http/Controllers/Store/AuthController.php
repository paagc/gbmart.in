<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Session;
use Validator;

class AuthController extends Controller
{
    public function getLogin(Request $request)
    {
        if (Auth::check() && Auth::user()->type == 'customer') {
            return redirect('/');
        } else {
            $cart = \Cart::content()->count();

            return view('store.login', compact('cart'));
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

        $user = User::where('email', $email)->where('status', 'ACTIVE')->where('type', 'customer')->first();

        if (is_null($user)) {
            \Session::flash('error', 'Invalid user.');
            return redirect()->back();
        }

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            if ($request->get('goToCheckout'))
                return redirect('store/checkout');
            return redirect('/');
        } else {
            \Session::flash('error', 'Login unsuccessful.');
            return redirect()->back();
        }
    }

    public function postRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'mobile_number' => 'required|size:10',
            'confirm_password' => 'required|same:password'
        ]);
        $input = $request->all();
        $input['type'] = 'customer';
        $input['status'] = 'ACTIVE';

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);

        Auth::login($user);
        if ($request->get('goToCheckout'))
            return redirect('store/checkout');
        return redirect('/');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}