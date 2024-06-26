<div id="addMember" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-s">
        <div class="modal-content">
            <form method="POST" action="{{ route('committees.members.store') }}" role="form" class="validate">
                @csrf
                {{ Form::hidden('committee_id', $committee->id) }}
                {{ Form::hidden('role', 'Member') }}
                <div class="modal-header">
                    <h5 class="modal-title">Add Members</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        {{ Form::label('members') }}
                        {{ Form::select('user_id', [], Null, ['class' => 'form-control select-remote-data' . ($errors->has('member') ? ' is-invalid' : ''), 'placeholder' => '--Select--', 'required']) }}
                        {!! $errors->first('member', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
