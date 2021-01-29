<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name'                 => $faker->text(120),
        'slug'                 => $faker->slug,
        'image_url'            => $faker->imageUrl(),
        'meta_title'           => $faker->text(126),
        'meta_description'     => $faker->text(126),
        'material_title'       => $faker->text(126),
        'material_sub_title'   => $faker->text(126),
        'material_description' => $faker->text(126),
        'is_published'         => $faker->boolean,
        'is_popular'           => $faker->boolean,
        'material_image_url'   => $faker->imageUrl(),
        'specs'                => [
            [
                'caption' => 'Состав',
                'value'   => $faker->text(126),
                'type'    => 'column',
            ],
            [
                'caption' => 'Масса',
                'value'   => $faker->text(126),
                'type'    => 'column',
            ],
            [
                'caption' => 'Условия хранения',
                'value'   => $faker->text(126),
                'type'    => 'column',
            ],
            [
                'caption' => 'ВАРН',
                'value'   => $faker->text(126),
                'type'    => 'warn',
            ],
        ]
    ];
});
