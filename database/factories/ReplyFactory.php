<?php

/** @var Factory $factory */

use App\Reply;
use App\Thread;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Reply::class, function (Faker $faker) {
    return [
        'thread_id' => fn() => factory(Thread::class)->create()->id,
        'user_id' => fn() => factory(User::class)->create()->id,
        'body' => $faker->paragraph,
    ];
});
