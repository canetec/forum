<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ParticipateInThreadsTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    /** @test */
    public function an_authenticated_user_can_participate_in_a_thread()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();
        $this->be($user);

        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->make([
            'user_id' => $user->id,
            'thead_id' => $thread->id,
            'body' => $this->faker->sentence,
        ]);

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())->assertSee($reply->body);
    }
}
