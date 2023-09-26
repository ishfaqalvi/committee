<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\User;

/**
 * Class MemberController
 * @package App\Http\Controllers
 */
class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:members-list',  ['only' => ['index']]);
        $this->middleware('permission:members-view',  ['only' => ['show']]);
        $this->middleware('permission:members-create',['only' => ['create','store']]);
        $this->middleware('permission:members-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:members-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = User::createdByUser()->get();

        return view('admin.member.index', compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $member = new User();
        return view('admin.member.create', compact('member'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $member = User::create($request->all());
        $member->assignRole(3);
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

        return view('admin.member.show', compact('member'));
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

        return view('admin.member.edit', compact('member'));
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
        $this->validate($request, [
            'name'          => 'required',
            'email'         => 'required',
            'password'      => 'same:confirm_password',
            'mobile_number' => 'required',
        ]);
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
        $member = User::find($id)->delete();

        return redirect()->route('members.index')
            ->with('success', 'Member deleted successfully');
    }

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkEmail(Request $request)
    {
        $query = User::where('email', $request->email);
        if ($request->id) {
            $query = $query->where('id','!=',$request->id); 
        }   
        $user = $query->first();

        if($user){ echo "false"; }else{ echo "true";}
    }

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkPhone(Request $request)
    {
        $query = User::where('mobile_number', $request->mobile_number);
        if ($request->id) {
            $query = $query->where('id','!=',$request->id); 
        }   
        $user = $query->first();

        if($user){ echo "false"; }else{ echo "true";}
    }
}
