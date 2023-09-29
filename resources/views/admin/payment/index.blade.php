@extends('admin.layout.app')

@section('title')
    Payment
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Payment Managment</span>
        </h4>
    </div>
</div>
@endsection

@section('content')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Payment</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
                    <th>Committee</th>
                    <th>Amount</th>
					<th>Member</th>
					<th>Date</th>
                    <th>Approval</th>
					<th>Status</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($payments as $key => $payment)
                <tr>
                    <td>{{ ++$key }}</td>
					<td>{{ $payment->interval->committee->name }}</td>
                    <td>{{ number_format($payment->interval->committee->amount) }}</td>
					<td>{{ $payment->user->name }}</td>
					<td>@if(!empty($payment->date)){{ date('Y-m-d', $payment->date) }} @endif</td>
					<td>{{ $payment->approval }}</td>
					<td>
                        {{ $payment->status }}
                        @php($tag = $payment->tags)
                        @if(!empty($tag) && $tag == 'Late')
                            <span class="badge bg-warning rounded-pill">{{ $tag }}</span>
                        @endif 
                        @if(!empty($tag) && $tag == 'On Time')
                            <span class="badge bg-success rounded-pill">{{ $tag }}</span>
                        @endif
                    </td>
                    <td class="text-center">@include('admin.payment.actions')</td>
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
    });
</script>
@endsection
