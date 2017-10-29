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
	protected $ebs_secret_key = "";

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
		"mode" => "TEST",
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
		"ship_phone" => ""
	];

	public function request(Request $request) {

		dd($request);
	}

	public function response(Request $request) {
		dd($request);
	}
}