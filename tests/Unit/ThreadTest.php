<?php

namespace Tests\Unit;

use App\Thread;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_thread_has_replies()
    {
        $thread = factory(Thread::class)->create();

        $this->assertInstanceOf(Collection::class, $thread->replies);
    }

    public function test_it_has_an_owner()
    {
        $reply = factory(Thread::class)->create();

        $this->assertInstanceOf(User::class, $reply->owner);
    }
}
