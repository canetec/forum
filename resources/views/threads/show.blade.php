<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $thread->title }}</title>
</head>
<body>
<h1>{{ $thread->title }}</h1>
<p>{{ $thread->body }}</p>
<hr>
@foreach($thread->replies as $reply)
    <h2>{{ $reply->owner->name }} said {{ $reply->created_at->diffForHumans() }}:</h2>
    <p>{{ $reply->body }}</p>
    @if( ! $loop->last)
        <hr>
    @endif
@endforeach
</body>
</html>
