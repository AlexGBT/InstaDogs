<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
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
}
