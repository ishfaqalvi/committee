<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Member;
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
        $members = Member::createdByUser()->with('user','createdBy')->get();
        
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
        $user = User::create($request->all());
        $user->assignRole(3);
        Member::create(['user_id' => $user->id, 'created_by' => $request->created_by]);

        return redirect()->route('members.index')
            ->with('success', 'Member created successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        Member::create(['user_id' => $request->user_id, 'created_by' => $request->created_by]);
        
        return redirect()->back()->with('success', 'Member added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $member = Member::find($id);

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
        if (auth()->user()->id == $member->created_by) {
            return view('admin.member.edit', compact('member'));    
        }
        return redirect()->back()
            ->with('warning', 'Oops! You are not the creater of this member.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  User $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
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
        $user->update($input);

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
        $member = Member::find($id)->delete();

        return redirect()->route('members.index')
            ->with('success', 'Member removed successfully.');
    }

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $parameter = $request->q;
        $page      = $request->page;
        $users     = User::where('name', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('email', 'LIKE', '%' . $parameter . '%')
                    ->orWhere('mobile_number', 'LIKE', '%' . $parameter . '%')
                    ->paginate(10, ['*'], 'page', $page)->toArray();
        return $users;
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

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkMember(Request $request)
    {
        $member = Member::where([['user_id', $request->user],['created_by',$request->parent]])->first();
        if($member){ echo "false"; }else{ echo "true";}
    }
}