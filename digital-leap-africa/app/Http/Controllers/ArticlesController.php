<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticlesController extends Controller
{
    public function index(Request $request): View
    {
        $articles = Article::query()
            ->whereNotNull('published_at')
            ->orderByDesc('published_at')
            ->paginate(9);

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article): View
    {
        $article->load(['author', 'comments.user']);

        $related = Article::where('id', '!=', $article->id)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('articles.show', compact('article', 'related'));
    }

    public function storeComment(Request $request, Article $article): RedirectResponse
    {
        $data = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
        ]);

        Comment::create([
            'article_id' => $article->id,
            'user_id' => $request->user()->id,
            'content' => $data['content'],
            'approved' => true,
        ]);

        return back()->with('status', 'Comment posted successfully.');
    }
}
