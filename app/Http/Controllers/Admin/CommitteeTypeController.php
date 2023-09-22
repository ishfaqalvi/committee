<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\CommitteeType;
use Illuminate\Http\Request;

/**
 * Class CommitteeTypeController
 * @package App\Http\Controllers
 */
class CommitteeTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:committeeTypes-list',  ['only' => ['index']]);
        $this->middleware('permission:committeeTypes-view',  ['only' => ['show']]);
        $this->middleware('permission:committeeTypes-create',['only' => ['create','store']]);
        $this->middleware('permission:committeeTypes-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:committeeTypes-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $committeeTypes = CommitteeType::get();

        return view('admin.committee-type.index', compact('committeeTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $committeeType = new CommitteeType();
        return view('admin.committee-type.create', compact('committeeType'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $committeeType = CommitteeType::create($request->all());

        return redirect()->route('committee-types.index')
            ->with('success', 'CommitteeType created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $committeeType = CommitteeType::find($id);

        return view('admin.committee-type.show', compact('committeeType'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $committeeType = CommitteeType::find($id);

        return view('admin.committee-type.edit', compact('committeeType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  CommitteeType $committeeType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CommitteeType $type)
    {
        $type->update($request->all());

        return redirect()->route('committee-types.index')
            ->with('success', 'CommitteeType updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $committeeType = CommitteeType::find($id)->delete();

        return redirect()->route('committee-types.index')
            ->with('success', 'CommitteeType deleted successfully');
    }
}
