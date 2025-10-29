@extends('layouts.app')

@section('content')


<!-- Latest Articles -->
<section id="articles-section" style="padding:2rem 0;">
  @php
      try {
          $articles = isset($articles) ? $articles : \App\Models\Article::query()->latest()->paginate(12);
      } catch (\Throwable $e) {
          $articles = collect();
      }
      // Helper to pick an image field if present
      $pickImage = function($article) {
          return $article->featured_image_url
              ?? $article->image_url
              ?? $article->cover_image
              ?? $article->thumbnail
              ?? $article->featured_image
              ?? null;
      };
  @endphp

  <div class="container">
    <div class="text-center mb-3" style="text-align:center !important; color: #64b5f6; font-size: 22px">
      <h2 class="m-0">Latest Articles</h2>
    </div>

    @if($articles->count())
      <div class="cards-grid">
        @foreach($articles as $post)
          @php
            $image = $pickImage($post);
            $title = $post->title ?? 'Untitled';
            $excerpt = method_exists($post, 'getExcerptAttribute')
              ? $post->excerpt
              : (\Illuminate\Support\Str::limit(strip_tags($post->content ?? $post->body ?? ''), 140));
            $readMinutes = max(1, ceil(str_word_count(strip_tags($post->content ?? $post->body ?? ''))/200));
            $category = $post->category_name ?? $post->category ?? null;
            $dateText = !empty($post->created_at) ? $post->created_at->format('M j, Y') : null;
            $tags = is_array($post->tags ?? null) ? $post->tags : [];
            $showUrl = route('blog.show', $post);
          @endphp

          <div class="card">
            <div class="card-image-container">
              @if($image)
                <img src="{{ $image }}" alt="{{ $title }}" class="card-image">
              @else
                <img src="https://via.placeholder.com/1000x600.png?text=Article" alt="{{ $title }}" class="card-image">
              @endif
              @if($category)
                <div class="card-category">{{ $category }}</div>
              @endif
              <h3 class="card-title">{{ $title }}</h3>
            </div>
            <div class="card-content">
              <div class="card-meta">
                <span><i class="fa-regular fa-clock"></i> {{ $readMinutes }} min read</span>
                @if($dateText)
                  <span><i class="fa-regular fa-calendar"></i> {{ $dateText }}</span>
                @endif
              </div>

              @if(!empty($tags))
                <div class="tags mb-2">
                  @foreach($tags as $t)
                    <a href="{{ route('blog.index', ['tag' => $t]) }}" class="tag">{{ $t }}</a>
                  @endforeach
                </div>
              @endif

              <p class="card-body">{{ $excerpt }}</p>

              <div class="d-flex align-items-center justify-content-between mb-2" style="gap:.75rem;flex-wrap:wrap;">
                <div style="display:flex;gap:1rem;color:#8892b0;">
                  <span title="Likes"><i class="fa-regular fa-thumbs-up"></i> {{ $post->likes_count ?? 0 }}</span>
                  <span title="Bookmarks"><i class="fa-regular fa-bookmark"></i> {{ $post->bookmarks_count ?? 0 }}</span>
                  <span title="Shares"><i class="fa-solid fa-share"></i> {{ $post->shares_count ?? 0 }}</span>
                </div>
                <div style="display:flex;gap:.5rem;">
                  @auth
                    <form method="POST" action="{{ route('blog.like', $post) }}">@csrf<button class="btn btn-sm btn-outline-primary" type="submit" title="Like"><i class="fa-regular fa-thumbs-up"></i></button></form>
                    <form method="POST" action="{{ route('blog.bookmark', $post) }}">@csrf<button class="btn btn-sm btn-outline-secondary" type="submit" title="Save"><i class="fa-regular fa-bookmark"></i></button></form>
                    <form method="POST" action="{{ route('blog.share', $post) }}">@csrf<button class="btn btn-sm btn-outline-info" type="submit" title="Share"><i class="fa-solid fa-share"></i></button></form>
                  @else
                    <a class="btn btn-sm btn-outline-primary" href="{{ route('login') }}" title="Like"><i class="fa-regular fa-thumbs-up"></i></a>
                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}" title="Save"><i class="fa-regular fa-bookmark"></i></a>
                    <a class="btn btn-sm btn-outline-info" href="{{ route('login') }}" title="Share"><i class="fa-solid fa-share"></i></a>
                  @endauth
                </div>
              </div>

              <a class="card-button" href="{{ $showUrl }}">
                Read Article <i class="fas fa-arrow-right"></i>
              </a>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-muted">No articles published yet.</div>
    @endif
    @if(method_exists($articles, 'links'))
      <div class="mt-4" style="display:flex;justify-content:center">
        {{ $articles->links() }}
      </div>
    @endif

  </div>
</section>

<style>
  /* Articles overlay card styles (scoped) */
  #articles-section .cards-grid{display:grid;grid-template-columns:repeat(auto-fill, minmax(320px,1fr));gap:2rem}
  #articles-section .card{background-color:#112240;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(2,12,27,0.7);transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275);height:100%;display:flex;flex-direction:column;padding:0}
  #articles-section .card:hover{transform:translateY(-8px);box-shadow:0 20px 40px rgba(2,12,27,0.9)}
  #articles-section .card-image-container{position:relative;overflow:hidden;margin:0;padding:0;line-height:0;border-top-left-radius:12px;border-top-right-radius:12px}
  #articles-section .card-image{width:100%;height:200px;object-fit:cover;display:block;margin:0;transition:transform .5s ease}
  #articles-section .card:hover .card-image{transform:scale(1.05)}
  #articles-section .card-title{position:absolute;bottom:0;left:0;right:0;background:linear-gradient(transparent, rgba(10,25,47,0.95));padding:1.5rem 1.5rem .75rem;margin:0;font-size:1.3rem;font-weight:600;line-height:1.4;text-shadow:0 2px 4px rgba(0,0,0,0.5)}
  #articles-section .card-content{padding:1.5rem;flex-grow:1;display:flex;flex-direction:column}
  #articles-section .card-body{color:#8892b0;line-height:1.6;margin-bottom:1.5rem;flex-grow:1;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
  #articles-section .card-meta{display:flex;justify-content:space-between;color:#8892b0;font-size:.85rem;margin-bottom:1rem;border-bottom:1px solid rgba(136,146,176,0.2);padding-bottom:.75rem}
  #articles-section .card-button{display:inline-flex;align-items:center;justify-content:center;background-color:transparent;color:#3b82f6;padding:.6rem 1.2rem;border:1px solid #3b82f6;border-radius:6px;text-decoration:none;font-size:.9rem;font-weight:500;transition:all .3s ease;cursor:pointer;gap:.5rem}
  #articles-section .card-button:hover{background-color:rgba(59,130,246,.1);transform:translateY(-2px);box-shadow:0 4px 12px rgba(59,130,246,.2)}
  #articles-section .card-category{position:absolute;top:1rem;left:1rem;background:rgba(100,255,218,0.9);color:#0a192f;padding:.3rem .8rem;border-radius:20px;font-size:.75rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px}

  /* Styled tags to match article page */
  #articles-section .tags{display:flex;flex-wrap:wrap;gap:.4rem}
  #articles-section .tag{display:inline-block;background:rgba(100,255,218,0.1);color:#64ffda;padding:.25rem .6rem;border-radius:999px;font-size:.8rem;border:1px solid rgba(100,255,218,0.2);text-decoration:none}
  #articles-section .tag:hover{background:rgba(100,255,218,0.15);}

  @media (max-width:768px){
    #articles-section .cards-grid{grid-template-columns:repeat(auto-fill, minmax(280px,1fr));gap:1.5rem}
    #articles-section .card-title{font-size:1.2rem;padding:1.25rem 1.25rem .5rem}
  }

  /* Light Mode Articles */
  [data-theme="light"] #articles-section .card {
      background-color: #FFFFFF;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(46, 120, 197, 0.15);
  }
  [data-theme="light"] #articles-section .card:hover {
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
  }
  [data-theme="light"] #articles-section .card-title {
      background: linear-gradient(transparent, rgba(230, 242, 255, 0.95));
      color: var(--diamond-white);
  }
  [data-theme="light"] #articles-section .card-body,
  [data-theme="light"] #articles-section .card-meta {
      color: var(--cool-gray);
  }
  [data-theme="light"] #articles-section .card-button {
      color: var(--primary-blue);
      border-color: var(--primary-blue);
  }
  [data-theme="light"] #articles-section .card-button:hover {
      background-color: rgba(46, 120, 197, 0.1);
      box-shadow: 0 4px 12px rgba(46, 120, 197, 0.2);
  }
  [data-theme="light"] #articles-section .card-category {
      background: rgba(46, 120, 197, 0.9);
      color: #FFFFFF;
  }
  [data-theme="light"] #articles-section .tag {
      background: rgba(46, 120, 197, 0.1);
      color: var(--primary-blue);
      border-color: rgba(46, 120, 197, 0.2);
  }
  [data-theme="light"] #articles-section .tag:hover {
      background: rgba(46, 120, 197, 0.15);
  }
</style>

