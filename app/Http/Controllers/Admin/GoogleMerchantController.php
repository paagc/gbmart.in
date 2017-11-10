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

	protected $token = null;

	public function show(Request $request) {
		$client = new \Google_Client();
		$client->setApplicationName(env('GOOGLE_APPLICATION_NAME'));
		$client->setClientId(env('GOOGLE_CLIENT_ID'));
		$client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
		// $client->setAccessToken('GOOGLE_DEVELOPER_KEY');
		$client->setRedirectUri($request->url());
		$client->setScopes('https://www.googleapis.com/auth/content');

		if ($request->has('code')) {
			$token = $client->authenticate($request->get('code'));
			$_SESSION['oauth_access_token'] = $token;
			session('oauth_access_token', $token);
			$this->token = $token;
			return redirect($request->url() . '?access_token=' . $token['access_token']);
		} elseif ($request->has('access_token')) {
			$token = $request->get('access_token');
			$client->setAccessToken($token);
			return $this->getProducts($client, $request);
		} else {
			return redirect($client->createAuthUrl());
		}
	}

	public function getProducts($client, Request $request) {
		$access_token = json_encode($client->getAccessToken());

		$shopping_content = new \Google_Service_ShoppingContent($client);

		$existingProducts = $shopping_content->products->listProducts($this->merchant_id);
		$existingProducts = $existingProducts->resources;

		$inputProducts = [];
		$seller_products = SellerProduct::where('status', 'ACTIVE')->with([ 'product' => function($query) {
			$query->where('status', 'ACTIVE');
		}, 'product.product_images' => function($query) {
			$query->where('status', 'ACTIVE');
		} ])->whereHas('product.category', function($query) {
			$query->where('status', 'ACTIVE');
		})->whereHas('product.sub_category', function($query) {
			$query->where('status', 'ACTIVE');
		})->orderBy('id', 'asc')->get();

		foreach($seller_products as $seller_product) {
			$googleProductCategory = "";
			if (strpos($seller_product->product->sub_category->name, 'mobile') !== false) {
				$googleProductCategory = "267";
			} elseif (true) {

			}

			if (strlen($googleProductCategory) > 0) {
				array_push($inputProducts, [
					'offerId' => $seller_product->id,
					'title' => $seller_product->product->display_name,
					'description' => $seller_product->product->description_small,
					'link' => 'https://www.gbmart.in' . '/store/' . $seller_product->product->category->name . '/' . $seller_product->product->sub_category->name . '/' . $seller_product->product->name . '-' . $seller_product->id . '',
					'condition' => 'new',
					'price.currency' => 'INR',
					'price.value' => $seller_product->seller_price,
					'availability' => ($seller_product->is_in_stock ? 'in stock' : 'out of stock'),
					'imageLink' => $seller_product->product->product_images[0]->url,
					'brand' => $seller_product->product->brand,
					'googleProductCategory' => $googleProductCategory,
					'destinations' => [
						0 => [
							'destinationName' => 'Shopping',
							'intention' => 'required'
						]
					]
				]);
			}
		}

		return view('admin.google-merchant-products', [ 'google_access_token' => $access_token, 'existingProducts' => $existingProducts, 'inputProducts' => $inputProducts ]);
	}

	public function save(Request $request) {
		$token = json_decode($request->get('access_token'), true);

		$productIds = $request->get('productIds');

		$client = new \Google_Client();
		$client->setApplicationName(env('GOOGLE_APPLICATION_NAME'));
		$client->setClientId(env('GOOGLE_CLIENT_ID'));
		$client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
		$client->setAccessToken($token);
		$client->setRedirectUri($request->url());
		$client->setScopes('https://www.googleapis.com/auth/content');

		$shopping_content = new \Google_Service_ShoppingContent($client);

		$existingProducts = $shopping_content->products->listProducts($this->merchant_id);
		$existingProducts = $existingProducts->resources;

		foreach ($existingProducts as $product) {
			$shopping_content->products->delete($this->merchant_id, $product->id);
		}

		$inputProducts = [];
		$seller_products = SellerProduct::where('status', 'ACTIVE')->whereIn('id', $productIds)->with([ 'product' => function($query) {
			$query->where('status', 'ACTIVE');
		}, 'product.product_images' => function($query) {
			$query->where('status', 'ACTIVE');
		} ])->whereHas('product.category', function($query) {
			$query->where('status', 'ACTIVE');
		})->whereHas('product.sub_category', function($query) {
			$query->where('status', 'ACTIVE');
		})->orderBy('id', 'asc')->get();

		foreach($seller_products as $seller_product) {
			$googleProductCategory = "";
			if (strpos($seller_product->product->sub_category->name, 'mobile') !== false) {
				$googleProductCategory = "267";
			} elseif (true) {

			}

			if (strlen($googleProductCategory) > 0) {
				array_push($inputProducts, [
					'offerId' => $seller_product->id,
					'title' => $seller_product->product->display_name,
					'description' => $seller_product->product->description_small,
					'link' => 'https://www.gbmart.in' . '/store/' . $seller_product->product->category->name . '/' . $seller_product->product->sub_category->name . '/' . $seller_product->product->name . '-' . $seller_product->id . '',
					'condition' => 'new',
					'price.currency' => 'INR',
					'price.value' => $seller_product->seller_price,
					'availability' => ($seller_product->is_in_stock ? 'in stock' : 'out of stock'),
					'imageLink' => $seller_product->product->product_images[0]->url,
					'brand' => $seller_product->product->brand,
					'googleProductCategory' => $googleProductCategory,
					'destinations' => [
						0 => [
							'destinationName' => 'Shopping',
							'intention' => 'required'
						]
					]
				]);
			}
		}

		foreach($inputProducts as $product) {
			$insert_data = json_encode($product);
			$shopping_content->products->inser($this->merchant_id, $insert_data);
		}

		return redirect('/admin/google-merchant-products?access_token=' . $token['access_token']);
	}
}
