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
