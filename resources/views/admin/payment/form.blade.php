<div class="row">
    <div class="col-lg-6">
        <div class="form-group mb-3">
            {{ Form::label('date') }}
            {{ Form::text('date', $payment->date, ['class' => 'form-control start_date' . ($errors->has('date') ? ' is-invalid' : ''), 'placeholder' => 'Date','required']) }}
            {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('remarks') }}
            {{ Form::textarea('remarks', $payment->remarks, ['class' => 'form-control' . ($errors->has('remarks') ? ' is-invalid' : ''), 'placeholder' => 'Remarks','required','rows' => '5']) }}
            {!! $errors->first('remarks', '<div class="invalid-feedback">:message</div>') !!}
        </div>    
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('attachment') }}
        {{ Form::file('attachment', ['class' => 'form-control dropify' . ($errors->has('attachment') ? ' is-invalid' : ''),'required','accept' => 'image/png,image/jpg,image/jpeg', 'data-height' => '197']) }}
        {!! $errors->first('attachment', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    {{ Form::hidden('approval', 'Not Approved') }}
    {{ Form::hidden('status', 'Submitted') }}
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            Submit <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>