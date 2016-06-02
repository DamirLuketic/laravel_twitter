@extends('layouts.master')

@section('content')

    <h1>Edit post</h1>



    <div class="row">

        <div class="col-sm-2">

            @if(session('post_updated'))

                <p class="bg-danger">{{session('post_updated')}}</p>

                @endif

        </div>

        <div class="col-sm-10">

            {!! Form::model($post, ['method'=>'PATCH', 'action' => ['PostController@update', $post->id]]) !!}

            <div class="form-group">
                {!! Form::label('text', 'Text:') !!}
                {!! Form::textarea('text', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update post', ['class' => 'btn btn-primary col-sm-6']) !!}
            </div>

            {!! Form::close() !!}


            {!! Form::open(['method'=>'DELETE', 'action' => ['PostController@destroy', $post->id]]) !!}

            <div class="form-group">
                {!! Form::submit('Delete post', ['class' => 'btn btn-danger col-sm-6']) !!}
            </div>

            {!! Form::close() !!}

        </div>

    </div>

    <div class="row">

        @include('includes.form_error')

    </div>

@endsection