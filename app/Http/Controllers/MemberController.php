<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('type','Member')->get();

        return view('member.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $member = new User();
        $roles = Role::pluck('name','id');

        return view('member.create', compact('member','roles'));
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

        return redirect()->route('members.index')
            ->with('success', 'Member created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = User::find($id);

        return view('member.show', compact('member'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $member = User::find($id);
        $roles = Role::pluck('name','id');

        return view('member.edit', compact('member','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $member)
    {
        $input = $request->all();
        if(empty($input['password'])){
            $input = Arr::except($input,array('password'));    
        }
        $member->update($input);

        return redirect()->route('members.index')
            ->with('success', 'Member updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect()->route('members.index')
            ->with('success', 'Member deleted successfully');
    }
}
