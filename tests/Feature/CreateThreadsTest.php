<?php

namespace Tests\Feature;

use App\Channel;
use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;
    use WithFaker;

    public function test_guests_may_not_create_threads()
    {
        $this->get(route('threads.create'))
            ->assertRedirect(route('login'));

        $this->post(route('threads.store'), [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
        ])->assertRedirect(route('login'));
    }

    public function test_authenticated_users_may_create_threads()
    {
        $user = factory(User::class)->create();
        $this->be($user);

        $thread = factory(Thread::class)->make([
            'title' => $this->faker->sentence,
            'channel_id' => factory(Channel::class)->create()->id,
            'body' => $this->faker->paragraph,
        ]);

        $response = $this->post(route('threads.store'), $thread->toArray());

        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
