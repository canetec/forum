<?php

namespace App\Http\Controllers;

use App\Channel;
use App\Thread;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ThreadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')
            ->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        if (request()->has('by')) {
            $threads = Thread::whereUserId(User::where('name', request()->get('by'))->first()->id)->get();
        } elseif (request()->has('popular')) {
            $threads = Thread::withCount('replies')
                ->orderBy('replies_count', 'desc')
                ->get();
        } else {
            $threads = Thread::latest()->get();
        }

        if (request()->expectsJson()) {
            return $threads->toArray();
        }

        return view('threads.index', compact('threads'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $channels = Channel::all();

        return view('threads.create', compact('channels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'body' => 'required',
            'channel_id' => 'required|exists:channels,id',
        ]);

        $thread = $request->user()->threads()->create([
            'title' => $request->title,
            'channel_id' => $request->channel_id,
            'body' => $request->body,
        ]);

        return redirect($thread->path());
    }

    /**
     * Display the specified resource.
     *
     * @param Channel $channel
     * @param Thread $thread
     * @return Response
     */
    public function show(Channel $channel, Thread $thread)
    {
        return view('threads.show', compact('thread'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Thread $thread
     * @return Response
     */
    public function edit(Thread $thread)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Thread $thread
     * @return Response
     */
    public function update(Request $request, Thread $thread)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Thread $thread
     * @return Response
     */
    public function destroy(Thread $thread)
    {
        //
    }
}
