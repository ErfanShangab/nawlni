<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Driver;
use App\User;
use App\Client;
use Image;

    use App\Order;

    class DriverController extends Controller
    {
        public function __construct()
        {
            // $this->middleware(['role:super-admin','permission:publish articles|edit articles']);
            $this->middleware(['role:employee|super_admin']);
        }

        public function index()
        {
            $items = Driver::all();
            $items->load('User');

            return view('admin.drivers.index', compact('items'));
        }

        public function active()
        {
            $items = Driver::where('is_available', '1')->get();
            $items->load('User');

            return view('admin.drivers.active', compact('items'));
        }
        public function create()
        {
            return view('admin.drivers.create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request  $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $this->validate($request, User::rules(), [
                'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
      
            $user=User::create($request->all());

            if ($request->hasFile('avatar')) {
                if ($request->file('avatar')->isValid()) {
                    $item->image=  $request->image->move('drivers_image/', $request->image->getClientOriginalName());
                    $user->save();
                }
            }

            $driver = new Driver([
            'vehicle_id' =>   $request->vehicle_id,
            'balance' =>   $request->balance,
            'details' =>   $request->details,
            'nid' =>   $request->nid,
            'nid_details' =>   $request->nid_details,
            'is_hosted' =>   $request->is_hosted,
            'user_id' => $user->id,

          
        ]);
            $user->Driver()->save($driver);
            return redirect()->route(ADMIN . '.drivers.index')->withSuccess(trans('app.success_store'));
        }

        /**
         * Display the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function show($id)
        {
            $item = Driver::with('User')->findOrFail($id);
            $items=Order::where('driver_id', $id)->get();
            return view('admin.drivers.show', compact('item', 'items'));
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function edit($id)
        {
            $item = Driver::with('User')->findOrFail($id);

            return view('admin.drivers.edit', compact('item'));
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
            $item = Driver::findOrFail($id);
      
            $this->validate($request, [   'email' => 'max:100|unique:users,email,'.$item->user->id,
        ]);

            $item = Driver::findOrFail($id);
            $item->vehicle_id= $request->vehicle_id;
            $item->balance= $request->balance;
            $item->details= $request->details;
            $item->nid= $request->nid;
            $item->nid_details= $request->nid_details;
            $item->vehiclis_hostede_id= $request->is_hosted;
             

            $item->save();
            $user=User::findOrFail($item->user_id);

            $user->update($request->all());
            if ($request->hasFile('image')) {
                if ($request->file('image')->isValid()) {
                    $item->image=  $request->image->move('drivers_image/', $request->image->getClientOriginalName());
                    $item->save();
                }
            }
       
            return redirect()->route(ADMIN . '.drivers.index')->withSuccess(trans('app.success_update'));
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            Driver::destroy($id);

            return redirect()->route(ADMIN . '.drivers.index')->withSuccess(trans('app.success_destroy'));
        }
    }
