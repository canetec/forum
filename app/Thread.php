<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    public function path()
    {
        return route('threads.show', [
            $this->id,
        ]);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function addReply(array $reply): Reply
    {
        return $this->replies()->create([
            'user_id' => $reply['user_id'],
            'body' => $reply['body'],
        ]);
    }
}
