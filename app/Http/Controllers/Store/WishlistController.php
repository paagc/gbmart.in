<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Auth;
use Session;
use Cart;
use App\User;
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
use App\Wishlist;

class WishlistController extends Controller
{
	public function add($product_id, Request $request) {
		$product = Product::find($product_id);
		if (!is_null($product)) {
			$wishlist = Wishlist::where('product_id', $product_id)->where('customer_id', Auth::user()->id)->first();
			if (is_null($wishlist)) {
				Wishlist::create([
					'product_id' => $product->id,
					'customer_id' => Auth::user()->id,
					'status' => 'ACTIVE'
				]);
			} elseif ($wishlist->status != "ACTIVE") {
				$wishlist->status = "ACTIVE";
				$wishlist->save();			
			}
		}
		return back();
	}

	public function remove($product_id, Request $request) {
		$wishlist = Wishlist::where('product_id', $product_id)->where('customer_id', Auth::user()->id)->first();
		if (is_null($wishlist)) {
		} elseif ($wishlist->status == "ACTIVE") {
			$wishlist->status = "INACTIVE";
			$wishlist->save();			
		}
		return back();
	}

	public function getAll(Request $request) {
		$wishlist = Wishlist::where('customer_id', Auth::user()->id)->where('status', 'ACTIVE')
		->whereHas('product', function ($query) {
			$query->where('status', 'ACTIVE');
		})->orderBy('updated_at', 'desc')->get();

		return view('store.wishlist', [ 'wishlist' => $wishlist ]);
	}
}