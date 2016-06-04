@extends('layouts.master')

@section('title', 'Edit user')

@section('content')

    @if(session('user_deleted'))

        <p class="bg-danger">{{session('user_deleted')}}</p>

        @endif


    <h1>Users</h1>

    @if(!isset($query))

        <?php $query = ''; ?>

    @endif

    {!! Form::open(['method'=>'get', 'action' => 'AdminUserController@index']) !!}

    <div class="form-group">
        {!! Form::label('search', 'Search user:') !!}
        {!! Form::text('search', $query, ['class'=>'form-control', 'placeholder' => 'Search user:']) !!}
    </div>

    <div class="form-group">
        {!! Form::submit('Search', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}




    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Picture</th>
            <th>Name</th>
        </tr>
        </thead>
        <tbody>

        @if($users)
            @foreach($users as $user)
                @if(Auth::user()->id == $user->id)

                    <tr>
                        <td>{{$user->id}}</td>
                        <td><img height="50" src="{{$user->image ? $user->image->profile_image != '/laravel_twitter/public/profile_image/' ? $user->image->profile_image : 'http://placehold.it/400x400' : 'http://placehold.it/400x400'}}" alt=""></td>
                        <td>{{$user->display_name ? $user->display_name : $user->nickname}}</td>
                        <td><a href="{{route('admin.users.edit', $user->slug)}}">Edit personal data</a></td>
                    </tr>



                @else


                    <tr>
                        <td>{{$user->id}}</td>
                        <td><img height="50" src="{{$user->image ? $user->image->profile_image != '/laravel_twitter/public/profile_image/' ? $user->image->profile_image : 'http://placehold.it/400x400' : 'http://placehold.it/400x400'}}" alt=""></td>
                        <td>{{$user->display_name ? $user->display_name : $user->nickname}}</td>
                        <td><a href="{{route('admin.users.edit', $user->slug)}}">Edit User data</a></td>
                    </tr>


                @endif
            @endforeach
        @endif

        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$users->render()}}
        </div>
    </div>

@endsection
