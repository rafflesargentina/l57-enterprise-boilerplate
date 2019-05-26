<?php

use Faker\Generator as Faker;

$factory->define(Raffles\Models\Contact::class, function (Faker $faker) {
    return [
        'contactable_id' => '1',
        'contactable_type' => 'Raffles\Models\User',
        'email' => $faker->email,
        'fax' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'phone' => $faker->phoneNumber,
        'position' => $faker->word,
        'website' => $faker->domainName,
    ];
});
