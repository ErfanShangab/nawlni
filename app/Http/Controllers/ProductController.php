<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Image;
use App\Product;
use App\Category;
use App\Client;
use App\User;
class ProductController extends Controller
{
    public function __construct()
    {
       $this->middleware(['role:employee|super_admin']);

    }
    public function index()
    {
        $items = Product::all();
        $items->load('Category');

        return view('admin.products.index', compact('items'));
    }

    
    public function create()
    {
        $clients = Client::all();
        $categories = Category::all();
        $clients->load('User');
        return view('admin.products.create', compact('clients','categories'));
    }

 
    public function store(Request $request)
    {
      
        $this->validate($request,  [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);
          $item=Product::create($request->all());
         
        if ($request->hasFile('image'))
        {
             if ($request->file('image')->isValid()) {
        $image = $request->file('image');
        $filename = $request->file('image')->getClientOriginalName();
        $path = public_path('product_image/' .  $filename);
        $img = Image::make($image->getRealPath());
        $img->encode('jpg')->save($path);
        // $user->image=  $request->image->getClientOriginalName();
        $item->save();
        }}

      
        return back()->withSuccess(trans('app.success_store'));
    }

     
    public function show($id)
    {
        $item = Product::findOrFail($id);
        return view('admin.products.show', compact('item'));
    }

   
    public function edit($id)
    {
        $item = Product::findOrFail($id);

        return view('admin.products.edit', compact('item'));
    }

    
    public function update(Request $request, $id)
    {
        
        $item = Product::findOrFail($id);
    

        $item->update($request->all());
    
        return redirect()->route(ADMIN . '.products.index')->withSuccess(trans('app.success_update'));
    }

   
    public function destroy($id)
    {
       Product::destroy($id);

        return back()->withSuccess(trans('app.success_destroy')); 
    } 

}

