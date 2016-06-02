@extends('layouts.master')

@section('title', 'Users')

@section('content')

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

        <tr>
            <td>{{$user->id}}</td>
            <td><img height="50" src="{{$user->image ? $user->image->profile_image != '/laravel_twitter/public/profile_image/' ? $user->image->profile_image : 'http://placehold.it/400x400' : 'http://placehold.it/400x400'}}" alt=""></td>
            <td>{{$user->display_name ? $user->display_name : $user->nickname}}</td>
            <td><a href="{{route('users.show', $user->slug)}}">View user</a></td>
        </tr>



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
