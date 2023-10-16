@extends('admin.layout.app')

@section('title')
    {{ $committee->name ?? "{{ __('Show') Committee" }}
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
            <a href="{{ route('committees.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
<div class="d-lg-flex align-items-lg-start">
    <div class="sidebar sidebar-component sidebar-expand-lg bg-transparent shadow-none me-lg-3">
        <div class="sidebar-content">
            <div class="card">
                <div class="sidebar-section-body text-center">
                    <div class="card-img-actions d-inline-block mb-3">
                        <img class="img-fluid rounded-circle" src="{{ $committee->user->image }}" width="150" height="150" alt="">
                    </div>
                    <h6 class="mb-0">{{ $committee->user->name }}</h6>
                    <span class="text-muted">{{ $committee->user->mobile_number }}</span>
                </div>
                <ul class="nav nav-sidebar">
                    <li class="nav-item">
                        <a href="#profile" class="nav-link active" data-bs-toggle="tab">
                            <i class="ph-book-open me-2"></i>
                            Committee Detail
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#members" class="nav-link" data-bs-toggle="tab">
                            <i class="ph-users-three me-2"></i>
                            Members
                            <span class="badge bg-secondary rounded-pill ms-auto">
                                {{ $committee->intervals()->count() }}
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#payments" class="nav-link" data-bs-toggle="tab">
                            <i class="ph-envelope me-2"></i>
                            Payments
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#interval" class="nav-link" data-bs-toggle="tab">
                            <i class="ph-sign-out me-2"></i>
                            Interval
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="tab-content flex-fill">
        <div class="tab-pane fade active show" id="profile">
            <div class="card">
                <div class="card-header d-sm-flex">
                    <h5 class="mb-0">Committee Detail</h5>
                </div>
                <div class="card-body">
                    @include('admin.committee.include.profile')
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="members">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Members</h5>
                </div>
                <div class="card-body">
                    @include('admin.committee.include.members')
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="payments">
            <div class="card">
                <div class="card-header d-flex">
                    <h5 class="mb-0">Payments</h5>
                </div>
                <div class="card-body d-flex align-items-start flex-wrap border-bottom">
                    
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="interval">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Interval</h5>
                </div>
                <div class="table-responsive">

                </div>
            </div>
        </div>
    </div>
</div>



























<div class="col-md-12">
    @can('intervals-create')
        @include('admin.interval.create')
    @endcan
    <div class="card">
        <div class="card-body">
            
            @can('intervals-list')
            <div class="row">
                @include('admin.interval.index')    
            </div>
            @endcan
            @can('intervals-view')
                @include('admin.interval.show')
            @endcan
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(function(){
        var _token = $("input[name='_token']").val();
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
            success: function(label) {
                label.addClass('validation-valid-label').text('Success.');
            },
            errorPlacement: function(error, element) {
                if (element.hasClass('select2-hidden-accessible')) {
                    error.appendTo(element.parent());
                }else if (element.parents().hasClass('form-control-feedback') || element.parents().hasClass('form-check') || element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                }else {
                    error.insertAfter(element);
                }
            },
            rules:{
                order:{
                    "remote":
                    {
                        url: "{{ route('intervals.checkOrder') }}",
                        type: "POST",
                        data: {
                            _token:_token,
                            id:function() {
                                return $("input[name='committee_id']").val();
                            },
                            days: function() {
                                return $("input[name='order']").val();
                            }
                        },
                    }
                }
            },
            messages:{
                order:{
                    remote: "The value entered is already contains."
                }
            }
        });
    });
</script>
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
        $(".sa-submit").click(function (event) {
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
        $(".sa-approve").click(function (event) {
            event.preventDefault();
            swalInit.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, approved it!',
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