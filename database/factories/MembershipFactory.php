<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Membership;
use Faker\Generator as Faker;

$factory->define(Membership::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence($nbWords = 2, $variableNbWords = true),
        'playing_alowed' => $faker->boolean($chanceOfGettingTrue = 50),
        'price' => $faker->numberBetween($min = 20, $max = 900),
    ];
});
