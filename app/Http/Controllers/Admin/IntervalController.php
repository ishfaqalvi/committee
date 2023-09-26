<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Interval;
use Illuminate\Http\Request;

/**
 * Class IntervalController
 * @package App\Http\Controllers
 */
class IntervalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:intervals-list',  ['only' => ['index']]);
        $this->middleware('permission:intervals-view',  ['only' => ['show']]);
        $this->middleware('permission:intervals-create',['only' => ['create','store']]);
        $this->middleware('permission:intervals-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:intervals-delete',['only' => ['destroy']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $interval = Interval::create($request->all());
        return redirect()->back()->with('success', 'New Member added successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $interval = Interval::find($id);

        return view('admin.interval.show', compact('interval'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $interval = Interval::find($id);

        return view('admin.interval.edit', compact('interval'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Interval $interval
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interval $interval)
    {
        if (in_array($interval->order, [1, 2]) || $interval->status != 'Pending') {
            return redirect()->back()->with('warning', 'Opps! This member order cannot be updated.');
        }
        $check = Interval::where([['committee_id',$interval->committee_id],['order',$request->order]])->first();
        if ($check && $check->id != $interval->id) {
            return redirect()->back()->with('warning', 'Opps! The value entered is already contains.');
        }
        $interval->update(['order' => $request->order]);

        return redirect()->back()->with('success', 'Member order updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $interval = Interval::find($id);
        if (in_array($interval->order, [1, 2])) {
            return redirect()->back()->with('warning', 'Opps! This member cannot be deleted.');
        }
        $interval->delete();
        return redirect()->back()->with('success', 'Member removed successfully');
    }

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkOrder(Request $request)
    {
        $interval = Interval::where([['committee_id', $request->id],['order',$request->order]])->first();
        if(!empty($interval)) { echo "false"; }else{ echo "true";}
    }
}
