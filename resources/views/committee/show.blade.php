@extends('layouts.app')

@section('title')
    {{ $committee->name ?? "{{ __('Show') Committee" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Committee</span>
        </h4>
        <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
            <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
        </a>
    </div>
    <div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('committees.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-arrow-circle-left"></i>
                </span>
                Back
            </a>
            <a href="{{ route('committees.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill ms-3">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-arrow-circle-left"></i>
                </span>
                Add Members
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ __('Show') }} Committee</h5>
        </div>
        <div class="card-body">
            
            <div class="form-group">
                <strong>Name:</strong>
                {{ $committee->name }}
            </div>
            <div class="form-group">
                <strong>Type:</strong>
                {{ $committee->type }}
            </div>
            <div class="form-group">
                <strong>Amount:</strong>
                {{ $committee->amount }}
            </div>
            <div class="form-group">
                <strong>Status:</strong>
                {{ $committee->status }}
            </div>
            <div class="form-group">
                <strong>User Id:</strong>
                {{ $committee->user_id }}
            </div>

        </div>
    </div>
</div>
@endsection