<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified')->only('create');

    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(PostRequest $request, Post $post)
    {

        $profile = auth()->user()->profile;
        $data = $request->except(['_token','_method']);
        $post->createPost($data);
        return redirect()->route('profile.show',[$profile])->with('message','Your post successfully saved');
    }

    public function show(Post $post)
    {
        $user = auth()->user();
        return view('posts.show',compact('post','user'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        $post->allow_comments = !$post->allow_comments ;
        $post->save();
        return $post;
    }

    public function destroy(Post $post)
    {
        $this->authorize('forceDelete', $post);
        $profile = $post->profile;
        Storage::disk('public')->delete($post->image);
        $post->delete();
        return redirect()->route('profile.show',[$profile]);
     }
}
