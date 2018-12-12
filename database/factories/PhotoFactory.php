<?php

use Faker\Generator as Faker;

$factory->define(Raffles\Models\Photo::class, function (Faker $faker) {
    $name = $faker->unique()->word;

    return [
        'description' => $faker->sentence,
        'featured' => rand(0,1),
        'location' => $faker->imageUrl,
        'name' => $name,
        'slug' => str_slug($name)
    ];
});
