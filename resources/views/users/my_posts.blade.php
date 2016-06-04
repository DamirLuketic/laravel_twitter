@extends('layouts.master')

@section('title', 'My Posts')

@section('content')

    @if(Session::has('post_deleted'))

    <p class="bg-danger">{{session('post_deleted')}}</p>

    @endif


    <h1>My Posts</h1>

    <table class="table">
        <thead>
        <tr>
            <th>Id</th>
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
                    <td>{{str_limit($post->text, 7)}}</td>
                    <td>{{$post->created_at ? $post->created_at->diffForHumans() : 'Unavailable'}}</td>
                    <td>{{$post->updated_at ? $post->updated_at->diffForHumans() : 'Unavailable'}}</td>
                    <td><a href="{{route('posts.show', $post->id)}}">View post</a></td>
                    <td>{{$post->approved == 1 ? 'Approved' : 'Not approved'}}</td>
                    <td><a href="{{route('posts.edit', $post->id)}}">Edit post</a></td>
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