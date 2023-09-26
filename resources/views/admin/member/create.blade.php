@extends('admin.layout.app')

@section('title')
{{ __('Create') }} Member
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Member Managment</span>
        </h4>
    </div>
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="{{ route('members.index') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
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
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">{{ __('Create') }} Member</h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('members.store') }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                @include('admin.member.form')
            </form>
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
                password: {
                    required: true,
                    minlength:8,
                    maxlength:15
                },    
                confirm_password:{
                    required: true,
                    equalTo: "#password"
                },
                email:{
                    "remote":
                    {
                        url: "{{ route('members.checkEmail') }}",
                        type: "POST",
                        data: {
                            _token:_token,
                            email: function() {
                                return $("input[name='email']").val();
                            }
                        },
                    }
                },
                mobile_number:{
                    "remote":
                    {
                        url: "{{ route('members.checkPhone') }}",
                        type: "POST",
                        data: {
                            _token:_token,
                            mobile_number: function() {
                                return $("input[name='mobile_number']").val();
                            }
                        },
                    }
                }
            },
            messages:{
                email:{
                    required: "Please enter a valid email address.",
                    remote: jQuery.validator.format("{0} is already exist.")
                },
                mobile_number:{
                    required: "Please enter a valid mobile number address.",
                    remote: jQuery.validator.format("{0} is already exist.")
                }
            }
        });
    });
</script>
@endsection
