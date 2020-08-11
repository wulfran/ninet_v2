<?php

/** @var Factory $factory */

use App\Models\Company;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Company::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'tax_number'=> $faker->randomNumber(9),
    ];
});
