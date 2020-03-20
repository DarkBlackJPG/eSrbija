<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Pitanja;
use Faker\Generator as Faker;

$factory->define(Pitanja::class, function (Faker $faker) {
    return [
        'tekst' => $faker->text,
        'ankete_id' => factory(\App\Ankete::class),
    ];
});
