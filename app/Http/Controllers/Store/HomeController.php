<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Route;
use Session;
use Carbon\Carbon;
use App\Category;
use App\SubCategory;
use App\Product;
use App\ProductImage;
use App\Attribute;
use App\HomeSlide;
use App\Offer;

class HomeController extends Controller
{
	public function getHome(Request $request) {
		$categories = Category::with(['sub_categories' => function($query) { $query->where('status', 'ACTIVE')->orderBy('id', 'asc'); }])->whereHas('sub_categories', function ($query) { $query->where('status', 'ACTIVE'); })->where('status', 'ACTIVE')->orderBy('id', 'asc')->get();

		$home_slides = HomeSlide::where('status', 'ACTIVE')->orderBy('updated_at', 'desc')->get();

		$offers = Offer::where('status', 'ACTIVE')->where('start_date', '>=', Carbon::now()->toDateString())
			->where('end_date', '<=', Carbon::now()->toDateString())->orderBy('updated_at', 'desc')->limit(5)->get();

		$hot_deal_products = Product::where('status', 'ACTIVE')->where('is_hot_deal', true)->whereHas('seller_products', function ($query) {
			$query->where('status', 'ACTIVE');
		})->with([ 'seller_products' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('seller_price', 'asc');
		}, 'product_images' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('id', 'asc');
		} ])->orderBy('updated_at', 'desc')->limit(10)->get();

		$featured_products = Product::where('status', 'ACTIVE')->where('is_featured', true)->whereHas('seller_products', function ($query) {
			$query->where('status', 'ACTIVE');
		})->with([ 'seller_products' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('seller_price', 'asc');
		}, 'product_images' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('id', 'asc');
		} ])->orderBy('updated_at', 'desc')->limit(10)->get();

		$bestseller_products = Product::where('status', 'ACTIVE')->where('is_bestseller', true)->whereHas('seller_products', function ($query) {
			$query->where('status', 'ACTIVE');
		})->with([ 'seller_products' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('seller_price', 'asc');
		}, 'product_images' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('id', 'asc');
		} ])->orderBy('updated_at', 'desc')->limit(10)->get();

		$new_products = Product::where('status', 'ACTIVE')->where('created_at', '>=', Carbon::now()->subDays(5)->toDateString())->whereHas('seller_products', function ($query) {
			$query->where('status', 'ACTIVE');
		})->with([ 'seller_products' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('seller_price', 'asc');
		}, 'product_images' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('id', 'asc');
		} ])->orderBy('updated_at', 'desc')->limit(10)->get();

		return view('store.home', [ 
			'categories' => $categories,
			'home_slides' => $home_slides,
			'offers' => $offers,
			'hot_deal_products' => $hot_deal_products,
			'featured_products' => $featured_products,
			'bestseller_products' => $bestseller_products,
			'new_products' => $new_products
		]);
	}
}
