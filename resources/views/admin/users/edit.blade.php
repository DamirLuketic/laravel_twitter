@extends('layouts.master')

@section('title', 'Edit User data')

@section('content')


    @if(session('user_data_updated'))

        <p class="bg-danger">{{session('user_data_updated')}}</p>

    @endif

    <h1>Edit User data</h1>

    <div class="row">

        <div class="col-sm-3">

            <img height="400" src="{{$user->image ? $user->image->profile_image != '/laravel_twitter/public/profile_image/' ? $user->image->profile_image : 'http://placehold.it/400x400' : 'http://placehold.it/400x400'}}" alt="" class="img-responsive img-rounded">


        </div>


        <div class="col-sm-9">

            {!! Form::model($user, ['method'=>'PATCH', 'action' => ['AdminUserController@update', $user->slug], 'files' => true]) !!}

            <div class="form-group">
                {!! Form::label('nickname', 'Nickname:') !!}
                {!! Form::text('nickname', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('display_name', 'Display name:') !!}
                {!! Form::text('display_name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('email', 'Email:') !!}
                {!! Form::email('email', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('role_id', 'Role') !!}
                {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!}

            </div>

            <div class="form-group">
                {!! Form::label('terms', 'Status') !!}
                {!! Form::select('terms', array(1 => 'Active', 0 => 'Not Active'), null, ['class'=>'form-control']) !!}

            </div>

            <div class="form-group">
                {!! Form::label('profile_image', 'Profile image:') !!}
                {!! Form::file('profile_image', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('cover_image', 'Cover image:') !!}
                {!! Form::file('cover_image', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('password', 'Password') !!}
                {!! Form::password('password', ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update data', ['class' => 'btn btn-primary col-sm-6']) !!}
            </div>

            {!! Form::close() !!}

            {{-- form for delete --}}

            {!! Form::open(['method'=>'DELETE', 'action' => ['AdminUserController@destroy', $user->slug]]) !!}

            <div class="form-group">
                {!! Form::submit('Delete account', ['class' => 'btn btn-danger col-sm-6']) !!}
            </div>

            {!! Form::close() !!}

        </div>

    </div>

@endsection

