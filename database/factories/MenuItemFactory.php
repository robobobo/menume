<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MenuItem;
use Faker\Generator as Faker;

$factory->define(MenuItem::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->name,
        'description' => $faker->sentence(10,true),
        'price' => $faker->randomFloat(2,2,20),
    ];
});
