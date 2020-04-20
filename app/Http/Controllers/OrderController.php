<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer;
use App\User;
use App\Client;
use App\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['role:super-admin','permission:publish articles|edit articles']);
        $this->middleware(['role:employee|super_admin']);
    }
    public function index()
    {
        $items = Order::all();
        $items->load('Customer.User' , 'Client.User');

        return view('admin.orders.index', compact('items'));
    }

    
    public function delivered()
    {
        $items = Order::where('status','deliverd')->get();
        $items->load('Customer.User' , 'Client.User');

        return view('admin.orders.delivered', compact('items'));
    }

    public function inprogress()
    {
        $items = Order::where('status','inprogress')->get();
        $items->load('Customer.User' , 'Client.User');

        return view('admin.orders.inprogress', compact('items'));
    }

    public function create()
    {
        return view('admin.orders.create');
    }

     
    public function store(Request $request)
    {
        $this->validate($request, User::rules());
        
        // Customer::create($request->all());
      
        $user=User::create($request->all());
        // $customer = new Customer( );

        // $customer = new Customer([
        //     'user_id' =>   $user->id,
          
        // ]);
        $user->Customer()->save(new Customer( ));
        return back()->withSuccess(trans('app.success_store'));
    }

     
    public function show($id)
    {
        // $items->load('Customer.User' , 'Client.User');

        $item = Order::with('Customer.User','Client.User')->findOrFail($id);
        return view('admin.orders.show', compact('item'));
    }

     
    public function edit($id)
    {
        $item = Order::findOrFail($id);

        return view('admin.orders.edit', compact('item'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request, User::rules(true, $id));

        $item = Order::findOrFail($id);

        $item->update($request->all());

        return redirect()->route(ADMIN . '.orders.index')->withSuccess(trans('app.success_update'));
    }

    
    public function destroy($id)
    {
        Order::destroy($id);

        return back()->withSuccess(trans('app.success_destroy')); 
    } 
}
