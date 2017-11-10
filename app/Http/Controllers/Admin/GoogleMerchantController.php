<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use Google;
use App\User;
use App\SellerProduct;

class GoogleMerchantController extends Controller
{
	protected $merchant_id = "114635174";

	public function show(Request $request) {
		$client = new \Google_Client();
		$client->setApplicationName(env('GOOGLE_APPLICATION_NAME'));
		$client->setClientId(env('GOOGLE_CLIENT_ID'));
		$client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
		// $client->setAccessToken('GOOGLE_DEVELOPER_KEY');
		$client->setRedirectUri($request->url());
		$client->setScopes('https://www.googleapis.com/auth/content');

		if(session()->has('oauth_access_token')) {
			dd(session());
			$client->setAccessToken(session()->get('oauth_access_token'));
			$this->getProducts($client, $request);
		} elseif ($request->has('code')) {
			$token = $client->authenticate($request->get('code'));
			$_SESSION['oauth_access_token'] = $token;
			session('oauth_access_token', $token);
			$client->setAccessToken($token);
			$this->getProducts($client, $request);
		} else {
			return redirect($client->createAuthUrl());
		}
	}

	public function getProducts($client, Request $request) {
		$shopping_content = new \Google_Service_ShoppingContent($client);

		$existingProducts = $shopping_content->products->listProducts($this->merchant_id);
		$existingProducts = $existingProducts->resources;
		return view('admin.google-merchant-producst', [ 'existingProducts' => $existingProducts ]);
	}

	public function save(Request $request) {
		return "Hi";
	}
}
