@extends('admin.layout.app')

@section('title')
    Payments
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Payments Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('committees.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Payment</h5>
        </div>
        <div class="table-responsive">
            <table class="table text-nowrap">
                <thead>
                    <tr>
                        <th>Attachment</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Remarks</th>
                        <th>Status</th>
                        <th class="text-center"><i class="ph-dots-three"></i></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $submission)
                    <tr class="table-light">
                        <td colspan="5" class="fw-semibold">{{ $submission->user->name }}</td>
                        <td class="text-end">
                            <span class="badge bg-secondary rounded-pill">
                                {{ $submission->payments()->count() }}
                            </span>
                        </td>
                    </tr>
                    @foreach($submission->payments as $payment)
                    <tr>
                        <td class="pe-0">
                            <a href="#">
                                <img src="{{ $payment->attachment}}" height="60" alt="">
                            </a>
                        </td>
                        <td>{{ date('d M Y',$payment->date) }}</td>
                        <td>{{ number_format($payment->amount) }}</td>
                        <td>{{ Str::limit($payment->remarks, 40) }}</td>
                        <td>{{ $payment->status }}</td>
                        <td class="text-center">
                            @if($payment->status == 'Pending' && auth()->user()->can('committeePayment-approve'))
                                <form action="{{ route('committees.payments.update',$payment->id) }}" method="POST">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    <input type="hidden" name="status" value="Approved">
                                    <a href="#" class="text-success sa-approved" data-bs-popup="tooltip" title="Approved">
                                        <i class="ph-check-square"></i>
                                    </a>
                                </form>
                            @endif
                            @if($payment->status == 'Pending' && auth()->user()->can('committeePayment-reject'))
                                <form action="{{ route('committees.payments.update',$payment->id) }}" method="POST">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    <input type="hidden" name="status" value="Not Approved">
                                    <a href="#" class="text-danger sa-rejected" data-bs-popup="tooltip" title="Not Approved">
                                        <i class="ph-x-square"></i>
                                    </a>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
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
        $(".sa-confirm").click(function (event) {
            event.preventDefault();
            swalInit.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
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
        $(".sa-approved").click(function (event) {
            event.preventDefault();
            swalInit.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approve it!',
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
        $(".sa-rejected").click(function (event) {
            event.preventDefault();
            swalInit.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, reject it!',
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