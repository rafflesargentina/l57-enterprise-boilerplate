<?php

use Faker\Generator as Faker;

$factory->define(Raffles\Models\ArticleCategory::class, function (Faker $faker) {
    $name = $faker->word;

    return [
        'description' => $faker->paragraph,
        'name' => $name,
        'slug' => str_slug($name),
    ];
});
