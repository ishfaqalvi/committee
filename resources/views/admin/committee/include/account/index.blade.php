@extends('admin.layout.app')

@section('title')
    {{ $committee->name ??  __('Show')." Committee" }}
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Committee Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('committees.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill me-2">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-arrow-circle-left"></i>
                </span>
                Back
            </a>
        </div>
    </div>
</div>
<div class="page-header-content d-lg-flex border-top">
    @include('admin.committee.include.navigation')
</div>
@endsection

@section('content')
<div class="d-lg-flex align-items-lg-start">
    <div class="card">
        <div class="card-header d-flex align-items-center py-0">
            <h6 class="py-3 mb-0">Committee Detail</h6>
        </div>
        <table class="table">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Mobile #</th>
                    <th>Email</th>
                    <th>Received Amount</th>
                    <th>Paid Amount</th>
                    <th>Balance</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($committee->members as $key => $member)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ $member->user->name }}</td>
                    <td>{{ $member->user->mobile_number }}</td>
                    <td>{{ $member->user->email }}</td>
                    <td>{{ number_format($member->receivable) }}</td>
                    <td>{{ number_format($member->payable) }}</td>
                    <td>{{ number_format($member->receivable-$member->payable) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function () {
        const swalInit = swal.mixin({
            buttonsStyling: false,
            customClass: {
                confirmButton: 'btn btn-primary',
                cancelButton: 'btn btn-light',
                denyButton: 'btn btn-light',
                input: 'form-control'
            }
        });
        $(".sa-publish").click(function (event) {
            event.preventDefault();
            swalInit.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, publish it!',
                cancelButtonText: 'No, cancel!',
                buttonsStyling: false,
                customClass: {
                    confirmButton: 'btn btn-success',
                    cancelButton: 'btn btn-danger'
                }
            }).then((result) => {
                if (result.value === true)  $(this).closest("form").submit();
            });
        });
    });
</script>
@endsection