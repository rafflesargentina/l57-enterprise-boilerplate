<?php

use Faker\Generator as Faker;

$factory->define(
    Raffles\Models\Photo::class, function (Faker $faker) {
        $name = $faker->unique()->word;
        $user = factory(Raffles\Models\User::class)->create();

        return [
        'description' => $faker->sentence,
        'featured' => rand(0, 1),
        'location' => $faker->imageUrl,
        'name' => $name,
        'photoable_id' => '1',
        'photoable_type' => 'Raffles\Models\User',
        'slug' => str_slug($name),
        'user_id' => $user->id
        ];
    }
);
