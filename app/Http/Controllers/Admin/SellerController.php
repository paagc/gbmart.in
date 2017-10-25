<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;

class SellerController extends Controller
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
        $sellers = new User;
        $sellers = $sellers->where('type', 'seller');

        if ($request->has('name') && strlen($request->get('name')) > 0) {
            $sellers = $sellers->where('name', 'like', '%' . $request->get('name') . '%');
        }

        if ($request->has('email') && strlen($request->get('email')) > 0) {
            $sellers = $sellers->where('email', 'like', '%' . $request->get('email') . '%');
        }

        if ($request->has('mobile_number') && strlen($request->get('mobile_number')) > 0) {
            $sellers = $sellers->where('mobile_number', 'like', '%' . $request->get('mobile_number') . '%');
        }

        $sellers = $sellers->paginate($page_size);
        return view('admin.sellers', [
            'sellers' => $sellers,
            'page' => $page,
            'page_size' => $page_size
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

    public function enable($id)
    {
        $seller = User::find($id);
        $seller->update(['status' => 'ACTIVE']);
        return back();
    }

    public function activate($id)
    {
        $seller = User::find($id);
        $seller->update(['status' => 'ACTIVE']);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function disable($id)
    {
        $seller = User::find($id);
        $seller->update(['status' => 'INACTIVE']);
        return back();
    }
}
