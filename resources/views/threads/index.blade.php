@extends('layouts.app')
@section('title', 'Threads')

@section('content')
    <h1>Forum threads</h1>
    @foreach($threads as $thread)
        <article>
            <h2><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h2>
            <p>{{ $thread->body }}</p>
        </article>
        <hr>
    @endforeach
@endsection
