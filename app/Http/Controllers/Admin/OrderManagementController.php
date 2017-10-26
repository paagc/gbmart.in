<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Order;
use App\OrderLog;

class OrderManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the pending orders.
     *
     * @return \Illuminate\Http\Response
     */
    public function pendingOrders()
    {
        $page = 1;
        $page_size = 15;
        $pending_orders = new Order;

        $pending_orders = $pending_orders->where('status', 'PENDING');
        $pending_orders = $pending_orders->paginate($page_size);
        return view('admin.orders.pending', [
            'page' => $page,
            'page_size' => $page_size,
            'pending_orders' => $pending_orders
        ]);
    }

    public function approvedOrders()
    {
        $page = 1;
        $page_size = 15;
        $approved_orders = new Order;

        $approved_orders = $approved_orders->where('status', 'APPROVED');
        $approved_orders = $approved_orders->paginate($page_size);
        return view('admin.orders.approved', [
            'page' => $page,
            'page_size' => $page_size,
            'approved_orders' => $approved_orders
        ]);
    }

    public function packedOrders()
    {
        return view('admin.orders.packed');
    }

    public function shippedOrders()
    {
        return view('admin.orders.shipped');
    }


    public function deliveredOrders()
    {
        return view('admin.orders.delivered');
    }

    public function cancelledOrders()
    {
        return view('admin.orders.cancelled');
    }

    public function rejectedOrders()
    {
        return view('admin.orders.rejected');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
