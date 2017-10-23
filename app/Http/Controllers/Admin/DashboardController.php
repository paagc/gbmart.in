<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
	public function getDashboard(Request $request) {
		return view('admin.dashboard');
	}
}