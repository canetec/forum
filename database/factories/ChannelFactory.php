<?php

/** @var Factory $factory */

use App\Channel;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Channel::class, function (Faker $faker) {
    $name = $faker->unique()->word;

    return [
        'name' => $name,
        'slug' => Str::slug($name),
    ];
});
