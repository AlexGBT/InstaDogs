<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Profile;
use Illuminate\Http\Request;
use App\Post;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
          $data = $request->all();
          $comment =Comment::create($data);
          return $comment;
    }

    public function load(Request $request)
    {
        $skip = $request->get('comments_number');
        $post = Post::find($request->get('post_id'));
        $com = $post->comments()->select('body', 'user_id', 'id')->with('user')->latest()->take(10)->skip($skip)->get();
        return $com;
    }

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
