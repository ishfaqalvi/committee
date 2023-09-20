@extends('layouts.app')

@section('title')
    Member
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Member</span>
        </h4>
        <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
            <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
        </a>
    </div>
    <div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('members.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">Member</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
					<th>Name</th>
					<th>Email</th>
					<th>Phone #</th>
                    <th>Role</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $member)
                    <tr>
                        <td>{{ ++$key }}</td>
						<td>{{ $member->name }}</td>
						<td>{{ $member->email }}</td>
                        <td>{{ $member->mobile_number }}</td>
						<td>
                            @if(!empty($member->getRoleNames()))
                                @foreach($member->getRoleNames() as $v)
                                    <span class="badge bg-primary rounded-pill">{{ $v }}</span>
                                @endforeach
                            @endif
                        </td>
                        <td class="text-center">@include('member.actions')</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection