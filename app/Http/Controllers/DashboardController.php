<?php

namespace App\Http\Controllers;

use App\Client;
use App\Customer;
use App\Driver;
use App\Order;
use App\User;
class DashboardController extends Controller
{public function x()
    {
        $user=User::find(1);
    $user->assignRole('super_admin');
         

    // return bcrypt('user@user.com');

    
    }
    // public function __construct()
    // {
    //    $this->middleware(['role:employee|super_admin']);
    // }

    
    public function index()
    {
        $orders = Order::all()->count();
        $clients = Client::all()->count();
        $drivers = Driver::all()->count();
        $customers = Customer::all()->count();
        return view('admin.dashboard.index', compact('orders', 'clients', 'drivers', 'customers'));
    }
}
