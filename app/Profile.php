<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    public $guarded =[];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getLogoAttribute()
    {
        $logoWay =  "storage/" . $this->image;
        return $logoWay;
    }
}
