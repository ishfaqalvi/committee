<?php

namespace App\Http\Controllers\Admin\Committee;
use App\Http\Controllers\Controller;

use App\Models\{User,Member,Committee,CommitteeMember};
use Illuminate\Http\Request;

/**
 * Class CommitteeMemberController
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
        $this->middleware('permission:committeeMembers-list',  ['only' => ['index']]);
        $this->middleware('permission:committeeMembers-create',['only' => ['store']]);
        $this->middleware('permission:committeeMembers-edit',  ['only' => ['update']]);
        $this->middleware('permission:committeeMembers-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $committee = Committee::find($id);

        return view('admin.committee.include.member.index', compact('committee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        CommitteeMember::create($request->all());
        return redirect()->back()->with('success', 'Member added successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  CommitteeMember $committeeMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        foreach($request->ids as $k => $id){
            CommitteeMember::find($id)->update(['order' => $k]);
        }
        return redirect()->back()->with('success', 'Member list updated successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $member = CommitteeMember::find($id);
        if ($member->role != 'Member'){
            return redirect()->back()->with('warning', 'Opps! This member cannot be deleted.');
        }elseif($member->submissions()->count() > 0) {
            return redirect()->back()->with('warning', 'Opps! Data exist against this member.');
        }
        $member->delete();
        return redirect()->back()->with('success', 'Member removed successfully');
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
        $members   = Member::where('created_by', auth()->user()->id)->pluck('user_id');
        $users     = User::whereIn('id', $members)->where(function ($query) use ($parameter) {
                        $query->where('name', 'LIKE', '%' . $parameter . '%')
                        ->orWhere('email', 'LIKE', '%' . $parameter . '%')
                        ->orWhere('mobile_number', 'LIKE', '%' . $parameter . '%');
                    })->paginate(10, ['*'], 'page', $page)->toArray();
        return $users;
    }
}
