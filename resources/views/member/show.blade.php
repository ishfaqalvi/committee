@extends('layouts.app')

@section('title')
    {{ $manager->name ?? "{{ __('Show') Manager" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Manager</span>
        </h4>
        <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
            <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
        </a>
    </div>
    <div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('managers.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">{{ __('Show') }} Manager</h5>
        </div>
        <div class="card-body">
            <div class="form-group">
                <strong>Name:</strong>
                {{ $manager->name }}
            </div>
            <div class="form-group">
                <strong>Email:</strong>
                {{ $manager->email }}
            </div>
            <div class="form-group">
                <strong>Mobile Number:</strong>
                {{ $manager->mobile_number }}
            </div>
            <div class="form-group">
                <strong>Image:</strong>
                {{ $manager->image }}
            </div>
            <div class="form-group">
                <strong>Type:</strong>
                {{ $manager->type }}
            </div>
        </div>
    </div>
</div>
@endsection