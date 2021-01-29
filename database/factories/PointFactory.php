<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Point::class, function (Faker $faker) {
    return [
        'type' => 1,
        'address' => $faker->address,
        'name' => $faker->realText(30),
        'info' => $faker->realText(200),
        'longitude' => $faker->longitude,
        'latitude' => $faker->latitude,
    ];
});
