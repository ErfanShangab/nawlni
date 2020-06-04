<?php

namespace App\Http\Controllers;

use App\SubCategory;
use Illuminate\Http\Request;
use App\Category;
use App\User;
use App\Product;
use Image;
class SubCategoryController extends Controller
{
    public function __construct()
     {
         $this->middleware(['role:employee|super_admin']);
        }
   
        public function index($id)
        {
            $item=Category::findOrFail($id);
            $items = SubCategory::where('category_id',$id)->get();
            return view('admin.subcategories.show', compact('item', 'items'));

        }
     
     public function create()
     {
        
        $categories =Category::pluck('name', 'id');



         return view('admin.subcategories.create',compact('categories'));
     }
 
  
     public function store(Request $request)
     {
         $this->validate($request, [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
          ]);

    
        
         $item=SubCategory::create($request->all());
 

         if ($request->hasFile('image')) {
             if ($request->file('image')->isValid()) {
                 $item->image=  $request->image->move('sub_categories_image/', $request->image->getClientOriginalName());
                 $item->save();
             }
         }

       
       
         return redirect()->back();
     }
 
      
     public function show($id)
     {
         $item = SubCategory::findOrFail($id);
        $category = Category::findOrFail($item->category_id);
         $items=Product::where('subcategory_id', $item->id)->get();
         return view('admin.subcategories.show', compact('item', 'category', 'items'));
     }
 
    
     public function edit($id)
     {
         $item = Category::findOrFail($id);
 
         return view('admin.subcategories.edit', compact('item'));
     }
 
     
     public function update(Request $request, $id)
     {
         $item = Category::findOrFail($id);
     
 
         $item->update($request->all());
         if ($request->hasFile('image')) {
             if ($request->file('image')->isValid()) {
                 $item->image=  $request->image->move('subcategories_image/', $request->image->getClientOriginalName());
                 $item->save();
             }
         }
     
         return redirect()->route(ADMIN . '.subcategories.index')->withSuccess(trans('app.success_update'));
     }
 
    
     public function destroy($id)
     {
         Category::destroy($id);
 
         return redirect()->route(ADMIN . '.subcategories.index')->withSuccess(trans('app.success_destroy'));
     }
}
