<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Marker;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(Marker::class, function (Faker $faker) {

    $latitude = $faker->latitude;
    $longitude = $faker->longitude;

    return [
        'comment' => $faker->realText(),
        'coordinates' => DB::raw("POINT({$latitude}, {$longitude})"),
        'created_at' => $faker->dateTimeThisMonth('now')
    ];
});
