@extends('layouts.app')

@section('title','Audit')

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">{{ __('Audit') }}</span>
        </h4>
        <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
            <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
        </a>
    </div>
</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ __('Audit') }}</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Model</th>
                    <th>Record ID</th>
                    <th>User</th>
                    <th>Time</th>
                    <th>Event</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($audits as $key => $audit)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $audit->auditable_type }}</td>
                        <td>{{ $audit->auditable_id }}</td>
                        <td>{{ $audit->user?->name }}</td>
                        <td>{{ $audit->created_at }}</td>
                        <td>
                            @if($audit->event == 'created')
                                <span class="label label-success">{{ $audit->event }}</span>
                            @elseif($audit->event == 'updated')
                                <span class="label label-info">{{ $audit->event }}</span>
                            @else
                                <span class="label label-warning">{{ $audit->event }}</span>
                            @endif
                        </td>
                        <td class="text-center">@include('audit.actions')</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection