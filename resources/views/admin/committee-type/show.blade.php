@extends('layouts.app')

@section('title')
    {{ $committeeType->name ?? "{{ __('Show') Committee Type" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Committee Type Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('committee-types.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Committee Type</h5>
        </div>
        <div class="card-body d-flex justify-content-around">
            <div class="form-group d-flex flex-column">
                 
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $committeeType->name }}
                        </div>
                        <div class="form-group">
                            <strong>Type:</strong>
                            {{ $committeeType->type }}
                        </div>
                        <div class="form-group">
                            <strong>Duration Days:</strong>
                            {{ $committeeType->duration_days }}
                        </div>

            </div>

        </div>
    </div>
</div>
@endsection
