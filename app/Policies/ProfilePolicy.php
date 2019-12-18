<?php

namespace App\Policies;

use App\Profile;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProfilePolicy
{
    use HandlesAuthorization;

    public function view(User $user, Profile $profile)
    {
        return $user->id != $profile->user_id ? true : false;
    }

    public function update(User $user, Profile $profile)
    {
         if( $user->id == $profile->user_id || $user->role == 'admin') {
             return true;
         }
         return false;
    }
}
