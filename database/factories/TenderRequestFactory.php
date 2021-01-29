<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\TenderRequest::class, function (Faker $faker) {
    return [
        'name'            => $faker->name,
        'email'           => $faker->email,
        'phone'           => $faker->phoneNumber,
        'company_name'    => $faker->company,
        'text'            => $faker->realText(320),
        'data_processing' => $faker->boolean,
    ];
});
