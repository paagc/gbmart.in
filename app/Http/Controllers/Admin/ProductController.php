<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Route;
use Session;
use App\Category;
use App\SubCategory;
use App\Product;
use App\ProductImage;
use App\Attribute;

class ProductController extends Controller
{
	public function index(Request $request) {
		$page = 1;
		$page_size = 15;

		if ($request->has('page')) {
			$page = $request->get('page');
		}

		$categories = Category::where('status', 'ACTIVE')->get();
		$sub_categories = SubCategory::whereHas('category', function ($query) {
			$query->where('status', 'ACTIVE');
		})->where('status', 'ACTIVE')->orderBy('id', 'asc');

		$sub_categories = $sub_categories->paginate($page_size);

		return view('admin.products-index', [
			'page' => $page,
			'page_size' => $page_size,
			'categories' => $categories,
			'sub_categories' => $sub_categories
		]);	
	}

	public function getCreate(Request $request) {
		$sub_categories = SubCategory::whereHas('category', function ($query) {
			$query->where('status', 'ACTIVE');
		})->where('status', 'ACTIVE')->orderBy('id', 'asc')->get();
		return view('admin.products-create', [ 'sub_categories' => $sub_categories ]);
	}

	public function postCreate(Request $request) {
		dd($request);
	}
}