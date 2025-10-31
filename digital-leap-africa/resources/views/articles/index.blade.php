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

              <div class="article-actions" style="display:flex;align-items:center;justify-content:space-between;gap:.75rem;flex-wrap:wrap;margin-bottom:1rem;">
                <div class="action-stats" style="display:flex;gap:1.5rem;">
                  @auth
                    <button class="action-btn" onclick="likeArticle({{ $post->id }})" title="Like">
                      <i class="fa-regular fa-heart"></i>
                      <span class="action-count">{{ $post->likes_count ?? 0 }}</span>
                    </button>
                    <button class="action-btn" onclick="bookmarkArticle({{ $post->id }})" title="Bookmark">
                      <i class="fa-regular fa-bookmark"></i>
                      <span class="action-count">{{ $post->bookmarks_count ?? 0 }}</span>
                    </button>
                    <button class="action-btn" onclick="openShareModal('{{ $showUrl }}', '{{ addslashes($title) }}', {{ $post->id }})" title="Share">
                      <i class="fa-solid fa-share-nodes"></i>
                      <span class="action-count">{{ $post->shares_count ?? 0 }}</span>
                    </button>
                  @else
                    <a href="{{ route('login') }}" class="action-btn" title="Like">
                      <i class="fa-regular fa-heart"></i>
                      <span class="action-count">{{ $post->likes_count ?? 0 }}</span>
                    </a>
                    <a href="{{ route('login') }}" class="action-btn" title="Bookmark">
                      <i class="fa-regular fa-bookmark"></i>
                      <span class="action-count">{{ $post->bookmarks_count ?? 0 }}</span>
                    </a>
                    <a href="{{ route('login') }}" class="action-btn" title="Share">
                      <i class="fa-solid fa-share-nodes"></i>
                      <span class="action-count">{{ $post->shares_count ?? 0 }}</span>
                    </a>
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

  /* Styled tags - smaller with blue theme */
  #articles-section .tags{display:flex;flex-wrap:wrap;gap:.35rem;margin-bottom:.75rem}
  #articles-section .tag{display:inline-block;background:rgba(59,130,246,0.1);color:#3b82f6;padding:.2rem .5rem;border-radius:999px;font-size:.7rem;border:1px solid rgba(59,130,246,0.2);text-decoration:none;font-weight:500}
  #articles-section .tag:hover{background:rgba(59,130,246,0.15);border-color:rgba(59,130,246,0.3)}
  
  /* Action buttons styling */
  .action-btn{background:none;border:none;color:#8892b0;cursor:pointer;display:inline-flex;align-items:center;gap:.4rem;font-size:.9rem;transition:all .2s ease;padding:.25rem .5rem;border-radius:6px}
  .action-btn:hover{color:#64b5f6;background:rgba(100,181,246,0.1)}
  .action-btn i{font-size:1.1rem}
  .action-count{font-weight:500}

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
  [data-theme="light"] .action-btn {
      color: #4A5568;
  }
  [data-theme="light"] .action-btn:hover {
      color: #2E78C5;
      background: rgba(46, 120, 197, 0.1);
  }
</style>

<!-- Share Modal -->
<div id="shareModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.8);z-index:9999;align-items:center;justify-content:center;">
  <div style="background:var(--charcoal);padding:2rem;border-radius:12px;max-width:500px;width:90%;position:relative;">
    <button onclick="closeShareModal()" style="position:absolute;top:1rem;right:1rem;background:none;border:none;color:var(--cool-gray);font-size:1.5rem;cursor:pointer;transition:color .2s;">
      <i class="fas fa-times"></i>
    </button>
    
    <h3 style="margin:0 0 1.5rem 0;color:var(--diamond-white);font-size:1.5rem;">
      <i class="fas fa-share-nodes" style="color:#3b82f6;margin-right:.5rem;"></i>
      Share Article
    </h3>
    
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(100px,1fr));gap:1rem;margin-bottom:1.5rem;">
      <a id="shareWhatsapp" target="_blank" class="share-btn" style="background:rgba(37,211,102,0.1);border:1px solid rgba(37,211,102,0.3);color:#25d366;">
        <i class="fab fa-whatsapp" style="font-size:1.5rem;"></i>
        <span style="font-size:.8rem;margin-top:.25rem;">WhatsApp</span>
      </a>
      <a id="shareTwitter" target="_blank" class="share-btn" style="background:rgba(29,161,242,0.1);border:1px solid rgba(29,161,242,0.3);color:#1da1f2;">
        <i class="fab fa-twitter" style="font-size:1.5rem;"></i>
        <span style="font-size:.8rem;margin-top:.25rem;">Twitter</span>
      </a>
      <a id="shareFacebook" target="_blank" class="share-btn" style="background:rgba(24,119,242,0.1);border:1px solid rgba(24,119,242,0.3);color:#1877f2;">
        <i class="fab fa-facebook" style="font-size:1.5rem;"></i>
        <span style="font-size:.8rem;margin-top:.25rem;">Facebook</span>
      </a>
      <a id="shareLinkedin" target="_blank" class="share-btn" style="background:rgba(0,119,181,0.1);border:1px solid rgba(0,119,181,0.3);color:#0077b5;">
        <i class="fab fa-linkedin" style="font-size:1.5rem;"></i>
        <span style="font-size:.8rem;margin-top:.25rem;">LinkedIn</span>
      </a>
      <a id="shareEmail" target="_blank" class="share-btn" style="background:rgba(234,67,53,0.1);border:1px solid rgba(234,67,53,0.3);color:#ea4335;">
        <i class="fas fa-envelope" style="font-size:1.5rem;"></i>
        <span style="font-size:.8rem;margin-top:.25rem;">Email</span>
      </a>
    </div>
    
    <div style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:1rem;">
      <label style="display:block;color:var(--cool-gray);font-size:.85rem;margin-bottom:.5rem;">Article Link:</label>
      <div style="display:flex;gap:.5rem;">
        <input id="shareLink" type="text" readonly style="flex:1;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:6px;padding:.5rem .75rem;color:var(--diamond-white);font-size:.9rem;">
        <button onclick="copyShareLink()" class="copy-link-btn" style="background:#3b82f6;border:none;color:white;padding:.5rem 1rem;border-radius:6px;cursor:pointer;font-weight:600;transition:all .2s;white-space:nowrap;">
          <i class="fas fa-copy"></i> Copy
        </button>
      </div>
      <div id="copyFeedback" style="display:none;color:#22c55e;font-size:.85rem;margin-top:.5rem;">
        <i class="fas fa-check-circle"></i> Link copied to clipboard!
      </div>
    </div>
  </div>
</div>

<style>
.share-btn{display:flex;flex-direction:column;align-items:center;justify-content:center;padding:1rem;border-radius:8px;text-decoration:none;transition:all .2s;cursor:pointer}
.share-btn:hover{transform:translateY(-2px);opacity:.9}
.copy-link-btn:hover{background:#2563eb;transform:scale(1.02)}
[data-theme="light"] #shareModal > div{background:#FFFFFF;box-shadow:0 20px 60px rgba(0,0,0,0.3)}
[data-theme="light"] #shareModal input{background:#F8FAFC;border-color:#E2E8F0;color:#1A202C}
</style>

<script>
let currentArticleId = null;

function openShareModal(url, title, articleId) {
  currentArticleId = articleId;
  const modal = document.getElementById('shareModal');
  const linkInput = document.getElementById('shareLink');
  
  linkInput.value = url;
  
  // Update social share links
  document.getElementById('shareWhatsapp').href = `https://wa.me/?text=${encodeURIComponent(title + ' - ' + url)}`;
  document.getElementById('shareTwitter').href = `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}&text=${encodeURIComponent(title)}`;
  document.getElementById('shareFacebook').href = `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`;
  document.getElementById('shareLinkedin').href = `https://www.linkedin.com/sharing/share-offsite/?url=${encodeURIComponent(url)}`;
  document.getElementById('shareEmail').href = `mailto:?subject=${encodeURIComponent(title)}&body=${encodeURIComponent('Check out this article: ' + url)}`;
  
  modal.style.display = 'flex';
  
  // Track share action
  if (currentArticleId) {
    fetch(`/blog/${currentArticleId}/share`, {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Content-Type': 'application/json'
      }
    });
  }
}

function closeShareModal() {
  document.getElementById('shareModal').style.display = 'none';
  document.getElementById('copyFeedback').style.display = 'none';
}

function copyShareLink() {
  const input = document.getElementById('shareLink');
  input.select();
  document.execCommand('copy');
  
  const feedback = document.getElementById('copyFeedback');
  feedback.style.display = 'block';
  
  setTimeout(() => {
    feedback.style.display = 'none';
  }, 3000);
}

function likeArticle(articleId) {
  fetch(`/blog/${articleId}/like`, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      'Content-Type': 'application/json'
    }
  }).then(() => location.reload());
}

function bookmarkArticle(articleId) {
  fetch(`/blog/${articleId}/bookmark`, {
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
      'Content-Type': 'application/json'
    }
  }).then(() => location.reload());
}

// Close modal when clicking outside
document.getElementById('shareModal')?.addEventListener('click', function(e) {
  if (e.target === this) closeShareModal();
});
</script>

