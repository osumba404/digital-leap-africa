<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\Reply;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ForumController extends Controller
{
    public function index(): View
    {
        $threads = Thread::withCount('replies')
            ->with(['user', 'latestReply.user'])
            ->latest()
            ->paginate(20);
        return view('pages.forum.index', compact('threads'));
    }

    public function show($id): View
    {
        $thread = Thread::with(['replies.user', 'user'])->findOrFail($id);
        return view('pages.forum.show', compact('thread'));
    }

    public function create(): View
    {
        return view('pages.forum.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string', 'max:5000'],
        ]);

        Thread::create([
            'user_id' => $request->user()->id,
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        return redirect()->route('forum.index')->with('success', 'Discussion started successfully!');
    }

    public function storeReply(Request $request, Thread $thread)
    {
        $data = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
        ]);

        $thread->replies()->create([
            'user_id' => $request->user()->id,
            'content' => $data['content'],
        ]);

        // Notify thread author about new reply (if not replying to own thread)
        if ($thread->user_id !== $request->user()->id) {
            Notification::createNotification(
                $thread->user_id,
                'forum_reply',
                'New Reply on Your Thread',
                "{$request->user()->name} replied to your thread: {$thread->title}",
                route('forum.show', $thread->id)
            );
        }

        return redirect()->route('forum.show', $thread->id)->with('success', 'Reply posted successfully!');
    }
}