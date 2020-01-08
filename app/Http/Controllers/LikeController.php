<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function likeChecker($id)
    {
        $post = Post::find($id);
        $users = $post->usersThatLikedMe;
        $isUserLiked = $users->where('id',auth()->id())->first();
        return $isUserLiked ? 'true':'false';
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
    public function likePost($id)
    {
        $user = auth()->user();
        $post = $user->likedPosts->where('id',$id)->first();
        if (!is_null($post)) {
             return json_decode($user->likedPosts()->detach($post));
        } else {
            if ($user->likes_amount >= 1 ) {
                $post = Post::find($id);
                $user->likes_amount--;
                $user->save();
                return json_decode($user->likedPosts()->attach($post));
            } else {
                return 'no_likes';
            }
        }

///////////////////---------------------- I MUST CHANHGE VUE LikePost !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!

//        $post = Post::find($id);
//        return auth()->user()->likedPosts()->toggle($post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        $usersThatLikedMe = $post->usersThatLikedMe->paginate(5);
        return view('like.show',compact('usersThatLikedMe'));
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
    public function destroy($id)
    {
        //
    }
}
