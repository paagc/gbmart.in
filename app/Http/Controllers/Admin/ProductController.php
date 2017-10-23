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
		$sub_categories = SubCategory::orderBy('id', 'asc');

		if($request->has('display_name')) {
			$sub_categories = $sub_categories->where('display_name', 'like', '%' . $request->get('display_name') . '%');
		}

		if($request->has('name')) {
			$sub_categories = $sub_categories->where('name', 'like', '%' . $request->get('name') . '%');
		}

		if($request->has('category_name')) {
			$sub_categories = $sub_categories->whereHas('category', function ($query) use ($request) {
				$query->where('name', $request->get('category_name'));
			});
		}

		if($request->has('status')) {
			$sub_categories = $sub_categories->where('status', $request->get('status'));
		}

		$sub_categories = $sub_categories->paginate($page_size);

		return view('admin.sub-categories-index', [
			'page' => $page,
			'page_size' => $page_size,
			'categories' => $categories,
			'sub_categories' => $sub_categories
		]);	
	}

	public function getCreate(Request $request) {

	}

	public function postCreate(Request $request) {

	}
}