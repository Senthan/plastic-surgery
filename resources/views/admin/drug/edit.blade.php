@extends('admin.layouts.master')
@section('content')
    <ul class="nav nav-tabs">
        <li class=""><a href="{{ route('subsurgery.index') }}">Sub Surgery</a></li>
        <li class="{{ request()->is('drug*') ? 'active' : '' }}"><a href="{{ route('drug.index') }}">Surgery</a></li>
    </ul>
    <ul class="breadcrumb">
        <li>{!! link_to_route('patient.index', 'Home ') !!}</li>
        <li>{!! link_to_route('drug.index', 'Surgery management ') !!}</li>
        <li class="active">Edit</li>
    </ul>
    {!! Form::model($drug, ['url' => route('drug.update', ['drug' => $drug->id]), 'method' => 'PATCH']) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            @include('admin.drug.back-btn', ['text' => 'Surgery'])
        </div>
        <div class="panel-body">
            @include('admin.drug.form', ['disabled' => 'disabled'])
        </div>
        <div class="panel-footer">
            @include('admin.drug.submit-btn', ['text' => 'Update', 'class' => 'info'])
            @include('admin.drug.back-btn', ['text' => 'Cancel'])
        </div>
    </div>
    {!! Form::close() !!}
@endsection