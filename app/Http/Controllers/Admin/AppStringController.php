<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\AppString;
use Illuminate\Http\Request;

/**
 * Class AppStringController
 * @package App\Http\Controllers
 */
class AppStringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('permission:appStrings-list',  ['only' => ['index']]);
        $this->middleware('permission:appStrings-view',  ['only' => ['show']]);
        $this->middleware('permission:appStrings-create',['only' => ['create','store']]);
        $this->middleware('permission:appStrings-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:appStrings-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appStrings = AppString::get();

        return view('admin.app-string.index', compact('appStrings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $appString = new AppString();
        return view('admin.app-string.create', compact('appString'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $appString = AppString::create($request->all());
        return redirect()->route('app-strings.index')
            ->with('success', 'AppString created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $appString = AppString::find($id);

        return view('admin.app-string.show', compact('appString'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appString = AppString::find($id);

        return view('admin.app-string.edit', compact('appString'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  AppString $appString
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AppString $appString)
    {
        $appString->update($request->all());

        return redirect()->route('app-strings.index')
            ->with('success', 'AppString updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $appString = AppString::find($id)->delete();

        return redirect()->route('app-strings.index')
            ->with('success', 'AppString deleted successfully');
    }
}
