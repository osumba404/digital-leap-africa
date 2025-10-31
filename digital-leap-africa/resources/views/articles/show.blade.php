@extends('layouts.app')


<style>
  :root {
    --primary-dark: #0a192f;
    --secondary-dark: #112240;
    --accent-blue: #64ffda;
    --accent-light-blue: #57cbff;
    --accent-purple: #7c4dff;
    --text-primary: #e6f1ff;
    --text-secondary: #8892b0;
    --border-color: #233554;
    --card-shadow: rgba(2, 12, 27, 0.7);
    --radius: 10px;
  }

  body { background-color: var(--primary-dark); color: var(--text-primary); }

  .article-container { max-width: 1200px; margin: 0 auto; }

  .article-header {
    background: linear-gradient(135deg, var(--primary-dark), var(--secondary-dark));
    padding: 3rem 0; margin-bottom: 2rem; border-bottom: 1px solid var(--border-color);
  }

  .article-title { font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; line-height: 1.2; color: var(--text-primary); }

  .article-meta { display: flex; align-items: center; gap: 1.5rem; margin-bottom: 1.5rem; flex-wrap: wrap; }

  .author-info { display: flex; align-items: center; gap: 0.75rem; }
  .author-avatar {
    width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, var(--accent-blue), var(--accent-light-blue));
    display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 1.2rem; color: var(--primary-dark);
  }

  .article-stats { display: flex; gap: 1.5rem; color: var(--text-secondary); }

  .article-featured-image {
    width: 100%; max-height: 500px; object-fit: cover; border-radius: var(--radius); margin-bottom: 2rem;
    box-shadow: 0 10px 30px var(--card-shadow); border: 1px solid var(--border-color);
  }

  .article-content {
    background: var(--secondary-dark); padding: 2.5rem; border-radius: var(--radius);
    box-shadow: 0 10px 30px var(--card-shadow); margin-bottom: 2rem; border: 1px solid var(--border-color);
  }

  .article-content p { margin-bottom: 1.25rem; font-size: 1.1rem; line-height: 1.7; color: var(--text-secondary); }
  .article-content h1 {
    font-size: 2rem; margin: 2rem 0 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid var(--border-color); color: var(--accent-blue);
  }
  .article-content h2 { font-size: 1.75rem; margin: 1.75rem 0 0.9rem; color: var(--accent-light-blue); }
  .article-content h3 { font-size: 1.5rem; margin: 1.5rem 0 0.8rem; color: var(--text-primary); }
  .article-content h4 { font-size: 1.25rem; margin: 1.25rem 0 0.7rem; color: var(--text-primary); }
  .article-content h5 { font-size: 1.1rem; margin: 1.1rem 0 0.6rem; color: var(--text-primary); }
  .article-content h6 { font-size: 1rem; margin: 1rem 0 0.5rem; color: var(--text-primary); }

  .article-content blockquote {
    border-left: 4px solid var(--accent-blue); padding: 1.5rem; margin: 1.5rem 0; font-style: italic; color: var(--text-secondary);
    background: rgba(100, 255, 218, 0.05); border-radius: 0 var(--radius) var(--radius) 0;
  }

  .article-content ul, .article-content ol { margin-bottom: 1.25rem; padding-left: 1.5rem; color: var(--text-secondary); }
  .article-content li { margin-bottom: 0.5rem; }
  .article-content strong, .article-content b { font-weight: 700; color: var(--text-primary); }
  .article-content em, .article-content i { font-style: italic; }
  .article-content code {
    background: rgba(100, 255, 218, 0.1); color: var(--accent-blue); padding: 0.2rem 0.4rem; border-radius: 4px; font-family: 'Courier New', monospace;
  }
  .article-content pre {
    background: var(--primary-dark); padding: 1.5rem; border-radius: var(--radius); overflow-x: auto; margin: 1.5rem 0; border: 1px solid var(--border-color);
  }
  .article-content pre code { background: none; padding: 0; }
  .article-content img {
    max-width: 100%; height: auto; border-radius: var(--radius); margin: 1.5rem 0;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3); border: 1px solid var(--border-color);
  }

  .comments-section {
    background: var(--secondary-dark); padding: 2rem; border-radius: var(--radius);
    box-shadow: 0 10px 30px var(--card-shadow); margin-bottom: 2rem; border: 1px solid var(--border-color);
  }

  .comment { display: flex; gap: 1rem; padding: 1.5rem 0; border-bottom: 1px solid var(--border-color); }
  .comment:last-child { border-bottom: none; }
  .comment-avatar {
    width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, var(--accent-purple), var(--accent-light-blue));
    display: flex; align-items: center; justify-content: center; color: var(--primary-dark); font-weight: bold; flex-shrink: 0;
  }
  .comment-content { flex-grow: 1; }
  .comment-header { display: flex; justify-content: space-between; margin-bottom: 0.5rem; }
  .comment-author { font-weight: bold; color: var(--text-primary); }
  .comment-date { color: var(--text-secondary); font-size: 0.9rem; }
  .comment-text { margin-bottom: 0; color: var(--text-secondary); }
  .comment-form { margin-top: 2rem; }

  .form-control {
    background: var(--primary-dark); border: 1px solid var(--border-color); border-radius: var(--radius);
    padding: 0.75rem 1rem; color: var(--text-primary); transition: all 0.3s;
  }
  .form-control:focus {
    border-color: var(--accent-blue); box-shadow: 0 0 0 0.2rem rgba(100, 255, 218, 0.25); background: var(--primary-dark); color: var(--text-primary);
  }

  .btn-primary {
    background: linear-gradient(135deg, var(--accent-blue), var(--accent-light-blue)); border: none; color: var(--primary-dark);
    padding: 0.75rem 1.5rem; border-radius: var(--radius); font-weight: 600; transition: all 0.3s;
  }
  .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 5px 15px rgba(100, 255, 218, 0.4); }

  .sidebar { position: sticky; top: 2rem; }
  .sidebar-card {
    background: var(--secondary-dark); border-radius: var(--radius); box-shadow: 0 10px 30px var(--card-shadow);
    padding: 1.5rem; margin-bottom: 1.5rem; border: 1px solid var(--border-color);
  }
  .sidebar-title {
    font-size: 1.25rem; margin-bottom: 1rem; padding-bottom: 0.5rem; border-bottom: 2px solid var(--border-color); color: var(--accent-blue);
  }
  .related-articles { list-style: none; padding: 0; margin: 0; }
  .related-article { padding: 0.75rem 0; border-bottom: 1px solid var(--border-color); transition: all 0.3s; }
  .related-article:last-child { border-bottom: none; }
  .related-article:hover { background: rgba(100, 255, 218, 0.05); padding-left: 0.5rem; }
  .related-article a { text-decoration: none; color: var(--text-primary); font-weight: 500; transition: color 0.3s; }
  .related-article a:hover { color: var(--accent-blue); }

  .article-actions { display: flex; gap: 1.5rem; margin-top: 2rem; align-items: center; }
  .action-btn {
    background: none; border: none; color: #8892b0; cursor: pointer; display: inline-flex; align-items: center;
    gap: 0.4rem; font-size: 0.9rem; transition: all 0.2s ease; padding: 0.25rem 0.5rem; border-radius: 6px;
  }
  .action-btn i { font-size: 1.1rem; }
  .action-btn:hover { color: #64b5f6; background: rgba(100,181,246,0.1); }
  .action-count { font-weight: 500; }

  .tag {
    display: inline-block; background: rgba(59,130,246,0.1); color: #3b82f6; padding: 0.2rem 0.5rem; border-radius: 999px;
    font-size: 0.7rem; margin-right: 0.35rem; margin-bottom: 0.35rem; border: 1px solid rgba(59,130,246,0.2); font-weight: 500;
  }
  .tag:hover { background: rgba(59,130,246,0.15); border-color: rgba(59,130,246,0.3); }

  @media (max-width: 768px) {
    .article-title { font-size: 2rem; }
    .article-content { padding: 1.5rem; }
    .article-meta { flex-direction: column; align-items: flex-start; gap: 1rem; }
    .comment { flex-direction: column; }
    .comment-avatar { align-self: flex-start; }
  }

  /* ========== Light Mode Styles ========== */
  [data-theme="light"] body {
      background-color: var(--navy-bg);
      color: var(--diamond-white);
  }

  [data-theme="light"] .article-header {
      background: linear-gradient(135deg, #E6F2FF, #F8FAFC);
      border-bottom: 1px solid rgba(46, 120, 197, 0.2);
  }

  [data-theme="light"] .article-title {
      color: var(--primary-blue);
  }

  [data-theme="light"] .author-avatar {
      background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
      color: #FFFFFF;
  }

  [data-theme="light"] .author-name,
  [data-theme="light"] .sidebar-title,
  [data-theme="light"] .comment-author {
      color: var(--primary-blue) !important;
  }

  [data-theme="light"] .publish-date,
  [data-theme="light"] .article-stats,
  [data-theme="light"] .comment-date,
  [data-theme="light"] .comment-text {
      color: var(--cool-gray) !important;
  }

  [data-theme="light"] .article-featured-image {
      border: 1px solid rgba(46, 120, 197, 0.2);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
  }

  [data-theme="light"] .article-content {
      background: #FFFFFF;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(46, 120, 197, 0.15);
  }

  [data-theme="light"] .article-content p {
      color: var(--cool-gray);
  }

  [data-theme="light"] .article-content h1 {
      color: var(--primary-blue);
      border-bottom-color: rgba(46, 120, 197, 0.2);
  }

  [data-theme="light"] .article-content h2 {
      color: var(--primary-blue);
  }

  [data-theme="light"] .article-content h3,
  [data-theme="light"] .article-content h4,
  [data-theme="light"] .article-content h5,
  [data-theme="light"] .article-content h6 {
      color: var(--diamond-white);
  }

  [data-theme="light"] .article-content blockquote {
      border-left-color: var(--primary-blue);
      background: rgba(46, 120, 197, 0.05);
      color: var(--cool-gray);
  }

  [data-theme="light"] .article-content ul,
  [data-theme="light"] .article-content ol {
      color: var(--cool-gray);
  }

  [data-theme="light"] .article-content strong,
  [data-theme="light"] .article-content b {
      color: var(--diamond-white);
  }

  [data-theme="light"] .article-content code {
      background: rgba(46, 120, 197, 0.1);
      color: var(--primary-blue);
  }

  [data-theme="light"] .article-content pre {
      background: #F8FAFC;
      border: 1px solid rgba(46, 120, 197, 0.2);
  }

  [data-theme="light"] .comments-section {
      background: #FFFFFF;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(46, 120, 197, 0.15);
  }

  [data-theme="light"] .comment {
      border-bottom-color: rgba(46, 120, 197, 0.15);
  }

  [data-theme="light"] .comment-avatar {
      background: linear-gradient(135deg, #8b5cf6, var(--primary-blue));
      color: #FFFFFF;
  }

  [data-theme="light"] .form-control {
      background: #FFFFFF;
      border: 1px solid rgba(46, 120, 197, 0.2);
      color: var(--diamond-white);
  }

  [data-theme="light"] .form-control:focus {
      border-color: var(--primary-blue);
      box-shadow: 0 0 0 0.2rem rgba(46, 120, 197, 0.25);
      background: #FFFFFF;
  }

  [data-theme="light"] .sidebar-card {
      background: #FFFFFF;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(46, 120, 197, 0.15);
  }

  [data-theme="light"] .sidebar-title {
      border-bottom-color: rgba(46, 120, 197, 0.2);
  }

  [data-theme="light"] .related-article {
      border-bottom-color: rgba(46, 120, 197, 0.15);
  }

  [data-theme="light"] .related-article:hover {
      background: rgba(46, 120, 197, 0.05);
  }

  [data-theme="light"] .related-article a {
      color: var(--diamond-white);
  }

  [data-theme="light"] .related-article a:hover {
      color: var(--primary-blue);
  }

  [data-theme="light"] .action-btn {
      color: #4A5568;
  }

  [data-theme="light"] .action-btn:hover {
      background: rgba(46, 120, 197, 0.1);
      color: #2E78C5;
  }

  [data-theme="light"] .tag {
      background: rgba(46, 120, 197, 0.1);
      color: var(--primary-blue);
      border-color: rgba(46, 120, 197, 0.2);
  }
  
  [data-theme="light"] .tag:hover {
      background: rgba(46, 120, 197, 0.15);
  }

  [data-theme="light"] #shareModal > div {
      background: #FFFFFF;
      box-shadow: 0 20px 60px rgba(0,0,0,0.3);
  }
  
  [data-theme="light"] #shareModal input {
      background: #F8FAFC;
      border-color: #E2E8F0;
      color: #1A202C;
  }
  
  .share-btn:hover { transform: translateY(-2px); opacity: .9; }
  .copy-link-btn:hover { background: #2563eb; transform: scale(1.02); }

  [data-theme="light"] .article-content img {
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      border-color: rgba(46, 120, 197, 0.2);
  }
</style>

@section('content')
  @php
    $authorName = $article->author->name ?? 'Unknown';
    $initials = collect(explode(' ', $authorName))->map(fn($p) => strtoupper(substr($p,0,1)))->take(2)->implode('');
    $readMinutes = max(1, ceil(str_word_count(strip_tags($article->content ?? ''))/200));
    $tags = is_array($article->tags ?? null) ? $article->tags : [];
    $shareUrl = route('blog.show', $article);
  @endphp

  <div class="article-container py-4">
    <div class="article-header">
      <div class="container">
        <h1 class="article-title">{{ $article->title }}</h1>
        <div class="article-meta">
          <div class="author-info">
            <div class="author-avatar">{{ $initials ?: 'AU' }}</div>
            <div>
              <div class="author-name" style="color: var(--accent-blue);">{{ $authorName }}</div>
              <div class="publish-date" style="color: var(--text-secondary);">
                {{ $article->published_at ? $article->published_at->toFormattedDateString() : '' }}
              </div>
            </div>
          </div>
          <div class="article-stats">
            <div><i class="fa-regular fa-clock me-1"></i> {{ $readMinutes }} min read</div>
            <div><i class="fa-regular fa-comment me-1"></i> {{ $article->comments->count() }} comments</div>
            <div><i class="fa-regular fa-thumbs-up me-1"></i> {{ $article->likes_count ?? 0 }} likes</div>
          </div>
        </div>

        @if(!empty($tags))
          <div class="tags">
            @foreach($tags as $t)
              <a class="tag" href="{{ route('blog.index', ['tag' => $t]) }}">{{ $t }}</a>
            @endforeach
          </div>
        @endif
      </div>
    </div>

    <div class="container">
      <div class="row g-4">
        <div class="col-lg-8 order-lg-1">
          @if($article->featured_image_url)
            <img class="article-featured-image" src="{{ $article->featured_image_url }}" alt="{{ $article->title }}">
          @endif

          <div class="article-content">
            {!! $article->content !!}
          </div>
          

          <div class="article-actions">
            @auth
              <form method="POST" action="{{ route('blog.like', $article) }}" style="display:inline;">
                @csrf
                <button type="submit" class="action-btn" title="Like">
                  <i class="fa-regular fa-heart"></i>
                  <span class="action-count">{{ $article->likes_count ?? 0 }}</span>
                </button>
              </form>
              <form method="POST" action="{{ route('blog.bookmark', $article) }}" style="display:inline;">
                @csrf
                <button type="submit" class="action-btn" title="Bookmark">
                  <i class="fa-regular fa-bookmark"></i>
                  <span class="action-count">{{ $article->bookmarks_count ?? 0 }}</span>
                </button>
              </form>
              <button type="button" class="action-btn" onclick="openShareModal('{{ $shareUrl }}', '{{ addslashes($article->title) }}', {{ $article->id }})" title="Share">
                <i class="fa-solid fa-share-nodes"></i>
                <span class="action-count">{{ $article->shares_count ?? 0 }}</span>
              </button>
            @else
              <a href="{{ route('login') }}" class="action-btn" title="Like">
                <i class="fa-regular fa-heart"></i>
                <span class="action-count">{{ $article->likes_count ?? 0 }}</span>
              </a>
              <a href="{{ route('login') }}" class="action-btn" title="Bookmark">
                <i class="fa-regular fa-bookmark"></i>
                <span class="action-count">{{ $article->bookmarks_count ?? 0 }}</span>
              </a>
              <a href="{{ route('login') }}" class="action-btn" title="Share">
                <i class="fa-solid fa-share-nodes"></i>
                <span class="action-count">{{ $article->shares_count ?? 0 }}</span>
              </a>
            @endauth
          </div>

          <!-- Share Modal -->
          <div id="shareModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.8);z-index:9999;align-items:center;justify-content:center;">
            <div style="background:var(--secondary-dark);padding:2rem;border-radius:12px;max-width:500px;width:90%;position:relative;border:1px solid var(--border-color);">
              <button onclick="closeShareModal()" style="position:absolute;top:1rem;right:1rem;background:none;border:none;color:var(--text-secondary);font-size:1.5rem;cursor:pointer;transition:color .2s;">
                <i class="fas fa-times"></i>
              </button>
              
              <h3 style="margin:0 0 1.5rem 0;color:var(--text-primary);font-size:1.5rem;">
                <i class="fas fa-share-nodes" style="color:#3b82f6;margin-right:.5rem;"></i>
                Share Article
              </h3>
              
              <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(100px,1fr));gap:1rem;margin-bottom:1.5rem;">
                <a id="shareWhatsapp" target="_blank" class="share-btn" style="background:rgba(37,211,102,0.1);border:1px solid rgba(37,211,102,0.3);color:#25d366;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:1rem;border-radius:8px;text-decoration:none;transition:all .2s;cursor:pointer;">
                  <i class="fab fa-whatsapp" style="font-size:1.5rem;"></i>
                  <span style="font-size:.8rem;margin-top:.25rem;">WhatsApp</span>
                </a>
                <a id="shareTwitter" target="_blank" class="share-btn" style="background:rgba(29,161,242,0.1);border:1px solid rgba(29,161,242,0.3);color:#1da1f2;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:1rem;border-radius:8px;text-decoration:none;transition:all .2s;cursor:pointer;">
                  <i class="fab fa-twitter" style="font-size:1.5rem;"></i>
                  <span style="font-size:.8rem;margin-top:.25rem;">Twitter</span>
                </a>
                <a id="shareFacebook" target="_blank" class="share-btn" style="background:rgba(24,119,242,0.1);border:1px solid rgba(24,119,242,0.3);color:#1877f2;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:1rem;border-radius:8px;text-decoration:none;transition:all .2s;cursor:pointer;">
                  <i class="fab fa-facebook" style="font-size:1.5rem;"></i>
                  <span style="font-size:.8rem;margin-top:.25rem;">Facebook</span>
                </a>
                <a id="shareLinkedin" target="_blank" class="share-btn" style="background:rgba(0,119,181,0.1);border:1px solid rgba(0,119,181,0.3);color:#0077b5;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:1rem;border-radius:8px;text-decoration:none;transition:all .2s;cursor:pointer;">
                  <i class="fab fa-linkedin" style="font-size:1.5rem;"></i>
                  <span style="font-size:.8rem;margin-top:.25rem;">LinkedIn</span>
                </a>
                <a id="shareEmail" target="_blank" class="share-btn" style="background:rgba(234,67,53,0.1);border:1px solid rgba(234,67,53,0.3);color:#ea4335;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:1rem;border-radius:8px;text-decoration:none;transition:all .2s;cursor:pointer;">
                  <i class="fas fa-envelope" style="font-size:1.5rem;"></i>
                  <span style="font-size:.8rem;margin-top:.25rem;">Email</span>
                </a>
              </div>
              
              <div style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.1);border-radius:8px;padding:1rem;">
                <label style="display:block;color:var(--text-secondary);font-size:.85rem;margin-bottom:.5rem;">Article Link:</label>
                <div style="display:flex;gap:.5rem;">
                  <input id="shareLink" type="text" readonly style="flex:1;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);border-radius:6px;padding:.5rem .75rem;color:var(--text-primary);font-size:.9rem;">
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

          <section class="comments-section mt-4">
            <h2 class="h4 mb-4" style="color: var(--accent-blue);">Comments ({{ $article->comments->count() }})</h2>

            @forelse($article->comments as $comment)
              @php
                $cname = $comment->user->name ?? 'User';
                $ci = collect(explode(' ', $cname))->map(fn($p) => strtoupper(substr($p,0,1)))->take(2)->implode('');
              @endphp
              <div class="comment">
                <div class="comment-avatar">{{ $ci ?: 'U' }}</div>
                <div class="comment-content">
                  <div class="comment-header">
                    <div class="comment-author">{{ $cname }}</div>
                    <div class="comment-date">{{ $comment->created_at->diffForHumans() }}</div>
                  </div>
                  <p class="comment-text">{{ $comment->content }}</p>
                </div>
              </div>
            @empty
              <p class="text-muted">No comments yet.</p>
            @endforelse

            <div class="comment-form">
              @auth
                <h3 class="h5 mb-3" style="color: var(--accent-light-blue);">Add a comment</h3>
                <form method="POST" action="{{ route('blog.comments.store', $article) }}">
                  @csrf
                  <div class="mb-3">
                    <textarea id="comment" name="content" rows="4" class="form-control @error('content') is-invalid @enderror" placeholder="Share your thoughts..."></textarea>
                    @error('content')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>
                  <button type="submit" class="btn btn-primary">Post Comment</button>
                </form>
              @else
                <div class="alert alert-info mt-3">
                  Please <a href="{{ route('login') }}" class="alert-link">log in</a> to post a comment.
                </div>
              @endauth
            </div>
          </section>
        </div>

        <div class="col-lg-4 order-lg-2">
          <div class="sidebar">
            <div class="sidebar-card">
              <h3 class="sidebar-title">Related Articles</h3>
              <ul class="related-articles">
                @forelse($related as $r)
                  <li class="related-article"><a href="{{ route('blog.show', $r) }}">{{ $r->title }}</a></li>
                @empty
                  <li class="related-article text-muted">No related articles.</li>
                @endforelse
              </ul>
            </div>

            <div class="sidebar-card">
              <h3 class="sidebar-title">Subscribe to Our Newsletter</h3>
              <p class="mb-3" style="color: var(--text-secondary);">Get the latest web development insights delivered to your inbox.</p>
              <form>
                <div class="mb-3">
                  <input type="email" class="form-control" placeholder="Your email address">
                </div>
                <button type="submit" class="btn btn-primary w-100">Subscribe</button>
              </form>
            </div>

            <div class="sidebar-card">
              <h3 class="sidebar-title">Popular Tags</h3>
              <div class="tags">
                @foreach(array_slice($tags,0,8) as $t)
                  <a class="tag" href="{{ route('blog.index', ['tag' => $t]) }}">{{ $t }}</a>
                @endforeach
                @if(empty($tags))
                  <span class="tag">Technology</span>
                  
                @endif
              </div>
            </div>

            <div class="sidebar-card">
              <h3 class="sidebar-title">Author</h3>
              <div class="author-info">
                <div class="author-avatar">{{ $initials ?: 'AU' }}</div>
                <div>
                  <div style="color: var(--accent-blue); font-weight: bold;">{{ $authorName }}</div>
                  <div style="color: var(--text-secondary); font-size: 0.9rem;">Contributor</div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

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

    // Close modal when clicking outside
    document.getElementById('shareModal')?.addEventListener('click', function(e) {
      if (e.target === this) closeShareModal();
    });
  </script>
@endsection