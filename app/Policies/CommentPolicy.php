<?php

namespace App\Policies;

use App\Comment;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    public function forceDelete(User $user, Comment $comment)
    {
        if ($user->id == $comment->user_id || $user->role == 'admin') {
            return true;
        }
        return false;
    }
}
