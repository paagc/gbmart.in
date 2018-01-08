<?php

namespace App\Http\Controllers\Admin;

use App\GiftCoupon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GiftCouponsController extends Controller
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
        $coupons = new GiftCoupon;

        if ($request->has('code') && strlen($request->get('code')) > 0) {
            $coupons = $coupons->where('code', 'like', '%' . $request->get('code') . '%');
        }

        if ($request->has('value') && strlen($request->get('value')) > 0) {
            $coupons = $coupons->where('value', 'like', '%' . $request->get('value') . '%');
        }

        if ($request->has('max_amount') && strlen($request->get('max_amount')) > 0) {
            $coupons = $coupons->where('max_amount', 'like', '%' . $request->get('max_amount') . '%');
        }

        $coupons = $coupons->paginate($page_size);
        return view('admin.gift_coupons.index', [
            'page' => $page,
            'page_size' => $page_size,
            'coupons' => $coupons
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.gift_coupons.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => 'required',
            'value' => 'required',
            'type' => 'required',
            'max_amount' => 'required',
            'end_date' => 'required|date|after:today'
        ]);
        $input = $request->all();
        $input['status'] = 'ACTIVE';
        $coupon = GiftCoupon::create($input);
        return redirect('admin/gift-coupon');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $coupon = GiftCoupon::find($id);
        return view('admin.gift_coupons.edit', ['coupon' => $coupon]);
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
            'code' => 'required',
            'value' => 'required',
            'type' => 'required',
            'max_amount' => 'required',
            'end_date' => 'required|date'
        ]);
        $input = $request->all();

        $coupon = GiftCoupon::find($id)->update($input);
        return redirect('admin/gift-coupon');
    }

    /**
     * Regain the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function active($id)
    {
        $coupon = GiftCoupon::find($id);
        $coupon->update(['status' => 'ACTIVE']);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = GiftCoupon::find($id);
        $coupon->update(['status' => 'INACTIVE']);

        return back();
    }
}
