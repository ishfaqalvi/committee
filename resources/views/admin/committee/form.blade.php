<div class="row">
    {{ Form::hidden('created_by', auth()->user()->id) }}
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('name') }}
        {{ Form::text('name', $committee->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('type') }}
        {{ Form::select('committee_type_id', $types, $committee->committee_type_id, ['class' => 'form-control select' . ($errors->has('committee_type_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
        {!! $errors->first('committee_type_id', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('collection_days') }}
        {{ Form::number('collection_days', $committee->collection_days, ['class' => 'form-control' . ($errors->has('collection_days') ? ' is-invalid' : ''), 'placeholder' => 'Collection Days','required', 'min' => '1']) }}
        {!! $errors->first('collection_days', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-lg-6 mb-3">
        {{ Form::label('start_date') }}
        {{ Form::text('start_date', $committee->start_date, ['class' => 'form-control start_date' . ($errors->has('start_date') ? ' is-invalid' : ''), 'placeholder' => 'Start Date','required']) }}
        {!! $errors->first('start_date', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <!-- <div class="form-group col-lg-6 mb-3">
        {{ Form::label('end_date') }}
        {{ Form::text('end_date', $committee->end_date, ['class' => 'form-control end_date' . ($errors->has('end_date') ? ' is-invalid' : ''), 'placeholder' => 'End Date','required']) }}
        {!! $errors->first('end_date', '<div class="invalid-feedback">:message</div>') !!}
    </div> -->
    <div class="form-group col-lg-12">
        {{ Form::label('description') }}
        {{ Form::textarea('description', $committee->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description','required','rows' => '2']) }}
        {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            Submit <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
 </div>
