<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
class Post extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;
    public $guarded =[];

    public function createPost($data)
    {
        $imagePath = request('image')->store('img/posts', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
        $image->save();
        auth()->user()->profile->posts()->create([
            'description' => $data['description'],
            'image' => $imagePath,
        ]);
    }
    public static function savePost($post)
    {
        $post->allow_comments = !$post->allow_comments ;
        $post->save();
        return $post;
    }

    public static function destroyPost($post)
    {
        $profile = $post->profile;
        Storage::disk('public')->delete($post->image);
        $post->delete();
        return  $profile;
    }


    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsToThrough('App\User','App\Profile');
    }

    public function usersThatLikedMe()
    {
        return $this->belongsToMany(User::class);
    }
    public function getUsersThatLikedMeCountAttribute()
    {
        return $this->usersThatLikedMe()->count();
    }
}
