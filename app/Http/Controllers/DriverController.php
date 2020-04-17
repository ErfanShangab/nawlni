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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $this->validate($request, User::rules());
        
      
        $user=User::create($request->all());

        if ($request->hasFile('avatar'))
        {
             if ($request->file('avatar')->isValid()) {
        $image = $request->file('avatar');
        $filename = $request->file('avatar')->getClientOriginalName();
        $path = public_path('drivers_image/' .  $filename);

        $img = Image::make($image->getRealPath());
        $img->encode('jpg')->save($path);
        // $user->avatar=  $request->avatar->getClientOriginalName();
        $user->save();
        }}

        $driver = new Driver([
            'vehicle_id' =>   $request->vehicle_id,
          
        ]);
        $user->Driver()->save($driver);
        return back()->withSuccess(trans('app.success_store'));
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
        $items=Order::where('driver_id',$id)->get();
        return view('admin.drivers.show', compact('item','items'));
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
      
        $this->validate($request,[   'email' => 'max:100|unique:users,email,'.$item->user->id,
        ] );

        $item = Driver::findOrFail($id);
        $item->vehicle_id= $request->vehicle_id;
        $item->save();
        $user=User::findOrFail($item->user_id);

        $user->update($request->all());
        if ($request->hasFile('avatar'))
        {
             if ($request->file('avatar')->isValid()) {
        $image = $request->file('avatar');
        $filename = $request->file('avatar')->getClientOriginalName();
        $path = public_path('drivers_image/' .  $filename);
        $img = Image::make($image->getRealPath());
        $img->encode('jpg')->save($path);
        // $user->avatar=  $request->avatar->getClientOriginalName();
        $user->save();
        }}
       
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

        return back()->withSuccess(trans('app.success_destroy')); 
    } 
}
