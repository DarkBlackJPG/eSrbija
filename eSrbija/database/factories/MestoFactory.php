<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Mesto;
use Faker\Generator as Faker;

$factory->define(Mesto::class, function (Faker $faker) {
    return [
        'naziv' => $faker->city,
    ];
});
