<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;


class TrackOrderController extends Controller
{
    public function index()
    {


        return view('store.track');
    }

    public function store(Request $request)
    {
        $order = Order::find($request->get('order_id'));
        if ($order)
            if ($order->customer->email == $request->get('email'))
                return view('store.track-details', compact('order'));
            else
                \Alert::error("Details didn't Match", 'ooops!');
        else
            \Alert::error("Order Not Found!!", 'ooops!');

        return back();
    }

    public function show($id)
    {
        $order = Order::find($id);

        return view('store.track-details', compact('order'));


    }
}
