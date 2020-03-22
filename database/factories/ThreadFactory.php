<?php

/** @var Factory $factory */

use App\Channel;
use App\Thread;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Thread::class, function (Faker $faker) {
    return [
        'user_id' => fn() => factory(User::class)->create()->id,
        'channel_id' => fn() => factory(Channel::class)->create()->id,
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
    ];
});
