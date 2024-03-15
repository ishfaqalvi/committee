@extends('admin.layout.app')

@section('title')
    Committee Member
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Committee Member Managment</span>
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
@include('admin.committee.include.member.create')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header d-flex align-items-center py-0">
            <h6 class="py-3 mb-0">Committee Member</h6>
            <div class="ms-auto my-auto">
                @can('committeeMembers-create')
                <button type="button" data-bs-toggle="modal" data-bs-target="#addMember" class="btn btn-success btn-icon">
                    <i class="ph-plus"></i>
                </button>
                @endcan
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('committees.members.update') }}" method="post">
                @csrf
                <div class="border rounded mb-3">
                    <ul class="list-group list-group-borderless pb-2">
                        @foreach($committee->members()->where(function($query) {
                            $query->where('role', 'Application')
                              ->orWhere('role', 'Manager');
                            })
                            ->orWhere(function($query) {
                                $query->where('role', 'Member')
                                ->whereIn('status', ['Active', 'Closed']);
                            })->orderBy('order')->get() as $member
                        )
                        <li class="list-group-item d-flex align-items-start">
                            <input type="hidden" name="ids[]" value="{{ $member->id }}">
                            <a href="#" class="d-inline-flex align-items-center me-3">
                                <i class="ph-dots-six me-2"></i>
                                <img src="{{ $member->user->image }}" width="40" height="40" class="rounded-circle"
                                    alt="">
                            </a>
                            <div class="flex-fill">
                                <div class="fw-semibold">{{ $member->user->name }}</div>
                                {{ $member->user->email }}
                            </div>
                            <div class="ms-3">
                                <div class="fw-semibold">{{ $member->user->mobile_number }}</div>
                            </div>
                            <div class="ms-3">
                                <span class="badge bg-primary">{{ $member->role }}</span>
                            </div>
                            <div class="ms-3">
                                @can('committeeMembers-delete')
                                <a href="#" class="text-danger sa-confirm" data-bs-popup="tooltip"
                                title="Delete" data-id="{{$member->id}}">
                                    <i class="ph-trash"></i>
                                </a>
                                @endcan
                            </div>
                        </li>
                        @endforeach
                    </ul>
                    <ul class="list-group list-group-borderless media-list-container pb-2" id="committe-members">
                        @foreach($committee->members()->whereRole('Member')->whereStatus('Pending')->orderBy('order')->get() as $member)
                        <li class="list-group-item d-flex align-items-start" data-role="{{ $member->role }}">
                            <input type="hidden" name="ids[]" value="{{ $member->id }}">
                            <a href="#" class="d-inline-flex align-items-center me-3">
                                <i class="ph-dots-six dragula-handle me-2"></i>
                                <img src="{{ $member->user->image }}" width="40" height="40" class="rounded-circle"
                                    alt="">
                            </a>
                            <div class="flex-fill">
                                <div class="fw-semibold">{{ $member->user->name }}</div>
                                {{ $member->user->email }}
                            </div>
                            <div class="ms-3">
                                <div class="fw-semibold">{{ $member->user->mobile_number }}</div>
                            </div>
                            <div class="ms-3">
                                <span class="badge bg-primary">{{ $member->role }}</span>
                            </div>
                            <div class="ms-3">
                                @can('committeeMembers-delete')
                                <a href="#" class="text-danger sa-confirm" data-bs-popup="tooltip"
                                title="Delete" data-id="{{$member->id}}">
                                    <i class="ph-trash"></i>
                                </a>
                                @endcan
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @can('committeeMembers-edit')
                <button type="submit" class="btn btn-info">Save Changes</button>
                @endcan
            </form>
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
                if (result.value === true){
                    let id = $(this).data('id');
                    let $form = $(`<form action="{{route('committees.members.destroy', '')}}/${id}" method="POST"></form>`);
                    $form.append(`<input type="hidden" name="_token" value="{{ csrf_token() }}" />`);
                    $form.append('<input type="hidden" name="_method" value="DELETE">');
                    $('body').append($form);
                    $form.submit();
                }
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
    });
</script>
<script>
    $(function () {
        function formatRepo (repo) {
            if (repo.loading) return repo.text;
            const markup = `
                <div class="select2-result-repository clearfix">
                    <div class="select2-result-repository__avatar"><img src="${repo.image}" /></div>
                    <div class="select2-result-repository__meta">
                        <div class="select2-result-repository__title">${repo.name}</div>
                        <div class="select2-result-repository__description">${repo.email}</div>
                    </div>
                    <div class="select2-result-repository__statistics">
                        <div class="select2-result-repository__forks">Mobile #: ${repo.mobile_number}</div>
                    </div>
                </div>
            `;
            return markup;
        }
        function formatRepoSelection (repo) {
            return repo.name || repo.text;
        }
        $('.select-remote-data').select2({
            dropdownParent: $("#addMember"),
            ajax: {
                url: "{{route('committees.members.search')}}",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term,
                        page: params.page
                    };
                },
                processResults: function (responce, params) {
                    params.page = params.page || 1;
                    return {
                        results: responce.data,
                        pagination: {
                            more: (params.page * 10) < responce.total
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function (markup) { return markup; },
            minimumInputLength: 1,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection
        });
    });
    document.addEventListener('DOMContentLoaded', function() {
        dragula([document.getElementById('committe-members')], {
            mirrorContainer: document.querySelector('.media-list-container'),
            moves: function (el, container, handle) {
                return handle.classList.contains('dragula-handle');
            }
        });
    });
</script>
@endsection