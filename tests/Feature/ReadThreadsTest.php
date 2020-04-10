<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use App\User;
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
        $this->get(route('threads.index'))
            ->assertSee($this->thread->title);
    }

    public function test_a_user_can_read_a_single_thread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    public function test_a_user_can_filter_threads_according_to_a_channel()
    {
        $reply = factory(Reply::class)
            ->create(['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    function test_a_user_can_filter_threads_by_any_username()
    {
        $this->be(factory(User::class)->create([
            'name' => 'JohnDoe',
        ]));

        $threadByJohn = factory(Thread::class)->create([
            'user_id' => auth()->id(),
        ]);
        $threadNotByJohn = factory(Thread::class)->create();

        $this->get(route('threads.index', [
            'by' => 'JohnDoe',
        ]))
            ->assertSee($threadByJohn->title)
            ->assertDontSee($threadNotByJohn->title);
    }

    function test_a_user_can_filter_threads_by_popularity()
    {
        $threadWithTwoReplies = factory(Thread::class)->create();
        factory(Reply::class, 2)->create([
            'thread_id' => $threadWithTwoReplies->id,
        ]);

        $threadWithThreeReplies = factory(Thread::class)->create();
        factory(Reply::class, 3)->create([
            'thread_id' => $threadWithThreeReplies->id,
        ]);

        $response = $this->getJson(route('threads.index', [
            'popular' => 1
        ]))->json();

        $this->assertEquals([3, 2, 0], array_column($response, 'replies_count'));
    }

    public function test_a_user_can_see_when_the_thread_was_created()
    {
        $this->get(route('threads.index'))
            ->assertSee($this->thread->created_at);
    }

    public function test_a_user_can_see_who_created_the_thread()
    {
        $this->get(route('threads.index'))
            ->assertSee($this->thread->owner->name);
    }
}
