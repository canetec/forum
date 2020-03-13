@extends('layouts.app')
@section('title', 'Threads')

@section('content')
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">{{ $thread->title }}</h1>
        </div>
        <div class="card-body">
            <p>{{ $thread->body }}</p>
        </div>
    </div>
    <hr>
    @foreach($thread->replies as $reply)
        <div class="card">
            <div class="card-header">
                <h2 class="card-title">
                    <a href="#">
                        {{ $reply->owner->name }}
                    </a> said
                    <time title="{{ $reply->created_at }}">{{ $reply->created_at->diffForHumans() }}:</time>
                </h2>
            </div>
            <div class="card-body">
                <p>{{ $reply->body }}</p>
            </div>
        </div>
        @if( ! $loop->last)
            <hr>
        @endif
    @endforeach
@endsection
