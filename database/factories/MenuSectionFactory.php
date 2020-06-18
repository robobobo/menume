<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\MenuSection;
use Faker\Generator as Faker;

$factory->define(MenuSection::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->randomElement(['Breakfast', 'Lunch','Brunch','Dinner','Drinks','Appetizers','Sides']),
    ];
});
