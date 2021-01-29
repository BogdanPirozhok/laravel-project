<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\Tender::class, function () {
    return [];
});

$factory->state(\App\Models\Tender::class, 'tender', function (Faker $faker) {
    return [
        'type'         => \App\Models\Tender::TENDER,
        'name'         => $faker->text(150),
        'unit'         => $faker->citySuffix,
        'volume'       => $faker->numberBetween(1, 230),
        'is_published' => $faker->boolean,
        'deadline'     => $faker->date('m.d.Y') . ' - ' . $faker->date('m.d.Y')
    ];
});

$factory->state(\App\Models\Tender::class, 'purchase', function (Faker $faker) {
    return [
        'type'         => \App\Models\Tender::PURCHASE,
        'name'         => $faker->text(150),
        'unit'         => $faker->citySuffix,
        'volume'       => $faker->numberBetween(1, 230),
        'description'  => $faker->text(350),
        'is_published' => $faker->boolean,
    ];
});

