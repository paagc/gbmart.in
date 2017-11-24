<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use Auth;
use Session;
use Cart;
use Validator;
use App\User;
use App\Order;
use App\OrderLog;
use App\SellerProduct;
use App\Address;
use App\Mail\OrderPlaced;

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

		$payment_reference = "";
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
		$validator =  Validator::make($request->all(), [
            'address' => 'required',
            'new_address' => 'required_if:address,new|array|size:5',
            'new_address.line_1' => 'required_if:address,new|max:50',
            'new_address.line_2' => 'required_if:address,new|max:50',
            'new_address.city_town' => 'required_if:address,new|max:20',
            'new_address.state' => 'required_if:address,new|max:20',
            'new_address.pin_code' => 'required_if:address,new',
            'payment_method' => 'required|in:COD,ONLINE'
        ]);

		if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

		$payment_method = $request->get('payment_method');
		$payment_reference = $request->get('payment_reference');
		$address_id = $request->get('address');
		$new_address = $request->get('new_address');

		$address = Address::where('user_id', Auth::user()->id)->where('id', $address_id)->first();
		if (is_null($address) && $address_id == "new") {
			$new_address['user_id'] = Auth::user()->id;
			$new_address['status'] = 'ACTIVE';
			$address = Address::create($new_address);
		}

		$status = "INITIATED";
		if ($payment_method == "COD") {
			$status = "PENDING";
		}

		$subtotal = 0;
		$total = 0;

		$cart_items = [];
		$payment_type_mismatch_seller_products = [];

		foreach(Cart::content()  as $item) {
			$seller_product = SellerProduct::find($item->id);
			if (!is_null($seller_product)) {
				if ($seller_product->is_cod_available == 0 && $payment_method == "COD") {
					array_push($payment_type_mismatch_seller_products, [
						'rowId' => $item->rowId,
						'seller_product' => $seller_product]
					);
				}
				if ($seller_product->is_online_payment_available  == 0 && $payment_method == "ONLINE") {
					array_push($payment_type_mismatch_seller_products, $seller_product);
				}
			}
		}

		if (count($payment_type_mismatch_seller_products) > 0) {
			Session::flash('payment_type_mismatch_seller_products', $payment_type_mismatch_seller_products);
			return back();
		}

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

				$order = Order::create([
					'customer_id' => Auth::user()->id,
					'product_id' => $seller_product->product->id,
					'seller_product_id' => $seller_product->id,
					'address' => $address->line_1 . ", " . $address->line_2,
					'city' => $address->city_town,
					'state' => $address->state,
					'postal_code' => $address->pin_code,
					'extra' => http_build_query($item->options->all(), '', ', '),
					'count' => $item->qty,
					'price' => $seller_product->seller_price,
					'delivery_charge' => $seller_product->delivery_charge,
					'total_amount' => ($item->price * $item->qty + $seller_product->delivery_charge),
					'payment_method' => $payment_method,
					'payment_reference' => $payment_reference,
					'status' => $status
				]);

				OrderLog::create([
					'order_id' => $order->id,
					'status' => $status,
					'remarks' => 'Order placed'
				]);
			}
		}

		$orders = Order::where('payment_reference', $payment_reference)->get();

		$user = Auth::user();

		$user->email = "gajubisen6@gmail.com";

		if(!is_null($user)) {
			$res = Mail::to($user)->send(new OrderPlaced([]));
		}

		return redirect('/store/pay/request/' . $payment_reference);
	}

	public function deleteAddress($address_id, Request $request) {
		$address = Address::find($address_id);
		if (!is_null($address)) {
			$address->status = "INACTIVE";
			$address->save();
		}

		return back();
	}

	public function testMail(Request $request) {
		$user = User::where('email', 'ajaykpradhan61@gmail.com')->first();

		if(!is_null($user)) {
			$res = Mail::to($user)->send(new OrderPlaced([]));
			dd($res);
		}

		return "Testing mail";
	}
}