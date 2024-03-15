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
    @foreach($committees as $committee)
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ $committee->name }} Payments</h5>
        </div>
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
                @foreach(getCurrentUserSubmissionsForCommittee($committee->id) as $submission)
                <tr class="table-light">
                    <td colspan="5" class="fw-semibold">
                        {{ $submission->committeeMember->user->name }}
                        <span class="badge bg-secondary rounded-pill">
                            {{ $submission->status }}
                        </span>
                    </td>
                    <td class="text-end">
                        @can('payments-create')
                        <a href="#" class="text-body addRecord" data-submission="{{ $submission->id }}">
                            <i class="ph-plus me-1"></i>
                            Add Payment
                        </a>
                        @endcan
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
                        @if($payment->status == 'Pending' && auth()->user()->can('payments-delete'))
                            <form action="{{ route('payments.destroy',$payment->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <a href="#" class="text-danger sa-confirm" data-bs-popup="tooltip" title="Delete">
                                    <i class="ph-trash"></i>
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
    @endforeach
</div>
@include('admin.payment.create')
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
        $('.validate').validate({
            errorClass: 'validation-invalid-label',
            successClass: 'validation-valid-label',
            validClass: 'validation-valid-label',
            highlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
                $(element).addClass('is-invalid');
                $(element).removeClass('is-valid');
            },
            unhighlight: function(element, errorClass) {
                $(element).removeClass(errorClass);
                $(element).removeClass('is-invalid');
                $(element).addClass('is-valid');
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }else if (element.parents().hasClass('form-control-feedback') || element.parents().hasClass('form-check') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                }else {
                    error.insertAfter(element);
                }
            }
        });
        $('.addRecord').on('click', function(e) {
            e.preventDefault();
            $('#submission_id').val($(this).data('submission'));
            $('#addRecord').modal('show');
        });
    });
</script>
@endsection
