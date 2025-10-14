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

  .article-actions { display: flex; gap: 1rem; margin-top: 2rem; }
  .action-btn {
    display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: var(--secondary-dark);
    border: 1px solid var(--border-color); border-radius: var(--radius); color: var(--text-secondary); text-decoration: none; transition: all 0.3s;
  }
  .action-btn:hover { background: rgba(100, 255, 218, 0.1); color: var(--accent-blue); border-color: var(--accent-blue); }

  .tag {
    display: inline-block; background: rgba(100, 255, 218, 0.1); color: var(--accent-blue); padding: 0.25rem 0.75rem; border-radius: 50px;
    font-size: 0.85rem; margin-right: 0.5rem; margin-bottom: 0.5rem; border: 1px solid rgba(100, 255, 218, 0.2);
  }

  @media (max-width: 768px) {
    .article-title { font-size: 2rem; }
    .article-content { padding: 1.5rem; }
    .article-meta { flex-direction: column; align-items: flex-start; gap: 1rem; }
    .comment { flex-direction: column; }
    .comment-avatar { align-self: flex-start; }
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
            @php
              $html = $article->content ?? '';
              $html = preg_replace('/<br\s*\/?>(?i)/', "\n", $html);
              for ($i = 1; $i <= 6; $i++) {
                  $hashes = str_repeat('#', $i) . ' ';
                  $html = preg_replace('/<h' . $i . '\b[^>]*>/i', "\n\n{$hashes}", $html);
              }
              $html = preg_replace('/<\/(p|div|h[1-6]|blockquote)>/i', "\n\n", $html);
              $html = preg_replace('/<li\b[^>]*>/i', "- ", $html);
              $html = preg_replace('/<\/li>/i', "\n", $html);
              $html = preg_replace('/<\/(ul|ol)>/i', "\n", $html);
              $html = preg_replace('/<(ul|ol)\b[^>]*>/i', "\n", $html);
              $allowedInline = '<strong><b><em><i><code>';
              $text = strip_tags($html, $allowedInline);
              $text = preg_replace("/\n{3,}/", "\n\n", $text);
              $lines = preg_split("/\r\n|\n|\r/", trim($text));
              $out = '';
              foreach ($lines as $line) {
                  $trim = trim($line);
                  if ($trim === '') { continue; }
                  if (preg_match('/^(#{1,6})\s+(.*)$/', $trim, $m)) {
                      $level = strlen($m[1]);
                      $headingText = strip_tags($m[2], $allowedInline);
                      $out .= "<h{$level}>{$headingText}</h{$level}>\n";
                  } else {
                      $para = strip_tags($trim, $allowedInline);
                      $out .= '<p>' . $para . "</p>\n";
                  }
              }
            @endphp
            {!! $out !!}
          </div>
          

          <div class="article-actions">
            @auth
              <form method="POST" action="{{ route('blog.like', $article) }}" class="d-inline">@csrf<button type="submit" class="action-btn" title="Like"><i class="fa-regular fa-thumbs-up" aria-hidden="true"></i></button></form>
              <button type="button" class="action-btn" id="shareBtn" title="Share" data-title="{{ $article->title }}" data-url="{{ $shareUrl }}"><i class="fa-solid fa-share" aria-hidden="true"></i></button>
              <form method="POST" action="{{ route('blog.bookmark', $article) }}" class="d-inline">@csrf<button type="submit" class="action-btn" title="Save"><i class="fa-regular fa-bookmark" aria-hidden="true"></i></button></form>
            @else
              <a href="{{ route('login') }}" class="action-btn" title="Like"><i class="fa-regular fa-thumbs-up" aria-hidden="true"></i></a>
              <a href="{{ route('login') }}" class="action-btn" title="Share"><i class="fa-solid fa-share" aria-hidden="true"></i></a>
              <a href="{{ route('login') }}" class="action-btn" title="Save"><i class="fa-regular fa-bookmark" aria-hidden="true"></i></a>
            @endauth
          </div>

          <!-- Share fallback menu -->
          <div id="shareMenu" style="display:none; position: fixed; inset: 0; z-index: 1050; align-items:center; justify-content:center;">
            <div style="position:absolute; inset:0; background: rgba(0,0,0,0.5);"></div>
            <div style="position:relative; background: var(--secondary-dark); color: var(--text-primary); border:1px solid var(--border-color); box-shadow: 0 10px 30px var(--card-shadow); border-radius: 10px; width: 90%; max-width: 420px; padding: 1rem;">
              <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:.75rem;">
                <strong>Share this article</strong>
                <button type="button" id="shareClose" class="btn btn-sm btn-outline-light" style="background:transparent; border:1px solid var(--border-color); color: var(--text-secondary);">Close</button>
              </div>
              <div style="display:flex; gap:.5rem; align-items:center; margin-bottom:.75rem;">
                <input id="shareLink" type="text" readonly class="form-control" value="{{ $shareUrl }}" style="flex:1;">
                <button type="button" id="copyLink" class="btn btn-primary">Copy</button>
              </div>
              <div style="display:flex; gap:.5rem; flex-wrap:wrap;">
                <a id="waShare" class="btn btn-outline" target="_blank" rel="noopener">WhatsApp</a>
                <a id="twShare" class="btn btn-outline" target="_blank" rel="noopener">Twitter</a>
                <a id="fbShare" class="btn btn-outline" target="_blank" rel="noopener">Facebook</a>
                <a id="emShare" class="btn btn-outline" target="_blank" rel="noopener">Email</a>
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
    (function(){
      const shareBtn = document.getElementById('shareBtn');
      if (!shareBtn) return;
      const title = shareBtn.getAttribute('data-title') || document.title;
      const url = shareBtn.getAttribute('data-url') || window.location.href;
      const menu = document.getElementById('shareMenu');
      const closeBtn = document.getElementById('shareClose');
      const copyBtn = document.getElementById('copyLink');
      const linkInput = document.getElementById('shareLink');
      const wa = document.getElementById('waShare');
      const tw = document.getElementById('twShare');
      const fb = document.getElementById('fbShare');
      const em = document.getElementById('emShare');

      function postShareIncrement(){
        try {
          const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
          fetch("{{ route('blog.share', $article) }}", { method: 'POST', headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' } });
        } catch(e) { /* noop */ }
      }

      function openMenu(){
        menu.style.display = 'flex';
      }
      function closeMenu(){
        menu.style.display = 'none';
      }

      function setLinks(){
        const text = encodeURIComponent(title + ' ' + url);
        const u = encodeURIComponent(url);
        wa.href = 'https://api.whatsapp.com/send?text=' + text;
        tw.href = 'https://twitter.com/intent/tweet?text=' + text;
        fb.href = 'https://www.facebook.com/sharer/sharer.php?u=' + u;
        em.href = 'mailto:?subject=' + encodeURIComponent(title) + '&body=' + text;
      }

      shareBtn.addEventListener('click', async function(){
        // Try native share first
        if (navigator.share) {
          try {
            await navigator.share({ title: title, url: url });
            postShareIncrement();
            return;
          } catch(err) {
            // fall through to menu if user cancels or share fails
          }
        }
        setLinks();
        openMenu();
      });

      if (copyBtn && linkInput) {
        copyBtn.addEventListener('click', async function(){
          try {
            await navigator.clipboard.writeText(linkInput.value);
            copyBtn.textContent = 'Copied!';
            setTimeout(()=> copyBtn.textContent = 'Copy', 1500);
            postShareIncrement();
          } catch(e) {
            linkInput.select();
            document.execCommand('copy');
            postShareIncrement();
          }
        });
      }

      [wa, tw, fb, em].forEach(function(a){
        if(!a) return;
        a.addEventListener('click', function(){
          postShareIncrement();
        });
      });

      if (closeBtn) closeBtn.addEventListener('click', closeMenu);
      if (menu) menu.addEventListener('click', function(e){ if(e.target === menu) closeMenu(); });
    })();
  </script>
@endsection