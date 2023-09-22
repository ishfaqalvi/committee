@extends('auth.layout.app')

@section('page_title', 'Register')

@section('page_content')
<form method="POST" action="{{ route('register') }}" class="flex-fill">
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="d-inline-flex align-items-center justify-content-center mb-4 mt-2">
                            <img src="https://demo.interface.club/limitless/demo/template/assets/images/logo_icon.svg" class="h-48px" alt="">
                        </div>
                        <h5 class="mb-0">Create account</h5>
                        <span class="d-block text-muted">Fill all required fields.</span>
                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger border-0 alert-dismissible fade show">
                            @foreach ($errors->all() as $error)
                            <span class="fw-semibold">Oh snap!</span> {{ $error }}
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">First name</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="text" class="form-control" placeholder="John" name="f_name">
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-user-circle-plus text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Last name</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="text" class="form-control" placeholder="Doe" name="l_name">
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-user-circle-plus text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Create password</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="password" class="form-control" placeholder="•••••••••••" name="password">
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-lock text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Repeat password</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="password" class="form-control" placeholder="•••••••••••" name="confirm_password">
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-lock text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Your email</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="email" class="form-control" placeholder="john@doe.com" name="email">
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-at text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label class="form-label">Mobile Number</label>
                                <div class="form-control-feedback form-control-feedback-start">
                                    <input type="email" class="form-control" placeholder="john@doe.com" name="mobile_number">
                                    <div class="form-control-feedback-icon">
                                        <i class="ph-at text-muted"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="form-check mb-2">
                            <input type="checkbox" name="remember" class="form-check-input" checked>
                            <span class="form-check-label">Send me <a href="#">&nbsp;test account settings</a></span>
                        </label>

                        <label class="form-check mb-2">
                            <input type="checkbox" name="remember" class="form-check-input" checked>
                            <span class="form-check-label">Subscribe to monthly newsletter</span>
                        </label>

                        <label class="form-check">
                            <input type="checkbox" name="remember" class="form-check-input">
                            <span class="form-check-label">Accept <a href="#">&nbsp;terms of service</a></span>
                        </label>
                    </div>
                </div>

                <div class="card-body text-end border-top">
                    <button type="submit" class="btn btn-primary">
                        <i class="ph-plus me-2"></i>
                        Create account
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection