<?php

namespace Tests\Unit;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    public function test_it_may_own_a_thread()
    {
        factory(Thread::class)->create();

        $this->assertCount(Thread::count(), User::first()->threads);
    }
}
