<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\User;

use App\Role;

use App\Image;

class AdminUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $query = $request->search;

        $users = User::where('nickname', 'LIKE', '%' . $query . '%')->orWhere('display_name', 'LIKE', '%' . $query . '%')->paginate(10);

        return view('admin.users.index', compact('users', 'query'));

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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $user = User::findBySlugOrFail($slug);

        $roles = Role::lists('name', 'id')->all();

        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $user = User::findBySlugOrFail($slug);

        $input_img = '';

        if($profile_image = $request->file('profile_image'))
        {
            if(isset($user->image))
            {

                if (isset($user->image->profile_image) && $user->image->profile_image != '/laravel_twitter/public/profile_image/') {
                    unlink(public_path() . '/../..' . $user->image->profile_image);
                }
            }

            $profile_name = time() . $profile_image->getClientOriginalName();

            $profile_image->move('profile_image', $profile_name);

            $input_img['profile_image'] = $profile_name;

        }

        if($cover_image = $request->file('cover_image'))
        {
            if(isset($user->image))
            {

                if (isset($user->image->cover_image) && $user->image->cover_image != '/laravel_twitter/public/cover_image/') {
                    unlink(public_path() . '/../..' . $user->image->cover_image);
                }
            }

            $cover_name = time() . $cover_image->getClientOriginalName();

            $cover_image->move('cover_image', $cover_name);

            $input_img['cover_image'] = $cover_name;
        }

        if($input_img && !empty($input_img))
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


        if(trim($request->password) == '')
        {
            $input = $request->except('password');
        }else
        {
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        $user->update($input);

        session()->flash('user_data_updated', 'User data is updated');

        return redirect()->route('admin.users.edit', $user->slug);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $user = User::findBySlugOrFail($slug);

        if(isset($user->image))
        {

            if (isset($user->image->profile_image) && $user->image->profile_image != "/laravel_twitter/public/profile_image/") {
                unlink(public_path() . '/../..' . $user->image->profile_image);
            }

            if (isset($user->image->cover_image) && $user->image->cover_image != "/laravel_twitter/public/cover_image/") {
                unlink(public_path() . '/../..' . $user->image->cover_image);
            }

        }

        $user->delete();

        session()->flash('user_deleted', 'User is deleted');

        return redirect()->route('admin.users.index');
    }
}
