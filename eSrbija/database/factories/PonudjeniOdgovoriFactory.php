<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PonudjeniOdgovori;
use Faker\Generator as Faker;

$factory->define(PonudjeniOdgovori::class, function (Faker $faker) {
    return [
        'tekst' => $faker->text,
        'pitanja_id' => factory(\App\Pitanja::class),
    ];
});
