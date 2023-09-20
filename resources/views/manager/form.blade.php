<div class="row">
    <div class="form-group col-md-6 mb-3">
        {{ Form::label('name') }}
        {{ Form::text('name', $manager->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name','required']) }}
        {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-md-6 mb-3">
        {{ Form::label('email') }}
        {{ Form::email('email', $manager->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email','required']) }}
        {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-md-6 mb-3">
        {{ Form::label('password') }}
        {{ Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Password']) }}
        {!! $errors->first('password', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-md-6 mb-3">
        {{ Form::label('confirm-password') }}
        {{ Form::password('confirm-password', ['class' => 'form-control' . ($errors->has('confirm-password') ? ' is-invalid' : ''), 'placeholder' => 'Confirm Password']) }}
        {!! $errors->first('confirm-password', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    <div class="form-group col-md-6 mb-3">
        {{ Form::label('mobile_number') }}
        {{ Form::number('mobile_number', $manager->mobile_number, ['class' => 'form-control' . ($errors->has('mobile_number') ? ' is-invalid' : ''), 'required','placeholder'=>'Mobile Number']) }}
        {!! $errors->first('mobile_number', '<div class="invalid-feedback">:message</div>') !!}
    </div>
    {{ Form::hidden('type', 'Manager') }}
    <div class="col-md-12 d-flex justify-content-end align-items-center mt-3">
        <button type="submit" class="btn btn-primary ms-3">
            Submit <i class="ph-paper-plane-tilt ms-2"></i>
        </button>
    </div>
</div>