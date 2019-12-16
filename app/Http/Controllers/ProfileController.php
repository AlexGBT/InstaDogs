<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $profiles = Profile::select('id', 'title', 'image','user_id')->with('user')->paginate(3);
//        dd($profiles[2]->user);


        return view('profiles.index', compact('profiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $follows = (auth()->user()) ? auth()->user()->profiles->contains($profile->id) : false;
//        dd(auth()->user()->profiles, $profile->users);


        $postCount  = $profile->posts->count();
        $followersCount = $profile->users->count();
        $followingCount = $profile->user->profiles->count();

//        $postCount = Cache::remember(
//            'count.posts.' . $profile->id,
//            now()->addSeconds(30),
//            function () use ($profile) {
//                return $profile->posts->count();
//            });
//        $followersCount = Cache::remember(
//            'count.followers.' . $profile->id,
//            now()->addSeconds(30),
//            function () use ($profile) {
//                return $profile->users->count();
//            });
//
//        $followingCount = Cache::remember(
//            'count.following.' . $profile->id,
//            now()->addSeconds(30),
//            function () use ($profile) {
//                return $profile->user->profiles->count();
//            });
        return view('profiles.show',compact(
            'profile', 'follows', 'postCount', 'followersCount', 'followingCount'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $this->authorize('update', $profile);
        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, Profile $profile)
    {
        $data = $request->except(['_token','_method']);
        $profile->updateData($data);
        return view('profiles.show',compact(
            'profile'
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
