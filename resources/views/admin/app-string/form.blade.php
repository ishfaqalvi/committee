<div class="row">
      
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('language') }}
        {{ Form::text('language', $appString->language, ['class' => 'form-control' . ($errors->has('language') ? ' is-invalid' : ''), 'placeholder' => 'Language','required']) }}
        {!! $errors->first('language', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('key') }}
        {{ Form::text('key', $appString->key, ['class' => 'form-control' . ($errors->has('key') ? ' is-invalid' : ''), 'placeholder' => 'Key','required']) }}
        {!! $errors->first('key', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('value') }}
        {{ Form::text('value', $appString->value, ['class' => 'form-control' . ($errors->has('value') ? ' is-invalid' : ''), 'placeholder' => 'Value','required']) }}
        {!! $errors->first('value', '<div class="invalid-feedback">:message</div>') !!}
    </div>

      <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
            <button type="submit" class="btn btn-primary ms-3">
                Submit <i class="ph-paper-plane-tilt ms-2"></i>
            </button>
      </div>
 </div>
