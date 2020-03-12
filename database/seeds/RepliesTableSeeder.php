<?php

use App\Reply;
use App\Thread;
use Illuminate\Database\Seeder;

class RepliesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Thread::all()->each(fn(Thread $thread) => factory(Reply::class)->create(['thread_id' => $thread->id]));
    }
}
