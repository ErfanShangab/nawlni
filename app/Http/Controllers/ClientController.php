<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Customer;
use App\User;
use App\Client;
use App\Order;
use Image;

class ClientController extends Controller
{
    public function __construct()
    {
        $this->middleware(
            ['role:employee|super_admin'],
            ['except' => ['showProfile']
            ]
        );
    }
    public function showProfile($id)
    {
        $user =  User::findOrFail($id);
        $item = Client::with('User')->where('user_id', $user->id)->first();
        $items = Order::where('client_id', $id)->get();
        return view('admin.clients.show', compact('item', 'items'));
    }



    public function index()
    {
        $items = Client::all();
        $items->load('User');
        return view('admin.clients.index', compact('items'));
    }

    public function edit($id)
    {
        $item = Client::with('User')->findOrFail($id);

        return view('admin.clients.edit', compact('item'));
    }
    public function pharmacy()
    {
        $items = Client::where('type', 'pharmacy')->get();
        $items->load('User');

        return view('admin.clients.pharmacy', compact('items'));
    }
    public function resturant()
    {
        $items = Client::where('type', 'resturant')->get();
        $items->load('User');

        return view('admin.clients.resturant', compact('items'));
    }
    public function merchant()
    {
        $items = Client::where('type', 'merchant')->get();
        $items->load('User');

        return view('admin.clients.merchant', compact('items'));
    }

 
    public function create()
    {
        return view('admin.clients.create');
    }

     
    public function show($id)
    {
        $item = Client::with('User')->findOrFail($id);
        $items = Order::where('client_id', $id)->get();
        return view('admin.clients.show', compact('item', 'items'));
    }

    public function store(Request $request)
    {


        $this->validate($request, User::rules(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    
        $user=User::create($request->all());
        


        if ($request->hasFile('avatar')) {
            if ($request->file('avatar')->isValid()) {
                $item->image=  $request->image->move('clients_image/', $request->avatar->getClientOriginalName());
                $item->save();
            }
        }
        $user->assignRole('client');
    

        $client = new Client([
            'type' =>   $request->type,
            'details' =>   $request->details,
            'nid' =>   $request->nid,
            'nid_details' =>   $request->nid_details,
            'user_id' => $user->id,

        ]);

    

        $client->save();
        // $user->Client()->save($Client);

        return redirect()->route(ADMIN . '.clients.index')->withSuccess(trans('app.success_store'));
    }

  
    public function update(Request $request, $id)
    {
        $item = Client::findOrFail($id);
        $user = user::findOrFail($item->user_id);

        $this->validate($request, [   'email' => 'required|max:100|unique:users,email,'.$item->user->id,
        ], User::rules(true, $id));

        $user->update($request->all());
        
        
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $item->image=  $request->image->move('clients_image/', $request->image->getClientOriginalName());
                $item->save();
            }
        }

        $item->nid=  $request->nid;
        $item->nid_details=  $request->nid_details;
        $item->type=  $request->type;
        $item->details =$request->details;
        $item->save();



        
        return redirect()->route(ADMIN . '.clients.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Client::destroy($id);

        returnredirect()->route(ADMIN . '.clients.index')->withSuccess(trans('app.success_destroy'));
    }
}
