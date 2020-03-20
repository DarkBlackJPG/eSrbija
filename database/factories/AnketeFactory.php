<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Ankete;
use Faker\Generator as Faker;

$factory->define(Ankete::class, function (Faker $faker) {
    $tempId = factory(\App\Moderator::class)->create()->id;
    //dd($tempId);
    return [
        'naziv' => $faker->title,
        'obrisanoFlag' => false,
        'nivoLokNac' => random_int(0, 10) % 2,
        'korisnik_id' => $tempId,
    ];
});
