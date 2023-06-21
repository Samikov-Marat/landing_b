<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Site::class, function (Faker $faker) {
    return [
        'name' => $faker->country(),
        'domain' => $faker->domainName(),
        'project_id' => 0,
        'currency_code' => null
    ];
});
