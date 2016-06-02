@extends('layouts.post')

@section('content')

    <h1>Post</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="{{route('users.show', $post->user->slug)}}">{{$post->user->display_name ? $post->user->display_name : $post->user->nickname}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at ? $post->created_at->diffForHumans() : ' - Unavailable'}}</p>

    <hr>

    <hr>
    <!-- Post Content -->

    <p>{{$post->text}}</p>

    <hr>





    @endsection

