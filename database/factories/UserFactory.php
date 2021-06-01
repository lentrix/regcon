<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $desg = ['Faculty','Faculty','Dean','Chairman','OIC','Administrator','IT Staff'];
    $schl = [
        'University of San Jose-Recolletos',
        'Cebu Institute of Technology-University',
        'Cebu Technological University',
        'University of Bohol',
        'Holy Name University',
        'University of San Carlos',
        'Mater Dei College',
        'University of Cebu - Lapulapu-Mandaue',
        'University of Cebu - Banilad'
    ];
    return [
        'lname' => $faker->lastName,
        'fname' => $faker->firstName,
        'designation' => $desg[array_rand($desg)],
        'school' => $schl[array_rand($schl)],
        'phone' => $faker->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('password'), // password
        'remember_token' => Str::random(10),
    ];
});
