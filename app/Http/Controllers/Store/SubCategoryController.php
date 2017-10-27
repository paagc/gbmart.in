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
use App\SellerProduct;
use App\ProductImage;
use App\Attribute;
use App\HomeSlide;
use App\Offer;

class SubCategoryController extends Controller
{
	public function getProducts($category_name, $sub_category_name, Request $request) {
		$page = 0;
		$page_size = 12;
		$price_range_min = 0;
		$price_range_max = 0;
		$price_min = 0;
		$price_max = 0;
		$brands = [];
		$selected_brands = [];

		$sub_category = SubCategory::where('status', 'ACTIVE')->where('name', $sub_category_name)
		->whereHas('category', function ($query) use ($category_name) {
			$query->where('name', $category_name);
		})->first();

		$products = Product::where('status', 'ACTIVE')
		->whereHas('category', function ($query) use ($category_name) {
			$query->where('name', $category_name);
		})->whereHas('sub_category', function ($query) use ($sub_category_name) {
			$query->where('name', $sub_category_name);
		})->whereHas('seller_products', function ($query) {
			$query->where('status', 'ACTIVE');
		})->orderBy('updated_at', 'desc');

		$brands = $products->pluck('brand');

		$tproducts = $products->get();
		foreach ($tproducts as $product) {
			foreach ($product->seller_products as $seller_product) {
				if ($seller_product->status = 'ACTIVE' && $seller_product->seller_price < $price_range_min) {
					$price_range_min = $seller_product->seller_price;
				}
				if ($seller_product->status = 'ACTIVE' && $seller_product->seller_price > $price_range_max) {
					$price_range_max = $seller_product->seller_price;
				}
			}
		}

		$price_max = $price_range_max;
		$price_min = $price_range_min;

		if ($request->has('price_min') && is_numeric($request->get('price_min'))) {
			$price_min = $request->get('price_min');
		}

		if ($request->has('price_max') && is_numeric($request->get('price_max'))) {
			$price_max = $request->get('price_max');
		}

		if (count($selected_brands) > 0) {
			$products = $products->whereIn('brand', $selected_brands);
		}

		$products = $products->with([ 'seller_products' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('seller_price', 'asc');
		}, 'product_images' => function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('id', 'asc');
		} ])->get();

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
		} ])->orderBy('updated_at', 'desc')->limit(10)->get();

		if (!is_null($sub_category)) {
			return view('store.sub-category', [ 
				'sub_category' => $sub_category,
				'products' => $products,
				'hot_deal_products' => $hot_deal_products,
				'page' => $page,
				'page_size' => $page_size,
				'price_range_min' => $price_range_min,
				'price_range_max' => $price_range_max,
				'price_min' => $price_min,
				'price_max' => $price_max,
				'brands' => $brands,
				'selected_brands' => $selected_brands
			]);
		} else {
			return abort(404);
		}
	}
}