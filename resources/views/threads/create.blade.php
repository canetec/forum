@extends('layouts.app')
@section('title', 'Start a new thread')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">Start a new thread</h1>
    </div>
    <div class="card-body">
        <form action="{{ route('threads.store') }}" method="POST" id="createThread">
            @csrf
            <div class="form-group">
                <input type="text" name="title" id="title" class="form-control" placeholder="Title" value="{{ old('title') }}" required>
            </div>
            <div class="form-group">
                <textarea name="body" id="body" cols="30" rows="10" class="form-control" placeholder="Your message" required>{{ old('body') }}</textarea>
            </div>
        </form>
    </div>
    <div class="card-footer">
        <button type="submit" form="createThread" class="btn btn-success">Start thread</button>
    </div>
</div>
@endsection
