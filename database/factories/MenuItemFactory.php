<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MenuItem;
use Faker\Generator as Faker;

$factory->define(MenuItem::class, function (Faker $faker) {
    $faker->addProvider(new \FakerRestaurant\Provider\en_US\Restaurant($faker));

    return [
        //
        'name' => $faker->foodName(),
        'description' => $faker->sentence(10,true),
        'price' => $faker->randomFloat(2,2,20),
    ];
});
