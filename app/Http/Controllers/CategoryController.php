<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

 use App\Category;
 use App\User;
 use App\Product;
use Image;
 
 class CategoryController extends Controller

 {
     public function __construct()
     {
        $this->middleware(['role:employee|super_admin']);

     }
     public function index()
     {
         $items = Category::all();
         return view('admin.categories.index', compact('items'));
     }
 
     
     public function create()
     {
         return view('admin.categories.create');
     }
 
  
     public function store(Request $request)
     {
        $this->validate($request  ,[
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);

    
        
          $item=Category::create($request->all());
 

        if ($request->hasFile('image'))
        {
             if ($request->file('image')->isValid()) {
        $image = $request->file('image');
        $filename = $request->file('image')->getClientOriginalName();
        $path = public_path('category_image/' .  $filename);
        $img = Image::make($image->getRealPath());
        $img->encode('jpg')->save($path);
        // $user->image=  $request->image->getClientOriginalName();
        $item->save();
        }}

       
       
         return back()->withSuccess(trans('app.success_store'));
     }
 
      
     public function show($id)
     {
        $item = Category::findOrFail($id);
        $items=Product::where('category_id',  $item->id);
         return view('admin.categories.show', compact('item','items'));
     }
 
    
     public function edit($id)
     {
         $item = Category::findOrFail($id);
 
         return view('admin.categories.edit', compact('item'));
     }
 
     
     public function update(Request $request, $id)
     {
         
         $item = Category::findOrFail($id);
     
 
         $item->update($request->all());
     
         return redirect()->route(ADMIN . '.categories.index')->withSuccess(trans('app.success_update'));
     }
 
    
     public function destroy($id)
     {
        Category::destroy($id);
 
         return back()->withSuccess(trans('app.success_destroy')); 
     } 

}
