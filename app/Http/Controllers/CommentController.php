<?php

namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
          $data = $request->all();
          return Comment::create($data);
    }

    public function load(Request $request)
    {
        return Comment::loadComments($request);
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('forceDelete', $comment);
        return Comment::deleteComment($comment);
    }
}
