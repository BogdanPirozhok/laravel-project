<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Recipe::class, function (Faker $faker) {
    return [
        'name'             => $faker->text(120),
        'is_published'     => $faker->boolean,
        'slug'             => $faker->slug,
        'image_url'        => $faker->imageUrl(),
        'body'             => [
            [
                'type' => 'header',
                'data' => [
                    'text'  => $faker->text(120),
                    'level' => 2
                ]
            ],
            [
                'type' => 'paragraph',
                'data' => [
                    'text' => $faker->text(120),
                ]
            ],
            [
                'type' => 'header',
                'data' => [
                    'text'  => $faker->text(120),
                    'level' => 3
                ]
            ],
            [
                'type' => 'paragraph',
                'data' => [
                    'text' => $faker->text(120),
                ]
            ]
        ],
        'ingredients'      => [
            [
                'type' => 'header',
                'data' => [
                    'text'  => $faker->text(120),
                    'level' => 2,
                ]
            ],
            [
                'type' => 'list',
                'data' => [
                    'style' => 'ordered',
                    'items' => [
                        $faker->text(120),
                        $faker->text(120),
                        $faker->text(120),
                    ]
                ]
            ]
        ],
        'complexity'       => $faker->text(120),
        'cooking_time'     => $faker->text(120),
        'servings'         => $faker->text(120),
        'meta_description' => $faker->text(120),
    ];
});
