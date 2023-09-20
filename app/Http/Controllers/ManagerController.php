<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\User;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('type','Manager')->get();

        return view('manager.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $manager = new User();
        $roles = Role::pluck('name','id');

        return view('manager.create', compact('manager','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::create($request->all());
        $user->assignRole($request->input('roles'));

        return redirect()->route('managers.index')
            ->with('success', 'Manager created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $manager = User::find($id);

        return view('manager.show', compact('manager'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $manager = User::find($id);
        $roles = Role::pluck('name','id');

        return view('manager.edit', compact('manager','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $manager)
    {
        $input = $request->all();
        if(empty($input['password'])){
            $input = Arr::except($input,array('password'));    
        }
        $manager->update($input);

        return redirect()->route('managers.index')
            ->with('success', 'Manager updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('managers.index')
            ->with('success', 'Manager deleted successfully');
    }
}