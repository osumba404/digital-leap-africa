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
        $tag = $request->query('tag');

        $articles = Article::query()
            ->whereNotNull('published_at')
            ->when($tag, fn($q) => $q->withTag($tag))
            ->orderByDesc('published_at')
            ->paginate(9)
            ->appends(['tag' => $tag]);

        return view('articles.index', compact('articles', 'tag'));
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

    public function like(Request $request, Article $article): RedirectResponse
    {
        $article->increment('likes_count');
        return back();
    }

    public function bookmark(Request $request, Article $article): RedirectResponse
    {
        $article->increment('bookmarks_count');
        return back();
    }

    public function share(Request $request, Article $article): RedirectResponse
    {
        $article->increment('shares_count');
        return back();
    }
}
