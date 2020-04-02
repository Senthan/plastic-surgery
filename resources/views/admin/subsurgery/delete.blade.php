@extends('admin.layouts.master')
@section('content')
    <ul class="nav nav-tabs">
        <li class="{{ request()->is('dose*') ? 'active' : '' }}"><a href="{{ route('dose.index') }}">subsurgery</a></li>
        <li class=""><a href="{{ route('drug.index') }}">Drugs</a></li>
    </ul>
    <ul class="breadcrumb">
        <li>{!! link_to_route('patient.index', 'Home ') !!}</li>
        <li>{!! link_to_route('dose.index', 'subsurgery') !!}</li>
        <li class="active">Delete</li>
    </ul>
    {!! Form::model($drug, ['url' => route('dose.destroy', ['dose' => $drug->id]), 'method' => 'DELETE']) !!}
    {!! Form::hidden('id', null) !!}
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <span class="pull-left"><h4>Delete subsurgery</h4></span>
        </div>
        <div class="panel-body">
            @if($errors->has('id'))
                <p class="alert alert-info">{{ $errors->first('id') }}</p>
            @else
                <p>Do you really want to delete this <strong>"{{ $drug->name }}"</strong> subsurgery?</p>
            @endif
        </div>
        <div class="panel-footer">
            @unless($errors->has('id'))
                @include('admin.subsurgery.submit-btn', ['text' => 'Delete', 'class' => 'red'])
            @endunless
            @include('admin.subsurgery.back-btn', ['text' => 'Cancel'])
        </div>
    </div>
    {!! Form::close() !!}
@endsection