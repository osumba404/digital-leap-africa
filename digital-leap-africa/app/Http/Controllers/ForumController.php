<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Thread;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $threads = Thread::withCount('replies')->with('latestReply','user')->latest()->paginate(20);
        return view('admin.forum.index', compact('threads'));
    }

    public function create()
    {
        return view('admin.forum.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'body' => ['required','string'],
        ]);

        Thread::create([
            'user_id' => Auth::id(),
            'title' => $data['title'],
            'content' => $data['body'], // maps to 'content' column
        ]);

        return redirect()->route('admin.forum.index')->with('success', 'Thread created.');
    }

    public function edit(Thread $forum) // route-model bind param 'forum' => Thread
    {
        $thread = $forum;
        return view('admin.forum.edit', compact('thread'));
    }

    public function update(Request $request, Thread $forum)
    {
        $data = $request->validate([
            'title' => ['required','string','max:255'],
            'body' => ['required','string'],
        ]);

        $forum->update([
            'title' => $data['title'],
            'content' => $data['body'],
        ]);

        return redirect()->route('admin.forum.index')->with('success','Thread updated.');
    }

    public function destroy(Thread $forum)
    {
        $forum->delete();
        return back()->with('success','Thread deleted.');
    }
}