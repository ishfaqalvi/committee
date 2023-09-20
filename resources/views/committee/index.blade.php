@extends('layouts.app')

@section('title')
    Committee
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
            <a href="{{ route('committees.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Create New
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Committee</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
					<th>Name</th>
					<th>Type</th>
					<th>Amount</th>
					<th>Status</th>
					<th>Manager</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($committees as $key => $committee)
                    <tr>
                        <td>{{ ++$key }}</td>
						<td>{{ $committee->name }}</td>
						<td>{{ $committee->type }}</td>
						<td>{{ $committee->amount }}</td>
						<td>{{ $committee->status }}</td>
						<td>{{ $committee->user->name }}</td>
                        <td class="text-center">@include('committee.actions')</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection