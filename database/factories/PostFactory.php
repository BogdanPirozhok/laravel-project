<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Post::class, function (Faker $faker) {
    return [
        'name'         => $faker->realText(120),
        'is_published' => $faker->boolean,
        'is_featured'  => $faker->boolean,
        'body'         => [
            [
                'type' => 'header',
                'data' => [
                    'text'  => $faker->realText(120),
                    'level' => 2
                ]
            ],
            [
                'type' => 'paragraph',
                'data' => [
                    'text' => $faker->realText(125)
                ]
            ],
            [
                'type' => 'header',
                'data' => [
                    'text'  => $faker->realText(120),
                    'level' => 3
                ]
            ],
            [
                'type' => 'paragraph',
                'data' => [
                    'text' => $faker->realText(350)
                ]
            ]
        ],


    ];
});
