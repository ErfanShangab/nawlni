<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

 use App\Category;
 use App\SubCategory;
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
         $categories= Category::all();
         return view('admin.categories.create');
     }
 
  
     public function store(Request $request)
     {
         $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);

    
        
         $item=Category::create($request->all());
 

         if ($request->hasFile('image')) {
             if ($request->file('image')->isValid()) {
                 $item->image=  $request->image->move('categories_image/', $request->image->getClientOriginalName());
                 $item->save();
             }
         }

       
       
         return redirect()->route(ADMIN . '.categories.index')->withSuccess(trans('app.success_store'));
     }
 
      
     public function show($id)
     {
         $item = Category::findOrFail($id);
         $items=SubCategory::where('category_id', $item->id)->get();
         return view('admin.categories.show', compact('item', 'items'));
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
         if ($request->hasFile('image')) {
             if ($request->file('image')->isValid()) {
                 $item->image=  $request->image->move('categories_image/', $request->image->getClientOriginalName());
                 $item->save();
             }
         }
     
         return redirect()->route(ADMIN . '.categories.index')->withSuccess(trans('app.success_update'));
     }
 
    
     public function destroy($id)
     {
         Category::destroy($id);
 
         return redirect()->route(ADMIN . '.categories.index')->withSuccess(trans('app.success_destroy'));
     }
 }
