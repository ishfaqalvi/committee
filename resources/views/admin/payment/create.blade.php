<div id="addRecord" class="modal fade" tabindex="-1">
    <div class="modal-dialog modal-s">
        <div class="modal-content">
            <form method="POST" action="{{ route('payments.store') }}" role="form" class="validate" enctype="multipart/form-data">
                @csrf
                {{ Form::hidden('submission_id', null,['id' => 'submission_id']) }}
                <div class="modal-header">
                    <h5 class="modal-title">Add Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        {{ Form::label('amount') }}
                        {{ Form::number('amount', null, ['class' => 'form-control' . ($errors->has('amount') ? ' is-invalid' : ''), 'placeholder' => 'Amount','required','min'=>'0']) }}
                    </div>
                    <div class="form-group mb-3">
                        {{ Form::label('date') }}
                        {{ Form::date('date', null, ['class' => 'form-control' . ($errors->has('date') ? ' is-invalid' : ''), 'placeholder' => 'Date','required']) }}
                    </div>
                    <div class="form-group mb-3">
                        {{ Form::label('attachment') }}
                        {{ Form::file('attachment', ['class' => 'form-control' . ($errors->has('attachment') ? ' is-invalid' : ''), 'required']) }}
                    </div>
                    <div class="form-group">
                        {{ Form::label('remarks') }}
                        {{ Form::textarea('remarks', null, ['class' => 'form-control' . ($errors->has('remarks') ? ' is-invalid' : ''), 'placeholder' => 'Remarks','rows'=>'3']) }}
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
