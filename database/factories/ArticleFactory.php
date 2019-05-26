<?php

use Raffles\Models\User;

use Faker\Generator as Faker;

$factory->define(Raffles\Models\Article::class, function (Faker $faker) {
    $title = $faker->sentence;
    $user = factory(User::class)->create();

    return [
        'body' => $faker->paragraph,
        'published' => rand(0,1),
        'published_at' => \Carbon\Carbon::now(),
        'slug' => str_slug($title),
        'title' => $title,
        'user_id' => $user->id,
    ];
});
