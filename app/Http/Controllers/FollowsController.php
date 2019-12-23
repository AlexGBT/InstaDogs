<?php

namespace App\Http\Controllers;

use App\Profile;
use App\User;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(User $user)
    {
        return auth()->user()->profiles()->toggle($user->profile);
    }

    public function showFollowers($id) {
        $showData = Profile::showFollowers($id);
        return view('users.show',[
            'profiles' => $showData['profiles'],
            'login'=> $showData['login'],
            'role' => $showData['role'],
        ]);
    }

    public function showFollowing($id) {
        $showData = Profile::showFollowing($id);
        return view('users.show',[
            'profiles' => $showData['profiles'],
            'login'=> $showData['login'],
            'role' => $showData['role'],
        ]);
    }
}
