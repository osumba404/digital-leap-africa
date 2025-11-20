<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
// use App\Services\ImageOptimizationService;

class ArticlesController extends Controller
{
    public function index(Request $request): View
    {
        $tag = $request->query('tag');
        $search = $request->query('search');

        // Cache key for articles list
        $cacheKey = 'articles_' . md5($tag . $search . $request->get('page', 1));
        
        $articles = Cache::remember($cacheKey, 300, function() use ($tag, $search) {
            return Article::query()
                ->whereNotNull('published_at')
                ->when($tag, fn($q) => $q->withTag($tag))
                ->when($search, function($q) use ($search) {
                    $q->where(function($query) use ($search) {
                        $query->where('title', 'LIKE', "%{$search}%")
                              ->orWhere('content', 'LIKE', "%{$search}%")
                              ->orWhere('excerpt', 'LIKE', "%{$search}%");
                    });
                })
                ->orderByDesc('published_at')
                ->paginate(9)
                ->appends(['tag' => $tag, 'search' => $search]);
        });

        // Optimize images for each article
        // foreach ($articles as $article) {
        //     $article->optimized_image = $this->getOptimizedImage($article);
        // }

        return view('articles.index', compact('articles', 'tag', 'search'));
    }

    public function show(Article $article): View
    {
        // Cache article data
        $cacheKey = 'article_' . $article->id . '_' . $article->updated_at->timestamp;
        
        $articleData = Cache::remember($cacheKey, 3600, function() use ($article) {
            $article->load(['author', 'comments.user']);
            return $article;
        });

        $tags = is_array($article->tags ?? null) ? $article->tags : [];

        // Cache related articles
        $relatedCacheKey = 'related_articles_' . $article->id . '_' . md5(implode(',', $tags));
        
        $related = Cache::remember($relatedCacheKey, 1800, function() use ($article, $tags) {
            $relatedQuery = Article::query()
                ->where('id', '!=', $article->id)
                ->whereNotNull('published_at');

            if (!empty($tags)) {
                $relatedQuery->where(function ($q) use ($tags) {
                    foreach ($tags as $t) {
                        $q->orWhereJsonContains('tags', $t);
                    }
                });
            }

            return $relatedQuery
                ->latest('published_at')
                ->take(5)
                ->get();
        });

        // Optimize images
        // $article->optimized_image = $this->getOptimizedImage($article);
        // foreach ($related as $relatedArticle) {
        //     $relatedArticle->optimized_image = $this->getOptimizedImage($relatedArticle);
        // }

        return view('articles.show', compact('article', 'related'));
    }

    public function storeComment(Request $request, Article $article)
    {
        $data = $request->validate([
            'content' => ['required', 'string', 'max:2000'],
        ]);

        $comment = Comment::create([
            'article_id' => $article->id,
            'user_id' => $request->user()->id,
            'content' => $data['content'],
            'approved' => true,
        ]);

        if ($request->expectsJson()) {
            $user = $request->user();
            $initials = collect(explode(' ', $user->name))->map(fn($p) => strtoupper(substr($p,0,1)))->take(2)->implode('');
            
            return response()->json([
                'success' => true,
                'comment' => [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'user_name' => $user->name,
                    'user_initials' => $initials ?: 'U',
                    'created_at' => $comment->created_at->diffForHumans()
                ],
                'comments_count' => $article->comments()->count()
            ]);
        }

        return back()->with('status', 'Comment posted successfully.');
    }

    public function like(Request $request, Article $article)
    {
        $user = $request->user();
        
        $interaction = \DB::table('article_user_interactions')
            ->where('user_id', $user->id)
            ->where('article_id', $article->id)
            ->first();
            
        if ($interaction) {
            if ($interaction->liked) {
                // Unlike
                \DB::table('article_user_interactions')
                    ->where('user_id', $user->id)
                    ->where('article_id', $article->id)
                    ->update(['liked' => false]);
                $article->decrement('likes_count');
                $liked = false;
            } else {
                // Like
                \DB::table('article_user_interactions')
                    ->where('user_id', $user->id)
                    ->where('article_id', $article->id)
                    ->update(['liked' => true]);
                $article->increment('likes_count');
                $liked = true;
            }
        } else {
            // First interaction
            \DB::table('article_user_interactions')->insert([
                'user_id' => $user->id,
                'article_id' => $article->id,
                'liked' => true,
                'bookmarked' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $article->increment('likes_count');
            $liked = true;
        }
        
        if ($request->expectsJson()) {
            return response()->json([
                'liked' => $liked,
                'likes_count' => $article->fresh()->likes_count
            ]);
        }
        
        return back();
    }

    public function bookmark(Request $request, Article $article)
    {
        $user = $request->user();
        
        $interaction = \DB::table('article_user_interactions')
            ->where('user_id', $user->id)
            ->where('article_id', $article->id)
            ->first();
            
        if ($interaction) {
            if ($interaction->bookmarked) {
                // Remove bookmark
                \DB::table('article_user_interactions')
                    ->where('user_id', $user->id)
                    ->where('article_id', $article->id)
                    ->update(['bookmarked' => false]);
                $article->decrement('bookmarks_count');
                $bookmarked = false;
            } else {
                // Add bookmark
                \DB::table('article_user_interactions')
                    ->where('user_id', $user->id)
                    ->where('article_id', $article->id)
                    ->update(['bookmarked' => true]);
                $article->increment('bookmarks_count');
                $bookmarked = true;
            }
        } else {
            // First interaction
            \DB::table('article_user_interactions')->insert([
                'user_id' => $user->id,
                'article_id' => $article->id,
                'liked' => false,
                'bookmarked' => true,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $article->increment('bookmarks_count');
            $bookmarked = true;
        }
        
        if ($request->expectsJson()) {
            return response()->json([
                'bookmarked' => $bookmarked,
                'bookmarks_count' => $article->fresh()->bookmarks_count
            ]);
        }
        
        return back();
    }

    public function share(Request $request, Article $article)
    {
        $article->increment('shares_count');
        
        if ($request->expectsJson()) {
            return response()->json([
                'shares_count' => $article->fresh()->shares_count
            ]);
        }
        
        return back();
    }

    /**
     * Get optimized image URL for an article
     */
    // private function getOptimizedImage($article)
    // {
    //     $imageUrl = $article->featured_image_url 
    //         ?? $article->image_url 
    //         ?? $article->thumbnail 
    //         ?? $article->featured_image;

    //     if (!$imageUrl) {
    //         return null;
    //     }

    //     return ImageOptimizationService::getOptimizedImageUrl($imageUrl, 800, 400);
    // }
}
