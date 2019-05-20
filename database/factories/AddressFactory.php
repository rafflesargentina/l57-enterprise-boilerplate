<?php

use Faker\Generator as Faker;

$factory->define(Raffles\Models\Address::class, function (Faker $faker) {
    return [
        'addressable_id' => '1',
        'addressable_type' => 'Raffles\Models\User',
        'country' => $faker->country,
        'door_number' => rand(1,25000),
        'featured' => rand(0,1),
        'floor_number' => rand(1,25),
        'locality' => $faker->city,
        'state' => $faker->state,
        'street_name' => $faker->streetName,
        'street_number' => rand(10, 15000),
        'sublocality' => $faker->city,
        'zip' => $faker->postCode,
    ];
});
