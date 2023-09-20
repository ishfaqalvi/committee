<?php

namespace App\Http\Controllers;

use App\Models\Committee;
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
    public function index()
    {
        $committees = Committee::get();

        return view('committee.index', compact('committees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $committee = new Committee();
        return view('committee.create', compact('committee'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate(Committee::$rules);

        $committee = Committee::create($request->all());

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

        return view('committee.show', compact('committee'));
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

        return view('committee.edit', compact('committee'));
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
        request()->validate(Committee::$rules);

        $committee->update($request->all());

        return redirect()->route('committees.index')
            ->with('success', 'Committee updated successfully');
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
}
