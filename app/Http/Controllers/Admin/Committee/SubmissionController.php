<?php

namespace App\Http\Controllers\Admin\Committee;
use App\Http\Controllers\Controller;

use App\Models\{Submission,Committee,CommitteeMember};
use Illuminate\Http\Request;

/**
 * Class SubmissionController
 * @package App\Http\Controllers
 */
class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:committeeSubmission-list',    ['only' => ['index']]);
        $this->middleware('permission:committeeSubmission-reminder',['only' => ['show']]);
        $this->middleware('permission:committeeSubmission-received',['only' => ['update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $committee = Committee::find($id);
        $member = CommitteeMember::where('committee_id', $id)->where('status', 'Active')->with('submissions')->first();
        return view('admin.committee.include.submission.index', compact('committee','member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Submission $submission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Submission $submission)
    {
        $submission->update($request->all());

        return redirect()->back()->with('success', 'Submission updated successfully.');
    }
}
