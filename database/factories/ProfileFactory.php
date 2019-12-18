<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
//        'user_id' => function() {
//            return factory(App\User::class)->create()->id;
//        },
        'description' => $faker->sentence(5),
        'title' => $faker->title,
        'image' => $faker->image('public/storage/img/logos',1000,1000, null, true),
    ];
});
