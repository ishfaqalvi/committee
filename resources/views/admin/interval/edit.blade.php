<div id="editMember{{ $key }}" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-s">
        <div class="modal-content">
            <form method="POST" action="{{ route('intervals.update', $interval->id) }}" role="form" enctype="multipart/form-data">
                @csrf
                {{ method_field('PATCH') }}
                <div class="modal-header">
                    <h5 class="modal-title">Change Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        {{ Form::label('order') }}
                        {{ Form::number('order', $interval->order, ['class' => 'form-control' . ($errors->has('order') ? ' is-invalid' : ''), 'placeholder' => 'Order','required','min' => '1']) }}
                        {!! $errors->first('order', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link" data-bs-dismiss="modal">Close</button>
                    <button type="submitt" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>