<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
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
        'title' => ['required','string','max:255'],
        'excerpt' => ['nullable','string','max:500'],
        'content' => ['required','string'],
        'featured_image' => ['nullable','image','image','max:1024'],
        'published' => ['nullable','boolean'],
        'status' => ['nullable', Rule::in(['draft','published','archived'])],
        'published_at' => ['nullable','date'],
        'tags' => ['sometimes','array'],
        'tags.*' => ['string','max:50'],
    ]);

    // Normalize tags: trim, drop empties, unique
    $tags = collect($request->input('tags', []))
        ->filter(fn($t) => is_string($t))
        ->map(fn($t) => trim($t))
        ->filter()
        ->unique()
        ->values()
        ->all();

    $payload = [
        'title' => $data['title'],
        'excerpt' => $data['excerpt'] ?? null,
        'content' => $data['content'],
        'slug' => $this->generateUniqueSlug($data['title']),
        'author_id' => $request->user()->id,
        'tags' => $tags,
    ];

    if ($request->boolean('published')) {
        $payload['status'] = 'published';
        $payload['published_at'] = $data['published_at'] ?? now();
    } else {
        $payload['status'] = $data['status'] ?? 'draft';
        $payload['published_at'] = null;
    }

    if ($request->hasFile('featured_image')) {
        $payload['featured_image'] = $request->file('featured_image')->store('public/articles');
    }

    Article::create($payload);

    return redirect()->route('admin.articles.index')->with('status', 'Article created');
}




    public function edit(Article $article): View
    {
        return view('admin.articles.edit', compact('article'));
    }




public function update(Request $request, Article $article): RedirectResponse
{
    $data = $request->validate([
        'title' => ['required','string','max:255'],
        'excerpt' => ['nullable','string','max:500'],
        'content' => ['required','string'],
        'featured_image' => ['nullable','image','image','max:1024'],
        'published' => ['nullable','boolean'],
        'status' => ['nullable', Rule::in(['draft','published','archived'])],
        'published_at' => ['nullable','date'],
        'tags' => ['sometimes','array'],
        'tags.*' => ['string','max:50'],
    ]);

    // Normalize tags
    $tags = collect($request->input('tags', []))
        ->filter(fn($t) => is_string($t))
        ->map(fn($t) => trim($t))
        ->filter()
        ->unique()
        ->values()
        ->all();

    $payload = [
        'title' => $data['title'],
        'excerpt' => $data['excerpt'] ?? null,
        'content' => $data['content'],
        'tags' => $tags,
    ];

    if ($article->title !== $data['title']) {
        $payload['slug'] = $this->generateUniqueSlug($data['title'], $article->id);
    }

    if ($request->boolean('published')) {
        $payload['status'] = 'published';
        $payload['published_at'] = $data['published_at'] ?? ($article->published_at ?: now());
    } else {
        $payload['status'] = $data['status'] ?? 'draft';
        $payload['published_at'] = null;
    }

    if ($request->hasFile('featured_image')) {
        if ($article->featured_image) {
            Storage::delete($article->featured_image);
        }
        $payload['featured_image'] = $request->file('featured_image')->store('public/articles');
    }

    $article->update($payload);

    return redirect()->route('admin.articles.index')->with('status', 'Article updated');
}

    public function destroy(Article $article): RedirectResponse
    {
        if ($article->featured_image) {
            Storage::delete($article->featured_image);
        }
        $article->delete();
        return redirect()->route('admin.articles.index')->with('status', 'Article deleted');
    }


   private function generateUniqueSlug(string $title, ?int $ignoreId = null): string
{
    $base = Str::slug($title);
    $slug = $base;
    $i = 2;

    while (
        Article::where('slug', $slug)
            ->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))
            ->exists()
    ) {
        $slug = $base . '-' . $i;
        $i++;
    }
    return $slug;
}
}
