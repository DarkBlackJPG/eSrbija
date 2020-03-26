<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Moderator;
use Faker\Generator as Faker;

$factory->define(Moderator::class, function (Faker $faker) {
    return [
        'id' => factory(\App\Korisnik::class),
        'naziv' => $faker->unique()->name,
        'adresa' => $faker->address,
        'pib' => $faker->unique()->randomNumber(9),
        'maticniBroj' => $faker->unique()->randomNumber(8),
        'opstinaPoslovanja_id' => factory(\App\Mesto::class),
    ];
});
