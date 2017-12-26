<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Order;
use App\OrderLog;
use Auth;
use Illuminate\Http\Request;
use Session;

class OrderController extends Controller
{
    public function getAll(Request $request)
    {
        $orders = Order::whereNotIn('status', ['INITIATED', 'FAILED'])->whereHas('seller_product', function ($query) {
            $query->where('seller_id', Auth::user()->id);
        })->orderBy('created_at', 'desc');

        $orders = $orders->paginate(10);

        return view('seller.orders-index', ['type' => 'all', 'orders' => $orders]);
    }

    public function getWithStatus($status, Request $request)
    {
        $orders = Order::whereNotIn('status', ['INITIATED', 'FAILED'])->where('status', $status)->whereHas('seller_product', function ($query) {
            $query->where('seller_id', Auth::user()->id);
        })->orderBy('created_at', 'desc');

        $orders = $orders->paginate(10);

        return view('seller.orders-index', ['type' => $status, 'orders' => $orders]);
    }

    public function updateStatus($order_id, $status, Request $request)
    {
        $remarks = "";

        if ($request->has('remarks')) {
            $remarks = urldecode($request->get('remarks'));
        }

        $status = strtoupper($status);
        $order = Order::find($order_id);
        if (!is_null($order)) {
            $curretn_status = $order->status;
            if ($order->status == 'PENDING' && ($status == 'APPROVED' || $status == 'REJECTED')) {
                $order->status = $status;
            } else if ($order->status == 'APPROVED' && $status == 'PACKED') {
                $order->status = $status;
            } else if ($order->status == 'PACKED' && $status == 'SHIPPED') {
                $order->status = $status;
            } else if ($order->status == 'SHIPPED' && $status == 'DELIVERED') {
                $order->status = $status;
            }
            if ($order->status != $curretn_status) {
                $order->save();
                $this->updateLog($order, $remarks);

                $user = $order->customer;
                \Mail::send('mails.order-status-update', compact('order'), function ($message) use ($user, $order) {
                    $message->to($user->email, $user->name)->bcc(['sales@gbmart.in',])
                        ->subject("Order {$order->status} ");
                });
            }
        }
        return back();
        //hey listen i can try coding with this but mac really don't know what the fuck is happening
    }

    public function updateLog($order, $remarks)
    {
        OrderLog::create([
            'order_id' => $order->id,
            'status' => $order->status,
            'remarks' => $remarks
        ]);
    }
}