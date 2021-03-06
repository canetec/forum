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

    public function test_unauthenticated_users_may_not_add_replies()
    {
        $thread = factory(Thread::class)->create();

        $this->post(route('replies.store', [$thread->channel, $thread]))
            ->assertRedirect('/login');
    }

    public function test_an_authenticated_user_may_participate_in_forum_threads()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->make([
            'user_id' => $user->id,
            'thread_id' => $thread->id,
            'body' => $this->faker->sentence,
        ]);

        $this->post(route('replies.store', [
            $thread->channel->slug,
            $thread->id,
        ]), $reply->toArray());

        $this->get($thread->path())->assertSee($reply->body);
    }

    public function test_a_reply_requires_a_body()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->make(['body' => null]);

        $response = $this->post(route('replies.store', [
            $thread->channel->slug,
            $thread->id,
        ]), $reply->toArray());

        $response->assertSessionHasErrors('body');
    }
}
