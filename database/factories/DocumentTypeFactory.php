<?php

use Faker\Generator as Faker;

$factory->define(Raffles\Models\DocumentType::class, function (Faker $faker) {

    $name = $faker->word;

    return [
        'description' => $faker->sentence,
        'name' => $name,
        'slug' => str_slug($name)
    ];
});
