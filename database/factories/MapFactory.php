<?php

use Faker\Generator as Faker;

$factory->define(Raffles\Models\Map::class, function (Faker $faker) {
    return [
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'zoom' => rand(0,22)
    ];
});
