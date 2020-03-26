<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Obavestenja;
use Faker\Generator as Faker;

$factory->define(Obavestenja::class, function (Faker $faker) {
    return [
        'naslov' => $faker->title,
        'opis' => $faker->text,
        'link' => $faker->url,
        'nivoLokNac' => random_int(0, 10) % 2,
        'korisnik_id' => factory(\App\Moderator::class),
        'obrisano' => false,
    ];
});
