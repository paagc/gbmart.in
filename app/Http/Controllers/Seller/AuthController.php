<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{

    public function getLogin(Request $request)
    {
        if (Auth::check() && Auth::user()->hasRole('seller')) {
            return redirect('/seller');
        } else {
            return view('seller.login');
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

        $user = User::where('email', $email)->where('status', 'ACTIVE')->where('type', 'seller')->first();

        if (is_null($user)) {
            \Session::flash('error', 'Invalid user.');
            return redirect()->back();
        }

        if (Auth::attempt(['email' => $email, 'password' => $password], $remember)) {
            return redirect('/seller');
        } else {
            return redirect()->back();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/seller/login');
    }

    public function create()
    {
        // return view('store.rlogin');
        return view('seller.register');
    }

    public function store(Request $input)
    {
        $input->validate([
            'email' => 'required|email',
            'name' => 'required',
            'mobile_number' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $existingUserWithEmail = User::where('email', $input->get('email'))->first();

        if (!is_null($existingUserWithEmail)) {
            \Session::flash('error', 'User already exists with this email ID.');
            return back();
        }

        $existingUserWithMobileNumber = User::where('mobile_number', 'like', '%' . $input->get('mobile_number') . '%')->first();

        if (!is_null($existingUserWithMobileNumber)) {
            \Session::flash('error', 'User already exists with this mobile number.');
            return back();
        }

        $seller = $input->all();
        $seller['status'] = 'PENDING';
        $seller['password'] = bcrypt($seller['password']);
        // dd($seller);
        $seller = User::create($seller);
        $seller_role = Role::where('name', 'seller')->first();
        $seller->attachRole($seller_role);

        return redirect('/');
    }
}