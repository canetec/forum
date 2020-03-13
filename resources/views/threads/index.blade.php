@extends('layouts.app')
@section('title', 'Threads')

@section('content')
    <h1>Forum threads</h1>
    @foreach($threads as $thread)
        <article>
            <h2><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h2>
            <small>By <a href="#">{{ $thread->owner->name }}</a>,
                <time title="{{ $thread->created_at }}">{{ $thread->created_at->diffForHumans() }}</time>
            </small>
            <br>
            <p>{{ $thread->body }}</p>
        </article>
        <hr>
    @endforeach
@endsection
