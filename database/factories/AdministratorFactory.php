<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Administrator;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Administrator::class, function (Faker $faker) {
    return [
        'id' => factory(\App\Korisnik::class),
    ];
});
