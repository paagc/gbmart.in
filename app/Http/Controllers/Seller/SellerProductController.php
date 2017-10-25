<?php

namespace App\Http\Controllers\Seller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use App\Category;
use App\SubCategory;
use App\Product;
use App\ProductImage;
use App\Attribute;
use App\SellerProduct;

class SellerProductController extends Controller
{
	public function index(Request $request) {
		$page = 1;
		$page_size = 15;

		$categories = Category::where('status', 'ACTIVE')->get();
		$sub_categories = SubCategory::whereHas('category', function ($query) {
			$query->where('status', 'ACTIVE');
		})->where('status', 'ACTIVE')->orderBy('id', 'asc')->get();

		$products = Product::whereHas('category', function ($query) {
			$query->where('status', 'ACTIVE');
		})->whereHas('sub_category', function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('id', 'asc');
		})->orderBy('id', 'asc')->get();

		$seller_products = SellerProduct::where('id','>',0);

		// $seller_products = SellerProduct::whereHas('product', function ($query) {
		// 	$query->whereHas('category', function ($query) {
		// 		$query->where('status', 'ACTIVE');
		// 	})->whereHas('sub_category', function ($query) {
		// 		$query->where('status', 'ACTIVE');
		// 	})->where('status', 'ACTIVE');
		// })->orderBy('id', 'asc');

		// if($request->has('display_name') && strlen($request->get('display_name')) > 0) {
		// 	$seller_products = $seller_products->whereHas('product', function ($query) use ($request) {
		// 		$query->where('display_name', 'like', '%' . $request->get('display_name') . '%');
		// 	});
		// }

		// if($request->has('brand') && strlen($request->get('brand')) > 0) {
		// 	$seller_products = $seller_products->whereHas('product', function ($query) use ($request) {
		// 		$query->where('brand', 'like', '%' . $request->get('brand') . '%');
		// 	});
		// }

		// if($request->has('category_name') && strlen($request->get('category_name')) > 0) {
		// 	$seller_products = $seller_products->whereHas('product', function ($query) use ($request) {
		// 		$query->whereHas('category', function ($query) use ($request) {
		// 			$query->where('name', $request->get('category_name'));
		// 		});
		// 	});
		// }

		// if($request->has('sub_category_name') && strlen($request->get('sub_category_name')) > 0) {
		// 	$seller_products = $seller_products->whereHas('product', function ($query) use ($request) {
		// 		$query->whereHas('sub_category', function ($query) use ($request) {
		// 			$query->where('name', $request->get('sub_category_name'));
		// 		});
		// 	});
		// }

		if($request->has('status') && strlen($request->get('status')) > 0) {
			$seller_products = $seller_products->where('status', $request->get('status'));
		}

		$seller_products = $seller_products->paginate($page_size);

		return view('seller.seller-products-index', [
			'page' => $page,
			'page_size' => $page_size,
			'seller_products' => $seller_products,
			'products' => $products,
			'categories' => $categories,
			'sub_categories' => $sub_categories
		]);	
	}

	public function getCreate(Request $request) {
		$seller_product_ids = SellerProduct::where('seller_id', Auth::user()->id)->pluck('product_id');

		$products = Product::whereHas('category', function ($query) {
			$query->where('status', 'ACTIVE');
		})->whereHas('sub_category', function ($query) {
			$query->where('status', 'ACTIVE')->orderBy('id', 'asc');
		})->whereNotIn('id', $seller_product_ids)->orderBy('id', 'asc')->get();

		$product = null;

		if ($request->has('product_id')) {
			$product = Product::find($request->get('product_id'));
		}

		return view('seller.seller-products-create', [ 'products' => $products, 'product' => $product ]);
	}

	public function postCreate(Request $request) {
		dd($request);
		$product_id = 0;
		$seller_id = Auth::user()->id;
		$seller_price = 0;
		$delivery_charge = 0;
		$is_in_stock = false;
		$is_cod_available = false;
		$is_online_payment_available = false;
		$status = "ACTIVE";

		if ($request->has('product_id') && is_numeric((int) ($request->get('product_id')))) {
			$product_id = $request->get('product_id');
		} else {
			Session::flash('error', 'Product is required.');
			return redirect()->back()->withInput();
		}

		if ($request->has('seller_price') && is_numeric((int) ($request->get('seller_price')))) {
			$seller_price = $request->get('seller_price');
		} else {
			Session::flash('error', 'Seller price is invalid.');
			return redirect()->back()->withInput();
		}

		if ($request->has('delivery_charge') && is_numeric((int) ($request->get('delivery_charge')))) {
			$delivery_charge = $request->get('delivery_charge');
		} else {
			Session::flash('error', 'Delivery charge is invalid.');
			return redirect()->back()->withInput();
		}

		if ($request->has('is_in_stock') && $request->get('is_in_stock') == "true") {
			$is_in_stock = true;
		}

		if ($request->has('is_cod_available') && $request->get('is_cod_available') == "true") {
			$is_cod_available = true;
		}

		if ($request->has('is_online_payment_available') && $request->get('is_online_payment_available') == "true") {
			$is_online_payment_available = true;
		}

		$seller_product = SellerProduct::create([
			'product_id' => $product_id,
			'seller_id' => $seller_id,
			'seller_price' => $seller_price,
			'delivery_charge' => $delivery_charge,
			'is_in_stock' => $is_in_stock,
			'is_cod_available' => $is_cod_available,
			'is_online_payment_available' => $is_online_payment_available,
			'status' => $status
		]);

		// if ($request->has('attributes') && is_array($request->get('attributes'))) {
		// 	foreach($request->get('attributes') as $attribute) {
		// 		if (strlen($attribute) > 0) {
		// 			Attribute::create([
		// 				'product_id' => $product->id,
		// 				'name' => $attribute,
		// 				'description' => '',
		// 				'status' => 'ACTIVE'
		// 			]);
		// 		}
		// 	}
		// }

		Session::flash('success', 'Product successfully created.');
		return redirect()->back();
	}

	public function changeStatus($seller_product_id, $status, Request $request) {
		$seller_product = SellerProduct::find($seller_product_id);
		if (!is_null($seller_product_id) && ($status == 'ACTIVE' || $status == 'INACTIVE')) {
			$seller_product->status = $status;
			$seller_product->save();
		}
		return redirect('/seller/seller-products');
	}
}