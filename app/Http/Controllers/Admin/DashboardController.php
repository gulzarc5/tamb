<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DashboardController extends Controller
{
    public function dashboardView()
    {
        $slots = DB::table('generated_number')->get();
        return view('admin.dashboard',compact('slots'));
    }
}
