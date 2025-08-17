<?php

namespace App\Http\Controllers;

use App\Models\ForumThread;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $threads = ForumThread::with('user')->latest()->get();
        return view('forum.index', compact('threads'));
    }

    public function show($id)
    {
        $thread = ForumThread::with(['user', 'replies.user'])->findOrFail($id);
        return view('forum.show', compact('thread'));
    }
}
