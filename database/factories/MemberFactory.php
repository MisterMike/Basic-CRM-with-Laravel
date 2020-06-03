<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Member;
use Faker\Generator as Faker;

$factory->define(Member::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        //'sex' => $faker->title($gender = null|'male'|'female'),
		'active' => $faker->boolean($chanceOfGettingTrue = 98),
		'address' => $faker->streetAddress,
		'zip' => $faker->postcode,
		'city' => $faker->city,
		'phone_home' => $faker->phoneNumber,
		'phone_mobile' => $faker->phoneNumber,
		'phone_office' => $faker->phoneNumber,
		'birthday' => $faker->dateTimeThisCentury->format('Y-m-d'),
		'member_since' => $faker->dateTimeThisDecade($max = 'now', $timezone = null),
		'license' => $faker->boolean($chanceOfGettingTrue = 40),
		'newsletter' => $faker->boolean($chanceOfGettingTrue = 90),
		'comment' => $faker->realText($maxNbChars = 200, $indexSize = 2),
    ];
});


