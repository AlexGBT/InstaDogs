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
        $role = 'Followers';
        $login = Profile::find($id)->user->login;

        $followers = Profile::find($id)->users;
        $profiles = $followers->map(function ($item) {
            return $item->profile;
        });
        $profiles = $profiles->paginate(10);
         return view('users.show',compact('profiles','login', 'role'));

    }

    public function showFollowing($id) {
        $role = 'Following';
        $login = User::find($id)->login;
        $profiles = User::find($id)->profiles()->paginate(10);
        return view('users.show',compact('profiles','login', 'role'));
    }

}
