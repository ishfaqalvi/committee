@extends('admin.layout.app')

@section('title')
    Submission
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Submission Managment</span>
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
            <h5 class="mb-0">Submission</h5>
        </div>
        @if(isset($member))
        <div class="card-body">
            <div class="border rounded mb-3">
                <ul class="list-group list-group-borderless">
                    <li class="list-group-item d-flex align-items-start">
                        <a href="#" class="d-inline-flex align-items-center me-3">
                            <img src="{{ $member->user->image }}" width="60" height="60" class="rounded-circle"
                                alt="">
                        </a>
                        <div class="flex-fill">
                            <div class="fw-semibold">{{ $member->user->name }}</div>
                            {{ $member->user->email }}
                            <div class="fw-semibold">{{ $member->user->mobile_number }}</div>
                        </div>
                        <div class="ms-3">
                            <div>
                                Start Date : <span class="fw-semibold">{{ date('d M Y',$member->start_date) }}</span>
                            </div>
                            <div>
                                Due Date : <span class="fw-semibold">{{ date('d M Y',$member->due_date) }}</span>
                            </div>
                            <div>
                                Close Date : <span class="fw-semibold">{{ date('d M Y',$member->close_date) }}</span>
                            </div>
                        </div>
                        <div class="ms-3">
                            @if($member->receivable == 0 && auth()->user()->id == $member->committee->created_by)
                            <form action="{{ route('committees.members.submit',$member->id) }}" method="POST">
                                @csrf
                                {{ method_field('PATCH') }}
                                <a href="#" class="btn btn-success btn-xs btn-icon sa-submitted" data-bs-popup="tooltip" title="Submit Committee">
                                    <i class="ph-check-square"></i>
                                </a>
                            </form>
                            @endif
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead">
                    <tr>
                        <th>No</th>
    					<th>Member</th>
                        <th>Receiveable Amount</th>
                        <th>Received Amount</th>
                        <th>Remaining Amount</th>
    					<th>Tags</th>
    					<th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($member->submissions as $key => $submission)
                    @php($amount = $submission->committeeMember->committee->amount)
                    @php($recieved = $submission->payments()->sum('amount'))
                    @php($remaining = $submission->committeeMember->committee->amount - $submission->payments()->sum('amount'))
                    <tr>
                        <td>{{ ++$key }}</td>
    					<td>{{ $submission->user->name }}</td>
                        <td>{{ number_format($amount) }}</td>
                        <td>{{ number_format($recieved) }}</td>
                        <td>{{ number_format($remaining) }}</td>
    					<td>{{ $submission->tags }}</td>
    					<td>{{ $submission->status }}</td>
                        <td class="text-center">
                            @if(
                                $submission->status == 'Pending' && 
                                $remaining < 1 &&
                                auth()->user()->can('committeeSubmission-received')
                                )
                                <form action="{{ route('committees.submissions.update',$submission->id) }}" method="POST">
                                    @csrf
                                    {{ method_field('PATCH') }}
                                    <input type="hidden" name="status" value="Received">
                                    <a href="#" class="text-success sa-approved" data-bs-popup="tooltip" title="Received">
                                        <i class="ph-check-square"></i>
                                    </a>
                                </form>
                            @endif
                            @if($remaining > 0 && auth()->user()->can('committeeSubmission-reminder'))
                            <a href="#" class="text-warning sa-publish" data-bs-popup="tooltip" title="Send Reminder">
                                <i class="ph-bell-ringing"></i>
                            </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
        <div class="card-body">
            <div class="alert bg-warning text-white">
                <span class="fw-semibold">Heads up!</span> Submission is only available when committe is in running state.
                <i class="ph-warning-circle float-end ms-2"></i>
            </div>
        </div>
        @endif
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
        $(".sa-approved").click(function (event) {
            event.preventDefault();
            swalInit.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, received it!',
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
        $(".sa-submitted").click(function (event) {
            event.preventDefault();
            swalInit.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, submit it!',
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