<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\VacancyInquirer::class, function (Faker $faker) {
    return [
        'email'            => $faker->email,
        'name'             => $faker->name,
        'phone'            => $faker->phoneNumber,
        'application_text' => $faker->text(302),
        'created_at'       => $faker->dateTimeBetween('-30 days', '+30 days'),
    ];
});
