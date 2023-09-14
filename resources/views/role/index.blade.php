@extends('layouts.app')

@section('title')
    Role
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Role</span>
        </h4>
        <a href="#page_header" class="btn btn-light align-self-center collapsed d-lg-none border-transparent rounded-pill p-0 ms-auto" data-bs-toggle="collapse">
            <i class="ph-caret-down collapsible-indicator ph-sm m-1"></i>
        </a>
    </div>
    <div class="collapse d-lg-block my-lg-auto ms-lg-auto" id="page_header">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route(':roles.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
            <h5 class="mb-0">Role</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    
										<th>Name</th>
										<th>Guard Name</th>

                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($roles as $role)
                    <tr>
                        <td>{{ ++$i }}</td>
                        
											<td>{{ $role->name }}</td>
											<td>{{ $role->guard_name }}</td>

                        <td class="text-center">
                            <div class="d-inline-flex">
                                <div class="dropdown">
                                    <a href="#" class="text-body" data-bs-toggle="dropdown">
                                        <i class="ph-list"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <a href="#" class="dropdown-item">
                                            <i class="ph-file-pdf me-2"></i>
                                            Export to .pdf
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <i class="ph-file-xls me-2"></i>
                                            Export to .csv
                                        </a>
                                        <a href="#" class="dropdown-item">
                                            <i class="ph-file-doc me-2"></i>
                                            Export to .doc
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <form action="{{ route(':roles.destroy',$role->id) }}" method="POST">
                                <a class="btn btn-sm btn-primary " href="{{ route(':roles.show',$role->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                <a class="btn btn-sm btn-success" href="{{ route(':roles.edit',$role->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {!! $roles->links() !!}
    </div>
</div>
@endsection
