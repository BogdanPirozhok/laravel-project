<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Models\StoreNetwork::class, function (Faker $faker) {
    return [
        'name' => $faker->text(30),
        'description' => $faker->text(200),
        'external_url' => $faker->url,
        'store_uid' => $faker->tld . $faker->fileExtension
    ];
});
