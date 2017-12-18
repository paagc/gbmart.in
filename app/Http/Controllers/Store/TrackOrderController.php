<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;

class TrackOrderController extends Controller
{
    public function index()
    {
        return view('store.track');
    }
    public function show($id)
    {

        return view('store.track-details');
    }
}
