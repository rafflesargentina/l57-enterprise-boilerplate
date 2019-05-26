<?php

use Faker\Generator as Faker;

$factory->define(Raffles\Models\Company::class, function (Faker $faker) {
    $name = $faker->company;

    return [
        'companyable_id' => '1',
        'companyable_type' => 'Raffles\Models\User',
        'description' => $faker->paragraph,
        'name' => $name,
        'slug' => str_slug($name),
    ];
});
