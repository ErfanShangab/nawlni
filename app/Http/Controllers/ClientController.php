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
        // $this->middleware(['role:super-admin','permission:publish articles|edit articles']);
        $this->middleware(['role:employee|super_admin'] ,['except' => [
            'showProfile' 
        ]]);

        
    }
    public function showProfile($id)
    {
        $user=User::findOrFail($id);
        $item = Client::where('user_id',$user->id)->first();
        $item->load('User');
        $items=Order::where('client_id',$id)->get();
        return view('admin.clients.show', compact('item','items'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  


    

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
        $items = Client::where('type','pharmacy')->get();
        $items->load('User');

        return view('admin.clients.pharmacy', compact('items'));
    }  
      public function resturant()
    {
        $items = Client::where('type','resturant')->get();
        $items->load('User');

        return view('admin.clients.resturant', compact('items'));
    }
    public function merchant()
    {
        $items = Client::where('type','merchant')->get();
        $items->load('User');

        return view('admin.clients.merchant', compact('items'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $item = Client::with('User')->findOrFail($id);
        $items=Order::where('client_id',$id)->get();
        return view('admin.clients.show', compact('item','items'));
    }

    public function store(Request $request)
    {
        $this->validate($request,  User::rules() ,[
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);

    
        $user=User::create($request->all());
        
 

        if ($request->hasFile('avatar'))
        {
             if ($request->file('avatar')->isValid()) {
        $image = $request->file('avatar');
        $filename = $request->file('avatar')->getClientOriginalName();
        $path = public_path('clients_image/' .  $filename);
        $img = Image::make($image->getRealPath());
        $img->encode('jpg')->save($path);
        // $user->avatar=  $request->avatar->getClientOriginalName();
        $user->save();
        }}
        $user->assignRole('agent');
    

        $client = new Client([
            'type' =>   $request->type,
            'details' =>   $request->details,
            'user_id' => $user->id,
        ]);

        $client->save();
        // $user->Client()->save($Client);
      
        return back()->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $item = Client::findOrFail($id);
        $user = user::findOrFail($item->user_id);

        $this->validate($request,[   'email' => 'required|max:100|unique:users,email,'.$item->user->id,
        ] , User::rules(true, $id));

        $user->update($request->all());
        
        
        if ($request->hasFile('avatar'))
        {
             if ($request->file('avatar')->isValid()) {
        $image = $request->file('avatar');
        $filename = $request->file('avatar')->getClientOriginalName();
        $path = public_path('clients_image/' .  $filename);
        $img = Image::make($image->getRealPath());
        $img->encode('jpg')->save($path);
        // $user->avatar=  $request->avatar->getClientOriginalName();
        $user->save();
        }}


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

        return back()->withSuccess(trans('app.success_destroy')); 
    } 
}
