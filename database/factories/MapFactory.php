<?php

use Faker\Generator as Faker;

$factory->define(Raffles\Models\Map::class, function (Faker $faker) {
    return [
        'lat' => $faker->latitude,
        'lng' => $faker->longitude,
        'mapable_id' => '1',
        'mapable_type' => 'Raffles\Models\User',
        'zoom' => rand(0,22)
    ];
});
