@extends('admin.layouts.master')
@section('content')

    <ul class="breadcrumb">
        <li>{!! link_to_route('patient.index', 'Home') !!}</li>
        <li>{!! link_to_route('dose.index', 'subsurgery') !!}</li>
        <li class="active">Create</li>
    </ul>
    {!! Form::open(['url' => route('subsurgery.store'), 'role' => 'form', 'class' => 'form-horizontal']) !!}

    <div class="panel panel-default" ng-controller="DoseController">
        <div class="panel-heading clearfix">
            <span class="pull-left"><h4>Create Surgery</h4></span>
            <span class="pull-right">
                @include('admin.subsurgery.back-btn', ['text' => 'Back'])
            </span>
        </div>
        <div class="panel-body">
            @include('admin.subsurgery.form')
        </div>
        <div class="panel-footer text-right">
            @include('admin.subsurgery.submit-btn', ['text' => 'Create', 'class' => 'green'])
        </div>
    </div>
    {!! Form::close() !!}
@endsection
