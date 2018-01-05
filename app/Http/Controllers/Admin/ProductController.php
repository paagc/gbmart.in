<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\Category;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductImage;
use App\SubCategory;
use App\Traits\GoogleMerchantUpdate;
use Illuminate\Http\Request;
use Route;
use Session;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
        })->orderBy('id', 'asc');

        if ($request->has('display_name') && strlen($request->get('display_name')) > 0) {
            $products = $products->where('display_name', 'like', '%' . $request->get('display_name') . '%');
        }

        if ($request->has('name') && strlen($request->get('name')) > 0) {
            $products = $products->where('name', 'like', '%' . $request->get('name') . '%');
        }

        if ($request->has('brand') && strlen($request->get('brand')) > 0) {
            $products = $products->where('brand', 'like', '%' . $request->get('brand') . '%');
        }

        if ($request->has('category_name') && strlen($request->get('category_name')) > 0) {
            $products = $products->whereHas('category', function ($query) use ($request) {
                $query->where('name', $request->get('category_name'));
            });
        }

        if ($request->has('sub_category_name') && strlen($request->get('sub_category_name')) > 0) {
            $products = $products->whereHas('sub_category', function ($query) use ($request) {
                $query->where('name', $request->get('sub_category_name'));
            });
        }

        if ($request->has('is_featured') && $request->get('is_featured') == 'YES') {
            $products = $products->where('is_featured', 1);
        }

        if ($request->has('status') && strlen($request->get('status')) > 0) {
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $sub_categories = SubCategory::whereHas('category', function ($query) {
            $query->where('status', 'ACTIVE');
        })->where('status', 'ACTIVE')->orderBy('id', 'asc')->get();
        return view('admin.products-create', ['sub_categories' => $sub_categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $sub_category_id = 0;
        $display_name = "";
        $brand = "";
        $original_price = 0;
        $images = [];
        $is_featured = false;
        $is_hot_deal = false;
        $is_bestseller = false;
        $description_small = "";
        $description_text = "";
        $description_image = null;
        $description_video_url = "";

        if ($request->has('sub_category_id') && is_numeric((int)($request->get('sub_category_id')))) {
            $sub_category_id = $request->get('sub_category_id');
        } else {
            \Session::flash('error', 'Sub cagetory is required.');
            return redirect()->back()->withInput();
        }

        if ($request->has('display_name') && strlen($request->get('display_name')) > 2) {
            $display_name = $request->get('display_name');
        } else {
            \Session::flash('error', 'Product name is required and atleast 3 characters long.');
            return redirect()->back()->withInput();
        }

        if ($request->has('brand') && strlen($request->get('brand')) > 2) {
            $brand = $request->get('brand');
        } else {
            \Session::flash('error', 'Brand name is required and atleast 3 characters long.');
            return redirect()->back()->withInput();
        }

        if ($request->has('original_price') && is_numeric((int)($request->get('original_price')))) {
            $original_price = $request->get('original_price');
        } else {
            \Session::flash('error', 'Price is required.');
            return redirect()->back()->withInput();
        }

        if ($request->has('is_featured') && $request->get('is_featured') == "true") {
            $is_featured = true;
        }

        if ($request->has('is_hot_deal') && $request->get('is_hot_deal') == "true") {
            $is_hot_deal = true;
        }

        if ($request->has('is_bestseller') && $request->get('is_bestseller') == "true") {
            $is_bestseller = true;
        }

        if ($request->hasFile('images') && count($request->file('images') > 0)) {
            $images = $request->file('images');
        } else {
            \Session::flash('error', 'Atlest one product image is required.');
            return redirect()->back()->withInput();
        }

        if ($request->has('description_small') && strlen($request->get('description_small')) > 10 && strlen($request->get('description_small')) <= 200) {
            $description_small = $request->get('description_small');
        } else {
            \Session::flash('error', 'Small description is required, atleast 10 characters long and not more than 200 characters.');
            return redirect()->back()->withInput();
        }

        if ($request->has('description_text') && strlen($request->get('description_text')) > 10) {
            $description_text = $request->get('description_text');
        } else {
            \Session::flash('error', 'Description is required and atleast 10 characters long.');
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

        if (!is_null($existingProduct)) {
            \Session::flash('error', 'Slug name created already exists. Try to change the name.');
            return redirect()->back()->withInput();
        }

        $sub_category = SubCategory::find($sub_category_id);

        if (is_null($sub_category)) {
            \Session::flash('error', 'Invalid sub category.');
            return redirect()->back()->withInput();
        }

        $product = Product::create([
            'category_id' => $sub_category->category_id,
            'sub_category_id' => $sub_category->id,
            'name' => $name,
            'display_name' => $display_name,
            'brand' => $brand,
            'original_price' => $original_price,
            'description_small' => $description_small,
            'description_text' => $description_text,
            'description_image_url' => '',
            'description_video_url' => $description_video_url,
            'is_featured' => $is_featured,
            'is_hot_deal' => $is_hot_deal,
            'is_bestseller' => $is_bestseller,
            'status' => $status
        ]);

        if ($request->hasFile('description_image')) {
            $description_image = $request->file('description_image');
            $filename = $product->id . "_description_" . str_random(5) . "." . $description_image->getClientOriginalExtension();
            $description_image->move(public_path() . '/storage/', $filename);
            $product->description_image_url = $request->root() . '/storage/' . $filename;
            $product->save();
        }

        if (!is_null($images) && count($images) > 0) {
            //get file
            foreach ($images as $image) {
                $filename = $product->id . "_image_" . str_random(5) . "." . $image->getClientOriginalExtension();
                $image->move(public_path() . '/storage/', $filename);

                ProductImage::create([
                    'product_id' => $product->id,
                    'url' => $request->root() . '/storage/' . $filename,
                    'status' => 'ACTIVE'
                ]);
            }
        }

        if ($request->has('attributes') && is_array($request->get('attributes'))) {
            foreach ($request->get('attributes') as $attribute) {
                if (strlen($attribute) > 0) {
                    Attribute::create([
                        'product_id' => $product->id,
                        'name' => $attribute,
                        'description' => '',
                        'status' => 'ACTIVE'
                    ]);
                }
            }
        }

        \Session::flash('success', 'Product successfully created.');
        return redirect()->back();
    }

    public function changeStatus($product_id, $status, Request $request)
    {
        $product = Product::find($product_id);
        if (!is_null($product) && ($status == 'ACTIVE' || $status == 'INACTIVE')) {
            $product->status = $status;
            $product->save();
        }
        return redirect('/admin/products');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        $sub_categories = SubCategory::whereHas('category', function ($query) {
            $query->where('status', 'ACTIVE');
        })->where('status', 'ACTIVE')->orderBy('id', 'asc')->get();
        return view('admin.products-edit', [
            'product' => $product,
            'sub_categories' => $sub_categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'sub_category_id' => 'required|integer',
            'display_name' => 'required|min:3',
            'brand' => 'required|min:3',
            'original_price' => 'required',
            'description_text' => 'required|min:10',

        ]);

        $input = $request->all();
        $is_featured = false;
        $is_hot_deal = false;
        $is_bestseller = false;
        $images = [];
        $description_image = null;
        $description_video_url = "";
        $description_small = "";

        // dd($request->all());

        if ($request->has('is_featured') && $request->get('is_featured') == "true") {
            $is_featured = true;
        }

        if ($request->has('is_hot_deal') && $request->get('is_hot_deal') == "true") {
            $is_hot_deal = true;
        }

        if ($request->has('is_bestseller') && $request->get('is_bestseller') == "true") {
            $is_bestseller = true;
        }

        if ($request->hasFile('images') && count($request->file('images') > 0)) {
            $images = $request->file('images');
        }

        if ($request->hasFile('description_image')) {
            $description_image = $request->file('description_image');
        }

        if ($request->has('description_video_url') && strlen($request->get('description_video_url')) > 3) {
            $description_video_url = $request->get('description_video_url');
        }

        if ($request->has('description_small') && strlen($request->get('description_small')) > 10 && strlen($request->get('description_small')) <= 200) {
            $description_small = $request->get('description_small');
        } else {
            \Session::flash('error', 'Small description is required, atleast 10 characters long and not more than 200 characters.');
            return redirect()->back()->withInput();
        }

        $name = "";

        $name = strtolower(trim(preg_replace('/[\s-]+/', '-', preg_replace('/[^A-Za-z0-9-]+/', '-', preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $input['display_name']))))), '-'));

        $status = 'ACTIVE';

        $description_image_url = "";

        $sub_category = SubCategory::find($input['sub_category_id']);

        if (is_null($sub_category)) {
            \Session::flash('error', 'Invalid sub category.');
            return redirect()->back()->withInput();
        }

        $input['is_featured'] = $is_featured;
        $input['is_hot_deal'] = $is_hot_deal;
        $input['is_bestseller'] = $is_bestseller;
        $input['description_small'] = $description_small;
        $input['description_video_url'] = $description_video_url;
        $product = Product::find($id);
        $product->update($input);

        if ($request->hasFile('description_image')) {
            $description_image = $request->file('description_image');
            $filename = $product->id . "_description_" . str_random(5) . "." . $description_image->getClientOriginalExtension();
            $description_image->move(public_path() . '/storage/', $filename);
            $product->description_image_url = $request->root() . '/storage/' . $filename;
            $product->save();
        }

        if (!is_null($images) && count($images) > 0) {
            //get file
            foreach ($images as $image) {
                $filename = $product->id . "_image_" . str_random(5) . "." . $image->getClientOriginalExtension();
                $image->move(public_path() . '/storage/', $filename);

                ProductImage::create([
                    'product_id' => $product->id,
                    'url' => $request->root() . '/storage/' . $filename,
                    'status' => 'ACTIVE'
                ]);
            }
        }

        if ($request->has('attributes') && is_array($request->get('attributes'))) {
            foreach ($request->get('attributes') as $attribute) {
                if (strlen($attribute) > 0) {
                    Attribute::create([
                        'product_id' => $product->id,
                        'name' => $attribute,
                        'description' => '',
                        'status' => 'ACTIVE'
                    ]);
                }
            }
        }

        if ($request->has('uploaded_image_id') && is_array($request->get('uploaded_image_id')) && count($request->get('uploaded_image_id'))) {
            $uploaded_images_ids = $request->get('uploaded_image_id');
            foreach ($uploaded_images_ids as $index => $product_image_id) {
                $product = ProductImage::find($product_image_id);
                $product->update(['status' => 'INACTIVE']);
            }
        }

        if ($request->has('delete_description_image')) {
            $product->description_image_url = '';
            $product->save();
        }

        if ($request->has('product_attribute_id') && is_array($request->get('product_attribute_id')) && count($request->get('product_attribute_id'))) {
            $product_attribute_ids = $request->get('product_attribute_id');
            foreach ($product_attribute_ids as $index => $product_attribute_id) {
                $product_attribute = Attribute::find($product_attribute_id);
                $product_attribute->update(['status' => 'INACTIVE']);
            }
        }

        \Session::flash('success', 'Product Updated Successfully.');

        return back();

    }

    public function updateXmlData()
    {
        GoogleMerchantUpdate::run();
        \Session::put('showAlert','XML Updated');
        return back();
    }
}