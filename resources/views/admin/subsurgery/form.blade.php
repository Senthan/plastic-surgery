


<div class="form-group {{ ($errors->has('sub_surgery')) ? 'has-error' : '' }}">
    {!! Form::label('sub_surgery', 'sub-surgery', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::text('sub_surgery', null, ['class' => 'form-control']) !!}
        <p class="help-block">{{ ($errors->has('sub_surgery') ? $errors->first('sub_surgery') : '') }}</p>
    </div>
</div>

<div class="form-group {{ ($errors->has('surgery')) ? 'has-error' : '' }}">
    {!! Form::label('surgery', 'Surgery', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-10">
        {!! Form::select('surgery[]', $drugs, null, ['class' => 'form-control', 'multiple']) !!}
        <p class="help-block">{{ ($errors->has('surgery') ? $errors->first('surgery') : '') }}</p>
    </div>
</div>
