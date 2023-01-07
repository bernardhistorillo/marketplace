<?php

use App\Mustachio;
use Faker\Generator as Faker;

$factory->define(Mustachio::class, function (Faker $faker) {
    return [
        'name' => $faker->firstName,
        'description' => $faker->paragraph,
        'image' => $faker->imageUrl,
        'attributes' => [],
        'exists' => 0,
    ];
});