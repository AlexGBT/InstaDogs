<?php

namespace App\Policies;

use App\Post;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;
    public function update(User $user, Post $post)
    {
        if( $user->profile->id == $post->profile_id ) {
            return true;
        }
        return false;
    }

    public function forceDelete(User $user, Post $post)
    {
        if( $user->id == $post->profile->user_id || $user->role == 'admin') {
            return true;
        }
        return false;
    }
}
