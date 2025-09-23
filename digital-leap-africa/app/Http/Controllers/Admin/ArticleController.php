<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $articles = Article::query()
            ->latest('created_at')
            ->paginate(15);
        return view('admin.articles.index', compact('articles'));
    }

    public function create(): View
    {
        $article = new Article();
        return view('admin.articles.create', compact('article'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'cover_image' => ['nullable', 'string', 'max:2048'],
            'published' => ['nullable', 'boolean'],
        ]);

        $article = new Article();
        $article->title = $data['title'];
        $article->excerpt = $data['excerpt'] ?? null;
        $article->content = $data['content'];
        $article->cover_image = $data['cover_image'] ?? null;
        $article->user_id = $request->user()->id;
        $article->published_at = ($request->boolean('published')) ? now() : null;
        $article->save();

        return redirect()->route('admin.articles.index')->with('status', 'Article created');
    }

    public function edit(Article $article): View
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'cover_image' => ['nullable', 'string', 'max:2048'],
            'published' => ['nullable', 'boolean'],
        ]);

        $article->title = $data['title'];
        $article->excerpt = $data['excerpt'] ?? null;
        $article->content = $data['content'];
        $article->cover_image = $data['cover_image'] ?? null;
        $article->published_at = ($request->boolean('published')) ? ($article->published_at ?? now()) : null;
        $article->save();

        return redirect()->route('admin.articles.index')->with('status', 'Article updated');
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();
        return redirect()->route('admin.articles.index')->with('status', 'Article deleted');
    }
}
