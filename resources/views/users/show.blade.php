@extends('layouts.master')

@section('title', 'User')


@section('content')


    <h1>User personal data</h1>

    <div class="row">

        <div class="col-sm-3">
            <img height="400" src="{{$user->image ? $user->image->profile_image != '/laravel_twitter/public/profile_image/' ? $user->image->profile_image : 'http://placehold.it/400x400' : 'http://placehold.it/400x400'}}" alt="" class="img-responsive img-rounded">
        </div>

        <div class="col-sm-9">

            <table class="table">
               <thead>
                <tr>
                    <th>Nickname</th>
                    <th>Display name</th>
                    <th>Email</th>
                    <th>Posts</th>

                </tr>
                </thead>
                <tbody>

                @if($user)

                <tr>
                    <td>{{$user->nickname}}</td>
                    <td>{{$user->display_name ? $user->display_name : $user->nickname}}</td>
                    <td>{{$user->email}}</td>
                    <td>user posts</td>
                    <td>
                        @if($follow)

                                {!! Form::open(['method'=>'DELETE', 'action' => ['FollowController@destroy', $user->id]]) !!}

                                    <div class="form-group">
                                        {!! Form::submit('Un-follow', ['class' => 'btn btn-primary']) !!}
                                    </div>

                                    {!! Form::close() !!}

                            @else

                                {!! Form::open(['method'=>'post', 'action' => 'FollowController@store']) !!}

                                <input type="hidden" name="follow_id" value="{{$user->id}}">

                                <div class="form-group">
                                    {!! Form::submit('Follow', ['class' => 'btn btn-primary']) !!}
                                </div>

                                {!! Form::close() !!}

                            @endif

                    </td>
                </tr>


                @endif

               </tbody>
              </table>

        </div>

    </div>


    {{-- include file for show errors --}}

    <div class="row">

        {{--@include('includes.form_error')--}}

    </div>




@endsection



