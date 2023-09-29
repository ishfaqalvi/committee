<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Add Member </h5>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('intervals.store') }}" class="validate" role="form" enctype="multipart/form-data">
                @csrf
                {{ Form::hidden('committee_id', $committee->id) }}
                <div class="row">
                    <div class="form-group col-lg-6 mb-3">
                        {{ Form::label('user') }}
                        {{ Form::select('user_id', $users, null, ['class' => 'form-control select' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => '--Select--','required']) }}
                        {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-lg-4 mb-3">
                        {{ Form::label('order') }}
                        {{ Form::number('order', null, ['class' => 'form-control' . ($errors->has('order') ? ' is-invalid' : ''), 'placeholder' => 'Order','required','min' => '1']) }}
                        {!! $errors->first('order', '<div class="invalid-feedback">:message</div>') !!}
                    </div>
                    <div class="form-group col-lg-2">
                        {{ Form::label('submit') }}
                        <button type="submit" class="form-control btn btn-primary">
                            Submit <i class="ph-paper-plane-tilt ms-2"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>