<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Order;
use Illuminate\Http\Request;

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
        $page = 1;
        $page_size = 15;
        $packed_orders = new Order;

        $packed_orders = $packed_orders->where('status', 'PACKED');
        $packed_orders = $packed_orders->paginate($page_size);
        return view('admin.orders.packed', [
            'page' => $page,
            'page_size' => $page_size,
            'packed_orders' => $packed_orders
        ]);
    }

    public function shippedOrders()
    {
        $page = 1;
        $page_size = 15;
        $shipped_orders = new Order;

        $shipped_orders = $shipped_orders->where('status', 'SHIPPED');
        $shipped_orders = $shipped_orders->paginate($page_size);
        return view('admin.orders.shipped', [
            'page' => $page,
            'page_size' => $page_size,
            'shipped_orders' => $shipped_orders
        ]);
    }


    public function deliveredOrders()
    {
        $page = 1;
        $page_size = 15;
        $delivered_orders = new Order;

        $delivered_orders = $delivered_orders->where('status', 'DELIVERED');
        $delivered_orders = $delivered_orders->paginate($page_size);
        return view('admin.orders.delivered', [
            'page' => $page,
            'page_size' => $page_size,
            'delivered_orders' => $delivered_orders
        ]);
    }

    public function cancelledOrders()
    {
        $page = 1;
        $page_size = 15;
        $cancelled_orders = new Order;

        $cancelled_orders = $cancelled_orders->where('status', 'CANCELLED');
        $cancelled_orders = $cancelled_orders->paginate($page_size);
        return view('admin.orders.cancelled', [
            'page' => $page,
            'page_size' => $page_size,
            'cancelled_orders' => $cancelled_orders
        ]);
    }

    public function rejectedOrders()
    {
        $page = 1;
        $page_size = 15;
        $rejected_orders = new Order;

        $rejected_orders = $rejected_orders->where('status', 'REJECTED');
        $rejected_orders = $rejected_orders->paginate($page_size);
        return view('admin.orders.rejected', [
            'page' => $page,
            'page_size' => $page_size,
            'rejected_orders' => $rejected_orders
        ]);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
