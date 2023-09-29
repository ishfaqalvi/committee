<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Payment;
use Illuminate\Http\Request;
use DB;

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
        $this->middleware('permission:payments-list',  ['only' => ['index']]);
        $this->middleware('permission:payments-view',  ['only' => ['show']]);
        $this->middleware('permission:payments-create',['only' => ['create','store']]);
        $this->middleware('permission:payments-edit',  ['only' => ['edit','update']]);
        $this->middleware('permission:payments-delete',['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payments = Payment::userWise()->get();

        return view('admin.payment.index', compact('payments'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $payment = Payment::find($id);

        return view('admin.payment.show', compact('payment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment = Payment::find($id);

        return view('admin.payment.edit', compact('payment'));
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

        return redirect()->route('payments.index')
            ->with('success', 'Payment updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function submit(Request $request, Payment $payment)
    {
        DB::transaction(function() use($payment, $request){
            $committee = $payment->interval->committee;

            // Submitt payment
            $date = strtotime(date('Y-m-d'));
            $tag = $date > $payment->interval->close_date ? 'Late' : 'On Time';
            $payment->update([
                'date'      => date('Y-m-d'),
                'remarks'   => 'Committee submitted and approved by manager.',
                'tags'      => $tag,
                'approval'  => 'Approved',
                'status'    => 'Submitted'
            ]);

            // Update recievable payments
            $payment->interval->increment('receivable',$committee->amount);
            
            // Update payable payments 
            $interval = $committee->intervals()->where('user_id', $payment->user_id)->first();
            $interval->increment('payable', $committee->amount);
        }); 
        return redirect()->back()->with('success', 'Payment Submitted successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Payment $payment
     * @return \Illuminate\Http\Response
     */
    public function approve(Request $request, Payment $payment)
    {
        DB::transaction(function() use($payment, $request){
            $committee = $payment->interval->committee;

            // Submitt payment
            $tag = $payment->date > $payment->interval->close_date ? 'Late' : 'On Time';
            $payment->update(['tags' => $tag, 'approval'  => 'Approved']);

            // Update recievable payments
            $payment->interval->increment('receivable',$committee->amount);
            
            // Update payable payments 
            $interval = $committee->intervals()->where('user_id', $payment->user_id)->first();
            $interval->increment('payable', $committee->amount);
        }); 
        return redirect()->back()->with('success', 'Payment approved successfully.');
    }
}
