@extends('layouts.master')

@section('title', 'Posts')

@section('content')


    @if(Session::has('post_create'))

        <p class="bg-danger">{{session('post_create')}}</p>

    @endif

    @if(session('account_deleted'))

        <p class="bg-danger">{{session('account_deleted')}}</p>

    @endif

    @if(session('mail_send'))

        <p class="bg-danger">{{session('mail_send')}}</p>

    @endif


    <h1>Posts</h1>

    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Owner picture</th>
            <th>Owner name</th>
            <th>Text start</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
        </thead>
        <tbody>

        @if($posts)

            @foreach($posts as $post)

                <tr>
                    <td>{{$post->id}}</td>
                    <th><img height="50" src="{{$post->user->image ? $post->user->image->profile_image != '/laravel_twitter/public/profile_image/' ? $post->user->image->profile_image : 'http://placehold.it/400x400' : 'http://placehold.it/400x400'}}" alt=""></th>
                    <td><a href="{{route('users.show', $post->user->slug)}}">{{$post->user->display_name ? $post->user->display_name : $post->user->nickname}}</a></td>
                    <td>{{str_limit($post->text, 7)}}</td>
                    <td>{{$post->created_at ? $post->created_at->diffForHumans() : 'Unavailable'}}</td>
                    <td>{{$post->updated_at ? $post->updated_at->diffForHumans() : 'Unavailable'}}</td>
                    <td><a href="{{route('posts.show', $post->id)}}">View post</a></td>
                </tr>

            @endforeach

        @endif
        </tbody>
    </table>

    <div class="row">
        <div class="col-sm-6 col-sm-offset-5">
            {{$posts->render()}}
        </div>
    </div>


@endsection