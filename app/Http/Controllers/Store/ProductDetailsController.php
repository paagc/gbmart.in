<?php

namespace App\Http\Controllers\Store;

use App\Attribute;
use App\Http\Controllers\Controller;
use App\SellerProduct;
use Cart;
use Illuminate\Http\Request;
use Route;
use Session;

class ProductDetailsController extends Controller
{
    public function getProductDetails($category_name, $sub_category_name, $product_name_seller_product_id, Request $request)
    {

        $tparts = explode('-', $product_name_seller_product_id);

        $product_name = "";
        $seller_product_id = "";

        foreach ($tparts as $index => $part) {
            if (sizeof($tparts) == $index + 1) {
                $seller_product_id = $part;
            } else {
                $product_name = $product_name . ($index == 0 ? "" : "-") . $part;
            }
        }

        $seller_product = SellerProduct::where('status', 'ACTIVE')->where('id', $seller_product_id)
            ->whereHas('product.category', function ($query) use ($category_name) {
                $query->where('name', $category_name);
            })->whereHas('product.sub_category', function ($query) use ($sub_category_name) {
                $query->where('name', $sub_category_name);
            })->whereHas('product', function ($query) use ($product_name) {
                $query->where('status', 'ACTIVE')->where('name', $product_name);
            })->with(['product.product_images' => function ($query) {
                $query->where('status', 'ACTIVE')->orderBy('id', 'asc');
            }])->orderBy('updated_at', 'desc')->first();

        $hot_deal_products = SellerProduct::where('status', 'ACTIVE')->whereHas('product', function ($query) {
            $query->where('status', 'ACTIVE')->where('is_hot_deal', true);
        })->whereHas('product.product_images', function ($query) {
            $query->where('status', 'ACTIVE')->orderBy('id', 'asc');
        })->whereHas('product.sub_category', function ($query) use ($sub_category_name) {
            $query->where('status', 'ACTIVE')->where('name', $sub_category_name);
        })->whereHas('product.sub_category.category', function ($query) use ($category_name) {
            $query->where('status', 'ACTIVE')->where('name', $category_name);
        })->orderBy('updated_at', 'desc')->limit(4)->get();

        $featured_products = SellerProduct::where('status', 'ACTIVE')->whereHas('product', function ($query) {
            $query->where('status', 'ACTIVE')->where('is_featured', true);
        })->whereHas('product.product_images', function ($query) {
            $query->where('status', 'ACTIVE')->orderBy('id', 'asc');
        })->whereHas('product.sub_category', function ($query) use ($sub_category_name) {
            $query->where('status', 'ACTIVE')->where('name', $sub_category_name);
        })->whereHas('product.sub_category.category', function ($query) use ($category_name) {
            $query->where('status', 'ACTIVE')->where('name', $category_name);
        })->orderBy('updated_at', 'desc')->limit(6)->get();

        $related_products = SellerProduct::where('status', 'ACTIVE')->whereHas('product', function ($query) {
            $query->where('status', 'ACTIVE');
        })->whereHas('product.product_images', function ($query) {
            $query->where('status', 'ACTIVE')->orderBy('id', 'asc');
        })->whereHas('product.sub_category', function ($query) use ($sub_category_name) {
            $query->where('status', 'ACTIVE')->where('name', $sub_category_name);
        })->whereHas('product.sub_category.category', function ($query) use ($category_name) {
            $query->where('status', 'ACTIVE')->where('name', $category_name);
        })->orderBy('updated_at', 'desc')->limit(10)->get();


        if (!is_null($seller_product)) {
            $attributes = Attribute::where('product_id', $seller_product->product->id)->where('status', 'ACTIVE')->get();
            return view('store.product-details', [
                'main_product' => $seller_product,
                'hot_deal_products' => $hot_deal_products,
                'featured_products' => $featured_products,
                'related_products' => $related_products,
                'attributes' => $attributes
            ]);
        } else {
            return abort(404);
        }
    }
}