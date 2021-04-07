<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Candidate;
use Faker\Generator as Faker;
$factory->define(Candidate::class, function (Faker $faker) {
    return [
        'participant_id' => $faker->numberBetween(1,49),
        'tagline' => $faker->sentence(5, true)
    ];
});
