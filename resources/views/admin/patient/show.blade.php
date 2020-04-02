@extends('admin.layouts.master')
@section('content')
    <ul class="breadcrumb">
        <li>{!! link_to_route('admin.home.index', 'Home ') !!}</li>
        <li>{!! link_to_route('patient.index', 'Patient Management') !!}</li>
        <li class="active">Summary</li>
    </ul>
    <div class="container-fluid">
        <section class="content">
            <div class="ui segments">
                <div class="ui olive segment">
                    <table class="ui celled table">
                        <thead>
                        <tr>
                            <th colspan="7">
                                Patient Pesional Data
                            </th>
                        </tr>
                        <tr>
                            <th> OSC No </th>
                            <th> Name </th>
                            <th> Age </th>
                            <th> Gender </th>
                            <th> Address </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td> {!! $patient->patient_uuid !!}</td>
                            <td> {!! $patient->name !!}</td>
                            <td> {!! $patient->age !!}</td>
                            <td> {!! $patient->sex !!}</td>
                            <td> {!! $patient->address !!}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>


                <div class="ui segment blue clearfix g">



                    <div class="ui segments">
                        <div class="ui segment">
                            <h3 class="ui header">Surgery</h3>
                        </div>
                        @foreach($patient->surgical as $surgical)
                        <div class="ui segments">
                            <div class="ui segment">
                                <h4 class="ui header"> Date of surgery </h4>
                                <p> {!! $surgical->date_of_surgery or '' !!}</p>
                            </div>
                            <div class="ui segment">
                                <h4 class="ui header"> Surgery sub category </h4>
                                <p> {!! $surgical->surgery_sub_category or '' !!}</p>
                            </div>
                            <div class="ui segment">
                                <h4 class="ui header"> Surgery </h4>
                                <p> {!! $surgical->surgery or '' !!}</p>
                            </div>
                            <div class="ui segment">
                                <h4 class="ui header"> Description </h4>
                                <p> {!! $surgical->description or '' !!}</p>
                            </div>
                            <div class="ui segment">
                                <h4 class="ui header"> Level of supervision </h4>
                                <p> {!! $surgical->level_of_supervision or '' !!}</p>
                            </div>
                            <div class="ui segment">
                                <h4 class="ui header"> Date of followup </h4>
                                <p> {!! $surgical->datetime_of_followup or '' !!}</p>
                            </div>


<div  class="ui segment">

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

</div>
@endforeach

                        </div>
                    </div>
                </div>




            </div>
        </section>
    </div>
@endsection