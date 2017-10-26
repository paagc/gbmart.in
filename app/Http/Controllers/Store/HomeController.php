<?php

namespace App\Http\Controllers\Store;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Route;
use Session;
use App\Category;
use App\SubCategory;
use App\Product;
use App\ProductImage;
use App\Attribute;

class HomeController extends Controller
{
	public function getHome(Request $request) {
		$categories = Category::with(['sub_categories' => function($query) { $query->where('status', 'ACTIVE')->orderBy('id', 'asc'); }])->whereHas('sub_categories', function ($query) { $query->where('status', 'ACTIVE'); })->where('status', 'ACTIVE')->orderBy('id', 'asc')->get();

		return view('store.home', [ 'categories' => $categories ]);
	}
}
