<?php

namespace Tests\Feature;

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

        $this->post(route('threads.store'), [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
        ]);

        $thread = Thread::first();
        $this->get(route('threads.index'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }
}
