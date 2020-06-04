<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\User;


class EmployeeController extends Controller
{
    
    
    public function __construct()
    {
        $this->middleware(['role:super_admin'])->except(['getLogin', 'login']);
    }

    public function index()
    {
        $items = Employee::latest('updated_at')->get();
        $items->load('User');

        return view('admin.employees.index', compact('items'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

     
    public function store(Request $request)
    {
        $this->validate($request, User::rules());

        $user = User::create($request->all());
        
        $user->assignRole('employee');
        $employee = new Employee([
            'nid' =>   $request->nid,
            'nid_details' =>   $request->nid_details,
            'details' =>   $request->details,
            'user_id' => $user->id,
        ]);

        $employee->save();
        return back()->withSuccess(trans('app.success_store'));
    }

   
 
    public function show($id)
    {
        
    }

     
    public function edit($id)
    {
        $item = Employee::findOrFail($id);
        $item->load('User');

        return view('admin.employees.edit', compact('item'));
    }

    
    public function update(Request $request, $id)
    {
        $item = Employee::findOrFail($id);
        $user = user::findOrFail($item->user_id);
        $this->validate($request, [   'email' => 'required|max:100|unique:users,email,'.$item->user->id,
        ], User::rules(true, $id));


       

        $user->update($request->all());

          
        if ($request->hasFile('image')) {
            if ($request->file('image')->isValid()) {
                $item->image=  $request->image->move('employees_image/', $request->image->getClientOriginalName());
                $item->save();
            }
        }

     
        $item->update($request->all());

        return redirect()->route(ADMIN . '.employees.index')->withSuccess(trans('app.success_update'));

        
        


        // $item->type=  $request->type;
        // $item->details =$request->details;
        // $item->save();




    }

    
    public function destroy($id)
    {
        Employee::destroy($id);

        return back()->withSuccess(trans('app.success_destroy'));
    }

}
