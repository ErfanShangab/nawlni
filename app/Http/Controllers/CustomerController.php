<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Customer;
use App\User;
use App\Order;

class CustomerController extends Controller
{
    public function __construct()
    {
        // $this->middleware(['role:super-admin','permission:publish articles|edit articles']);
        $this->middleware(['role:employee|super_admin']);
    }

    public function index()
    {
        $items = Customer::all();
        $items->load('User');

        return view('admin.customers.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, User::rules());
        
    
        $user=User::create($request->all());
         
        $user->Customer()->save(new Customer());
        return redirect()->route(ADMIN . '.customers.index')->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Customer::with('User')->findOrFail($id);
        $items=Order::where('customer_id', $id)->get();
        return view('admin.customers.show', compact('item', 'items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Customer::findOrFail($id);

        return view('admin.customers.edit', compact('item'));
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
        $this->validate($request, User::rules(true, $id));

        $item = Customer::findOrFail($id);

        $item->update($request->all());
        $user=User::findOrFail($item->user_id);
        $user->update($request->all());
        return redirect()->route(ADMIN . '.customers.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Customer::destroy($id);

        return redirect()->route(ADMIN . '.customers.index')->withSuccess(trans('app.success_destroy'));
    }
}
