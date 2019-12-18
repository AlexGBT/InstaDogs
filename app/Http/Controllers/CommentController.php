<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Profile;
use Illuminate\Http\Request;
use App\Post;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
                dd(__METHOD__);
//        echo 'adsgggggggggggggggggg asdgasdg ';
//        return 'pop thes niggas';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
          $data = $request->all();
          $comment =Comment::create($data);
          return $comment;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function load(Request $request)
    {

//        $profiles = Profile::select('id', 'title', 'image','user_id')->with('user')->paginate(3);
        $skip = $request->get('comments_number');
        $post = Post::find($request->get('post_id'));
        $com = $post->comments()->select('body', 'user_id', 'id')->with('user')->latest()->take(10)->skip($skip)->get();

//        $com = $post->comments()->latest()->get();
        return $com;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('forceDelete', $comment);
        $status = $comment->delete();
        if ($status) {
            return 'success';
        }
        return false;
     }
}
