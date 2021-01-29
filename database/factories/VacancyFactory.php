<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Models\Vacancy::class, function (Faker $faker) {
    return [
        'name'            => $faker->realText(120),
        'city'            => $faker->city,
        'payment'         => $faker->numberBetween(1200, 40000),
        'employment_type' => $faker->word,
        'is_published'    => $faker->boolean,
        'body' => array (
            0 =>
                array (
                    'caption' => 'Требование к кандидату',
                    'type' => 'header',
                ),
            1 =>
                array (
                    'caption' => 'Образование',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            2 =>
                array (
                    'caption' => 'Требуемый опыт работы',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            3 =>
                array (
                    'caption' => 'Прохождение медицинского осмотра',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            4 =>
                array (
                    'caption' => 'Основные компетенции',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            5 =>
                array (
                    'caption' => 'Специальные навыки',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            6 =>
                array (
                    'caption' => 'Личные качества',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            7 =>
                array (
                    'caption' => 'Особые требования',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            8 =>
                array (
                    'type' => 'dashed',
                ),
            9 =>
                array (
                    'caption' => 'Обязаности',
                    'type' => 'header',
                ),
            10 =>
                array (
                    'caption' => 'Трудовые функции',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            11 =>
                array (
                    'caption' => 'Наличие подчиненных',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            12 =>
                array (
                    'type' => 'dashed',
                ),
            13 =>
                array (
                    'caption' => 'Предложение работодателя',
                    'type' => 'header',
                ),
            14 =>
                array (
                    'caption' => 'График работы',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            15 =>
                array (
                    'caption' => 'Характер работы',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            16 =>
                array (
                    'caption' => 'Заработная плата',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            17 =>
                array (
                    'caption' => 'Испытательный срок',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            18 =>
                array (
                    'caption' => 'Наличие командировок',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            19 =>
                array (
                    'caption' => 'Обучение',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            20 =>
                array (
                    'caption' => 'Оснащенность рабочего места',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            21 =>
                array (
                    'caption' => 'Спецодежда',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            22 =>
                array (
                    'caption' => 'Доставка служебным транспортом',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            23 =>
                array (
                    'caption' => 'Предоставление питания',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
            24 =>
                array (
                    'caption' => 'Возможность карьерного роста',
                    'value' => $faker->text(120),
                    'type' => 'column',
                ),
        )
    ];
});
