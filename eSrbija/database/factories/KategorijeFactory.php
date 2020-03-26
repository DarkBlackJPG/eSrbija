<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Kategorije;
use Faker\Generator as Faker;

$factory->define(Kategorije::class, function (Faker $faker) {
    return [
        'naziv' => $faker->unique()->firstName(),
    ];
});
