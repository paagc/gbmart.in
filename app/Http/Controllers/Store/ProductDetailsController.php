<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Cart;
use Route;
use Session;
use Carbon\Carbon;
use App\Category;
use App\SubCategory;
use App\Product;
use App\ProductImage;
use App\SellerProduct;
use App\Attribute;
use App\AttributeValue;
use App\HomeSlide;
use App\Offer;

class ProductDetailsController extends Controller
{
	public function getProductDetails($category_name, $sub_category_name, $product_name, Request $request) {

		$product = Product::where('status', 'ACTIVE')->where('name', $product_name)
		->whereHas('category', function ($query) use ($category_name) {
			$query->where('name', $category_name);
		})->whereHas('sub_category', function ($query) use ($sub_category_name) {
			$query->where('name', $sub_category_name);
		})->whereHas('seller_products', function ($query) {
			$query->where('status', 'ACTIVE');
		})->with([ 'seller_products' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('seller_price', 'asc');
		}, 'product_images' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('id', 'asc');
		} ])->orderBy('updated_at', 'desc')->first();

		$hot_deal_products = Product::where('status', 'ACTIVE')->where('is_hot_deal', true)
		->whereHas('category', function ($query) use ($category_name) {
			$query->where('name', $category_name);
		})->whereHas('sub_category', function ($query) use ($sub_category_name) {
			$query->where('name', $sub_category_name);
		})->whereHas('seller_products', function ($query) {
			$query->where('status', 'ACTIVE');
		})->with([ 'seller_products' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('seller_price', 'asc');
		}, 'product_images' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('id', 'asc');
		} ])->orderBy('updated_at', 'desc')->limit(4)->get();

		$featured_products = Product::where('status', 'ACTIVE')->where('is_featured', true)
		->whereHas('category', function ($query) use ($category_name) {
			$query->where('name', $category_name);
		})->whereHas('sub_category', function ($query) use ($sub_category_name) {
			$query->where('name', $sub_category_name);
		})->whereHas('seller_products', function ($query) {
			$query->where('status', 'ACTIVE');
		})->with([ 'seller_products' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('seller_price', 'asc');
		}, 'product_images' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('id', 'asc');
		} ])->orderBy('updated_at', 'desc')->limit(6)->get();

		$related_products = Product::where('status', 'ACTIVE')
		->whereHas('category', function ($query) use ($category_name) {
			$query->where('name', $category_name);
		})->whereHas('sub_category', function ($query) use ($sub_category_name) {
			$query->where('name', $sub_category_name);
		})->whereHas('seller_products', function ($query) {
			$query->where('status', 'ACTIVE');
		})->with([ 'seller_products' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('seller_price', 'asc');
		}, 'product_images' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('id', 'asc');
		}])->orderBy('updated_at', 'desc')->limit(10)->get();

		if (!is_null($product)) {
			$attributes = Attribute::where('product_id', $product->id)->where('status', 'ACTIVE')->get();

			return view('store.product-details', [ 
				'main_product' => $product,
				'hot_deal_products' => $hot_deal_products,
				'featured_products' => $featured_products,
				'related_products' => $related_products,
				'attributes' => $attributes
			]);
		} else {
			return abort(404);
		}
	}
}