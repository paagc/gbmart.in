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
use App\Address;

class PaymentController extends Controller
{
	protected $ebs_secret_key = "0b6f61afae9669a3e8de59aeaae61b9e";

	protected $parameters = [
		"channel" => "0",
		"account_id" => "23469",
		"reference_no" => "",
		"amount" => "",
		"currency" => "INR",
		"display_currency" => "",
		"display_currency_rates" => "",
		"description" => "",
		"return_url" => "",
		"mode" => "LIVE",
		"payment_mode" => "",
		"card_brand" => "",
		"payment_option" => "",
		"bank_code" => "",
		"emi" => "",
		"page_id" => "",
		"name" => "",
		"address" => "",
		"city" => "",
		"state" => "",
		"postal_code" => "",
		"country" => "IND",
		"email" => "",
		"phone" => "",
		"ship_name" => "",
		"ship_address" => "",
		"ship_city" => "",
		"ship_state" => "",
		"ship_postal_code" => "",
		"ship_country" => "",
		"ship_phone" => "",
		"secure_hash" => ""
	];

	public function request($payment_reference, Request $request) {
		// dd($request);
		$orders = Order::where("payment_reference", $payment_reference)->get();
		$parameters = $this->parameters;
		$status = "";
		$payment_method = "";
		if (count($orders) > 0) {
			// $parameters['_token'] = csrf_token();
			$parameters['reference_no'] = $payment_reference;
			$parameters['amount'] = 0;
			$parameters['description'] = "Payment of order for " . Auth::user()->email . " , " . $payment_reference . ", on " . date('d-M-y');
			$parameters['return_url'] = $request->root() . '/store/pay/response/' . $payment_reference;
			$parameters['name'] = Auth::user()->name;
			$parameters['email'] = Auth::user()->email;
			$parameters['phone'] = Auth::user()->mobile_number;

			foreach($orders as $index => $order) {
				if ($index == 0) {
					$parameters['address'] = $order->address;
					$parameters['city'] = $order->city;
					$parameters['state'] = $order->state;
					$parameters['postal_code'] = $order->postal_code;
					$status = $order->status;
					$payment_method = $order->payment_method;
				}
				$parameters['amount'] += $order->total_amount;
			}


			// For testing
			// $parameters['amount'] = 1;

			$hashData = $this->ebs_secret_key;
			ksort($parameters);
			foreach ($parameters as $key => $value){
				if (strlen($value) > 0) {
					$hashData .= '|'.$value;
				}
			}
			if (strlen($hashData) > 0) {
				$parameters['secure_hash'] = strtoupper(hash("sha512", $hashData));//for SHA512
			}

			if ($status == "PENDING" && $payment_method == "COD") {
				Cart::destroy();
				return redirect('/')->with('message', 'Your order is successful.');
			} else if ($status == "INITIATED" && $payment_method == "ONLINE") {
				return view('store.pay-request', [ 'parameters' => $parameters ]);
			} else {
				return abort(400);
			}
		} else {
			return abort(404);
		}
	}

	public function response($payment_reference, Request $request) {
		// dd($request);
		if ($request->has('ResponseCode')) {
			if ($request->get('ResponseCode') == '0') {
				Cart::destroy();
				$orders = Order::where('payment_reference', $payment_reference)->get();
				foreach($orders as $order) {
					$order->status = "PENDING";
					$order->save();
				}
			} else {
				$orders = Order::where('payment_reference', $payment_reference)->get();
				foreach($orders as $order) {
					$order->status = "FAILED";
					$order->save();
				}
			}
		}
		return view('store.pay-response');
	}
}