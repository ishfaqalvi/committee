<?php

namespace App\Http\Controllers\Admin\Committee;
use App\Http\Controllers\Controller;

use App\Models\{Payment,Committee};
use Illuminate\Http\Request;

/**
 * Class PaymentController
 * @package App\Http\Controllers
 */
class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:committeePayment-list',   ['only' => ['index']]);
        $this->middleware('permission:committeePayment-approve',['only' => ['update']]);
        $this->middleware('permission:committeePayment-reject', ['only' => ['update']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $committee = Committee::with(['members.submissions'])->find($id);

        $submissions = $committee->members->flatMap(function ($member) {
            return $member->submissions()->whereStatus('Pending')->get();
        });

        return view('admin.committee.include.payment.index', compact('committee', 'submissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        $payment->update($request->all());
        $member = $payment->submission->committeeMember;
        $member->increment('payable',$payment->amount);

        return redirect()->back()->with('success', 'Payment updated successfully.');
    }
}
