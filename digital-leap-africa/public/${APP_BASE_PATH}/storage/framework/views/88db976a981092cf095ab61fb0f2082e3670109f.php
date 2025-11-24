

<?php $__env->startSection('title', 'Digital Insights Blog - Web Development & Technology Articles | Digital Leap Africa'); ?>
<?php $__env->startSection('meta_description', 'Discover the latest web development tutorials, technology insights, and digital transformation articles from Digital Leap Africa. Expert content on Laravel, JavaScript, PHP, and more.'); ?>
<?php $__env->startSection('meta_keywords', 'web development blog, technology articles, Laravel tutorials, JavaScript guides, PHP development, digital transformation Africa, programming tutorials, tech insights'); ?>
<?php $__env->startSection('canonical', route('blog.index')); ?>

<?php $__env->startPush('meta'); ?>
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo e(route('blog.index')); ?>">
<meta property="og:title" content="Digital Insights Blog - Web Development & Technology Articles">
<meta property="og:description" content="Discover the latest web development tutorials, technology insights, and digital transformation articles from Digital Leap Africa. Expert content on Laravel, JavaScript, PHP, and more.">
<meta property="og:image" content="<?php echo e(asset('images/blog-og-image.jpg')); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="Digital Leap Africa">
<meta property="og:locale" content="en_US">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?php echo e(route('blog.index')); ?>">
<meta property="twitter:title" content="Digital Insights Blog - Web Development & Technology Articles">
<meta property="twitter:description" content="Discover the latest web development tutorials, technology insights, and digital transformation articles from Digital Leap Africa.">
<meta property="twitter:image" content="<?php echo e(asset('images/blog-og-image.jpg')); ?>">
<meta property="twitter:creator" content="@DigitalLeapAfrica">
<meta property="twitter:site" content="@DigitalLeapAfrica">

<!-- Additional SEO -->
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="author" content="Digital Leap Africa">
<meta name="publisher" content="Digital Leap Africa">
<meta name="geo.region" content="KE">
<meta name="geo.country" content="Kenya">
<meta name="geo.placename" content="Nairobi">
<meta name="language" content="English">
<meta name="theme-color" content="#0a192f">
<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telephone=no">
<meta name="referrer" content="origin-when-cross-origin">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://cdnjs.cloudflare.com">
<link rel="dns-prefetch" href="//fonts.googleapis.com">
<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

<!-- Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Blog",
  "name": "Digital Leap Africa Blog",
  "description": "Web development tutorials, technology insights, and digital transformation articles from Digital Leap Africa",
  "url": "<?php echo e(route('blog.index')); ?>",
  "publisher": {
    "@type": "Organization",
    "name": "Digital Leap Africa",
    "url": "<?php echo e(url('/')); ?>",
    "logo": {
      "@type": "ImageObject",
      "url": "<?php echo e(asset('images/logo.png')); ?>"
    }
  },
  "mainEntityOfPage": {
    "@type": "WebPage",
    "@id": "<?php echo e(route('blog.index')); ?>"
  },
  "blogPost": [
    <?php if(isset($articles) && $articles->count()): ?>
      <?php $__currentLoopData = $articles->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        {
          "@type": "BlogPosting",
          "headline": "<?php echo e(addslashes($article->title)); ?>",
          "description": "<?php echo e(addslashes(Str::limit(strip_tags($article->content ?? ''), 160))); ?>",
          "url": "<?php echo e(route('blog.show', $article)); ?>",
          "datePublished": "<?php echo e($article->created_at->toISOString()); ?>",
          "dateModified": "<?php echo e($article->updated_at->toISOString()); ?>",
          "author": {
            "@type": "Person",
            "name": "<?php echo e($article->author->name ?? 'Digital Leap Africa'); ?>"
          },
          "publisher": {
            "@type": "Organization",
            "name": "Digital Leap Africa",
            "logo": {
              "@type": "ImageObject",
              "url": "<?php echo e(asset('images/logo.png')); ?>"
            }
          }
        }<?php echo e($index < min(4, $articles->count() - 1) ? ',' : ''); ?>

      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
  ]
}
</script>

<!-- Breadcrumb Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "BreadcrumbList",
  "itemListElement": [
    {
      "@type": "ListItem",
      "position": 1,
      "name": "Home",
      "item": "<?php echo e(url('/')); ?>"
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Blog",
      "item": "<?php echo e(route('blog.index')); ?>"
    }
  ]
}
</script>

<!-- Website Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "Digital Leap Africa",
  "url": "<?php echo e(url('/')); ?>",
  "potentialAction": {
    "@type": "SearchAction",
    "target": {
      "@type": "EntryPoint",
      "urlTemplate": "<?php echo e(route('blog.index')); ?>?search={search_term_string}"
    },
    "query-input": "required name=search_term_string"
  },
  "sameAs": [
    "https://twitter.com/DigitalLeapAfrica",
    "https://linkedin.com/company/digital-leap-africa",
    "https://github.com/digital-leap-africa"
  ]
}
</script>

<!-- Organization Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Digital Leap Africa",
  "url": "<?php echo e(url('/')); ?>",
  "logo": "<?php echo e(asset('images/logo.png')); ?>",
  "description": "Empowering Africa through digital transformation, web development education, and technology innovation.",
  "address": {
    "@type": "PostalAddress",
    "addressCountry": "Kenya",
    "addressRegion": "Nairobi"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "contactType": "customer service",
    "url": "<?php echo e(route('contact')); ?>"
  },
  "sameAs": [
    "https://twitter.com/DigitalLeapAfrica",
    "https://linkedin.com/company/digital-leap-africa",
    "https://github.com/digital-leap-africa"
  ]
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<!-- Hero Section -->
<section class="blog-hero" style="padding: 3rem 0 2rem; background: linear-gradient(135deg, var(--navy-bg), var(--charcoal)); border-bottom: 1px solid rgba(100, 181, 246, 0.1);">
  <div class="container">
    <div class="text-center">
      <h1 style="font-size: 2.5rem; font-weight: 700; color: var(--diamond-white); margin-bottom: 1rem; background: linear-gradient(90deg, #64b5f6, #00d4ff); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
        📚 Digital Insights Blog
      </h1>
      <p style="font-size: 1.1rem; color: var(--cool-gray); max-width: 600px; margin: 0 auto; line-height: 1.6;">
        Discover the latest trends, tutorials, and insights in web development, technology, and digital transformation across Africa.
      </p>
    </div>
  </div>
</section>

<!-- Latest Articles -->
<section id="articles-section" style="padding: 3rem 0;">
  <?php
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
  ?>

  <div class="container">
    <!-- Search Bar -->
    <div class="search-container" style="max-width: 500px; margin: 0 auto 2rem; position: relative;">
      <form method="GET" action="<?php echo e(route('blog.index')); ?>" style="position: relative;">
        <input type="text" 
               name="search" 
               value="<?php echo e($search ?? ''); ?>" 
               placeholder="Search articles..." 
               class="search-input"
               style="width: 100%; padding: 0.875rem 3rem 0.875rem 1rem; border: 1px solid rgba(100, 181, 246, 0.3); border-radius: 50px; background: rgba(255, 255, 255, 0.05); color: var(--diamond-white); font-size: 1rem; outline: none; transition: all 0.3s ease;">
        <button type="submit" 
                class="search-btn"
                style="position: absolute; right: 0.5rem; top: 50%; transform: translateY(-50%); background: linear-gradient(135deg, #64b5f6, #00d4ff); border: none; border-radius: 50%; width: 2.5rem; height: 2.5rem; display: flex; align-items: center; justify-content: center; color: var(--navy-bg); cursor: pointer; transition: all 0.3s ease;">
          <i class="fas fa-search"></i>
        </button>
      </form>
      <?php if($search ?? false): ?>
        <div style="text-align: center; margin-top: 0.75rem; color: var(--cool-gray); font-size: 0.9rem;">
          Showing results for "<strong style="color: #64b5f6;"><?php echo e($search); ?></strong>" 
          <a href="<?php echo e(route('blog.index')); ?>" style="color: #64b5f6; text-decoration: none; margin-left: 0.5rem;">
            <i class="fas fa-times"></i> Clear
          </a>
        </div>
      <?php endif; ?>
    </div>

    <?php if($articles->count()): ?>
      <?php if($search && $articles->total() > 0): ?>
        <div style="text-align: center; margin-bottom: 1.5rem; color: var(--cool-gray);">
          Found <?php echo e($articles->total()); ?> article<?php echo e($articles->total() !== 1 ? 's' : ''); ?>

        </div>
      <?php endif; ?>
      <!-- Featured Article -->
      <?php if($articles->items() && count($articles->items()) > 0): ?>
        <?php $featured = $articles->items()[0]; ?>
        <div class="featured-article" style="margin-bottom: 3rem;">
          <div class="featured-card" style="background: var(--charcoal); border-radius: 16px; overflow: hidden; box-shadow: 0 20px 40px rgba(2,12,27,0.8); border: 1px solid rgba(100, 181, 246, 0.1); display: grid; grid-template-columns: 1fr 1fr; gap: 0; min-height: 400px;">
            <div class="featured-image" style="position: relative; overflow: hidden;">
              <?php if($featured->optimized_image ?? $pickImage($featured)): ?>
                <img 
                  src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 800 400'%3E%3Crect width='800' height='400' fill='%23f3f4f6'/%3E%3C/svg%3E" 
                  data-src="<?php echo e($featured->optimized_image ?? $pickImage($featured)); ?>" 
                  alt="<?php echo e($featured->title); ?>" 
                  class="lazy-load" 
                  style="width: 100%; height: 100%; object-fit: cover; transition: opacity 0.3s ease;"
                  loading="lazy"
                >
              <?php else: ?>
                <div style="width: 100%; height: 100%; background: linear-gradient(135deg, #64b5f6, #00d4ff); display: flex; align-items: center; justify-content: center;">
                  <i class="fas fa-newspaper" style="font-size: 4rem; color: rgba(255,255,255,0.3);"></i>
                </div>
              <?php endif; ?>
              <div style="position: absolute; top: 1rem; left: 1rem; background: rgba(100, 181, 246, 0.9); color: var(--navy-bg); padding: 0.5rem 1rem; border-radius: 20px; font-size: 0.8rem; font-weight: 600;">Featured</div>
            </div>
            <div class="featured-content" style="padding: 2rem; display: flex; flex-direction: column; justify-content: center;">
              <div style="margin-bottom: 1rem;">
                <?php $featuredTags = is_array($featured->tags ?? null) ? $featured->tags : []; ?>
                <?php if(!empty($featuredTags)): ?>
                  <?php $__currentLoopData = array_slice($featuredTags, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <span class="tag" style="display: inline-block; background: rgba(100, 181, 246, 0.1); color: #64b5f6; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.75rem; margin-right: 0.5rem; border: 1px solid rgba(100, 181, 246, 0.2);"><?php echo e($tag); ?></span>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
              </div>
              <h2 style="font-size: 1.8rem; font-weight: 700; color: var(--diamond-white); margin-bottom: 1rem; line-height: 1.3;"><?php echo e($featured->title); ?></h2>
              <p style="color: var(--cool-gray); line-height: 1.6; margin-bottom: 1.5rem; font-size: 1rem;"><?php echo e(Str::limit(strip_tags($featured->content ?? ''), 150)); ?></p>
              <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1.5rem;">
                <div style="display: flex; gap: 1rem; color: var(--cool-gray); font-size: 0.9rem;">
                  <span><i class="fa-regular fa-clock"></i> <?php echo e(max(1, ceil(str_word_count(strip_tags($featured->content ?? ''))/200))); ?> min</span>
                  <span><i class="fa-regular fa-calendar"></i> <?php echo e($featured->created_at->format('M j, Y')); ?></span>
                </div>
              </div>
              <a href="<?php echo e(route('blog.show', $featured)); ?>" class="featured-btn" style="display: inline-flex; align-items: center; gap: 0.5rem; background: linear-gradient(135deg, #64b5f6, #00d4ff); color: var(--navy-bg); padding: 0.75rem 1.5rem; border-radius: 8px; text-decoration: none; font-weight: 600; transition: all 0.3s ease; align-self: flex-start;">
                Read Full Article <i class="fas fa-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      <?php endif; ?>
      
      <!-- Articles Grid -->
      <div class="section-header" style="text-align: center; margin-bottom: 2rem;">
        <h2 style="font-size: 2rem; font-weight: 700; color: var(--diamond-white); margin-bottom: 0.5rem;">All Articles</h2>
        <p style="color: var(--cool-gray);">Explore our collection of insights and tutorials</p>
      </div>
      
      <div class="cards-grid">
        <?php $__currentLoopData = $articles->skip(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
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
          ?>

          <div class="card">
            <div class="card-image-container">
              <?php if($post->optimized_image ?? $image): ?>
                <img 
                  src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 240'%3E%3Crect width='400' height='240' fill='%23f3f4f6'/%3E%3C/svg%3E" 
                  data-src="<?php echo e($post->optimized_image ?? $image); ?>" 
                  alt="<?php echo e($title); ?>" 
                  class="card-image lazy-load"
                  loading="lazy"
                >
              <?php else: ?>
                <img 
                  src="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 400 240'%3E%3Crect width='400' height='240' fill='%23e5e7eb'/%3E%3Ctext x='50%25' y='50%25' text-anchor='middle' dy='.3em' fill='%236b7280'%3EArticle%3C/text%3E%3C/svg%3E" 
                  alt="<?php echo e($title); ?>" 
                  class="card-image"
                >
              <?php endif; ?>
              <?php if($category): ?>
                <div class="card-category"><?php echo e($category); ?></div>
              <?php endif; ?>
              <h3 class="card-title"><?php echo e($title); ?></h3>
            </div>
            <div class="card-content">
              <div class="card-meta">
                <span><i class="fa-regular fa-clock"></i> <?php echo e($readMinutes); ?> min read</span>
                <?php if($dateText): ?>
                  <span><i class="fa-regular fa-calendar"></i> <?php echo e($dateText); ?></span>
                <?php endif; ?>
              </div>

              <?php if(!empty($tags)): ?>
                <div class="tags mb-2">
                  <?php $__currentLoopData = $tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('blog.index', ['tag' => $t])); ?>" class="tag"><?php echo e($t); ?></a>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
              <?php endif; ?>

              <p class="card-body"><?php echo e($excerpt); ?></p>

              <div class="article-actions" style="display:flex;align-items:center;justify-content:space-between;gap:.75rem;flex-wrap:wrap;margin-bottom:1rem;">
                <div class="action-stats" style="display:flex;gap:1.5rem;">
                  <?php if(auth()->guard()->check()): ?>
                    <?php
                      $userInteraction = \DB::table('article_user_interactions')
                          ->where('user_id', auth()->id())
                          ->where('article_id', $post->id)
                          ->first();
                      $isLiked = $userInteraction ? $userInteraction->liked : false;
                      $isBookmarked = $userInteraction ? $userInteraction->bookmarked : false;
                    ?>
                    <button class="action-btn like-btn" data-article-id="<?php echo e($post->id); ?>" title="Like">
                      <i class="<?php echo e($isLiked ? 'fa-solid' : 'fa-regular'); ?> fa-heart" style="<?php echo e($isLiked ? 'color: #ef4444;' : ''); ?>"></i>
                      <span class="action-count"><?php echo e($post->likes_count ?? 0); ?></span>
                    </button>
                    <button class="action-btn bookmark-btn" data-article-id="<?php echo e($post->id); ?>" title="Bookmark">
                      <i class="<?php echo e($isBookmarked ? 'fa-solid' : 'fa-regular'); ?> fa-bookmark" style="<?php echo e($isBookmarked ? 'color: #3b82f6;' : ''); ?>"></i>
                      <span class="action-count"><?php echo e($post->bookmarks_count ?? 0); ?></span>
                    </button>
                    <button class="action-btn share-btn" data-article-id="<?php echo e($post->id); ?>" onclick="openShareModal('<?php echo e($showUrl); ?>', '<?php echo e(addslashes($title)); ?>', <?php echo e($post->id); ?>)" title="Share">
                      <i class="fa-solid fa-share-nodes"></i>
                      <span class="action-count"><?php echo e($post->shares_count ?? 0); ?></span>
                    </button>
                  <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="action-btn" title="Like">
                      <i class="fa-regular fa-heart"></i>
                      <span class="action-count"><?php echo e($post->likes_count ?? 0); ?></span>
                    </a>
                    <a href="<?php echo e(route('login')); ?>" class="action-btn" title="Bookmark">
                      <i class="fa-regular fa-bookmark"></i>
                      <span class="action-count"><?php echo e($post->bookmarks_count ?? 0); ?></span>
                    </a>
                    <a href="<?php echo e(route('login')); ?>" class="action-btn" title="Share">
                      <i class="fa-solid fa-share-nodes"></i>
                      <span class="action-count"><?php echo e($post->shares_count ?? 0); ?></span>
                    </a>
                  <?php endif; ?>
                </div>
              </div>

              <a class="card-button" href="<?php echo e($showUrl); ?>">
                Read Article <i class="fas fa-arrow-right"></i>
              </a>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      
      <!-- Newsletter CTA -->
      <?php if($articles->count() > 3): ?>
        <div class="newsletter-cta">
          <h3>📧 Stay Updated with Digital Leap Africa</h3>
          <p>Get the latest articles, tutorials, and insights delivered straight to your inbox. Join our growing community of tech enthusiasts!</p>
          <form class="newsletter-form" id="blog-newsletter-form">
            <?php echo csrf_field(); ?>
            <input type="email" name="email" placeholder="Enter your email address" required>
            <button type="submit" id="blog-newsletter-submit">
              <i class="fas fa-paper-plane"></i> Subscribe
            </button>
          </form>
          <div id="blog-newsletter-success" style="display: none; color: #22c55e; margin-top: 1rem;">
            <i class="fas fa-check-circle"></i> <span></span>
          </div>
          <div id="blog-newsletter-error" style="display: none; color: #ef4444; margin-top: 1rem;">
            <i class="fas fa-exclamation-circle"></i> <span></span>
          </div>
        </div>
      <?php endif; ?>
      
    <?php else: ?>
      <div class="empty-state" style="text-align: center; padding: 4rem 2rem; color: var(--cool-gray);">
        <i class="fas fa-search" style="font-size: 4rem; opacity: 0.3; margin-bottom: 1rem;"></i>
        <?php if($search ?? false): ?>
          <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">No articles found for "<?php echo e($search); ?>"</h3>
          <p>Try searching with different keywords or <a href="<?php echo e(route('blog.index')); ?>" style="color: #64b5f6;">browse all articles</a></p>
        <?php else: ?>
          <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">No Articles Yet</h3>
          <p>We're working on bringing you amazing content. Check back soon!</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    
    <?php if(method_exists($articles, 'links')): ?>
      <div class="pagination-wrapper" style="display: flex; justify-content: center; margin-top: 3rem;">
        <div class="pagination-container" style="background: var(--charcoal); border-radius: 12px; padding: 1rem; border: 1px solid rgba(100, 181, 246, 0.1);">
          <?php echo e($articles->links()); ?>

        </div>
      </div>
    <?php endif; ?>

  </div>
</section>

<style>
  /* Articles overlay card styles (scoped) */
  main{background:var(--navy-bg)!important}
  #articles-section .cards-grid{display:grid;grid-template-columns:repeat(3, 1fr);gap:1.5rem;max-width:1200px;margin:0 auto}
  #articles-section .card{background-color:#112240;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(2,12,27,0.7);transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275);height:100%;display:flex;flex-direction:column;padding:0;max-width:380px}
  #articles-section .card:hover{transform:translateY(-8px);box-shadow:0 20px 40px rgba(2,12,27,0.9)}
  #articles-section .card-image-container{position:relative;overflow:hidden;margin:0;padding:0;line-height:0;border-top-left-radius:12px;border-top-right-radius:12px}
  #articles-section .card-image{width:100%;height:180px;object-fit:cover;display:block;margin:0;transition:transform .5s ease}
  #articles-section .card:hover .card-image{transform:scale(1.05)}
  #articles-section .card-title{position:absolute;bottom:0;left:0;right:0;background:linear-gradient(transparent, rgba(10,25,47,0.95));padding:1.25rem 1.25rem .5rem;margin:0;font-size:1.1rem;font-weight:600;line-height:1.3;text-shadow:0 2px 4px rgba(0,0,0,0.5)}
  #articles-section .card-content{padding:1.25rem;flex-grow:1;display:flex;flex-direction:column}
  #articles-section .card-body{color:#8892b0;line-height:1.5;margin-bottom:1.25rem;flex-grow:1;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;font-size:0.9rem}
  #articles-section .card-meta{display:flex;justify-content:space-between;color:#8892b0;font-size:.8rem;margin-bottom:1rem;border-bottom:1px solid rgba(136,146,176,0.2);padding-bottom:.5rem}
  #articles-section .card-button{display:inline-flex;align-items:center;justify-content:center;background-color:transparent;color:#3b82f6;padding:.5rem 1rem;border:1px solid #3b82f6;border-radius:6px;text-decoration:none;font-size:.85rem;font-weight:500;transition:all .3s ease;cursor:pointer;gap:.4rem}
  #articles-section .card-button:hover{background-color:rgba(59,130,246,.1);transform:translateY(-2px);box-shadow:0 4px 12px rgba(59,130,246,.2)}
  #articles-section .card-category{position:absolute;top:1rem;left:1rem;background:rgba(100,255,218,0.9);color:#0a192f;padding:.25rem .6rem;border-radius:20px;font-size:.7rem;font-weight:600;text-transform:uppercase;letter-spacing:.5px}

  /* Styled tags - smaller with blue theme */
  #articles-section .tags{display:flex;flex-wrap:wrap;gap:.35rem;margin-bottom:.75rem}
  #articles-section .tag{display:inline-block;background:rgba(59,130,246,0.1);color:#3b82f6;padding:.2rem .5rem;border-radius:999px;font-size:.7rem;border:1px solid rgba(59,130,246,0.2);text-decoration:none;font-weight:500}
  #articles-section .tag:hover{background:rgba(59,130,246,0.15);border-color:rgba(59,130,246,0.3)}
  
  /* Action buttons styling */
  .action-btn{background:none;border:none;color:#8892b0;cursor:pointer;display:inline-flex;align-items:center;gap:.4rem;font-size:.9rem;transition:all .2s ease;padding:.25rem .5rem;border-radius:6px}
  .action-btn:hover{color:#64b5f6;background:rgba(100,181,246,0.1);transform:translateY(-1px)}
  .action-btn i{font-size:1.1rem}
  .action-count{font-weight:500}
  
  /* Featured article enhancements */
  .featured-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(100, 181, 246, 0.3); }
  
  /* Enhanced card hover effects */
  #articles-section .card:hover { transform: translateY(-10px); }
  #articles-section .card:hover .card-image { transform: scale(1.08); }
  
  /* Newsletter integration in articles */
  .newsletter-cta {
    background: linear-gradient(135deg, var(--charcoal), rgba(100, 181, 246, 0.05));
    border: 1px solid rgba(100, 181, 246, 0.1);
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
    margin: 3rem 0;
  }
  
  .newsletter-cta h3 {
    color: var(--diamond-white);
    font-size: 1.5rem;
    margin-bottom: 1rem;
  }
  
  .newsletter-cta p {
    color: var(--cool-gray);
    margin-bottom: 1.5rem;
  }
  
  .newsletter-form {
    display: flex;
    gap: 1rem;
    max-width: 400px;
    margin: 0 auto;
  }
  
  .newsletter-form input {
    flex: 1;
    padding: 0.75rem 1rem;
    border: 1px solid rgba(100, 181, 246, 0.2);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.05);
    color: var(--diamond-white);
  }
  
  .newsletter-form button {
    padding: 0.75rem 1.5rem;
    background: linear-gradient(135deg, #64b5f6, #00d4ff);
    border: none;
    border-radius: 8px;
    color: var(--navy-bg);
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
  }
  
  .newsletter-form button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(100, 181, 246, 0.3);
  }
  
  @media (max-width: 480px) {
    .newsletter-form { flex-direction: column; }
    .newsletter-cta { padding: 1.5rem; margin: 2rem 0; }
  }

  /* Lazy Loading Styles */
  .lazy-load {
    opacity: 0;
    transition: opacity 0.3s ease;
  }
  
  .lazy-load.loaded {
    opacity: 1;
  }
  
  .card-image.lazy-load {
    background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
    background-size: 200% 100%;
    animation: loading 1.5s infinite;
  }
  
  @keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
  }
  
  [data-theme="light"] .card-image.lazy-load {
    background: linear-gradient(90deg, #f8f9fa 25%, #e9ecef 50%, #f8f9fa 75%);
    background-size: 200% 100%;
  }
  
  /* Performance optimizations */
  .card-image, .featured-image img {
    will-change: transform;
    backface-visibility: hidden;
    transform: translateZ(0);
  }
  
  .card:hover .card-image {
    transform: scale(1.05) translateZ(0);
  }
  
  /* Critical resource hints */
  .featured-image img {
    content-visibility: auto;
    contain-intrinsic-size: 800px 400px;
  }
  
  .card-image {
    content-visibility: auto;
    contain-intrinsic-size: 400px 240px;
  }
  
  /* Reduce layout shifts */
  .card-image-container {
    aspect-ratio: 5/3;
  }
  
  .featured-image {
    aspect-ratio: 2/1;
  }

  /* Enhanced Mobile Responsiveness */
  @media (max-width: 768px) {
    .blog-hero { padding: 2rem 0 1.5rem; }
    .blog-hero h1 { font-size: 2rem; }
    .blog-stats { gap: 1.5rem; }
    .featured-card { grid-template-columns: 1fr !important; min-height: auto !important; }
    .featured-content { padding: 1.5rem; }
    .featured-btn { align-self: stretch; text-align: center; justify-content: center; }
    #articles-section { padding: 2rem 0; }
    #articles-section .cards-grid { grid-template-columns: repeat(2, 1fr); gap: 1.5rem; }
    #articles-section .card-title { font-size: 1.1rem; padding: 1.25rem 1.25rem .5rem; }
    .action-stats { justify-content: center; }
  }
  
  @media (max-width: 480px) {
    .blog-hero { padding: 1.5rem 0 1rem; }
    .blog-hero h1 { font-size: 1.8rem; }
    .blog-stats { flex-direction: column; gap: 1rem; }
    .stat-item { padding: 0.5rem; }
    .featured-content { padding: 1.25rem; }
    .featured-content h2 { font-size: 1.5rem; }
    #articles-section .cards-grid { grid-template-columns: 1fr; gap: 1.25rem; padding: 0 1rem; }
    #articles-section .card { margin: 0 auto; max-width: 400px; }
    .action-stats { gap: 1rem; }
    .action-btn { padding: 0.4rem 0.8rem; font-size: 0.85rem; }
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
  
  /* Light Mode Blog Enhancements */
  [data-theme="light"] .blog-hero {
      background: linear-gradient(135deg, #E6F2FF, #F8FAFC);
      border-bottom-color: rgba(46, 120, 197, 0.2);
  }
  
  [data-theme="light"] .blog-hero h1 {
      background: linear-gradient(90deg, var(--primary-blue), var(--cyan-accent));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
  }
  
  [data-theme="light"] .featured-card {
      background: #FFFFFF;
      border-color: rgba(46, 120, 197, 0.15);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
  }
  
  [data-theme="light"] .featured-content h2 {
      color: var(--primary-blue);
  }
  
  [data-theme="light"] .featured-btn {
      background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
      color: #FFFFFF;
  }
  
  [data-theme="light"] .newsletter-cta {
      background: linear-gradient(135deg, #FFFFFF, rgba(46, 120, 197, 0.02));
      border-color: rgba(46, 120, 197, 0.15);
  }
  
  [data-theme="light"] .newsletter-cta h3 {
      color: var(--primary-blue);
  }
  
  [data-theme="light"] .newsletter-form input {
      background: #FFFFFF;
      border-color: rgba(46, 120, 197, 0.2);
      color: var(--diamond-white);
  }
  
  [data-theme="light"] .newsletter-form button {
      background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
      color: #FFFFFF;
  }
  
  /* Light Mode Search */
  [data-theme="light"] .search-input {
      background: #FFFFFF !important;
      border-color: rgba(46, 120, 197, 0.3) !important;
      color: #1A202C !important;
  }
  [data-theme="light"] .search-input::placeholder {
      color: #4A5568 !important;
  }
  [data-theme="light"] .search-btn {
      background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent)) !important;
      color: #FFFFFF !important;
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

// AJAX interaction handlers
document.addEventListener('DOMContentLoaded', function() {
  // Like button handlers
  document.querySelectorAll('.like-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const articleId = this.dataset.articleId;
      const icon = this.querySelector('i');
      const count = this.querySelector('.action-count');
      
      fetch(`/blog/${articleId}/like`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.liked) {
          icon.className = 'fa-solid fa-heart';
          icon.style.color = '#ef4444';
        } else {
          icon.className = 'fa-regular fa-heart';
          icon.style.color = '';
        }
        count.textContent = data.likes_count;
      })
      .catch(error => console.error('Error:', error));
    });
  });
  
  // Bookmark button handlers
  document.querySelectorAll('.bookmark-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const articleId = this.dataset.articleId;
      const icon = this.querySelector('i');
      const count = this.querySelector('.action-count');
      
      fetch(`/blog/${articleId}/bookmark`, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        }
      })
      .then(response => response.json())
      .then(data => {
        if (data.bookmarked) {
          icon.className = 'fa-solid fa-bookmark';
          icon.style.color = '#3b82f6';
        } else {
          icon.className = 'fa-regular fa-bookmark';
          icon.style.color = '';
        }
        count.textContent = data.bookmarks_count;
      })
      .catch(error => console.error('Error:', error));
    });
  });
});

// Legacy functions for backward compatibility
function likeArticle(articleId) {
  const btn = document.querySelector(`[data-article-id="${articleId}"].like-btn`);
  if (btn) btn.click();
}

function bookmarkArticle(articleId) {
  const btn = document.querySelector(`[data-article-id="${articleId}"].bookmark-btn`);
  if (btn) btn.click();
}

// Close modal when clicking outside
document.getElementById('shareModal')?.addEventListener('click', function(e) {
  if (e.target === this) closeShareModal();
});

// Blog newsletter form handler
const blogNewsletterForm = document.getElementById('blog-newsletter-form');
if (blogNewsletterForm) {
  blogNewsletterForm.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const submitBtn = document.getElementById('blog-newsletter-submit');
    const emailInput = this.querySelector('input[name="email"]');
    const errorDiv = document.getElementById('blog-newsletter-error');
    const successDiv = document.getElementById('blog-newsletter-success');
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Subscribing...';
    errorDiv.style.display = 'none';
    successDiv.style.display = 'none';
    
    fetch('/newsletter/subscribe', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Accept': 'application/json'
      },
      body: formData
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        emailInput.value = '';
        successDiv.querySelector('span').textContent = data.message;
        successDiv.style.display = 'block';
        setTimeout(() => successDiv.style.display = 'none', 5000);
      } else {
        errorDiv.querySelector('span').textContent = data.message || 'Error subscribing. Please try again.';
        errorDiv.style.display = 'block';
      }
    })
    .catch(error => {
      errorDiv.querySelector('span').textContent = 'Error subscribing. Please try again.';
      errorDiv.style.display = 'block';
    })
    .finally(() => {
      submitBtn.disabled = false;
      submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Subscribe';
    });
  });
}

// Intersection Observer for lazy loading
if ('IntersectionObserver' in window) {
  const imageObserver = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        const img = entry.target;
        const src = img.getAttribute('data-src');
        if (src) {
          img.src = src;
          img.classList.remove('lazy-load');
          img.classList.add('loaded');
          observer.unobserve(img);
        }
      }
    });
  }, {
    rootMargin: '50px 0px',
    threshold: 0.01
  });

  // Observe all lazy load images
  document.querySelectorAll('.lazy-load').forEach(img => {
    imageObserver.observe(img);
  });
} else {
  // Fallback for browsers without Intersection Observer
  document.querySelectorAll('.lazy-load').forEach(img => {
    const src = img.getAttribute('data-src');
    if (src) {
      img.src = src;
    }
  });
}

// Preload critical images
function preloadCriticalImages() {
  const criticalImages = document.querySelectorAll('.featured-image img[data-src]');
  criticalImages.forEach(img => {
    const src = img.getAttribute('data-src');
    if (src) {
      const preloadImg = new Image();
      preloadImg.onload = () => {
        img.src = src;
        img.classList.add('loaded');
      };
      preloadImg.src = src;
    }
  });
}

// Preload critical images immediately
preloadCriticalImages();
</script>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views/articles/index.blade.php ENDPATH**/ ?>