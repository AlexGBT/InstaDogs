<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Profile;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }

    public function index()
    {
        $profiles = Profile::select('id', 'title', 'image','user_id')->with('user')->paginate(5);
        return view('profiles.index', compact('profiles'));
    }


    public function show(Profile $profile)
    {
        $follows = (auth()->user()) ? auth()->user()->profiles->contains($profile->id) : false;
        $postCount  = $profile->posts->count();
        $followersCount = $profile->users->count();
        $followingCount = $profile->user->profiles->count();
        return view('profiles.show',compact(
            'profile', 'follows', 'postCount', 'followersCount', 'followingCount'
        ));
    }

    public function edit(Profile $profile)
    {
        $this->authorize('update', $profile);
        return view('profiles.edit', compact('profile'));
    }

    public function update(ProfileRequest $request, Profile $profile)
    {
        $data = $request->except(['_token','_method']);
        $profile->updateData($data);
        return view('profiles.show',compact(
            'profile'
        ));
    }
}
