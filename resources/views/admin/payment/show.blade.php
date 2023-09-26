@extends('admin.layout.app')

@section('title')
    {{ $payment->name ?? "{{ __('Show') Payment" }}
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
        <div class="card-body d-flex justify-content-around">
            <div class="form-group d-flex flex-column">
                 
                        <div class="form-group">
                            <strong>Interval Id:</strong>
                            {{ $payment->interval_id }}
                        </div>
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $payment->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Date:</strong>
                            {{ $payment->date }}
                        </div>
                        <div class="form-group">
                            <strong>Remarks:</strong>
                            {{ $payment->remarks }}
                        </div>
                        <div class="form-group">
                            <strong>Attachment:</strong>
                            {{ $payment->attachment }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $payment->status }}
                        </div>

            </div>

        </div>
    </div>
</div>
@endsection
