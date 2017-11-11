<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use App\Category;
use App\SubCategory;
use App\Product;
use App\ProductImage;
use App\Attribute;
use App\SellerProduct;
use App\AttributeValue;
use App\Order;
use App\OrderLog;

class OrderController extends Controller
{
	public function getAll(Request $request) {
		$orders = Order::whereNotIn('status', ['INITIATED', 'FAILED'])->whereHas('seller_product', function($query) {
			$query->where('seller_id', Auth::user()->id);
		})->orderBy('created_at', 'desc');

		$orders = $orders->paginate(10);

		return view('seller.orders-index', [ 'type' => 'all', 'orders' => $orders ]);
	}

	public function getWithStatus($status, Request $request) {
		$orders = Order::whereNotIn('status', ['INITIATED', 'FAILED'])->where('status', $status)->whereHas('seller_product', function($query) {
			$query->where('seller_id', Auth::user()->id);
		})->orderBy('created_at', 'desc');

		$orders = $orders->paginate(10);

		return view('seller.orders-index', [ 'type' => $status, 'orders' => $orders ]);
	}

	public function updateStatus($order_id, $status, Request $request) {
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
			}
		}
		return back();
	}

	public function updateLog($order, $remarks) {
		$log = OrderLog::create([
			'order_id' => $order->id,
			'status' => $order->status,
			'remarks' => $remarks
		]);
	}
}