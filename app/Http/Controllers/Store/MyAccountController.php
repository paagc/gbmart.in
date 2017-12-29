<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use Auth;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;

class MyAccountController extends Controller
{
    public function view(Request $request)
    {
        // dd($request);
        // $user = Auth::user();
        // $orders = Order::where('customer_id', $user->id)->whereNotIn('status', [ 'INITIATED', 'FAILED' ])->orderBy('created_at', 'desc')->get();

        // return view('store.account', [
        // 	'user' => $user,
        // 	'orders' => $orders
        // ]);
        return redirect('/store/my-account/orders');
    }

    public function orders()
    {
        return view('store.account-orders');
    }

    public function addresses()
    {
        $addresses = \Auth::user()->addresses()->orderBy('status', 'DESC')->get();
//        $addresses = $addressesRaw->map(function ($address) {
//            return [$address->id => $address];
//        });

        return view('store.account-addresses', compact('addresses'));
    }

    public function user(Request $request)
    {
        $me = \Auth::user();
        $activeAddress = $me->addresses()->where('status', 'ACTIVE')->first();
        return view('store.account-user', compact('me', 'activeAddress'));
    }

    public function password(Request $request)
    {
        return view('store.account-password');
    }

    public function changePassword(Request $request)
    {


        if (Hash::check($request->get('old_password'), auth()->user()->password)) {
            if (trim($request->get('new_password')) === trim($request->get('new_password_confirm'))) {
                auth()->user()->password = bcrypt(trim($request->get('new_password')));
                auth()->user()->save();
                \Session::put('message', 'Password Changed!!');
                \Session::put('class', 'info');
            } else {
                \Session::put('message', 'New passwords did not match!!');
                \Session::put('class', 'danger');
            }
        } else {
            \Session::put('message', 'Old password is wrong!!');
            \Session::put('class', 'danger');
        }
        return back();
    }

    public function update(Request $request)
    {
        auth()->user()->update($request->only('name', 'email', 'mobile_number'));
        return back();
    }
}