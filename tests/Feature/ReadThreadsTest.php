<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    private $thread;

    protected function setUp(): void
    {
        parent::setUp();

        $this->thread = factory(Thread::class)->create();
    }

    public function test_a_user_can_view_all_threads()
    {
        $this->get('/threads')
            ->assertSee($this->thread->title);
    }

    public function test_a_user_can_read_a_single_thread()
    {
        $this->get('/thread/' . $this->thread->id)
            ->assertSee($this->thread->title);
    }

    public function test_a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = factory(Reply::class)
            ->create(['thread_id' => $this->thread->id]);

        $this->get('/thread/' . $this->thread->id)
            ->assertSee($reply->body);
    }

    public function test_a_user_can_see_when_the_thread_was_created()
    {
        $this->get('/threads')
            ->assertSee($this->thread->created_at);
    }

    public function test_a_user_can_see_who_created_the_thread()
    {
        $this->get('/threads')
            ->assertSee($this->thread->owner->name);
    }
}
