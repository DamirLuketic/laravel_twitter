<?php

namespace App\Http\Controllers;

use App\Follow;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Image;
use App\Post;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(7);

        return view('users.index', compact('a_user', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $user = User::findBySlugOrFail($slug);

        // complete follow users data

        $follows = Follow::where('user_id', Auth::user()->id)->get();

        // follow user id

        $follows_array = array();

        foreach ($follows as $follow)
        {
            $follows_array[] = $follow->follow_id;
        }


        if(in_array($user->id, $follows_array))
        {
            $follow = true;
        }else
        {
            $follow = false;
        }

        return view('users.show', compact('user', 'follow'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = Auth::user();


        // If new image is set -> delete old image, upload new image, and set path

        $input_img = array();

        if($profile_image = $request->file('profile_image'))
        {
                    // because I was create accessor in image model a use also second check in next if
            // -> if column value is not set, because accessor colum will have value of path part
            if(isset($user->image->profile_image) && $user->image->profile_image != "/laravel_twitter/public/profile_image/")
            {
                unlink(public_path() . '/../..' . $user->image->profile_image);
            }

            // upload part

            $profile_name = time() . $profile_image->getClientOriginalName();

            $profile_image->move('profile_image', $profile_name);

            $input_img['profile_image'] = $profile_name;

        }

        if($cover_image = $request->file('cover_image'))
        {

            if(isset($user->image->cover_image) && $user->image->cover_image != "/laravel_twitter/public/cover_image/")
            {
                unlink(public_path() . '/../..' . $user->image->cover_image);
            }

            $cover_name = time() . $cover_image->getClientOriginalName();

            $cover_image->move('cover_image', $cover_name);

            $input_img['cover_image'] = $cover_name;

        }

        // update or create path

        if($input_img)
        {
            if($user->image)
            {
                $user->image->update($input_img);
            }else
            {
                $input_img['user_id'] = $user->id;

                Image::create($input_img);
            }

        }



            // re-write password if password is in $request

            if(trim($request->password) == '')
            {
                $input = $request->except('password');
            }else
            {
                $input = $request->all();

                $input['password'] = bcrypt($request->password);
            }

            session()->flash('personal_data_updated', 'Your data has been changed');

            $user->update($input);

            return redirect()->route('users.edit', $user->slug);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();

        if(isset($user->image))
        {

            if (isset($user->image->profile_image) && $user->image->profile_image != "/laravel_twitter/public/profile_image/") {
                unlink(public_path() . '/../..' . $user->image->profile_image);
            }

            if (isset($user->image->cover_image) && $user->image->cover_image != "/laravel_twitter/public/cover_image/") {
                unlink(public_path() . '/../..' . $user->image->cover_image);
            }

        }

        // User image data (path) will be deleted when user been deleted (set in table "images")

        $user->delete();

        session()->flash('account_deleted', 'Your account has been deleted');

        return redirect('/');
    }

    public function my_posts()
    {
        $user = Auth::user();

        $posts = Post::whereUserId($user->id)->latest()->paginate(10);

        return view('users.my_posts', compact('posts'));
    }

    public function follows_posts()
    {
        $user = Auth::user();

        $user_follows = $user->follows;

        $user_follows_id = array();

        foreach($user_follows as $id)
        {
            $user_follows_id[] = $id->follow_id;
        }

         $posts = Post::whereIn('user_id', $user_follows_id)->paginate(7);

        return view('users.follows_posts', compact('posts'));
    }
}
