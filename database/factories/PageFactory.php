<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Page::class, function (Faker $faker) {
    return [
        'url' => '',
        'name' => $faker->word(),
        'template' => $faker->word(),
        'sort' => $faker->randomNumber(5, true),
        'is_layout' => 0
    ];
});
