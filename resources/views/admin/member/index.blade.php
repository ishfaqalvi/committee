@extends('admin.layout.app')

@section('title')
    Member
@endsection

@section('header')
<div class="page-header-content d-lg-flex">
    <div class="d-flex">
        <h4 class="page-title mb-0">
            Home - <span class="fw-normal">Member Managment</span>
        </h4>
    </div>
    @can('members-create')
    <div class="d-lg-block my-lg-auto ms-lg-auto">
        <div class="d-sm-flex align-items-center mb-3 mb-lg-0 ms-lg-3">
            <a href="#" data-bs-toggle="modal" data-bs-target="#addMember" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Add New
            </a>
            <a href="{{ route('members.create') }}" class="btn btn-outline-primary btn-labeled btn-labeled-start rounded-pill ms-2">
                <span class="btn-labeled-icon bg-primary text-white rounded-pill">
                    <i class="ph-plus"></i>
                </span>
                Create New
            </a>
        </div>
    </div>
    @endcan
</div>
@endsection

@section('content')
@include('admin.member.add')
<div class="col-sm-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Member</h5>
        </div>
        <table class="table datatable-basic">
            <thead class="thead">
                <tr>
                    <th>No</th>
					<th>Name</th>
					<th>Email</th>
					<th>Mobile Number</th>
                    <th>Manager</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($members as $key => $member)
                <tr>
                    <td>{{ ++$key }}</td>
					<td>{{ $member->user->name }}</td>
					<td>{{ $member->user->email }}</td>
					<td>{{ $member->user->mobile_number }}</td>
                    <td>{{ $member->user->createdBy->name }}</td>
                    <td class="text-center">@include('admin.member.actions')</td>
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
                url: 'search',
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
        var _token = $("input[name='_token']").val();
        var parent = $("input[name='created_by']").val();
        $('.validate').validate({
            errorClass: 'validation-invalid-label',
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
                user_id:{
                    "remote":
                    {
                        url: "{{ route('members.checkMember') }}",
                        type: "POST",
                        data: {
                            _token:_token,
                            parent:parent,
                            user: function() {
                                return $("select[name='user_id']").val();
                            }
                        },
                    }
                }
            },
            messages:{
                user_id:{
                    required: "Please search and chose any member.",
                    remote: jQuery.validator.format("This member is already exist in your list.")
                }
            }
        });
    });
</script>
@endsection