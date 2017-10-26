<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Route;
use Session;
use App\Category;
use App\SubCategory;

class SubCategoryController extends Controller
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
		})->orderBy('id', 'asc');

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
		$categories = Category::where('status', 'ACTIVE')->get();
		return view('admin.sub-categories-create', [
			'categories' => $categories
		]);
	}

	public function postCreate(Request $request) {
		$category_id = 0;
		$display_name = "";

		if ($request->has('category_id')) {
			$category_id = $request->get('category_id');
		}

		if ($request->has('display_name')) {
			$display_name = $request->get('display_name');
		}

		$name = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $display_name))))), '-'));

		$status = 'ACTIVE';

		$category = Category::find($category_id);

		if (is_null($category)) {
			Session::flash('error', 'Category selected is invalid.');
			return redirect()->back()->withInput();
		}

		if (strlen($display_name) < 3) {
			Session::flash('error', 'Name is too small.');
			return redirect()->back()->withInput();
		}

		if (strlen($name) < 3) {
			Session::flash('error', 'Slug name created too small.');
			return redirect()->back()->withInput();
		}

		$existingSubCategory = SubCategory::where('name', $name)->first();

		if(!is_null($existingSubCategory)) {
			Session::flash('error', 'Slug name created already exists. Try to change the name.');
			return redirect()->back()->withInput();
		}

		SubCategory::create([
			'category_id' => $category->id,
			'name' => $name,
			'display_name' => $display_name,
			'status' => $status
		]);

		Session::flash('success', 'Sub category successfully created.');
		return redirect()->back();
	}

	public function changeStatus(Request $request, $sub_category_id, $status) {
		$sub_category = SubCategory::find($sub_category_id);
		// $status = $request->get('status');
		if (!is_null($sub_category) && ($status == 'ACTIVE' || $status == 'INACTIVE')) {
			$sub_category->status = $status;
			$sub_category->save();
		}
		return redirect('/admin/sub-categories');
	}
}