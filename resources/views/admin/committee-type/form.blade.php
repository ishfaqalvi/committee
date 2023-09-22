<div class="row">
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('name') }}
        {{ Form::text('name', $committeeType->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('type') }}
        {{ Form::select('type', ['1 Week' => '1 Week', '2 Week' => '2 Week', '1 Month' => '1 Month', '2 Month' => '2 Month', '3 Month' => '3 Month', '6 Month' => '6 Month', 'Year' => 'Year', 'Days' => 'Days'], $committeeType->type, ['class' => 'form-control select' . ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => '--Select--', 'required', 'id' => 'type']) }}
        {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3 duration_days" style="display:none;">
        {{ Form::label('duration_days') }}
        {{ Form::number('duration_days', $committeeType->duration_days, ['class' => 'form-control' . ($errors->has('duration_days') ? ' is-invalid' : ''), 'placeholder' => 'Duration Days','min' => '1']) }}
        {!! $errors->first('duration_days', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            Submit <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
 </div>
