<div>

<div class="form-group {{ ($errors->has('date_of_surgery')) ? 'has-error' : '' }} required">
    {!! Form::label('date_of_surgery', 'Date of Surgery', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            {!! Form::text('date_of_surgery', null, ['class' => 'form-control', 'placeholder' => 'Date of Surgery']) !!}
        </div>
        <p class="help-block">{{ ($errors->has('date_of_surgery') ? $errors->first('date_of_surgery') : '') }}</p>
    </div>
</div>


<div class="form-group {!! ($errors->has('surgery_sub_category')) ? 'has-error' : '' !!} required">
    {!! Form::label('surgery_sub_category', 'Surgery sub category', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('surgery_sub_category', $surgery_sub_category, null, ['class' => 'form-control']) !!}
        <p class="help-block">{!! ($errors->has('surgery_sub_category') ? $errors->first('surgery_sub_category') : '') !!}</p>
    </div>
</div>


<div class="form-group {{ ($errors->has('surgery')) ? 'has-error' : '' }} required">
    {!! Form::label('surgery', 'Name of the surgery', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        <select clas="form-control" name="surgery[]" multiple id="mySelect">Choose Surgery</select>
        <p class="help-block">{{ ($errors->has('surgery') ? $errors->first('surgery') : '') }}</p>
    </div>
</div>
          

<!-- <div class="form-group {{ ($errors->has('surgery')) ? 'has-error' : '' }} required">
    {!! Form::label('surgery', 'Name of the surgery', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('surgery', null, ['class' => 'form-control', 'placeholder' => 'Surgery']) !!}
        <p class="help-block">{{ ($errors->has('surgery') ? $errors->first('surgery') : '') }}</p>
    </div>
</div> -->


<div class="form-group {{ ($errors->has('operative_notes')) ? 'has-error' : '' }}">
    {!! Form::label('operative_notes', 'Operative Notes', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::file('operative_notes', null, ['class' => 'form-control', 'placeholder' => 'Operative Notes']) !!}
        <p class="help-block">{{ ($errors->has('operative_notes') ? $errors->first('operative_notes') : '') }}</p>
    </div>
</div>

<div class="form-group {{ ($errors->has('description')) ? 'has-error' : '' }} required">
    {!! Form::label('description', 'Description', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'Description', 'rows' => '3']) !!}
        <p class="help-block">{{ ($errors->has('description') ? $errors->first('description') : '') }}</p>
    </div>
</div>

<div class="form-group {!! ($errors->has('level_of_supervision')) ? 'has-error' : '' !!} required">
    {!! Form::label('level_of_supervision', 'Level of supervision', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-6">
        {!! Form::select('level_of_supervision[]', ['' => 'Select Level of supervision', 'Asssisted' => 'Asssisted', 'Partially performed' => 'Partially performed', 'Performed' => 'Performed'], null, ['class' => 'form-control ui fluid search selection dropdown']) !!}
        <p class="help-block">{!! ($errors->has('level_of_supervision') ? $errors->first('level_of_supervision') : '') !!}</p>
    </div>
</div>

<div class="form-group {{ ($errors->has('pre_op_xray')) ? 'has-error' : '' }}">
    {!! Form::label('pre_op_xray', 'Pre op images/vidoes', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::file('pre_op_xray', null, ['class' => 'form-control', 'placeholder' => 'Pre op images/vidoes']) !!}
        <p class="help-block">{{ ($errors->has('pre_op_xray') ? $errors->first('pre_op_xray') : '') }}</p>
    </div>
</div>


<div class="form-group {{ ($errors->has('intra_op')) ? 'has-error' : '' }} ">
    {!! Form::label('intra_op', 'Intra  op images/vidoes', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::file('intra_op', null, ['class' => 'form-control', 'placeholder' => 'Pre op images/vidoes']) !!}
        <p class="help-block">{{ ($errors->has('intra_op') ? $errors->first('intra_op') : '') }}</p>
    </div>
</div>

<div class="form-group {{ ($errors->has('post_op_xray')) ? 'has-error' : '' }} ">
    {!! Form::label('post_op_xray', 'Post op images/vidoes', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::file('post_op_xray', null, ['class' => 'form-control', 'placeholder' => 'Pre op images/vidoes']) !!}
        <p class="help-block">{{ ($errors->has('post_op_xray') ? $errors->first('post_op_xray') : '') }}</p>
    </div>
</div>


<div class="form-group {{ ($errors->has('datetime_of_followup')) ? 'has-error' : '' }} ">
    {!! Form::label('date_of_review', 'Date of Review', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
            {!! Form::text('date_of_review', null, ['class' => 'form-control', 'placeholder' => 'Date of Review']) !!}
        </div>
        <p class="help-block">{{ ($errors->has('date_of_review') ? $errors->first('date_of_review') : '') }}</p>
    </div>
</div>


<div class="form-group {{ ($errors->has('complication')) ? 'has-error' : '' }} required">
    {!! Form::label('complication', 'Complications', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea('complication', null, ['class' => 'form-control', 'placeholder' => 'Complications']) !!}
        <p class="help-block">{{ ($errors->has('complication') ? $errors->first('complication') : '') }}</p>
    </div>
</div>


<div class="form-group {{ ($errors->has('learning_points')) ? 'has-error' : '' }} ">
    {!! Form::label('learning_points', 'Learning points', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::file('learning_points', null, ['class' => 'form-control', 'placeholder' => 'Learning points']) !!}
        <p class="help-block">{{ ($errors->has('learning_points') ? $errors->first('learning_points') : '') }}</p>
    </div>
</div>


<div class="form-group {{ ($errors->has('follow_up_images')) ? 'has-error' : '' }} ">
    {!! Form::label('follow_up_images', 'Follow up images/vidoes', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::file('follow_up_images', null, ['class' => 'form-control', 'placeholder' => 'Follow up images/vidoes']) !!}
        <p class="help-block">{{ ($errors->has('follow_up_images') ? $errors->first('follow_up_images') : '') }}</p>
    </div>
</div>

</div>
@section('script')
    <script>

        $(document).ready(function () {

           $('.ui.dropdown')
                .dropdown({});


            $('#date_of_surgery').datetimepicker({
                format: 'YYYY-MM-DD'
            });


            $('#date_of_review').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss'
            });

            var surgerysubcategory = [{!! $surgerysubcategories !!}][0];
            


            $('#surgery_sub_category').change(function(e) {
              console.log(e.target.value); 
                var sub_surgery = e.target.value;
                var surgery = _.where(surgerysubcategory, {sub_surgery: sub_surgery});
               surgery = surgery ? surgery[0].surgery : '';
               // $('#surgery').val(surgery);

                var surgeries = surgery ? JSON.parse(surgery) : [];
                $.each(surgeries, function(key, value) {   
                    $('#mySelect')
                            .append($("<option></option>")
                            .attr("value",value)
                            .text(value)); 
                    });
                });
        });

  
    </script>
@endsection