<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Profile extends Model
{
    public $guarded = [];

    public function updateData($data)
    {
        if (request('image')) {
            $imagePath = request('image')->store('img/logos', 'public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();
            $imageArray = ['image' => $imagePath];
        }

        $this->update(array_merge(
            $data,
            $imageArray ?? []
        ));
    }

    public static function showFollowers($id) {
        $role = 'Followers';
        $login = Profile::find($id)->user->login;

        $followers = Profile::find($id)->users;
        $profiles = $followers->map(function ($item) {
            return $item->profile;
        });
        $profiles = $profiles->paginate(10);
        return [
            'profiles' => $profiles,
            'login'=> $login,
            'role' =>$role
        ];
    }

    public static function showFollowing($id) {
        $role = 'Following';
        $login = User::find($id)->login;
        $profiles = User::find($id)->profiles()->paginate(10);
        return [
            'profiles' => $profiles,
            'login'=> $login,
            'role' =>$role
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class)->orderBy('created_at', 'DESC');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getLogoAttribute()
    {
        $logoWay =  "storage/" . $this->image;
        return $logoWay;
    }
}
