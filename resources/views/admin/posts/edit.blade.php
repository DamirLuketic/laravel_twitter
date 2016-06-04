@extends('layouts.master')

@section('content')


    <h1>Edit post</h1>



    <div class="row">

        <div class="col-sm-2">

            @if(session('post_updated'))

                <p class="bg-danger">{{session('post_updated')}}</p>

            @endif

                @if(session('post_status'))

                    <p class="bg-danger">{{session('post_status')}}</p>

                @endif

        </div>

        <div class="col-sm-10">

            {!! Form::model($post, ['method'=>'PATCH', 'action' => ['AdminPostController@update', $post->id]]) !!}

            <div class="form-group">
                {!! Form::label('text', 'Text:') !!}
                {!! Form::textarea('text', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update post', ['class' => 'btn btn-primary col-sm-4']) !!}
            </div>

            {!! Form::close() !!}



            @if($post->approved == 0)



                {!! Form::open(['method'=>'post', 'action' => 'AdminPostController@approved']) !!}

                <input type="hidden" name="id" value="{{$post->id}}">
                <input type="hidden" name="approved" value="1">

                <div class="form-group">
                    {!! Form::submit('Approve post', ['class' => 'btn btn-success col-sm-4']) !!}
                </div>

                {!! Form::close() !!}


            @else

                {!! Form::open(['method'=>'post', 'action' => 'AdminPostController@approved']) !!}

                <input type="hidden" name="id" value="{{$post->id}}">
                <input type="hidden" name="approved" value="0">

                <div class="form-group">
                    {!! Form::submit('Un-approve post', ['class' => 'btn btn-warning col-sm-4']) !!}
                </div>

                {!! Form::close() !!}

                @endif



            {!! Form::open(['method'=>'DELETE', 'action' => ['AdminPostController@destroy', $post->id]]) !!}

            <div class="form-group">
                {!! Form::submit('Delete post', ['class' => 'btn btn-danger col-sm-4']) !!}
            </div>

            {!! Form::close() !!}

        </div>

    </div>

    {{--<div class="row">--}}

        {{--@include('includes.form_error')--}}

    {{--</div>--}}

@endsection