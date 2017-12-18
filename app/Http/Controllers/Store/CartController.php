<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\SellerProduct;
use Auth;
use Cart;
use Illuminate\Http\Request;
use Session;

class CartController extends Controller
{
    public function get(Request $request)
    {
        $subtotal = 0;
        $total = 0;

        $cart_items = [];

        foreach (Cart::content() as $item) {
            $seller_product = SellerProduct::find($item->id);
            if (!is_null($seller_product)) {
                array_push($cart_items, [
                    'rowId' => $item->rowId,
                    'seller_product' => $seller_product,
                    'quantity' => $item->qty,
                    'options' => $item->options
                ]);
                $subtotal += $item->qty * $seller_product->seller_price;
                $total += $item->qty * $seller_product->seller_price + $seller_product->delivery_charge;
            }
        }

        // dd([ 'cart_items' => $cart_items, 'subtotal' => $subtotal, 'total' => $total ]);

        return view('store.cart', ['cart_items' => $cart_items, 'subtotal' => $subtotal, 'total' => $total]);
    }

    public function addToCart($seller_product_id, Request $request)
    {
        $seller_product = SellerProduct::find($seller_product_id);

        $options = $request->query();
        $quantity = 1;

        if ($request->has('quantity') && is_numeric($request->get('quantity'))) {
            $quantity = (int)$request->get('quantity');
        }

        if (!is_null($seller_product)) {
            $cart_item = null;

            foreach (Cart::content() as $item) {
                if ($item->id == $seller_product->id) {
                    $cart_item = $item;
                }
            }

            if (is_null($cart_item)) {
                // $options['image'] = $seller_product->product->product_images[0]->url;
                Cart::add($seller_product->id, $seller_product->product->display_name, $quantity, $seller_product->seller_price, $options);
            } else {
                // $options['image'] = $seller_product->product->product_images[0]->url;
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

    public function buyNow($seller_product_id, Request $request)
    {
        $seller_product = SellerProduct::find($seller_product_id);

        $options = $request->query();
        $quantity = 1;

        if ($request->has('quantity') && is_numeric($request->get('quantity'))) {
            $quantity = (int)$request->get('quantity');
        }

        if (!is_null($seller_product)) {
            $cart_item = null;

            foreach (Cart::content() as $item) {
                if ($item->id == $seller_product->id) {
                    $cart_item = $item;
                }
            }

            if (is_null($cart_item)) {
                // $options['image'] = $seller_product->product->product_images[0]->url;
                Cart::add($seller_product->id, $seller_product->product->display_name, $quantity, $seller_product->seller_price, $options);
            } else {
                // $options['image'] = $seller_product->product->product_images[0]->url;
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

        return redirect('/store/checkout');
    }

    public function removeFromCart($cart_row_id, Request $request)
    {
        Cart::remove($cart_row_id);

        return back();
    }
}