@extends('admin.layouts.master')
@section('content')
    <ul class="nav nav-tabs">
        <li class=""><a href="{{ route('subsurgery.index') }}">subsurgery</a></li>
        <li class="{{ request()->is('drug*') ? 'active' : '' }}"><a href="{{ route('drug.index') }}">Drugs</a></li>
    </ul>
    <ul class="breadcrumb">
        <li>{!! link_to_route('patient.index', 'Home ') !!}</li>
        <li>{!! link_to_route('subsurgery.index', 'subsurgery') !!}</li>
        <li class="active">Edit</li>
    </ul>
    {!! Form::model($subSurgery, ['url' => route('subsurgery.update', ['drug' => $subSurgery->id]), 'method' => 'PATCH', 'role' => 'form', 'class' => 'form-horizontal']) !!}
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <span class="pull-left"><h4>Edit subsurgery</h4></span>
            <span class="pull-right">
                @include('admin.subsurgery.back-btn', ['text' => 'Back'])
            </span>
        </div>
        <div class="panel-body">
            @include('admin.subsurgery.form')
        </div>
        <div class="panel-footer text-right">
            @include('admin.subsurgery.submit-btn', ['text' => 'Update', 'class' => 'blue'])
        </div>
    </div>
    {!! Form::close() !!}
@endsection