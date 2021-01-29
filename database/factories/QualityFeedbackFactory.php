<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\QualityFeedback::class, function (Faker $faker) {
    return [
        'purchase_date'                => $faker->iso8601,
        'purchase_place_name'          => $faker->userName,
        'purchase_place_address'       => $faker->address,
        'purchase_product_date'        => $faker->iso8601,
        'purchase_product_description' => $faker->realText('150'),
        'wishes'                       => $faker->realText('100'),
        'contact_me'                   => $faker->boolean,
        'contact_name'                 => $faker->name,
        'contact_attribute'            => $faker->email
    ];
});
