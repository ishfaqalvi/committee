<?php

namespace App\Http\Controllers\Admin\Committee;

use App\Http\Controllers\Controller;
use App\Models\Committee;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $committee = Committee::find($id);

        return view('admin.committee.include.account.index', compact('committee'));
    }
}
