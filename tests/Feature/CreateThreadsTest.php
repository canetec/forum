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

    public function test_a_user_may_create_a_thread()
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

    public function test_a_guest_user_may_not_create_a_thread()
    {
        $this->post(route('threads.store'), [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
        ]);

        $this->assertCount(0, Thread::all());
    }
}
