<?php

namespace App\Observers;

use App\User;

class UserObserver
{

    public function creating(User $user)
    {
        $user->role = 'user';
    }

    public function created(User $user)
    {
        $user->profile()->create([
            'title' => $user->login,
            'image' => '/img/logos/base-logo.png',
        ]);
    }
}
