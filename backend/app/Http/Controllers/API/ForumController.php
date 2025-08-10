<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\ForumPost;

class ForumController extends Controller
{
    public function index()
    {
        $posts = ForumPost::whereNull('parent_id') // Only get top-level posts
            ->with('user:id,name')       // Get the user's id and name
            ->withCount('replies')      // Get the number of replies
            ->latest()
            ->get();
        return response()->json($posts);
    }
}