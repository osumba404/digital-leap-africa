<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use App\Models\Reply;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $threads = Thread::with(['user', 'replies'])
            ->withCount('replies')
            ->latest()
            ->paginate(15);

        return view('admin.forum.index', compact('threads'));
    }

    public function show(Thread $thread)
    {
        $thread->load(['user', 'replies.user']);
        
        return view('admin.forum.show', compact('thread'));
    }

    public function destroy(Thread $thread)
    {
        $thread->delete();
        
        return redirect()->route('admin.forum.index')
            ->with('success', 'Thread deleted successfully.');
    }

    public function destroyReply(Reply $reply)
    {
        $reply->delete();
        
        return back()->with('success', 'Reply deleted successfully.');
    }
}