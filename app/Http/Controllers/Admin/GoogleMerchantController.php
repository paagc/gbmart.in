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
	public function show(Request $request) {
		$client = new \Google_Client();
		$client->setApplicationName(env('GOOGLE_APPLICATION_NAME'));
		$client->setClientId(env('GOOGLE_CLIENT_ID'));
		$client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
		$client->setAccessToken('GOOGLE_DEVELOPER_KEY');
		$client->setRedirectUri($request->fullUrl());
		$client->setScopes('https://www.googleapis.com/auth/content');

		if (isset($_SESSION['oauth_access_token'])) {
		  $client->setAccessToken($_SESSION['oauth_access_token']);
		  $this->getProducts($request);
		} elseif (isset($_GET['code'])) {
		  $token = $client->authenticate($_GET['code']);
		  $_SESSION['oauth_access_token'] = $token;
		  $request->session()->put('oauth_access_token', $token);
		  $this->getProducts($request);
		} else {
		  return redirect($client->createAuthUrl());
		}
	}

	public function getProducts(Request $request) {
		dd($request->session()->all());
		$shopping_content = Google::make('ShoppingContent');

		$existingProducts = $shopping_content->products->listProducts('114635174');
		dd($existingProducts);
		return view('admin.google-merchant-producst');
	}

	public function save(Request $request) {
		return "Hi";
	}
}
