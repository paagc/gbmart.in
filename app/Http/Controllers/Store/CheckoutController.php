<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use Cart;
use App\User;
use App\Order;
use App\SellerProduct;

class CheckoutController extends Controller
{
	public function get(Request $request) {
		$subtotal = 0;
		$total = 0;

		$cart_items = [];
		foreach(Cart::content()  as $item) {
			$seller_product = SellerProduct::find($item->id);
			if (!is_null($seller_product)) {
				array_push($cart_items, [
					'seller_product' => $seller_product,
					'quantity' => $item->qty,
					'options' => $item->options
				]);
				$subtotal += $item->qty * $seller_product->seller_price;
				$total += $item->qty * $seller_product->seller_price + $seller_product->delivery_charge;
			}
		}

		$addresses = Auth::user()->addresses;

		$payment_reference = 
		$existingOrderWithSamePaymentReference = [];

		do {
			$payment_reference = str_random(10);
			$existingOrderWithSamePaymentReference = Order::where('payment_reference', $payment_reference)->get();
		} while (count($existingOrderWithSamePaymentReference) > 0);

		return view('store.checkout', [ 
			'cart_items' => $cart_items, 
			'subtotal' => $subtotal, 
			'total' => $total,
			'addresses' => $addresses,
			'payment_reference' => $payment_reference
		]);
	}

	public function post(Request $request) {
		dd($request);
		$payment_method = $request->get('payment_method');
		$payment_reference = $request->get('payment_reference');
		$address = $request->get('address');
		$status = "INITIATED";
		if ($payment_method == "COD") {
			$status = "PENDING";
		}

		$subtotal = 0;
		$total = 0;

		$cart_items = [];
		foreach(Cart::content()  as $item) {
			$seller_product = SellerProduct::find($item->id);
			if (!is_null($seller_product)) {
				array_push($cart_items, [
					'seller_product' => $seller_product,
					'quantity' => $item->qty,
					'options' => $item->options
				]);
				$subtotal += $item->qty * $seller_product->seller_price;
				$total += $item->qty * $seller_product->seller_price + $seller_product->delivery_charge;
			}
		}

		return back();
	}
}