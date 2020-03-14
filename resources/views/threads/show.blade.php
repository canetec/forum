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
    <hr>
    @auth
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Add your reply</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('replies.store', $thread->id) }}" method="POST" id="addReply">
                    @csrf
                    <textarea name="body" id="body" cols="30" rows="10" class="form-control" required>{{ old('body') }}</textarea>
                </form>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" form="addReply">Add reply</button>
            </div>
        </div>
    @endauth
@endsection
