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

		$categories = Category::where('status', 'ACTIVE')->get();
		$sub_categories = SubCategory::whereHas('category', function ($query) {
			$query->where('status', 'ACTIVE');
		})->where('status', 'ACTIVE')->orderBy('id', 'asc')->get();

		$products = Product::whereHas('category', function ($query) {
			$query->where('status', 'ACTIVE');
		})->whereHas('sub_category', function ($query) {
			$query->where('status', 'ACTIVE');
		});

		if($request->has('display_name') && strlen($request->get('display_name')) > 0) {
			$products = $products->where('display_name', 'like', '%' . $request->get('display_name') . '%');
		}

		if($request->has('name') && strlen($request->get('name')) > 0) {
			$products = $products->where('name', 'like', '%' . $request->get('name') . '%');
		}

		if($request->has('brand') && strlen($request->get('brand')) > 0) {
			$products = $products->where('brand', 'like', '%' . $request->get('brand') . '%');
		}

		if($request->has('category_name') && strlen($request->get('category_name')) > 0) {
			$products = $products->whereHas('category', function ($query) use ($request) {
				$query->where('name', $request->get('category_name'));
			});
		}

		if($request->has('sub_category_name') && strlen($request->get('sub_category_name')) > 0) {
			$products = $products->whereHas('sub_category', function ($query) use ($request) {
				$query->where('name', $request->get('sub_category_name'));
			});
		}

		if($request->has('is_featured') && $request->get('is_featured') == 'YES') {
			$products = $products->where('is_featured', 1);
		}

		if($request->has('status') && strlen($request->get('status')) > 0) {
			$products = $products->where('status', $request->get('status'));
		}

		$products = $products->paginate($page_size);

		return view('admin.products-index', [
			'page' => $page,
			'page_size' => $page_size,
			'products' => $products,
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
		$sub_category_id = 0;
		$display_name = "";
		$brand = "";
		$original_price = 0;
		$images = [];
		$is_featured = false;
		$description_text = "";
		$description_image = null;
		$description_video_url = "";

		if ($request->has('sub_category_id') && is_numeric((int) ($request->get('sub_category_id')))) {
			$sub_category_id = $request->get('sub_category_id');
		} else {
			Session::flash('error', 'Sub cagetory is required.');
			return redirect()->back()->withInput();
		}

		if ($request->has('display_name') && strlen($request->get('display_name')) > 2) {
			$display_name = $request->get('display_name');
		} else {
			Session::flash('error', 'Product name is required and atleast 3 characters long.');
			return redirect()->back()->withInput();
		}

		if ($request->has('brand') && strlen($request->get('brand')) > 2) {
			$brand = $request->get('brand');
		} else {
			Session::flash('error', 'Brand name is required and atleast 3 characters long.');
			return redirect()->back()->withInput();
		}

		if ($request->has('original_price') && is_numeric((int) ($request->get('original_price')))) {
			$original_price = $request->get('original_price');
		} else {
			Session::flash('error', 'Price is required.');
			return redirect()->back()->withInput();
		}

		if ($request->has('is_featured') && $request->get('is_featured') == "true") {
			$is_featured = true;
		}

		if ($request->hasFile('images') && count($request->file('images') > 0)) {
			$images = $request->file('images');
		} else {
			Session::flash('error', 'Atlest one product image is required.');
			return redirect()->back()->withInput();
		}

		if ($request->has('description_text') && strlen($request->get('description_text')) > 10) {
			$description_text = $request->get('description_text');
		} else {
			Session::flash('error', 'Description is required and atleast 10 characters long.');
			return redirect()->back()->withInput();
		}

		if ($request->hasFile('description_image')) {
			$description_image = $request->file('description_image');
		}

		if ($request->has('description_video_url') && strlen($request->get('description_video_url')) > 3) {
			$description_video_url = $request->get('description_video_url');
		}

		$name = "";

		$name = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $display_name))))), '-'));

		$status = 'ACTIVE';

		$description_image_url = "";

		$existingProduct = Product::where('name', $name)->first();

		if(!is_null($existingProduct)) {
			Session::flash('error', 'Slug name created already exists. Try to change the name.');
			return redirect()->back()->withInput();
		}

		$sub_category = SubCategory::find($sub_category_id);

		if(is_null($sub_category)) {
			Session::flash('error', 'Invalid sub category.');
			return redirect()->back()->withInput();
		}

		$product = Product::create([
			'category_id' => $sub_category->category_id,
			'sub_category_id' => $sub_category->id,
			'name' => $name,
			'display_name' => $display_name,
			'brand' => $brand,
			'original_price' => $original_price,
			'description_text' => $description_text,
			'description_image_url' => '',
			'description_video_url' => $description_video_url,
			'is_featured' => $is_featured,
			'status' => $status
		]);

		if ($request->hasFile('description_image')) {
			$description_image = $request->file('description_image');
			$filename = $product->id ."_description_" . str_random(5) . "." . $description_image->getClientOriginalExtension();
			$description_image->move(public_path() . '/storage/', $filename);
			$product->description_image_url = $request->root() . '/storage/' . $filename;
			$product->save();
		}

		if (!is_null($images) && count($images) > 0) {
			//get file
			foreach($images as $image) {
				$filename = $product->id . "_image_" . str_random(5) . "." . $image->getClientOriginalExtension();
				$image->move(public_path() . '/storage/', $filename);

				ProductImage::create([
					'product_id' => $product->id,
					'url' => $request->root() . '/storage/' . $filename,
					'status' => 'ACTIVE'
				]);
			}
		}

		Session::flash('success', 'Product successfully created.');
		return redirect()->back();
	}

	public function changeStatus($product_id, $status, Request $request) {
		$product = Product::find($product_id);
		if (!is_null($product) && ($status == 'ACTIVE' || $status == 'INACTIVE')) {
			$product->status = $status;
			$product->save();
			dd($request);
		}
		return redirect()->back();
	}
}