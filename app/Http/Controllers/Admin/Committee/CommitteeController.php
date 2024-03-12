<?php

namespace App\Http\Controllers\Admin\Committee;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Member;
use App\Models\Committee;
use App\Models\CommitteeType;
use App\Models\Interval;
use Illuminate\Http\Request;

/**
 * Class CommitteeController
 * @package App\Http\Controllers
 */
class CommitteeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:committees-list',   ['only' => ['index']]);
        $this->middleware('permission:committees-view',   ['only' => ['show']]);
        $this->middleware('permission:committees-create', ['only' => ['create','store']]);
        $this->middleware('permission:committees-edit',   ['only' => ['edit','update']]);
        $this->middleware('permission:committees-publish',['only' => ['publish']]);
        $this->middleware('permission:committees-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $committees = Committee::userRoleWise()->get();

        return view('admin.committee.index', compact('committees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $committee = new Committee();
        $types = CommitteeType::pluck('name', 'id');
        return view('admin.committee.create', compact('committee','types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $committee = Committee::create($request->all());
            $members = [
                ['user_id'=>2,                   'order' => 1, 'role'=>'Application'],
                ['user_id'=>$request->created_by,'order' => 2, 'role'=>'Manager']
            ];
            $committee->members()->createMany($members);
        });

        return redirect()->route('committees.index')
            ->with('success', 'Committee created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $committee = Committee::find($id);

        return view('admin.committee.include.show.index', compact('committee'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $committee = Committee::find($id);
        $types = CommitteeType::pluck('name', 'id');

        return view('admin.committee.edit', compact('committee','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Committee $committee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Committee $committee)
    {
        $committee->update($request->all());

        return redirect()->route('committees.index')
            ->with('success', 'Committee updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Committee $committee
     * @return \Illuminate\Http\Response
     */
    public function publish(Request $request, Committee $committee)
    {
        $committee->update($request->all());
        $startDate = $committee->start_date;
        $endDate = addDays($startDate, $committee->committeeType->duration_days);
        $dueDate = addDays($startDate, $committee->collection_days);
        foreach($committee->members()->orderBy('order')->get() as $member)
        {
            $member->update([
                'start_date'=> $startDate,
                'close_date'=> $endDate,
                'due_date'  => $dueDate
            ]);
            $startDate= $member->close_date + 86400;
            $dueDate  = addDays($startDate, $committee->collection_days);
            $endDate  = addDays($startDate, $committee->committeeType->duration_days);
        }

        return redirect()->back()->with('success', 'Committee publish successfully.');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $committee = Committee::find($id)->delete();

        return redirect()->route('committees.index')
            ->with('success', 'Committee deleted successfully');
    }

    /**
     * Validate a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function checkDays(Request $request)
    {
        $type = CommitteeType::find($request->id);
        if($request->days > $type->duration_days) { echo "false"; }else{ echo "true";}
    }
}
