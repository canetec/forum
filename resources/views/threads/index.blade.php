<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Threads</title>
</head>
<body>
<h1>Forum threads</h1>
@foreach($threads as $thread)
    <article>
        <h2><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h2>
        <p>{{ $thread->body }}</p>
    </article>
    <hr>
@endforeach
</body>
</html>
