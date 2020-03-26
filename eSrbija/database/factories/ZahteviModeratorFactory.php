<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\ZahteviModerator;
use Faker\Generator as Faker;

$factory->define(ZahteviModerator::class, function (Faker $faker) {
    return [
        'e-mail' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'naziv' => $faker->unique()->name,
        'adresa' => $faker->address,
        'pib' => $faker->unique()->randomNumber(9),
        'maticniBroj' => $faker->unique()->randomNumber(8),
        'opstinaPoslovanja_id' => factory(\App\Mesto::class),
    ];
});
