<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function __construct()
    {
        // $this->middleware(['role:super-admin','permission:publish articles|edit articles']);
        $this->middleware(['role:employee|super_admin']);
    }

    public function index()
    {

        $orders = \App\Order::all()->count();
        $clients=\App\Client::all()->count();
        $drivers = \App\Driver::all()->count();
        $customers = \App\Customer::all()->count();
        return view('admin.dashboard.index',compact('orders','clients','drivers','customers'));
       
    }
}
