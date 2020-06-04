<?php

namespace App\Http\Controllers;

use App\Client;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */

    public function __construct()
    {
        $this->middleware(['role:super_admin'])->except(['getLogin', 'login']);
    }

    public function index()
    {
        $items = User::latest('updated_at')->where('role', 'employee')->get();

        return view('admin.users.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, User::rules());

        $user = User::create($request->all());
        $user->assignRole('employee');
        return back()->withSuccess(trans('app.success_store'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = User::findOrFail($id);

        return view('admin.users.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, User::rules(true, $id));

        $item = User::findOrFail($id);

        $item->update($request->all());

        return redirect()->route(ADMIN . '.users.index')->withSuccess(trans('app.success_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);

        return back()->withSuccess(trans('app.success_destroy'));
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function login(Request $request)
    {
        $this->validate($request, User::rules());

        $credentials = $request->only('email', 'password');

        if (\Auth::attempt($credentials, $request->remember)) {
            $user = \Auth::user();
            if ($user->hasRole('client')) {
                return redirect()->route('profile', ['id' => $user->id]);
            }

            return redirect()->route('admin.dashboard');
        }

        return redirect()->back()->withErrors('حدث خطأ');
    }

    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getLogin()
    {
        return view('auth.login');
    }
}
