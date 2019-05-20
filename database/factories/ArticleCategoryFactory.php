<?php

use Raffles\Models\User;

use Faker\Generator as Faker;

$factory->define(Raffles\Models\ArticleCategory::class, function (Faker $faker) {
    $name = $faker->word;
    $user = factory(User::class)->create();

    return [
        'description' => $faker->paragraph,
        'name' => $name,
        'slug' => str_slug($name),
        'user_id' => $user->id,
    ];
});
