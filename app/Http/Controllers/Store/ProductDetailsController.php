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
		} ])->orderBy('updated_at', 'desc')->limit(10)->get();

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
		} ])->orderBy('updated_at', 'desc')->limit(10)->get();

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

		$attributes = Attribute::where('product_id', $product->id)->where('status', 'ACTIVE')->get();

		if (!is_null($product)) {
			return view('store.product_details', [ 
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

	public function addToCart($seller_product_id, Request $request) {
		$seller_product = SellerProduct::find($seller_product_id);

		$options = $request->query();
		$quantity = 1;

		if ($request->has('quantity') && is_numeric($request->get('quantity'))) {
			$quantity = (int) $request->get('quantity');
		}

		if (!is_null($seller_product)) {
			$cart_item = null;

			foreach(Cart::content() as $item) {
				if ($item->id == $seller_product->id) {
					$cart_item = $item;
				}
			}

			if (is_null($cart_item)) {
				$options['image'] = $seller_product->product->product_images[0]->url;
				Cart::add($seller_product->id, $seller_product->product->display_name, $quantity, $seller_product->seller_price, $options);
			} else {
				$options['image'] = $seller_product->product->product_images[0]->url;
				$cart_item->qty = $cart_item->qty + $quantity;
				Cart::update($cart_item->rowId, [
					'id' => $cart_item->id,
					'name' => $cart_item->name,
					'qty' => $cart_item->qty,
					'price' => $cart_item->price,
					'options' => $cart_item->options
				]);
			}
		}

		return back();
	}

	public function removeFromCart($cart_row_id, Request $request) {
		Cart::remove($cart_row_id);

		return back();
	}
}