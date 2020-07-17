<?php

/** @var Factory $factory */

use App\Model;
use App\Models\ShoppingList;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(ShoppingList::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence,
        'created_at' => now(),
        'user_id' => rand(1,21),
    ];
});
