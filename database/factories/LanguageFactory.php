<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Language::class, function (Faker $faker) {
    $code_iso = $faker->languageCode();
    return [
        'id' => $faker->randomNumber(5, false),
        'shortname' => Str::upper($code_iso),
        'language_code_iso' => $code_iso,
        'name' => $faker->word(),
        'sort' => $faker->randomNumber(5, false)
    ];
});
