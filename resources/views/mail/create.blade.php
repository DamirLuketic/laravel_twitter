@extends('layouts.master')

@section('title', 'Contact')

@section('content')

    <h1>Send e-mail</h1>

        {!! Form::open(['method'=>'post', 'action' => 'MailController@send']) !!}

            <div class="form-group">
                {!! Form::label('title', 'Title') !!}
                {!! Form::text('title', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('body', 'Text') !!}
                {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Send', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

    @include('includes.form_error')

    @endsection