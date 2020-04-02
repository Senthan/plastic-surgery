@extends('admin.layouts.master')
@section('content')
    <ul class="nav nav-tabs">
        <li class=""><a href="{{ route('subsurgery.index') }}">subsurgery</a></li>
        <li class="{{ request()->is('drug*') ? 'active' : '' }}"><a href="{{ route('drug.index') }}">Surgery</a></li>
    </ul>
    <ul class="breadcrumb">
        <li>{!! link_to_route('patient.index', 'Home ') !!}</li>
        <li>{!! link_to_route('drug.index', 'Surgery management ') !!}</li>
        <li class="active">Delete</li>
    </ul>
    {!! Form::model($drug, ['url' => route('drug.destroy', ['drug' => $drug->id]), 'method' => 'DELETE']) !!}
    {!! Form::hidden('id', null) !!}
    <div class="panel panel-default">
        <div class="panel-heading">
            @include('admin.drug.back-btn', ['text' => 'Surgery'])
        </div>
        <div class="panel-body">
            @if($errors->has('id'))
            <p class="alert alert-info">{{ $errors->first('id') }}</p>
            @else
                <p>Do you really want to delete this ({{ $drug->name }}) surgery?</p>
            @endif
        </div>
        <div class="panel-footer">
            @unless($errors->has('id'))
                @include('admin.drug.submit-btn', ['text' => 'Delete', 'class' => 'danger'])
            @endunless
            @include('admin.drug.back-btn', ['text' => 'Cancel'])
        </div>
    </div>
    {!! Form::close() !!}
@endsection