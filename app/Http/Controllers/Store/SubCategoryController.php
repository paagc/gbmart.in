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
		// dd($request);
		$page = 1;
		$page_size = 12;
		$page_count = 1;
		$price_range_min = 0;
		$price_range_max = 0;
		$price_min = 0;
		$price_max = 0;
		$brands = [];
		$selected_brands = [];

		if ($request->has('page') && is_numeric($request->get('page'))) {
			$page = (int) $request->get('page');
		}

		if ($request->has('selected_brands') && is_array($request->get('selected_brands'))) {
			$selected_brands = $request->get('selected_brands');
		}

		$sub_category = SubCategory::where('status', 'ACTIVE')->where('name', $sub_category_name)
		->whereHas('category', function ($query) use ($category_name) {
			$query->where('name', $category_name);
		})->first();

		$seller_products = SellerProduct::where('status', 'ACTIVE')
		->whereHas('product.category', function ($query) use ($category_name) {
			$query->where('name', $category_name);
		})->whereHas('product.sub_category', function ($query) use ($sub_category_name) {
			$query->where('name', $sub_category_name);
		});


		$brands = clone $seller_products;
		$brands = $brands->with('product')->get()->pluck('product.brand');
		$brand_list = $brands;
		$brands = [];

		foreach ($brand_list as $brand) {
			if (!in_array($brand, $brands)) {
				array_push($brands, $brand);
			}
		}
		sort($brands);

		$seller_products = $seller_products->orderBy('updated_at', 'desc');

		$tseller_products = $seller_products->get();
		foreach ($tseller_products as $seller_product) {
			if ($seller_product->seller_price < $price_range_min) {
				$price_range_min = $seller_product->seller_price;
			}
			if ($seller_product->seller_price > $price_range_max) {
				$price_range_max = $seller_product->seller_price;
			}
		}

		$price_max = $price_range_max;
		$price_min = $price_range_min;

		if ($request->has('price_min') && is_numeric($request->get('price_min'))) {
			$price_min = (int) $request->get('price_min');
		}

		if ($request->has('price_max') && is_numeric($request->get('price_max'))) {
			$price_max = (int) $request->get('price_max');
		}

		$seller_products = $seller_products->whereHas('product', function ($query) use ($selected_brands, $price_min, $price_max, $price_range_min, $price_range_max) {

			$query->where('status', 'ACTIVE');

			if (count($selected_brands) > 0) {
				$query->whereIn('brand', $selected_brands);
			}
		});

		if ($price_min != $price_range_min && $price_min > 0) {
			$seller_products = $seller_products->where('seller_price', '>=', $price_min);
		}
		if ($price_max != $price_range_max && $price_range_max > 0) {
			$seller_products = $seller_products->where('seller_price', '<=', $price_max);
		}

		$seller_products = $seller_products->whereHas('product.product_images', function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('id', 'asc');
		});

		$count = $seller_products->count();
		$page_count = ($count / $page_size) + ((($count % $page_size) > 0) ? 1 : 0);

		$seller_products = $seller_products->skip(($page - 1) * $page_size)->limit($page_size)->get();

		$featured_products = SellerProduct::where('status', 'ACTIVE')->whereHas('product', function ($query) {
			$query->where('status', 'ACTIVE')->where('is_featured', true);
		})->whereHas('product.product_images', function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('id', 'asc');
		})->whereHas('product.sub_category', function ($query) use ($sub_category_name) {
			$query->where('status', 'ACTIVE')->where('name', $sub_category_name);
		})->whereHas('product.sub_category.category', function ($query) use ($category_name) {
			$query->where('status', 'ACTIVE')->where('name', $category_name);
		})->orderBy('updated_at', 'desc')->limit(6)->get();

		if (!is_null($sub_category)) {
			return view('store.sub-category', [ 
				'sub_category' => $sub_category,
				'seller_products' => $seller_products,
				'featured_products' => $featured_products,
				'page' => $page,
				'page_size' => $page_size,
				'page_count' => $page_count,
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