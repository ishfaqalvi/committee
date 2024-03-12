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
            @if($committee->status == 'Pending')
            <div class="ms-auto my-auto">
                <form action="{{ route('committees.publish',$committee->id) }}" method="POST">
                    @csrf
                    {{ method_field('PATCH') }}
                    <input type="hidden" name="status" value="Active">
                    <button type="button" class="btn btn-outline-pink btn-icon sa-publish">
                        <i class="ph-fast-forward-circle"></i>
                    </button>
                </form>
            </div>
            @endif
        </div>
        <div class="card-body">
            <div class="d-lg-flex align-items-lg-center mb-4">
                <a href="#" class="d-block me-lg-3 mb-3 mb-lg-0">
                    <img src="{{ $committee->user->image }}" class="rounded" width="44" height="44" alt="">
                </a>
                <div class="flex-fill">
                    <h5 class="mb-0">{{ $committee->user->name }}</h5>
                    <ul class="list-inline list-inline-bullet text-muted mb-0">
                        <li class="list-inline-item">{{ $committee->user->mobile_number }}</li>
                        <li class="list-inline-item">{{ $committee->user->email }}</li>
                    </ul>
                </div>
            </div>
            <div class="mb-4">
                <h6>{{ $committee->name }}</h6>
                <p>{{ $committee->description }}</p>
                <div class="row px-3">
                    <div class="col-lg-6">
                        <dl>
                            <dt class="fs-sm text-primary text-uppercase mb-2">
                                1. Manager
                            </dt>
                            <dd class="mb-3">{{ $committee->user->name }}</dd>
                            <dt class="fs-sm text-primary text-uppercase mb-2">
                                3. Committee Type</dt>
                            <dd class="mb-3">{{ $committee->committeeType->name }}</dd>
                            <dt class="fs-sm text-primary text-uppercase mb-2">
                                5. Per Committee Duration</dt>
                            <dd class="mb-3">{{ $committee->committeeType->duration_days }} Days</dd>
                            <dt class="fs-sm text-primary text-uppercase mb-2">
                                7. Collection Days</dt>
                            <dd class="mb-3">{{ $committee->collection_days }} Days</dd>
                        </dl>
                    </div>
                    <div class="col-lg-6">
                        <dl>
                            <dt class="fs-sm text-primary text-uppercase mb-2">
                                2. Amount
                            </dt>
                            <dd class="mb-3">{{ number_format($committee->amount) }}</dd>
                            <dt class="fs-sm text-primary text-uppercase mb-2">
                                4. Start Date</dt>
                            <dd class="mb-3">{{ date('Y-m-d', $committee->start_date) }}</dd>
                            <dt class="fs-sm text-primary text-uppercase mb-2">
                                6. End Date</dt>
                            <dd class="mb-3">
                                {{ $committee->end_date ?? "Not defined" }}
                            <dt class="fs-sm text-primary text-uppercase mb-2">
                                8. Status</dt>
                            <dd class="mb-3">{{ $committee->status }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
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