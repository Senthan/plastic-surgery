@extends('admin.layouts.master')
@section('content')
    <ul class="breadcrumb">
        <li>{!! link_to_route('admin.home.index', 'Home') !!}</li>
        <li>{!! link_to_route('patient.index', 'Patient Management') !!}</li>
        <li>{!! $patient->patient_uuid !!}</li>
        <li>{!! link_to_route('surgical.index', 'Surgical Management', ['patient' => $patient->id]) !!}</li>
        <li class="active">Create</li>
    </ul>

    {!! Form::model($surgical, ['url' => route('surgical.update', ['patient' => $patient->id, 'surgical' => $surgical->id]),  'role' => 'form', 'class' => 'form-horizontal', 'method' => 'PATCH', 'files' => true]) !!}
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <span class="pull-left"><h4>Edit Surgical</h4></span>
            <span class="pull-right">
                <a class="ui small button" href="{{ route('surgical.index', ['patient' => $patient->id]) }}">Back</a>
                    <a ng-href="{{ route('subsurgery.index') }}" class="button ui big blue labeled icon">
                <i class="icon list"></i>Add subsurgery
            </a>  
                                        <a ng-href="{{ route('drug.index') }}" class="button ui big blue labeled icon">
                <i class="icon list"></i>Add surgery
            </a>  
            </span>
        </div>
        <div class="panel-body">
            @include('admin.patient.surgical.form')
        </div>
        <div class="panel-footer text-right">
            @include('admin.patient.submit-btn', ['text' => 'Update', 'class' => 'blue'])
        </div>
    </div>
    {!! Form::close() !!}

    
    

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <span class="pull-left"><h4>Operative Notes</h4></span>
        </div>
        <div class="panel-body">
            @foreach($surgical->getMedia("operative_notes") as $image)
            @if(str_contains($image->file_name, [".mp4", ".flv", "mov"]))
            <span >
            <video width="100px" height="100px" controls>
              <source src="{!! env('APP_URL'). 'media/' .$image->order_column. '/'. $image->file_name !!}"  />
            </video>
            </span>
            @else
            <span >
            <img style="" width="100px" height="100px" src="{!! env('APP_URL'). 'media/' .$image->order_column. '/'. $image->file_name !!}" />
        </span>
            @endif
            @endforeach
        </div>
    </div>
    


    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <span class="pull-left"><h4>Pre op images/vidoes </h4></span>
        </div>
        <div class="panel-body">
            @foreach($surgical->getMedia("pre_op_xray") as $image)
            @if(str_contains($image->file_name, [".mp4", ".flv", "mov"]))
            <span >
            <video width="100px" height="100px" controls>
              <source src="{!! env('APP_URL'). 'media/' .$image->order_column. '/'. $image->file_name !!}"  />
            </video>
            </span>
            @else
            <span >
            <img style="" width="100px" height="100px" src="{!! env('APP_URL'). 'media/' .$image->order_column. '/'. $image->file_name !!}" />
        </span>
            @endif
            @endforeach
        </div>
    </div>
    
    

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <span class="pull-left"><h4>Intra op images/vidoes</h4></span>
        </div>
        <div class="panel-body">
            @foreach($surgical->getMedia("intra_op") as $image)
            @if(str_contains($image->file_name, [".mp4", ".flv", "mov"]))
            <span >
            <video width="100px" height="100px" controls>
              <source src="{!! env('APP_URL'). 'media/' .$image->order_column. '/'. $image->file_name !!}"  />
            </video>
            </span>
            @else
            <span >
            <img style="" width="100px" height="100px" src="{!! env('APP_URL'). 'media/' .$image->order_column. '/'. $image->file_name !!}" />
        </span>
            @endif
            @endforeach
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <span class="pull-left"><h4>Post op images/vidoes </h4></span>
        </div>
        <div class="panel-body">
            @foreach($surgical->getMedia("post_op_xray") as $image)
            @if(str_contains($image->file_name, [".mp4", ".flv", "mov"]))
            <span >
            <video width="100px" height="100px" controls>
              <source src="{!! env('APP_URL'). 'media/' .$image->order_column. '/'. $image->file_name !!}"  />
            </video>
            </span>
            @else
            <span >
            <img style="" width="100px" height="100px" src="{!! env('APP_URL'). 'media/' .$image->order_column. '/'. $image->file_name !!}" />
        </span>
            @endif
            @endforeach
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <span class="pull-left"><h4>follow_up_images </h4></span>
        </div>
        <div class="panel-body">
            @foreach($surgical->getMedia("follow_up_images") as $image)
            @if(str_contains($image->file_name, [".mp4", ".flv", "mov"]))
            <span >
            <video width="100px" height="100px" controls>
              <source src="{!! env('APP_URL'). 'media/' .$image->order_column. '/'. $image->file_name !!}"  />
            </video>
            </span>
            @else
            <span >
            <img style="" width="100px" height="100px" src="{!! env('APP_URL'). 'media/' .$image->order_column. '/'. $image->file_name !!}" />
        </span>
            @endif
            @endforeach
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <span class="pull-left"><h4>Learning points </h4></span>
        </div>
        <div class="panel-body">
            @foreach($surgical->getMedia("learning_points") as $image)
            
            <span >
            <a href="{!! env('APP_URL'). 'media/' .$image->order_column. '/'. $image->file_name !!}">{!! $image->file_name !!}</a>
        </span>
            
            @endforeach
        </div>
    </div>
@endsection