<?php
// app/Http/Controllers/Admin/AdminArticleController.php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class AdminArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        $article = new Article();
        return view('admin.articles.create', compact('article'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'published_at' => ['nullable', 'date'],
            // Accept file upload for featured_image
            'featured_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:4096'],
        ]);

        $data['slug'] = $this->generateUniqueSlug($data['title']);
        $data['author_id'] = $request->user()->id;

        // Handle image upload (preferred)
        if ($request->hasFile('featured_image')) {
            $file = $request->file('featured_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/articles'), $filename);
            $data['featured_image'] = '/storage/articles/' . $filename;
        }

        $article = Article::create($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function edit(Article $article)
    {
        return view('admin.articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'status' => ['required', Rule::in(['draft', 'published', 'archived'])],
            'published_at' => ['nullable', 'date'],
            'featured_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:4096'],
        ]);

        // Update slug if title changed
        if ($data['title'] !== $article->title) {
            $data['slug'] = $this->generateUniqueSlug($data['title'], $article->id);
        }

        // Handle image replacement
        if ($request->hasFile('featured_image')) {
            if ($article->featured_image) {
                $oldFile = public_path($article->featured_image);
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }
            $file = $request->file('featured_image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('storage/articles'), $filename);
            $data['featured_image'] = '/storage/articles/' . $filename;
        }

        $article->update($data);

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        if ($article->featured_image) {
            $oldFile = public_path($article->featured_image);
            if (file_exists($oldFile)) {
                unlink($oldFile);
            }
        }

        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article deleted successfully.');
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
            $slug = $base.'-'.$i;
            $i++;
        }

        return $slug;
    }
}