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
use App\Order;
use App\Wishlist;

class MyAccountController extends Controller
{
	public function view(Request $request) {
		// dd($request);
		$user = Auth::user();
		$orders = Order::where('customer_id', $user->id)->whereNotIn('status', [ 'INITIATED', 'FAILED' ])->orderBy('created_at', 'desc')->get();

		return view('store.account', [
			'user' => $user,
			'orders' => $orders
		]);
	}
}