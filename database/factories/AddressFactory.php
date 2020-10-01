<?php

/** @var Factory $factory */

use App\Models\Address;
use App\Models\Country;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Address::class, function (Faker $faker) {
    $countries = Country::all();

    return [
        'street' => $faker->streetName,
        'street_number' => $faker->randomNumber(2),
        'post_code' => $faker->postcode,
        'city' => $faker->city,
        'country_id' => $countries->random()->id,
    ];
});
