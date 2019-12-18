<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    return [
        'description' => $faker->sentence(5),
        'image' => 'img/posts/' . $faker->image('public/storage/img/posts',1000,1000, null, false  ),
        'allow_comments' => $faker->boolean
    ];
});
