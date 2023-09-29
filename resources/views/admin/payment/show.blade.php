@extends('admin.layout.app')

@section('title')
    {{ $payment->name ?? "Show Payment" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Payment Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('payments.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-arrow-circle-left"></i>
                </span>
                Back
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ __('Show') }} Payment</h5>
        </div>
        <div class="card-body">
            <div class="d-flex flex-column">
                <div class="form-group mb-3">
                    <strong>Committee:</strong>
                    {{ $payment->interval->committee->name }}
                </div>
                <div class="form-group mb-3">
                    <strong>Amount:</strong>
                    {{ number_format($payment->interval->committee->amount) }}
                </div>
                <div class="form-group mb-3">
                    <strong>Recievable Member:</strong>
                    {{ $payment->interval->user->name }}
                </div>
                <div class="form-group mb-3">
                    <strong>Payable Member:</strong>
                    {{ $payment->user->name }}
                </div>
                <div class="form-group mb-3">
                    <strong>Date:</strong>
                    {{ date('Y-m-d', $payment->date) }}
                </div>
                <div class="form-group mb-3">
                    <strong>Approval:</strong>
                    {{ $payment->approval }}
                </div>
                <div class="form-group mb-3">
                    <strong>Status:</strong>
                    {{ $payment->status }}
                    @php($tag = $payment->tags)
                    @if(!empty($tag) && $tag == 'Late')
                        <span class="badge bg-warning rounded-pill">{{ $tag }}</span>
                    @endif 
                    @if(!empty($tag) && $tag == 'On Time')
                        <span class="badge bg-success rounded-pill">{{ $tag }}</span>
                    @endif
                </div>
                <div class="form-group mb-3">
                    <strong>Remarks:</strong>
                    {{ $payment->remarks }}
                </div>
                @if($payment->attachment != '' && isset($payment->attachment))
                <div class="form-group mb-3">
                    <strong>Attachment:</strong>
                    <img src="{{ $payment->attachment }}" max-width="100%"> 
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection