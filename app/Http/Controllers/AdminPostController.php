<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminPostRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

use App\Post;

class AdminPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('approved', 'asc')->orderBy('created_at', 'asc')->paginate(7);

        return view('admin.posts.index', compact('posts'));
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
    public function edit($id)
    {
        $post = Post::findOrFail($id);

        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AdminPostRequest $request, $id)
    {
        Post::findOrFail($id)->update($request->all());

        session()->flash('post_updated', 'Post has been updated');

        return redirect()->back();
    }

    public function approved(Request $request)
    {

        Post::findOrFail($request->id)->update($request->all());


        if($request->approved == 1)
        {
            session()->flash('post_status', 'Post has been approved');
        }else
        {
            session()->flash('post_status', 'Post has been un-approved');
        }

        return redirect()->back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();

        session()->flash('post_deleted', 'Post has been deleted');

        return redirect()->route('admin.posts.index');
    }
}
