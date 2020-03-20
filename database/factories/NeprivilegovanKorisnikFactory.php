<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\NeprivilegovanKorisnik;
use Faker\Generator as Faker;

$factory->define(NeprivilegovanKorisnik::class, function (Faker $faker) {
    return [
        'id' => factory(\App\Korisnik::class),
        'ime' => $faker->firstName,
        'prezime' => $faker->lastName,
        'datumRodjenja' => $faker->date(),
        'adresaPrebivalista' => $faker->address,
        'jmbg' => substr($faker->unique()->creditCardNumber,0,13),
        'pol' => true,
        'brojLicneKarte' => $faker->unique()->randomNumber(9),
        'opstinaPrebivalista_id' => factory(\App\Mesto::class),
        'opstinaRodjenja_id' => factory(\App\Mesto::class),
    ];
});
