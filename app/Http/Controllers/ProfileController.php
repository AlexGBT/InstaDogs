<?php

namespace App\Http\Controllers;

use App\Helpers\Contracts\PersonPropertiesContract;
use App\Http\Requests\ProfileRequest;
use App\Post;
use App\Profile;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
        $this->middleware('verified')->only('edit');
    }

    public function index()
    {
        $profiles = Profile::select('id', 'title', 'image','user_id')->with('user')->paginate(5);
        return view('profiles.index', compact('profiles'));
    }


    public function show(Profile $profile, PersonPropertiesContract $personProperties)
    {
        $personInfo = $personProperties->getPersonInfo();
        $personPrivileges = $personProperties->getPersonPrivileges();
        $follows = (auth()->user()) ? auth()->user()->profiles->contains($profile->id) : false;
        $postCount  = $profile->posts->count();
        $followersCount = $profile->users->count();
        $followingCount = $profile->user->profiles->count();
        return view('profiles.show',compact(
            'profile', 'follows', 'postCount', 'followersCount', 'followingCount','personInfo','personPrivileges'
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
        return redirect()->route('profile.show', ['profile' => $profile->id])->with('message','Your profile was successfully updated');
    }

    public function followingPosts()
    {
        $followingProfilesId = auth()->user()->profiles()->pluck('profiles.id');
        $followingPosts = Post::whereIn('profile_id',$followingProfilesId)->latest()->take(100)->paginate(10);
        return view('profiles.followingPosts',compact('followingPosts'));
    }
}
