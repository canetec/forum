<?php

namespace Tests\Unit;

use App\Channel;
use App\Thread;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function test_it_has_replies()
    {
        $thread = factory(Thread::class)->create();

        $this->assertInstanceOf(Collection::class, $thread->replies);
    }

    public function test_it_has_an_owner()
    {
        $reply = factory(Thread::class)->create();

        $this->assertInstanceOf(User::class, $reply->owner);
    }

    public function test_it_belongs_to_a_channel()
    {
        $thread = factory(Thread::class)->create();

        $this->assertInstanceOf(Channel::class, $thread->channel);
    }

    public function test_it_can_add_a_reply()
    {
        $thread = factory(Thread::class)->create();
        $replier = factory(User::class)->create();

        $thread->addReply([
            'body' => 'Lorem ipsum',
            'user_id' => $replier->id,
        ]);

        $this->assertCount(1, $thread->replies);
        $this->assertSame($replier->id, $thread->replies()->first()->owner->id);
    }
}
