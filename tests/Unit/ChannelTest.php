<?php

namespace Tests\Unit;

use App\Channel;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    use DatabaseMigrations;

    public function test_a_channel_consists_of_threads()
    {
        $channel = factory(Channel::class)->create();
        $thread = factory(Thread::class)->create([
            'channel_id' => $channel->id,
        ]);

        $this->assertTrue($channel->threads->contains($thread));
    }
}
