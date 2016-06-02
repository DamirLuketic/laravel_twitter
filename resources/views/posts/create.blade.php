@extends('layouts.master')

@section('title', 'Create Post')

@section('content')

    <h1>Create post</h1>

    <div class="row">

        {!! Form::open(['method'=>'POST', 'action' => 'PostController@store', 'files' => true]) !!}

        <div class="form-group">
            {!! Form::label('text', 'Text') !!}
            {!! Form::textarea('text', null, ['class'=>'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>

    <div class="row">

        @include('includes.form_error')

    </div>

@endsection