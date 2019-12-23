<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $guarded =[];

    public static function loadComments($request)
    {
        $skip = $request->get('comments_number');
        $post = Post::find($request->get('post_id'));
        $com = $post->comments()->select('body', 'user_id', 'id')->with('user')->latest()->take(10)->skip($skip)->get();
        return $com;
    }

    public static function deleteComment($comment)
    {
        $status = $comment->delete();
        if ($status) {
            return 'success';
        }
        return false;
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
