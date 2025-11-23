

<?php $__env->startSection('title', 'Digital Leap Africa - E-Learning Platform for African Youth | Courses, Jobs & Community'); ?>

<?php $__env->startPush('meta'); ?>
<meta name="description" content="Empowering African youth through comprehensive e-learning courses, job opportunities, and vibrant community. Join Digital Leap Africa for tech skills, career development, and professional growth.">
<meta name="keywords" content="e-learning Africa, online courses Kenya, tech education Africa, digital skills training, African youth empowerment, programming courses, job opportunities Africa, community learning">
<meta name="author" content="Digital Leap Africa">
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo e(url('/')); ?>">
<meta property="og:title" content="Digital Leap Africa - E-Learning Platform for African Youth">
<meta property="og:description" content="Empowering African youth through comprehensive e-learning courses, job opportunities, and vibrant community. Join Digital Leap Africa for tech skills and career development.">
<meta property="og:image" content="<?php echo e(asset('images/og-image.jpg')); ?>">
<meta property="og:site_name" content="Digital Leap Africa">
<meta property="og:locale" content="en_US">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="<?php echo e(url('/')); ?>">
<meta name="twitter:title" content="Digital Leap Africa - E-Learning Platform for African Youth">
<meta name="twitter:description" content="Empowering African youth through comprehensive e-learning courses, job opportunities, and vibrant community.">
<meta name="twitter:image" content="<?php echo e(asset('images/og-image.jpg')); ?>">
<meta name="twitter:image:alt" content="Digital Leap Africa - Empowering African Youth Through Technology Education">
<meta name="twitter:label1" content="Courses Available">
<meta name="twitter:data1" content="<?php echo e($stats['courses'] ?? 0); ?>+">
<meta name="twitter:label2" content="Community Members">
<meta name="twitter:data2" content="<?php echo e($stats['members'] ?? 0); ?>+">

<!-- Additional SEO Meta Tags -->
<meta name="geo.region" content="KE">
<meta name="geo.placename" content="Kenya">
<meta name="geo.position" content="-1.286389;36.817223">
<meta name="ICBM" content="-1.286389, 36.817223">
<meta name="language" content="English">
<meta name="distribution" content="global">
<meta name="rating" content="general">
<meta name="revisit-after" content="7 days">
<meta name="coverage" content="Worldwide">
<meta name="target" content="all">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="apple-touch-fullscreen" content="yes">
<meta name="mobile-web-app-capable" content="yes">

<!-- Dublin Core Metadata -->
<meta name="DC.title" content="Digital Leap Africa - E-Learning Platform for African Youth">
<meta name="DC.creator" content="Digital Leap Africa">
<meta name="DC.subject" content="E-learning, Education, Technology, Africa, Programming, Digital Skills">
<meta name="DC.description" content="Empowering African youth through comprehensive e-learning courses, job opportunities, and vibrant community.">
<meta name="DC.publisher" content="Digital Leap Africa">
<meta name="DC.contributor" content="Digital Leap Africa Team">
<meta name="DC.date" content="<?php echo e(date('Y-m-d')); ?>">
<meta name="DC.type" content="Text">
<meta name="DC.format" content="text/html">
<meta name="DC.identifier" content="<?php echo e(url('/')); ?>">
<meta name="DC.source" content="<?php echo e(url('/')); ?>">
<meta name="DC.language" content="en">
<meta name="DC.coverage" content="Africa">
<meta name="DC.rights" content="© <?php echo e(date('Y')); ?> Digital Leap Africa. All rights reserved.">

<!-- Additional Social Media Tags -->
<meta property="fb:app_id" content="your-facebook-app-id">
<meta name="twitter:site" content="@digitalleapafrica">
<meta name="twitter:creator" content="@digitalleapafrica">
<meta name="twitter:domain" content="<?php echo e(parse_url(url('/'), PHP_URL_HOST)); ?>">

<!-- LinkedIn -->
<meta property="og:site_name" content="Digital Leap Africa">
<meta property="article:publisher" content="https://linkedin.com/company/digitalleapafrica">
<meta property="article:author" content="Digital Leap Africa">
<meta property="article:section" content="Education">
<meta property="article:tag" content="E-learning,Education,Technology,Africa,Programming">

<!-- Pinterest -->
<meta name="pinterest-rich-pin" content="true">
<meta property="og:type" content="website">

<!-- WhatsApp -->
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">

<!-- Search Engine Specific -->
<meta name="googlebot" content="index,follow,snippet,archive">
<meta name="bingbot" content="index,follow">
<meta name="slurp" content="index,follow">
<meta name="msnbot" content="index,follow">

<!-- Content Classification -->
<meta name="classification" content="Education">
<meta name="category" content="Education Technology">
<meta name="news_keywords" content="e-learning, africa, education, technology, programming, digital skills">

<!-- Technical SEO -->
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="referrer" content="origin-when-cross-origin">
<meta name="format-detection" content="telephone=no,address=no,email=no">
<meta name="skype_toolbar" content="skype_toolbar_parser_compatible">

<!-- Canonical URL -->
<link rel="canonical" href="<?php echo e(url('/')); ?>">

<!-- Performance Hints -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://cdnjs.cloudflare.com">
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link rel="dns-prefetch" href="//cdnjs.cloudflare.com">

<!-- Preload critical images -->
<?php
  $heroSlides = $siteSettings['hero_slides'] ?? [];
  $firstSlideImage = !empty($heroSlides) && !empty($heroSlides[0]['image']) ? $heroSlides[0]['image'] : null;
?>
<?php if($firstSlideImage): ?>
<link rel="preload" as="image" href="<?php echo e($firstSlideImage); ?>" fetchpriority="high">
<?php endif; ?>

<?php if(!empty($heroSlides) && count($heroSlides) > 1): ?>
  <?php $__currentLoopData = array_slice($heroSlides, 1, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(!empty($slide['image'])): ?>
<link rel="preload" as="image" href="<?php echo e($slide['image']); ?>" fetchpriority="low">
    <?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

<!-- Additional SEO Meta Tags -->
<meta name="theme-color" content="#2E78C5">
<meta name="msapplication-TileColor" content="#2E78C5">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="format-detection" content="telephone=no">

<!-- Alternate Languages -->
<link rel="alternate" hreflang="en" href="<?php echo e(url('/')); ?>">
<link rel="alternate" hreflang="x-default" href="<?php echo e(url('/')); ?>">

<!-- Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "Digital Leap Africa",
  "description": "Empowering African youth through comprehensive e-learning courses, job opportunities, and vibrant community.",
  "url": "<?php echo e(url('/')); ?>",
  "logo": "<?php echo e(asset('images/logo.png')); ?>",
  "sameAs": [
    "https://facebook.com/digitalleapafrica",
    "https://twitter.com/digitalleapafrica",
    "https://linkedin.com/company/digitalleapafrica"
  ],
  "address": {
    "@type": "PostalAddress",
    "addressCountry": "Kenya",
    "addressRegion": "Nairobi"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "contactType": "customer service",
    "email": "info@digitalleapafrica.com"
  },
  "offers": {
    "@type": "AggregateOffer",
    "offerCount": "<?php echo e($stats['courses'] ?? 0); ?>",
    "lowPrice": "0",
    "highPrice": "10000",
    "priceCurrency": "KES"
  },
  "hasOfferCatalog": {
    "@type": "OfferCatalog",
    "name": "Course Catalog",
    "itemListElement": [
      {
        "@type": "Course",
        "name": "Programming Courses",
        "description": "Learn programming languages and web development"
      },
      {
        "@type": "Course",
        "name": "Digital Marketing",
        "description": "Master digital marketing strategies and tools"
      }
    ]
  }
}
</script>

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
      "urlTemplate": "<?php echo e(url('/courses')); ?>?search={search_term_string}"
    },
    "query-input": "required name=search_term_string"
  }
}
</script>

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
    }
  ]
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "Digital Leap Africa",
  "alternateName": "DLA",
  "url": "<?php echo e(url('/')); ?>",
  "logo": "<?php echo e(asset('images/logo.png')); ?>",
  "foundingDate": "2024",
  "founders": [
    {
      "@type": "Person",
      "name": "Digital Leap Africa Team"
    }
  ],
  "areaServed": {
    "@type": "Place",
    "name": "Africa"
  },
  "knowsAbout": [
    "E-learning",
    "Programming",
    "Web Development",
    "Digital Marketing",
    "Technology Education",
    "Career Development"
  ],
  "memberOf": {
    "@type": "Organization",
    "name": "African Education Technology Network"
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "Digital Leap Africa - Home",
  "description": "Empowering African youth through comprehensive e-learning courses, job opportunities, and vibrant community.",
  "url": "<?php echo e(url('/')); ?>",
  "mainEntity": {
    "@type": "ItemList",
    "numberOfItems": <?php echo e(($latestCourses->count() + $latestArticles->count())); ?>,
    "itemListElement": [
      <?php $__currentLoopData = $latestCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      {
        "@type": "Course",
        "position": <?php echo e($index + 1); ?>,
        "name": "<?php echo e($course->title); ?>",
        "description": "<?php echo e(strip_tags($course->short_description ?? $course->description ?? '')); ?>",
        "url": "<?php echo e(route('courses.show', $course)); ?>",
        "provider": {
          "@type": "Organization",
          "name": "Digital Leap Africa"
        },
        "courseMode": "online",
        "educationalLevel": "beginner",
        "inLanguage": "en"
      }<?php if(!$loop->last || $latestArticles->count() > 0): ?>,<?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php $__currentLoopData = $latestArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      {
        "@type": "Article",
        "position": <?php echo e($latestCourses->count() + $index + 1); ?>,
        "headline": "<?php echo e($article->title); ?>",
        "description": "<?php echo e(\Illuminate\Support\Str::limit(strip_tags($article->content ?? ''), 160)); ?>",
        "url": "<?php echo e(route('blog.show', $article)); ?>",
        "author": {
          "@type": "Organization",
          "name": "Digital Leap Africa"
        },
        "publisher": {
          "@type": "Organization",
          "name": "Digital Leap Africa"
        },
        "datePublished": "<?php echo e($article->created_at->toISOString()); ?>"
      }<?php if(!$loop->last): ?>,<?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    ]
  }
}
</script>

<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "SiteNavigationElement",
  "name": "Main Navigation",
  "url": "<?php echo e(url('/')); ?>",
  "hasPart": [
    {
      "@type": "SiteNavigationElement",
      "name": "Home",
      "url": "<?php echo e(route('home')); ?>"
    },
    {
      "@type": "SiteNavigationElement", 
      "name": "About",
      "url": "<?php echo e(route('about')); ?>"
    },
    {
      "@type": "SiteNavigationElement",
      "name": "Courses",
      "url": "<?php echo e(route('courses.index')); ?>"
    },
    {
      "@type": "SiteNavigationElement",
      "name": "Blog",
      "url": "<?php echo e(route('blog.index')); ?>"
    },
    {
      "@type": "SiteNavigationElement",
      "name": "eLibrary",
      "url": "<?php echo e(route('elibrary.index')); ?>"
    }
  ]
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>

<header role="banner" itemscope itemtype="https://schema.org/WPHeader">
<?php
  $heroSlides = $siteSettings['hero_slides'] ?? [];
?>

<?php if(!empty($heroSlides) && is_array($heroSlides)): ?>
<section class="hero-carousel" role="banner" aria-label="Featured content carousel" itemscope itemtype="https://schema.org/ImageGallery">
  <div class="hero-rtl" data-interval="6000">
    <div class="hero-fader">
      <?php $__currentLoopData = $heroSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(($slide['enabled'] ?? true)): ?>
        <div class="fade-slide <?php echo e($i === 0 ? 'is-active' : ''); ?>">
          <?php if(!empty($slide['image'])): ?>
            <img src="<?php echo e($slide['image']); ?>" alt="<?php echo e($slide['title'] ?? 'Hero Slide'); ?>" class="hero-img" width="1920" height="1080" <?php if($i > 0): ?> loading="lazy" <?php endif; ?> fetchpriority="<?php echo e($i === 0 ? 'high' : 'low'); ?>">
          <?php endif; ?>
          <div class="hero-overlay"></div>
          <div class="hero-stars"></div>
          <div class="hero-caption">
            <div class="slide-content">
              <?php if(!empty($slide['mini'])): ?>
                <div class="hero-badge" style="display: inline-flex; align-items: center; gap: 0.5rem; background: rgba(59, 130, 246, 0.2); border: 1px solid rgba(59, 130, 246, 0.4); color: white; padding: 0.75rem 1.5rem; border-radius: 50px; font-size: 0.9rem; font-weight: 600; margin-bottom: 1.5rem; backdrop-filter: blur(10px);">
                  <i class="fas fa-star"></i>
                  <span><?php echo e($slide['mini']); ?></span>
                </div>
              <?php endif; ?>
              
              <?php if(!empty($slide['title'])): ?>
                <h1 class="main-title" style="font-size: 3.5rem; font-weight: 800; color: #fff; margin-bottom: 1rem; line-height: 1.1;" itemprop="headline"><?php echo e($slide['title']); ?></h1>
              <?php endif; ?>
              
              <?php if(!empty($slide['sub'])): ?>
                <p class="hero-text hero-sub" style="font-size: 1.3rem; margin-bottom: 2rem; max-width: 600px; color: #f1f3f5;"><?php echo e($slide['sub']); ?></p>
              <?php endif; ?>
              
              <?php if(!empty($slide['cta1_label']) || !empty($slide['cta2_label'])): ?>
                <div class="cta-buttons" style="display: flex; gap: 1rem; flex-wrap: wrap;">
                  <?php if(!empty($slide['cta1_label']) && !empty($slide['cta1_route'])): ?>
                    <a href="<?php echo e(route($slide['cta1_route'])); ?>" class="btn btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 1rem 2rem; background: linear-gradient(135deg, #00C9FF, #2E78C5); color: white; text-decoration: none; border-radius: 50px; font-weight: 600; transition: all 0.3s ease;">
                      <i class="fas fa-graduation-cap" style="color: white;"></i>
                      <?php echo e($slide['cta1_label']); ?>

                    </a>
                  <?php endif; ?>
                  
                  <?php if(!empty($slide['cta2_label']) && !empty($slide['cta2_route'])): ?>
                    <a href="<?php echo e(route($slide['cta2_route'])); ?>" class="btn btn-outline" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 1rem 2rem; background: transparent; border: 2px solid rgba(255,255,255,0.3); color: white; text-decoration: none; border-radius: 50px; font-weight: 600; transition: all 0.3s ease;">
                      <i class="fas fa-info-circle" style="color: white;"></i>
                      <?php echo e($slide['cta2_label']); ?>

                    </a>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </div>
        <?php endif; ?>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    
    
    <?php if(count($heroSlides) > 1): ?>
      <div style="position: absolute; bottom: 2rem; left: 50%; transform: translateX(-50%); display: flex; gap: 0.75rem; z-index: 10;">
        <?php $__currentLoopData = $heroSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <button class="hero-dot <?php echo e($i === 0 ? 'is-active' : ''); ?>" data-index="<?php echo e($i); ?>" 
                  style="width: 12px; height: 12px; border-radius: 50%; border: 2px solid rgba(255,255,255,0.6); background: <?php echo e($i === 0 ? '#64b5f6' : 'rgba(255,255,255,0.6)'); ?>; cursor: pointer; transition: all 0.3s ease;"></button>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php endif; ?>
  </div>
</section>
<?php else: ?>
<!-- Fallback Static Hero Section -->
<section class="hero-section" role="banner" aria-label="Welcome section" itemscope itemtype="https://schema.org/WebPageElement">
    <div class="hero-background">
        <div class="hero-overlay"></div>
        <div class="floating-elements">
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
            <div class="floating-element"></div>
        </div>
    </div>
    
    <div class="hero-content">
        <div class="container">
            <div class="hero-text-content">
                <div class="hero-badge">
                    <i class="fas fa-users"></i>
                    <span>Empowering African Youth</span>
                </div>
                
                <h1 class="hero-title" itemprop="headline">
                    Welcome to <span class="gradient-text">Digital Leap Africa</span>
                </h1>
                
                <p class="hero-description">
                    Empowering learners across Africa with courses, projects, jobs, events, and a vibrant community.
                </p>
                
                <div class="hero-actions">
                    <a href="<?php echo e(route('courses.index')); ?>" class="btn-primary hero-btn">
                        <i class="fas fa-graduation-cap"></i>
                        <span>Browse Courses</span>
                    </a>
                    <a href="<?php echo e(route('elibrary.index')); ?>" class="btn-outline hero-btn">
                        <i class="fas fa-book-open"></i>
                        <span>Visit eLibrary</span>
                    </a>
                    <a href="<?php echo e(route('about')); ?>" class="btn-outline hero-btn">
                        <i class="fas fa-info-circle"></i>
                        <span>About Us</span>
                    </a>
                    <a href="<?php echo e(route('contact')); ?>" class="btn-outline hero-btn">
                        <i class="fas fa-envelope"></i>
                        <span>Contact</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
</header>

<!-- Stats Section -->
<section class="stats-section" role="region" aria-labelledby="stats-heading" itemscope itemtype="https://schema.org/AboutPage">
    <h2 id="stats-heading" class="sr-only">Platform Statistics</h2>
    <div class="container">
        <div class="stats-grid">
            <?php
                $statsData = [
                    ['label' => 'Courses', 'value' => $stats['courses'], 'icon' => 'fa-book-open'],
                    ['label' => 'Articles', 'value' => $stats['articles'], 'icon' => 'fa-diagram-project'],
                    ['label' => 'Partners', 'value' => $stats['partners'], 'icon' => 'fa-handshake'],
                    ['label' => 'Members', 'value' => $stats['members'], 'icon' => 'fa-users'],
                ];
            ?>
            
            <?php $__currentLoopData = $statsData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="stat-card" itemscope itemtype="https://schema.org/QuantitativeValue">
                    <div style="font-size:1.25rem;color:var(--cyan-accent);margin-bottom:.25rem;">
                        <i class="fa-solid <?php echo e($stat['icon']); ?>"></i>
                    </div>
                    <div class="stat-value" itemprop="value"><?php echo e(number_format($stat['value'])); ?></div>
                    <div class="stat-label" itemprop="name"><?php echo e($stat['label']); ?></div>
                    <meta itemprop="unitText" content="count">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<style>
/* Screen reader only class for accessibility */
.sr-only {
    position: absolute !important;
    width: 1px !important;
    height: 1px !important;
    padding: 0 !important;
    margin: -1px !important;
    overflow: hidden !important;
    clip: rect(0, 0, 0, 0) !important;
    white-space: nowrap !important;
    border: 0 !important;
}

/* Modern Hero Section */
.hero-section {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
}

.hero-background {
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, #0C121C 0%, #1E293B 50%, #0F172A 100%);
    z-index: 1;
}

.hero-overlay {
    position: absolute;
    inset: 0;
    background: radial-gradient(circle at 30% 40%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 70% 60%, rgba(0, 201, 255, 0.1) 0%, transparent 50%);
    z-index: 2;
}

.floating-elements {
    position: absolute;
    inset: 0;
    pointer-events: none;
    z-index: 2;
}

.floating-element {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.2), rgba(0, 201, 255, 0.1));
    animation: float 8s ease-in-out infinite;
}

.floating-element:nth-child(1) {
    width: 120px;
    height: 120px;
    top: 15%;
    left: 10%;
    animation-delay: 0s;
}

.floating-element:nth-child(2) {
    width: 80px;
    height: 80px;
    top: 60%;
    right: 15%;
    animation-delay: 2s;
}

.floating-element:nth-child(3) {
    width: 60px;
    height: 60px;
    bottom: 20%;
    left: 20%;
    animation-delay: 4s;
}

.floating-element:nth-child(4) {
    width: 100px;
    height: 100px;
    top: 30%;
    right: 30%;
    animation-delay: 6s;
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-30px) rotate(180deg); }
}

.hero-content {
    position: relative;
    z-index: 10;
    width: 100%;
    padding: 2rem 0;
}

.hero-text-content {
    max-width: 800px;
    text-align: center;
    margin: 0 auto;
}

.hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.3);
    color: var(--cyan-accent);
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 2rem;
    backdrop-filter: blur(10px);
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { box-shadow: 0 0 0 0 rgba(59, 130, 246, 0.4); }
    50% { box-shadow: 0 0 0 10px rgba(59, 130, 246, 0); }
}

.hero-title {
    font-size: 4rem;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 1.5rem;
    color: var(--diamond-white);
}

.gradient-text {
    background: linear-gradient(135deg, var(--cyan-accent), var(--purple-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.hero-description {
    font-size: 1.25rem;
    line-height: 1.6;
    color: var(--cool-gray);
    margin-bottom: 3rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.hero-actions {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
    justify-content: center;
    max-width: 900px;
    margin: 0 auto;
}

.hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    padding: 1rem 2rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.hero-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: left 0.5s;
}

.hero-btn:hover::before {
    left: 100%;
}

.hero-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
}

/* Stats Section */
.stats-section {
    padding: 4rem 0;
    background: rgba(255, 255, 255, 0.02);
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.stat-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--accent-color), transparent);
    transition: all 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-10px);
    background: rgba(255, 255, 255, 0.08);
    border-color: var(--accent-color);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
}

.stat-card:hover::before {
    height: 100%;
    opacity: 0.1;
}

.stat-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1.5rem;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: inherit;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.stat-value {
    font-size: 3rem;
    font-weight: 800;
    color: var(--diamond-white);
    margin-bottom: 0.5rem;
    line-height: 1;
}

.stat-label {
    font-size: 1.1rem;
    color: var(--cool-gray);
    font-weight: 500;
}

/* Color Variants - Removed */

/* Light Mode Styles */
[data-theme="light"] .hero-background {
    background: linear-gradient(135deg, #F8FAFC 0%, #E2E8F0 50%, #F1F5F9 100%);
}

[data-theme="light"] .hero-overlay {
    background: radial-gradient(circle at 30% 40%, rgba(46, 120, 197, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 70% 60%, rgba(0, 201, 255, 0.08) 0%, transparent 50%);
}

[data-theme="light"] .hero-title {
    color: var(--charcoal);
}

[data-theme="light"] .hero-description {
    color: var(--cool-gray);
}

[data-theme="light"] .hero-badge {
    background: rgba(46, 120, 197, 0.1);
    border-color: rgba(46, 120, 197, 0.3);
    color: var(--primary-blue);
}

[data-theme="light"] .stats-section {
    background: rgba(46, 120, 197, 0.02);
    border-top-color: rgba(46, 120, 197, 0.1);
}

[data-theme="light"] .stat-card {
    background: #FFFFFF;
    border-color: rgba(46, 120, 197, 0.15);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .stat-card:hover {
    background: #FFFFFF;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

[data-theme="light"] .stat-value {
    color: var(--charcoal);
}

/* Section Styles */
.articles-section,
.courses-section {
    padding: 6rem 0;
    position: relative;
}

.articles-section {
    background: rgba(255, 255, 255, 0.02);
}

.courses-section {
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05) 0%, rgba(0, 201, 255, 0.03) 100%);
}

.section-header {
    text-align: center;
    margin-bottom: 4rem;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.section-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: rgba(59, 130, 246, 0.1);
    border: 1px solid rgba(59, 130, 246, 0.2);
    color: var(--cyan-accent);
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.9rem;
    font-weight: 600;
    margin-bottom: 1rem;
}

.section-title {
    font-size: 3rem;
    font-weight: 800;
    color: var(--diamond-white);
    margin-bottom: 1rem;
    line-height: 1.2;
}

.section-description {
    font-size: 1.1rem;
    color: var(--cool-gray);
    line-height: 1.6;
}

/* Articles Grid */
.articles-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.article-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 20px;
    overflow: hidden;
    transition: all 0.4s ease;
    position: relative;
}

.article-card:hover {
    transform: translateY(-10px);
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(59, 130, 246, 0.3);
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
}

.article-image {
    position: relative;
    height: 220px;
    overflow: hidden;
}

.article-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.article-card:hover .article-image img {
    transform: scale(1.05);
}

.article-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--purple-accent), var(--cyan-accent));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: white;
}

.article-category {
    position: absolute;
    top: 1rem;
    left: 1rem;
    background: rgba(59, 130, 246, 0.9);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 15px;
    font-size: 0.8rem;
    font-weight: 600;
    backdrop-filter: blur(10px);
}

.article-content {
    padding: 2rem;
}

.article-meta {
    display: flex;
    gap: 1rem;
    margin-bottom: 1rem;
    font-size: 0.9rem;
    color: var(--cool-gray);
}

.article-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: var(--diamond-white);
    margin-bottom: 1rem;
    line-height: 1.3;
}

.article-excerpt {
    color: var(--cool-gray);
    line-height: 1.6;
    margin-bottom: 1.5rem;
}

.article-link {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--cyan-accent);
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
}

.article-link:hover {
    gap: 1rem;
    color: var(--purple-accent);
}

/* Courses List */
.courses-list {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.course-horizontal-card {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    transition: all 0.3s ease;
    min-height: 160px;
}

.course-horizontal-card:hover {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(0, 201, 255, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
}

.course-image-wrapper {
    flex: 0 0 200px;
    position: relative;
    overflow: hidden;
}

.course-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.course-horizontal-card:hover .course-img {
    transform: scale(1.02);
}

.course-img-placeholder {
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: white;
}

.course-details {
    flex: 1;
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.course-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 0.75rem;
}

.course-name {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--diamond-white);
    margin: 0;
    line-height: 1.3;
    flex: 1;
    margin-right: 1rem;
}

.course-price {
    padding: 0.4rem 0.8rem;
    border-radius: 12px;
    font-size: 0.85rem;
    font-weight: 600;
    white-space: nowrap;
}

.course-price.free {
    background: rgba(16, 185, 129, 0.2);
    color: #10b981;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.course-price.premium {
    background: rgba(245, 158, 11, 0.2);
    color: #f59e0b;
    border: 1px solid rgba(245, 158, 11, 0.3);
}

.course-info {
    display: flex;
    gap: 1.5rem;
    margin-bottom: 0.75rem;
    font-size: 0.9rem;
    color: var(--cool-gray);
}

.course-lessons,
.course-instructor {
    display: flex;
    align-items: center;
    gap: 0.4rem;
}

.course-description {
    color: var(--cool-gray);
    line-height: 1.5;
    margin-bottom: 1rem;
    font-size: 0.95rem;
}

.course-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, var(--cyan-accent), var(--primary-blue));
    color: white;
    padding: 0.6rem 1.2rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    align-self: flex-start;
}

.course-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 201, 255, 0.3);
    gap: 0.75rem;
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    color: var(--cool-gray);
}

.empty-icon {
    width: 100px;
    height: 100px;
    margin: 0 auto 2rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: var(--cyan-accent);
}

.empty-state h3 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
    color: var(--diamond-white);
}

/* Section Footer */
.section-footer {
    text-align: center;
}

.btn-outline-large {
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 2.5rem;
    background: transparent;
    border: 2px solid var(--cyan-accent);
    color: var(--cyan-accent);
    border-radius: 50px;
    font-weight: 600;
    font-size: 1.1rem;
    text-decoration: none;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.btn-outline-large::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: var(--cyan-accent);
    transition: left 0.3s ease;
    z-index: -1;
}

.btn-outline-large:hover::before {
    left: 0;
}

.btn-outline-large:hover {
    color: var(--charcoal);
    transform: translateY(-3px);
    box-shadow: 0 10px 30px rgba(0, 201, 255, 0.3);
}

/***** Hero Carousel *****/
.hero-carousel { width: 100%; }

.hero-slide {
  position: relative;
  width: 100%;
  height: min(75vh, 720px);
  min-height: 420px;
}

.hero-img {
  position: absolute;
  inset: 0;
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.hero-overlay {
  position: absolute;
  inset: 0;
  background: rgba(0,0,0,0.65);
}

[data-theme="light"] .hero-overlay {
  background: rgba(0,0,0,0.75);
}

.hero-caption {
  position: absolute;
  left: 5%;
  right: 5%;
  bottom: 8%;
  text-align: center;
  padding: 0;
  z-index: 5;
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100%;
}

.slide-content {
  max-width: 800px;
  margin: 0 auto;
}

@media (max-width: 768px) {
  .hero-caption {
    text-align: left;
    align-items: flex-end;
    height: auto;
    bottom: 8%;
  }
  .slide-content {
    max-width: 100%;
  }
}

.hero-caption h1 { color: #fff; }
.hero-sub { max-width: 760px; color: #f1f3f5; }

/* Light mode hero text */
[data-theme="light"] .hero-caption h1 { color: #fff; text-shadow: 2px 2px 4px rgba(0,0,0,0.8); }
[data-theme="light"] .hero-sub { color: #f1f3f5; text-shadow: 1px 1px 3px rgba(0,0,0,0.7); }
[data-theme="light"] .hero-badge { color: white !important; text-shadow: 1px 1px 2px rgba(0,0,0,0.6); }
[data-theme="light"] .main-title { color: #fff !important; text-shadow: 2px 2px 4px rgba(0,0,0,0.8); }
[data-theme="light"] .hero-text { color: #f1f3f5 !important; text-shadow: 1px 1px 3px rgba(0,0,0,0.7); }

/* Fade slider */
.fade-slide{opacity:0;transition:opacity .8s ease;}
.fade-slide.is-active{opacity:1}
/* Ensure hero reserves height */
.hero-rtl{position:relative; height: 100vh; min-height:100vh}
.hero-fader{position:relative; width:100%; height:100%}
.hero-stars{position:absolute;inset:0;pointer-events:none;z-index:3;opacity:0;transition:opacity .6s ease;background-image:
  radial-gradient(2px 2px at 20% 30%, rgba(255,255,255,.9) 40%, transparent 41%),
  radial-gradient(1.5px 1.5px at 60% 20%, rgba(255,255,255,.8) 40%, transparent 41%),
  radial-gradient(2.5px 2.5px at 80% 70%, rgba(255,255,255,.85) 40%, transparent 41%),
  radial-gradient(1.2px 1.2px at 35% 75%, rgba(255,255,255,.7) 40%, transparent 41%),
  radial-gradient(1.8px 1.8px at 70% 55%, rgba(255,255,255,.75) 40%, transparent 41%);
animation: twinkle 2s infinite ease-in-out;
}
.hero-rtl.is-transitioning .hero-stars{opacity:.85}
@keyframes twinkle{0%,100%{filter:brightness(1)}50%{filter:brightness(1.6)}}

@media (max-width: 768px) {
  .hero-slide { height: 80vh; min-height: 360px; }
  .hero-rtl, .hero-fader { height:80vh; min-height:360px }
  .hero-caption { bottom: 6%; text-align: left; align-items: flex-end; height: auto; }
  .hero-caption h1 { font-size: 1.75rem; }
}

/* Light Mode Styles */
[data-theme="light"] .articles-section {
    background: rgba(46, 120, 197, 0.02);
}

[data-theme="light"] .courses-section {
    background: linear-gradient(135deg, rgba(46, 120, 197, 0.05) 0%, rgba(0, 201, 255, 0.03) 100%);
}

[data-theme="light"] .section-title {
    color: var(--charcoal);
}

[data-theme="light"] .section-badge {
    background: rgba(46, 120, 197, 0.1);
    border-color: rgba(46, 120, 197, 0.2);
    color: var(--primary-blue);
}

[data-theme="light"] .article-card,
[data-theme="light"] .course-horizontal-card {
    background: #FFFFFF;
    border-color: rgba(46, 120, 197, 0.15);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .article-card:hover,
[data-theme="light"] .course-horizontal-card:hover {
    background: #FFFFFF;
    border-color: rgba(46, 120, 197, 0.3);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

[data-theme="light"] .article-title,
[data-theme="light"] .course-name {
    color: var(--charcoal);
}

[data-theme="light"] .article-link {
    color: var(--primary-blue);
}

[data-theme="light"] .article-link:hover {
    color: var(--deep-blue);
}

[data-theme="light"] .course-price.free {
    background: rgba(16, 185, 129, 0.15);
    color: #059669;
}

[data-theme="light"] .course-price.premium {
    background: rgba(245, 158, 11, 0.15);
    color: #d97706;
}

[data-theme="light"] .empty-state {
    color: var(--cool-gray);
}

[data-theme="light"] .empty-state h3 {
    color: var(--charcoal);
}

[data-theme="light"] .empty-icon {
    background: rgba(46, 120, 197, 0.1);
    color: var(--primary-blue);
}

[data-theme="light"] .btn-outline-large {
    border-color: var(--primary-blue);
    color: var(--primary-blue);
}

[data-theme="light"] .btn-outline-large::before {
    background: var(--primary-blue);
}

[data-theme="light"] .btn-outline-large:hover {
    color: white;
    box-shadow: 0 10px 30px rgba(46, 120, 197, 0.3);
}

/* Responsive Design */
@media (max-width: 1024px) {
    .hero-title {
        font-size: 3.5rem;
    }
    
    .stats-grid {
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.5rem;
    }
    
    .section-title {
        font-size: 2.5rem;
    }
    
    .articles-grid {
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }
    
    .course-horizontal-card {
        flex-direction: column;
        min-height: auto;
    }
    
    .course-image-wrapper {
        flex: none;
        height: 180px;
    }
    
    .course-details {
        padding: 1.25rem;
    }
}

@media (max-width: 768px) {
    .hero-section {
        min-height: 80vh;
        padding: 2rem 0;
    }
    
    .hero-title {
        font-size: 2.5rem;
    }
    
    .hero-description {
        font-size: 1.1rem;
    }
    
    .hero-actions {
        grid-template-columns: 1fr;
        max-width: 300px;
    }
    
    .hero-btn {
        width: 100%;
        max-width: 300px;
        justify-content: center;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }
    
    .stat-card {
        padding: 1.5rem;
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .stat-value {
        font-size: 2rem;
    }
    
    .articles-section,
    .courses-section {
        padding: 4rem 0;
    }
    
    .section-header {
        margin-bottom: 3rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .section-description {
        font-size: 1rem;
    }
    
    .articles-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .course-horizontal-card {
        flex-direction: column;
    }
    
    .course-image-wrapper {
        height: 160px;
    }
    
    .course-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .course-name {
        margin-right: 0;
        font-size: 1.1rem;
    }
    
    .course-info {
        gap: 1rem;
    }
    
    .article-content,
    .course-content {
        padding: 1.5rem;
    }
    
    .article-image,
    .course-image {
        height: 180px;
    }
    
    .btn-outline-large {
        padding: 0.875rem 2rem;
        font-size: 1rem;
    }
}

@media (max-width: 480px) {
    .hero-title {
        font-size: 2rem;
    }
    
    .hero-description {
        font-size: 1rem;
    }
    
    .hero-badge {
        padding: 0.5rem 1rem;
        font-size: 0.8rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
    
    .stat-value {
        font-size: 1.75rem;
    }
    
    .section-title {
        font-size: 1.75rem;
    }
    
    .section-badge {
        padding: 0.4rem 0.8rem;
        font-size: 0.8rem;
    }
    
    .article-content,
    .course-content {
        padding: 1.25rem;
    }
    
    .article-title,
    .course-title {
        font-size: 1.2rem;
    }
    
    .empty-state {
        padding: 3rem 1rem;
    }
    
    .empty-icon {
        width: 80px;
        height: 80px;
        font-size: 2rem;
    }
}
</style>



<!-- About, Mission & Vision, Stats -->
<?php
  $aboutText   = $siteSettings['about_us'] ?? $siteSettings['about'] ?? '';
  $missionText = $siteSettings['mission'] ?? '';
  $visionText  = $siteSettings['vision'] ?? '';

  $stats = [
    ['label'=>'Courses',  'value'=> \App\Models\Course::count(),  'icon'=>'fa-book-open'],
    ['label'=>'Articles', 'value'=> \App\Models\Article::count(), 'icon'=>'fa-newspaper'],
    ['label'=>'Partners', 'value'=> \App\Models\Partner::count(), 'icon'=>'fa-handshake'],
    ['label'=>'Members',  'value'=> \App\Models\User::count(),    'icon'=>'fa-users'],
  ];
?>


<?php
  $about = \App\Models\AboutSection::where('section_type', 'about')->active()->first();
?>

<?php if($about): ?>
<section id="about-section" class="section" role="region" aria-labelledby="about-heading" itemscope itemtype="https://schema.org/AboutPage" style="padding:2.5rem 0;">
  <div class="container">
    <h2 id="about-heading" class="sr-only">About Digital Leap Africa</h2>
  <style>
      :root {
          --dark-blue: #0a1f3a;
          --medium-blue: #1a3a5f;
          --light-blue: #2a4a7a;
          --accent: #4a7fc8;
          --accent-light: #6ba1e6;
          --text-light: #f0f4f8;
          --text-muted: #a8c2e0;
      }
      
      #about-section .about-card {
          background: rgba(255, 255, 255, 0.03);
          border-radius: 16px;
          overflow: hidden;
          box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
          transition: transform 0.3s ease, box-shadow 0.3s ease;
          border: 1px solid rgba(255, 255, 255, 0.1);
          width: 100%;
          position: relative;
          display: flex;
          flex-direction: row;
          min-height: 400px;
          margin: 0 auto;
      }
      
      #about-section .about-card:hover {
          transform: translateY(-5px);
          box-shadow: 0 12px 35px rgba(0, 0, 0, 0.4);
      }
      
      #about-section .about-card-image-section {
          width: 40%;
          position: relative;
          display: flex;
      }
      
      #about-section .about-card-image {
          flex: 1;
          background-color: var(--medium-blue);
          display: flex;
          align-items: center;
          justify-content: center;
          overflow: hidden;
          position: relative;
      }
      
      #about-section .about-card-image img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          transition: transform 0.7s ease;
      }
      
      #about-section .about-card:hover .about-card-image img {
          transform: scale(1.05);
      }
      
      #about-section .about-image-overlay {
          position: absolute;
          bottom: 0;
          left: 0;
          right: 0;
          background: linear-gradient(to top, rgba(10, 31, 58, 0.85), transparent);
          padding: 25px 20px 15px;
          color: white;
          display: flex;
          align-items: center;
          gap: 10px;
      }
      
      #about-section .about-icon-circle {
          width: 50px;
          height: 50px;
          border-radius: 50%;
          background: rgba(255, 255, 255, 0.15);
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 1.3rem;
          color: var(--accent-light);
          flex-shrink: 0;
      }
      
      #about-section .about-overlay-text {
          font-size: 0.95rem;
          line-height: 1.4;
      }
      
      #about-section .about-card-content-section {
          width: 60%;
          display: flex;
          flex-direction: column;
      }
      
      #about-section .about-card-header {
          padding: 30px 30px 20px;
          position: relative;
      }
      
      #about-section .about-mini-title {
          font-size: 0.85rem;
          text-transform: uppercase;
          letter-spacing: 1.5px;
          color: var(--accent);
          margin-bottom: 12px;
          font-weight: 600;
          display: inline-block;
          padding: 5px 15px;
          background: rgba(74, 127, 200, 0.15);
          border-radius: 20px;
      }
      
      #about-section .about-title {
          font-size: 1.8rem;
          font-weight: 700;
          margin-bottom: 12px;
          background: linear-gradient(to right, #ffffff, #a8c2e0);
          -webkit-background-clip: text;
          background-clip: text;
          color: transparent;
          line-height: 1.2;
      }
      
      #about-section .about-tagline {
          font-size: 1.05rem;
          color: var(--text-muted);
          margin-bottom: 5px;
          font-style: italic;
      }
      
      #about-section .about-card-content {
          padding: 0 30px 20px;
          color: var(--text-light);
          flex-grow: 1;
          display: flex;
          flex-direction: column;
          justify-content: space-between;
      }
      
      #about-section .about-card-content p {
          margin-bottom: 25px;
          font-size: 1rem;
          line-height: 1.6;
      }
      
      #about-section .about-bullets {
          margin-top: 5px;
          list-style: none;
          padding: 0;
      }
      
      #about-section .about-bullets li {
          margin-bottom: 15px;
          position: relative;
          padding-left: 35px;
          display: flex;
          align-items: flex-start;
      }
      
      #about-section .about-bullets li:before {
          content: "";
          position: absolute;
          left: 0;
          top: 3px;
          width: 22px;
          height: 22px;
          background: rgba(74, 127, 200, 0.2);
          border-radius: 50%;
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 0.8rem;
          color: var(--accent);
          font-weight: bold;
      }
      
      #about-section .about-bullets li:nth-child(1):before { content: "1"; }
      #about-section .about-bullets li:nth-child(2):before { content: "2"; }
      #about-section .about-bullets li:nth-child(3):before { content: "3"; }
      #about-section .about-bullets li:nth-child(4):before { content: "4"; }
      
      #about-section .about-bullet-text {
          flex: 1;
      }
      
      #about-section .about-bullet-title {
          font-weight: 600;
          color: var(--accent-light);
          margin-bottom: 3px;
          font-size: 0.95rem;
      }
      
      #about-section .about-card-footer {
          padding: 20px 30px;
          background: rgba(10, 31, 58, 0.6);
          border-top: 1px solid rgba(74, 127, 200, 0.2);
          display: flex;
          justify-content: flex-end;
          align-items: center;
      }
      
      #about-section .about-btn {
          background: linear-gradient(to right, var(--accent), var(--accent-light));
          color: white;
          border: none;
          padding: 10px 22px;
          border-radius: 30px;
          font-size: 0.95rem;
          font-weight: 600;
          cursor: pointer;
          transition: all 0.3s ease;
          display: flex;
          align-items: center;
          gap: 8px;
          text-decoration: none;
      }
      
      #about-section .about-btn:hover {
          transform: translateY(-3px);
          box-shadow: 0 7px 15px rgba(74, 127, 200, 0.4);
      }
      
      #about-section .about-btn i {
          font-size: 0.9rem;
      }
      
      #about-section .about-mobile-header {
          display: none;
          padding: 25px 25px 15px;
          text-align: center;
      }
      
      @media (max-width: 900px) {
          #about-section .about-card {
              flex-direction: column;
              max-width: 500px;
              min-height: auto;
          }
          
          #about-section .about-card-image-section,
          #about-section .about-card-content-section {
              width: 100%;
          }
          
          #about-section .about-card-image {
              height: 250px;
          }
          
          #about-section .about-card-header {
              display: none;
          }
          
          #about-section .about-mobile-header {
              display: block;
          }
          
          #about-section .about-card-content {
              padding: 20px 25px;
          }
      }
      
      @media (max-width: 480px) {
          #about-section .about-mobile-header,
          #about-section .about-card-content {
              padding-left: 20px;
              padding-right: 20px;
          }
          
          #about-section .about-title {
              font-size: 1.6rem;
          }
          
          #about-section .about-mobile-header .about-title {
              font-size: 1.7rem;
          }
      }

      /* Light Mode */
      [data-theme="light"] #about-section .about-card {
          background: linear-gradient(145deg, #FFFFFF, #F8FAFC);
          border-color: var(--primary-blue);
          box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
      }
      [data-theme="light"] #about-section .about-card:hover {
          box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
      }
      [data-theme="light"] #about-section .about-card::before {
          background: linear-gradient(90deg, var(--primary-blue), var(--cyan-accent));
      }
      [data-theme="light"] #about-section .about-mini-title {
          color: var(--primary-blue);
          background: rgba(46, 120, 197, 0.15);
      }
      [data-theme="light"] #about-section .about-title {
          background: linear-gradient(to right, var(--primary-blue), var(--deep-blue));
          -webkit-background-clip: text;
          background-clip: text;
          color: transparent;
      }
      [data-theme="light"] #about-section .about-tagline,
      [data-theme="light"] #about-section .about-card-content p {
          color: var(--cool-gray);
      }
      [data-theme="light"] #about-section .about-bullet-title {
          color: var(--primary-blue);
      }
      [data-theme="light"] #about-section .about-bullets li:before {
          background: rgba(46, 120, 197, 0.2);
          color: var(--primary-blue);
      }
    </style>
  
      <div class="about-card fade-in-up">
          <!-- Mobile header (only visible on small screens) -->
          <div class="about-mobile-header">
              <div class="about-mini-title"><?php echo e($about->mini_title ?? 'Our Approach'); ?></div>
              <h1 class="about-title"><?php echo e($about->title); ?></h1>
          </div>
          
          <div class="about-card-image-section">
              <div class="about-card-image">
                  <?php if($about->image_url): ?>
                      <img src="<?php echo e($about->image_url); ?>" alt="<?php echo e($about->title); ?>" loading="lazy" fetchpriority="low">
                  <?php else: ?>
                      <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="<?php echo e($about->title); ?>" loading="lazy" fetchpriority="low">
                  <?php endif; ?>
                  <div class="about-image-overlay">
                      <div class="about-icon-circle">
                          <i class="fas fa-graduation-cap"></i>
                      </div>
                      <div class="about-overlay-text">
                          Empowering African youth through technology and education
                      </div>
                  </div>
              </div>
          </div>
          
          <div class="about-card-content-section">
              <!-- Desktop header (hidden on mobile) -->
              <div class="about-card-header">
                  <div class="about-mini-title"><?php echo e($about->mini_title ?? 'Our Approach'); ?></div>
                  <h1 class="about-title"><?php echo e($about->title); ?></h1>
              </div>
              
              <div class="about-card-content">
                  <div>
                      <p><?php echo nl2br(e($about->content)); ?></p>
                      
                      <?php if(!empty($about->bullet_points) && is_array($about->bullet_points)): ?>
                      <ul class="about-bullets">
                          <?php $__currentLoopData = $about->bullet_points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <li>
                              <div class="about-bullet-text">
                                  <div class="about-bullet-title"><?php echo e($bp); ?></div>
                              </div>
                          </li>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                      </ul>
                      <?php endif; ?>
                  </div>
              </div>
              
              <div class="about-card-footer">
                  <a href="<?php echo e(route('about')); ?>" class="about-btn">
                      <span>Learn More</span>
                      <i class="fas fa-arrow-right"></i>
                  </a>
              </div>
          </div>
      </div>
  </div>
</section>
<?php endif; ?>






 

<!-- Latest Articles -->
<section class="articles-section" itemscope itemtype="https://schema.org/ItemList" aria-labelledby="articles-heading">
    <div class="container">
        <div class="section-title" style="text-align:center; margin-bottom: 2rem;">
            <h2 id="articles-heading" style="font-weight: 700; color: #64b5f6; font-size: 1.5rem; margin-bottom: 0.5rem;"><i class="fas fa-newspaper" aria-hidden="true"></i> Latest Articles</h2>
            <p style="color: var(--cool-gray); font-size: 1rem;">Stay updated with the latest insights, tutorials, and industry trends</p>
        </div>

        <?php
            $pickImage = function($article) {
                return $article->featured_image_url
                    ?? $article->image_url
                    ?? $article->cover_image
                    ?? $article->thumbnail
                    ?? $article->featured_image
                    ?? null;
            };
        ?>

        <?php if($latestArticles->count()): ?>
            <div class="articles-grid">
                <?php $__currentLoopData = $latestArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $image = $pickImage($post);
                        $title = $post->title ?? 'Untitled';
                        $excerpt = method_exists($post, 'getExcerptAttribute')
                            ? $post->excerpt
                            : (\Illuminate\Support\Str::limit(strip_tags($post->content ?? $post->body ?? ''), 120));
                        $readMinutes = max(1, ceil(str_word_count(strip_tags($post->content ?? $post->body ?? ''))/200));
                        $category = $post->category_name ?? $post->category ?? null;
                        $dateText = !empty($post->created_at) ? $post->created_at->format('M j, Y') : null;
                    ?>

                    <article class="article-card" itemscope itemtype="https://schema.org/Article" itemprop="itemListElement">
                        <div class="article-image">
                            <?php if($image): ?>
                                <img src="<?php echo e($image); ?>" alt="<?php echo e($title); ?> - Digital Leap Africa Article" itemprop="image" width="400" height="220" loading="lazy" fetchpriority="low">
                            <?php else: ?>
                                <div class="article-placeholder">
                                    <i class="fas fa-newspaper"></i>
                                </div>
                            <?php endif; ?>
                            <?php if($category): ?>
                                <div class="article-category"><?php echo e($category); ?></div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="article-content">
                            <div class="article-meta">
                                <span class="read-time">
                                    <i class="far fa-clock"></i>
                                    <?php echo e($readMinutes); ?> min read
                                </span>
                                <?php if($dateText): ?>
                                    <span class="article-date">
                                        <i class="far fa-calendar"></i>
                                        <?php echo e($dateText); ?>

                                    </span>
                                <?php endif; ?>
                            </div>
                            
                            <h3 class="article-title" itemprop="headline"><?php echo e($title); ?></h3>
                            <p class="article-excerpt" itemprop="description"><?php echo e($excerpt); ?></p>
                            <meta itemprop="datePublished" content="<?php echo e($post->created_at?->toISOString()); ?>">
                            <meta itemprop="author" content="Digital Leap Africa">
                            
                            <a href="<?php echo e(route('blog.show', $post)); ?>" class="article-link">
                                <span>Read Article</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h3>No Articles Yet</h3>
                <p>Stay tuned for exciting content coming soon!</p>
            </div>
        <?php endif; ?>

        <div class="section-footer">
            <a href="<?php echo e(route('blog.index')); ?>" class="btn-outline-large">
                <span>View All Articles</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>







<!-- Available Courses -->
<section class="courses-section" itemscope itemtype="https://schema.org/ItemList" aria-labelledby="courses-heading">
    <div class="container">
        <div class="section-title" style="text-align:center; margin-bottom: 2rem;">
            <h2 id="courses-heading" style="font-weight: 700; color: #64b5f6; font-size: 2rem; margin-bottom: 0.5rem;"><i class="fas fa-graduation-cap" aria-hidden="true"></i> Available Courses</h2>
            <p style="color: var(--cool-gray); font-size: 1rem;">Master new skills with our expert-led courses designed for African learners</p>
        </div>

        <?php
            $pickCourseImage = function($course) {
                return $course->image_url_full ?? $course->image_url
                    ?? $course->thumbnail
                    ?? $course->cover_image
                    ?? $course->banner_image
                    ?? null;
            };
        ?>

        <?php if($latestCourses->count()): ?>
            <div class="courses-list">
                <?php $__currentLoopData = $latestCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $courseImage = $pickCourseImage($course);
                        $courseTitle = $course->title ?? 'Untitled';
                        $courseExcerpt = \Illuminate\Support\Str::limit(strip_tags($course->short_description ?? $course->description ?? $course->summary ?? ''), 120);
                        $showUrl = route('courses.show', $course);
                        $lessonsCount = $course->lessons_count ?? 0;
                        $courseType = $course->is_free ? 'Free' : 'Premium';
                        $coursePrice = $course->price ?? 0;
                    ?>

                    <div class="course-horizontal-card" itemscope itemtype="https://schema.org/Course" itemprop="itemListElement">
                        <div class="course-image-wrapper">
                            <?php if($courseImage): ?>
                                <img src="<?php echo e($courseImage); ?>" alt="<?php echo e($courseTitle); ?> - Online Course at Digital Leap Africa" class="course-img" itemprop="image" width="200" height="160" loading="lazy" fetchpriority="low">
                            <?php else: ?>
                                <div class="course-img-placeholder">
                                    <i class="fas fa-graduation-cap"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="course-details">
                            <div class="course-header">
                                <h3 class="course-name" itemprop="name"><?php echo e($courseTitle); ?></h3>
                                <meta itemprop="description" content="<?php echo e($courseExcerpt); ?>">
                                <meta itemprop="provider" content="Digital Leap Africa">
                                <?php if(!$course->is_free && $coursePrice > 0): ?>
                                    <meta itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                    <meta itemprop="price" content="<?php echo e($coursePrice); ?>">
                                    <meta itemprop="priceCurrency" content="KES">
                                <?php endif; ?>
                                <div class="course-price <?php echo e($course->is_free ? 'free' : 'premium'); ?>">
                                    <?php if(!$course->is_free && $coursePrice > 0): ?>
                                        KES <?php echo e(number_format($coursePrice)); ?>

                                    <?php else: ?>
                                        <?php echo e($courseType); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <div class="course-info">
                                <span class="course-lessons">
                                    <i class="fas fa-play-circle"></i>
                                    <?php echo e($lessonsCount); ?> lessons
                                </span>
                                <span class="course-instructor">
                                    <i class="fas fa-user"></i>
                                    <?php echo e($course->instructor ?? 'Instructor'); ?>

                                </span>
                            </div>
                            
                            <p class="course-description"><?php echo e($courseExcerpt); ?></p>
                            
                            <a href="<?php echo e($showUrl); ?>" class="course-btn">
                                View Course
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php else: ?>
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h3>No Courses Available</h3>
                <p>New courses are being prepared. Check back soon!</p>
            </div>
        <?php endif; ?>

        <div class="section-footer">
            <a href="<?php echo e(route('courses.index')); ?>" class="btn-outline-large">
                <span>View All Courses</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<!-- Testimonials Carousel -->
<section id="testimonials-section" role="region" aria-labelledby="testimonials-heading" itemscope itemtype="https://schema.org/ItemList" style="padding:3rem 0; background: rgba(255, 255, 255, 0.02);">
  <div class="container">
    <div class="section-title" style="text-align:center; margin-bottom: 2rem;">
      <h2 id="testimonials-heading" style="font-weight: 700; color: #64b5f6; font-size: 2rem; margin-bottom: 0.5rem;"><i class="fas fa-comments" aria-hidden="true"></i> What People Say About Us</h2>
      <p style="color: var(--cool-gray); font-size: 1rem;">Hear from our community members</p>
    </div>

    <?php if(isset($testimonials) && $testimonials->count()): ?>
    <div class="testimonials-carousel-wrapper" style="position: relative; overflow: hidden;">
      <button class="carousel-nav carousel-prev" onclick="scrollTestimonials('prev')" aria-label="Previous testimonial">
        <i class="fas fa-chevron-left"></i>
      </button>
      
      <div class="testimonials-carousel" id="testimonialsCarousel">
        <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="testimonial-slide" itemscope itemtype="https://schema.org/Review" itemprop="itemListElement">
          <div class="testimonial-content">
            <div class="testimonial-quote-home" itemprop="reviewBody">
              <i class="fas fa-quote-left quote-icon" aria-hidden="true"></i>
              <?php echo e(\Illuminate\Support\Str::limit($testimonial->quote, 200)); ?>

            </div>
            <div class="testimonial-author-home">
              <div class="testimonial-avatar-wrapper">
                <?php if($testimonial->user && $testimonial->user->profile_photo): ?>
                  <img src="<?php echo e(route('me.photo')); ?>?user_id=<?php echo e($testimonial->user_id); ?>" 
                       alt="<?php echo e($testimonial->name); ?> - Digital Leap Africa Community Member" 
                       class="testimonial-avatar-home"
                       onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <div class="testimonial-avatar-placeholder-home" style="display:none;">
                    <?php echo e(strtoupper(substr($testimonial->name ?? 'U', 0, 1))); ?>

                  </div>
                <?php elseif($testimonial->avatar_path): ?>
                  <img src="<?php echo e(Storage::url($testimonial->avatar_path)); ?>" 
                       alt="<?php echo e($testimonial->name); ?> - Digital Leap Africa Community Member" 
                       class="testimonial-avatar-home"
                       onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                  <div class="testimonial-avatar-placeholder-home" style="display:none;">
                    <?php echo e(strtoupper(substr($testimonial->name ?? 'U', 0, 1))); ?>

                  </div>
                <?php else: ?>
                  <div class="testimonial-avatar-placeholder-home">
                    <?php echo e(strtoupper(substr($testimonial->name ?? 'U', 0, 1))); ?>

                  </div>
                <?php endif; ?>
              </div>
              <div class="testimonial-author-info">
                <div class="author-name" itemprop="author" itemscope itemtype="https://schema.org/Person">
                  <span itemprop="name"><?php echo e($testimonial->name ?? 'Anonymous'); ?></span>
                </div>
                <div class="author-date">
                  <i class="far fa-calendar" aria-hidden="true"></i> 
                  <time itemprop="datePublished" datetime="<?php echo e($testimonial->created_at?->toISOString()); ?>"><?php echo e($testimonial->created_at?->format('M d, Y')); ?></time>
                </div>
                <meta itemprop="reviewRating" itemscope itemtype="https://schema.org/Rating">
                <meta itemprop="ratingValue" content="5">
                <meta itemprop="bestRating" content="5">
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      
      <button class="carousel-nav carousel-next" onclick="scrollTestimonials('next')" aria-label="Next testimonial">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>

    <div class="testimonial-mobile-nav">
      <button class="mobile-nav-btn mobile-prev" onclick="scrollTestimonials('prev')">
        <i class="fas fa-chevron-left"></i>
      </button>
      <button class="mobile-nav-btn mobile-next" onclick="scrollTestimonials('next')">
        <i class="fas fa-chevron-right"></i>
      </button>
    </div>

    <div class="text-center mt-4" style="padding-top:2rem !important; display: flex; justify-content: center;">
      <a href="<?php echo e(route('testimonials.index')); ?>" class="btn-outline-large">
        <i class="fas fa-star"></i>
        <span>View Testimonials</span>
        <i class="fas fa-arrow-right"></i>
      </a>
    <?php else: ?>
    <div class="text-center" style="color: var(--cool-gray); padding: 2rem;">
      <p>No testimonials yet. Be the first to share your experience!</p>
      <?php if(auth()->guard()->check()): ?>
      <a class="btn-primary" href="<?php echo e(route('testimonials.create')); ?>" style="text-decoration: none; margin-top: 1rem; display: inline-block;">
        <i class="fas fa-plus-circle" style="margin-right: 0.5rem;"></i>Share Your Testimonial
      </a>
      <?php endif; ?>
    </div>
    <?php endif; ?>
  </div>
</section>

<style>
.testimonials-carousel-wrapper {
  position: relative;
  margin: 0 auto;
  max-width: 1200px;
  padding: 0 3rem;
}

.testimonials-carousel {
  display: flex;
  gap: 1.5rem;
  overflow-x: auto;
  scroll-behavior: smooth;
  scrollbar-width: none;
  -ms-overflow-style: none;
  padding: 1rem 0;
}

.testimonials-carousel::-webkit-scrollbar {
  display: none;
}

.testimonial-slide {
  flex: 0 0 330px;
  min-width: 330px;
}

.testimonial-mobile-nav {
  display: none;
  justify-content: center;
  gap: 1rem;
  margin-top: 1rem;
}

.mobile-nav-btn {
  background: rgba(0, 201, 255, 0.2);
  border: 1px solid rgba(0, 201, 255, 0.4);
  color: var(--cyan-accent);
  width: 45px;
  height: 45px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  backdrop-filter: blur(10px);
}

.mobile-nav-btn:hover {
  background: rgba(0, 201, 255, 0.3);
  border-color: var(--cyan-accent);
  transform: scale(1.1);
}

.btn-outline-large {
  margin: 0 auto;
  justify-content: center;
}

@media (max-width: 768px) {
  .testimonials-carousel-wrapper {
    padding: 0 !important;
    margin: 0 !important;
    max-width: 100% !important;
    width: 100% !important;
  }
  
  .testimonial-slide {
    flex: 0 0 100% !important;
    min-width: 100% !important;
    width: 100% !important;
    scroll-snap-align: start;
    padding: 0 !important;
  }
  
  .testimonial-content {
    margin: 0 1rem !important;
    width: calc(100% - 2rem) !important;
  }
  
  .testimonials-carousel {
    scroll-snap-type: x mandatory;
    padding: 0 !important;
    width: 100% !important;
  }
  
  .carousel-nav {
    display: none !important;
  }
  
  .testimonial-mobile-nav {
    display: flex !important;
  }
}

.testimonial-content {
  background: rgba(255, 255, 255, 0.03);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 12px;
  padding: 2rem;
  height: 100%;
  display: flex;
  flex-direction: column;
  gap: 1rem;
  transition: all 0.3s ease;
  min-height: 200px;
  max-height: 280px;
}

.testimonial-content:hover {
  background: rgba(255, 255, 255, 0.05);
  border-color: rgba(0, 201, 255, 0.3);
  transform: translateY(-4px);
  box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
}

.testimonial-avatar-wrapper {
  flex-shrink: 0;
}

.testimonial-avatar-home {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid rgba(0, 201, 255, 0.4);
}

.testimonial-avatar-placeholder-home {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--cyan-accent), var(--purple-accent));
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 600;
  font-size: 1.2rem;
  color: white;
}

.testimonial-quote-home {
  color: var(--diamond-white);
  line-height: 1.6;
  font-style: italic;
  text-align: left;
  position: relative;
  flex: 1;
  word-wrap: break-word;
  overflow-wrap: break-word;
  hyphens: auto;
}

.quote-icon {
  color: var(--cyan-accent);
  font-size: 1.2rem;
  opacity: 0.3;
  margin-bottom: 0.5rem;
  display: block;
}

.testimonial-author-home {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding-top: 1rem;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.testimonial-author-info {
  flex: 1;
  text-align: left;
}

.author-name {
  font-weight: 600;
  color: var(--cyan-accent);
  margin-bottom: 0.25rem;
}

.author-date {
  font-size: 0.85rem;
  color: var(--cool-gray);
}

/* Light Mode Testimonials */
[data-theme="light"] .testimonial-content {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}
[data-theme="light"] .testimonial-content:hover {
    background: #FFFFFF;
    border-color: rgba(46, 120, 197, 0.4);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}
[data-theme="light"] .testimonial-quote-home {
    color: var(--diamond-white);
}
[data-theme="light"] .quote-icon {
    color: var(--primary-blue);
}
[data-theme="light"] .author-name {
    color: var(--primary-blue);
}
[data-theme="light"] .author-date {
    color: var(--cool-gray);
}
[data-theme="light"] .carousel-nav {
    background: rgba(46, 120, 197, 0.15);
    border-color: rgba(46, 120, 197, 0.4);
    color: var(--primary-blue);
}
[data-theme="light"] .carousel-nav:hover {
    background: rgba(46, 120, 197, 0.25);
    border-color: var(--primary-blue);
}

.carousel-nav {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  background: rgba(0, 201, 255, 0.2);
  border: 1px solid rgba(0, 201, 255, 0.4);
  color: var(--cyan-accent);
  width: 45px;
  height: 45px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.3s ease;
  z-index: 10;
  backdrop-filter: blur(10px);
}

.carousel-nav:hover {
  background: rgba(0, 201, 255, 0.3);
  border-color: var(--cyan-accent);
  transform: translateY(-50%) scale(1.1);
}

.carousel-prev {
  left: -10px;
}

.carousel-next {
  right: -10px;
}

@media (max-width: 768px) {
  .carousel-prev,
  .carousel-next {
    display: none !important;
  }
}

@media (max-width: 768px) {
  .testimonials-carousel-wrapper {
    padding: 0 3rem;
  }
  
  .testimonial-slide {
    flex: 0 0 100%;
    min-width: 100%;
    scroll-snap-align: start;
  }
  
  .testimonial-content {
    padding: 1.5rem;
  }
  
  .carousel-nav {
    width: 40px;
    height: 40px;
  }

  .testimonials-carousel {
    scroll-snap-type: x mandatory;
  }

  .carousel-prev {
    left: -25px;
  }
  .carousel-next {
    right: -25px;
  }
}

@media (max-width: 480px) {
  .testimonials-carousel-wrapper {
    padding: 0 2.5rem;
  }
  .testimonial-slide {
    flex: 0 0 100%;
    min-width: 100%;
  }
  
  .testimonial-content {
    padding: 1.25rem;
  }
  
  .testimonial-avatar-home,
  .testimonial-avatar-placeholder-home {
    width: 45px;
    height: 45px;
    font-size: 1.1rem;
  }
  
  .carousel-nav {
    width: 35px;
    height: 35px;
    font-size: 0.9rem;
  }

  .carousel-prev {
    left: -20px;
  }
  .carousel-next {
    right: -20px;
  }
}
</style>

<script>
let autoScrollInterval;
let isUserScrolling = false;

function scrollTestimonials(direction) {
  const carousel = document.getElementById('testimonialsCarousel');
  if (!carousel) return;

  const scrollAmount = 370; // slide width + gap
  const currentScroll = carousel.scrollLeft;
  
  if (direction === 'next') {
    carousel.scrollLeft = currentScroll + scrollAmount;
  } else {
    carousel.scrollLeft = currentScroll - scrollAmount;
  }

  // For mobile snap scrolling
  if (window.innerWidth <= 768) {
    const slideWidth = carousel.querySelector('.testimonial-slide').offsetWidth;
    const newScrollLeft = direction === 'next' ? currentScroll + slideWidth : currentScroll - slideWidth;
    carousel.scrollTo({ left: newScrollLeft, behavior: 'smooth' });
  }

  // Reset auto-scroll after manual interaction
  isUserScrolling = true;
  clearInterval(autoScrollInterval);
  setTimeout(() => {
    isUserScrolling = false;
    startAutoScroll();
  }, 5000);
}

function startAutoScroll() {
  const carousel = document.getElementById('testimonialsCarousel');
  if (!carousel) return;
  
  clearInterval(autoScrollInterval);
  
  autoScrollInterval = setInterval(() => {
    if (isUserScrolling) return;
    
    const maxScroll = carousel.scrollWidth - carousel.clientWidth;
    const currentScroll = carousel.scrollLeft;
    
    if (currentScroll >= maxScroll - 10) {
      // Reset to start
      carousel.scrollLeft = 0;
    } else {
      // Scroll to next
      if (window.innerWidth <= 768) {
        const slideWidth = carousel.querySelector('.testimonial-slide').offsetWidth;
        carousel.scrollLeft += slideWidth;
      } else {
        carousel.scrollLeft = currentScroll + 370;
      }
    }
  }, 4000); // Auto-scroll every 4 seconds
}

// Initialize auto-scroll when page loads
document.addEventListener('DOMContentLoaded', function() {
  startAutoScroll();
  
  // Pause auto-scroll when user manually scrolls
  const carousel = document.getElementById('testimonialsCarousel');
  if (carousel) {
    carousel.addEventListener('scroll', () => {
      isUserScrolling = true;
      clearInterval(autoScrollInterval);
      setTimeout(() => {
        isUserScrolling = false;
        startAutoScroll();
      }, 3000);
    });
  }
});

// Clean up on page unload
window.addEventListener('beforeunload', () => {
  clearInterval(autoScrollInterval);
});
</script>

<!-- Partners Logos -->
<section id="partners-section" role="region" aria-labelledby="partners-heading" itemscope itemtype="https://schema.org/ItemList" style="padding:2rem 0;">
  <?php
    try {
      $partners = \App\Models\Partner::query()->active()->ordered()->get();
    } catch (\Throwable $e) {
      $partners = collect();
    }
    $applyUrl = \Illuminate\Support\Facades\Route::has('partners.apply')
      ? route('partners.apply')
      : url('/partners/apply');
  ?>

  <div class="container">
    <div class="section-title" style="text-align:center; margin-bottom: 2rem;">
      <h2 id="partners-heading" style="font-weight: 700; color: #64b5f6; font-size: 2rem; margin-bottom: 0.5rem;"><i class="fas fa-handshake" aria-hidden="true"></i> Our Partners</h2>
      <p style="color: var(--cool-gray); font-size: 1rem;">We collaborate with leading organizations to amplify impact</p>
    </div>

    <?php if($partners->count()): ?>
      <div class="partners-grid">
        <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a class="partner-item" href="<?php echo e($p->website_url ?: '#'); ?>" <?php if(!empty($p->website_url)): ?> target="_blank" rel="noopener" <?php endif; ?> title="<?php echo e($p->name); ?>" itemscope itemtype="https://schema.org/Organization" itemprop="itemListElement">
            <?php if(!empty($p->logo_url)): ?>
              <img src="<?php echo e($p->logo_url); ?>" alt="<?php echo e($p->name); ?> - Digital Leap Africa Partner" itemprop="logo" loading="lazy" fetchpriority="low">
            <?php else: ?>
              <div class="partner-fallback" itemprop="name"><?php echo e(\Illuminate\Support\Str::limit($p->name, 20)); ?></div>
            <?php endif; ?>
            <meta itemprop="name" content="<?php echo e($p->name); ?>">
            <?php if(!empty($p->website_url)): ?>
              <meta itemprop="url" content="<?php echo e($p->website_url); ?>">
            <?php endif; ?>
          </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php else: ?>
      <div class="text-muted" style="text-align:center">No partners yet.</div>
    <?php endif; ?>

    <div class="text-center mt-3" style="padding-top:1rem !important; display: flex; justify-content: center;">
      <a href="<?php echo e($applyUrl); ?>" class="btn-outline-large">
        <i class="fas fa-handshake"></i>
        <span>Become a Partner</span>
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </div>
</section>

<style>
  /* Partners grid (scoped) */
  #partners-section .partners-grid{display:grid;grid-template-columns:repeat(auto-fill, minmax(140px,1fr));gap:1.25rem;align-items:center}
  #partners-section .partner-item{display:flex;align-items:center;justify-content:center;background-color:#0f1a2f;border:1px solid rgba(136,146,176,0.2);border-radius:12px;min-height:90px;padding:12px;transition:transform .2s ease, box-shadow .2s ease}
  #partners-section .partner-item:hover{transform:translateY(-3px);box-shadow:0 8px 20px rgba(2,12,27,0.6)}
  #partners-section .partner-item img{max-width:100%;max-height:56px;object-fit:contain;filter:grayscale(20%);opacity:.95}
  #partners-section .partner-fallback{color:#94a3b8;font-weight:700}
  @media (max-width:768px){#partners-section .partners-grid{grid-template-columns:repeat(auto-fill, minmax(120px,1fr))}}

  /* Light Mode Partners */
  [data-theme="light"] #partners-section .partner-item {
      background-color: #FFFFFF;
      border: 1px solid rgba(46, 120, 197, 0.2);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  }
  [data-theme="light"] #partners-section .partner-item:hover {
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
  }
  [data-theme="light"] #partners-section .partner-fallback {
      color: var(--primary-blue);
  }
</style>


<style>
  /* Events card styles (scoped) */
  #events-section .cards-grid{display:grid;grid-template-columns:repeat(auto-fill, minmax(320px,1fr));gap:2rem}
  #events-section .card{background-color:#112240;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(2,12,27,0.7);transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275);position:relative;border:0;padding:0}
  #events-section .card:hover{transform:translateY(-8px);box-shadow:0 20px 40px rgba(2,12,27,0.9)}
  /* Image container to allow overlays */
  #events-section .card-image-container{position:relative;line-height:0;font-size:0;margin:0;padding:0;display:block;border-top-left-radius:12px;border-top-right-radius:12px;overflow:hidden}
  /* Top image: full width, fixed height to reduce card length */
  #events-section .card-image{width:100%;height:180px;object-fit:cover;display:block;margin:0;border-radius:0;transition:transform .5s ease}
  #events-section .card:hover .card-image{transform:scale(1.03)}
  #events-section .card-content{padding:1.25rem}
  #events-section .card-title{font-size:1.15rem;margin-bottom:.5rem;color:#e6f1ff;line-height:1.35}
  /* shorter description to reduce height */
  #events-section .card-body{color:#8892b0;line-height:1.55;margin-bottom:1rem;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
  /* CTA button (blue) */
  #events-section .card-button{display:inline-flex;align-items:center;justify-content:center;background-color:transparent;color:#3b82f6;padding:.5rem 1rem;border:1px solid #3b82f6;border-radius:6px;text-decoration:none;font-size:.9rem;font-weight:500;transition:all .3s ease;cursor:pointer;gap:.5rem}
  #events-section .card-button:hover{background-color:rgba(59,130,246,.1);transform:translateY(-2px);box-shadow:0 4px 12px rgba(59,130,246,.2)}
  /* Meta row: time left, location right */
  #events-section .event-meta{display:flex;align-items:center;justify-content:space-between;margin-bottom:.65rem}
  #events-section .event-date{display:inline-flex;align-items:center;gap:.45rem;color:#3b82f6;font-size:.9rem}
  #events-section .event-location{display:inline-flex;align-items:center;gap:.45rem;color:#8892b0;font-size:.9rem}
  /* Topic badge over image, bottom-left (no container): overlap upward */
  #events-section .event-category{position:relative;display:inline-flex;align-items:center;gap:.4rem;background:rgba(59,130,246,0.85);color:#fff;padding:.35rem .65rem;border-radius:999px;font-size:.7rem;font-weight:800;text-transform:uppercase;letter-spacing:.04em;backdrop-filter:saturate(140%) blur(6px);box-shadow:0 6px 16px rgba(59,130,246,.35);margin-top:-1.6rem;margin-left:.75rem;z-index:2}
  #events-section .event-category::before{content:"\f02b";font-family:"Font Awesome 6 Free";font-weight:900;font-size:.75rem;display:inline-block}
  #events-section .event-category::after{content:"";display:inline-block;width:4px;height:4px;border-radius:50%;background:rgba(255,255,255,.8)}
  #events-section .card-style-2{position:relative}
  /* Hex date badge with white text */
  #events-section .event-date-badge{position:absolute;top:0.5rem;right:0.5rem;background:#3b82f6;color:#ffffff;width:64px;height:75px;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;font-weight:800;line-height:1.1;z-index:2;clip-path:polygon(50% 0%,100% 25%,100% 75%,50% 100%,0% 75%,0% 25%);box-shadow:0 4px 12px rgba(0,0,0,0.3)}
  #events-section .event-date-badge .day{font-size:1.35rem;display:block;margin-bottom:-2px;color:#ffffff}
  #events-section .event-date-badge .month{font-size:.75rem;display:block;font-weight:800;letter-spacing:.5px;color:#ffffff}
  @media (max-width:768px){#events-section .cards-grid{grid-template-columns:repeat(auto-fill, minmax(280px,1fr));gap:1.25rem}#events-section .card-image{height:160px}#events-section .event-date-badge{width:60px;height:70px}#events-section .event-date-badge .day{font-size:1.2rem}#events-section .event-date-badge .month{font-size:.7rem}}

  /* Light Mode Events */
  [data-theme="light"] #events-section .card {
      background-color: #FFFFFF;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(46, 120, 197, 0.15);
  }
  [data-theme="light"] #events-section .card:hover {
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
  }
  [data-theme="light"] #events-section .card-title {
      color: var(--diamond-white);
  }
  [data-theme="light"] #events-section .card-body,
  [data-theme="light"] #events-section .event-location {
      color: var(--cool-gray);
  }
  [data-theme="light"] #events-section .event-date {
      color: var(--primary-blue);
  }
  [data-theme="light"] #events-section .card-button {
      color: var(--primary-blue);
      border-color: var(--primary-blue);
  }
  [data-theme="light"] #events-section .card-button:hover {
      background-color: rgba(46, 120, 197, 0.1);
      box-shadow: 0 4px 12px rgba(46, 120, 197, 0.2);
  }
  [data-theme="light"] #events-section .event-date-badge {
      background: var(--primary-blue);
  }
</style>

<!-- Upcoming Events -->
<section id="events-section" role="region" aria-labelledby="events-heading" itemscope itemtype="https://schema.org/ItemList" style="padding:2rem 0;">
  <?php
    try {
      $todayEnd = now()->copy()->endOfDay();
      // Pick 3 events that are closest to happening (soonest first)
      $upcomingTop3 = \App\Models\Event::where('date', '>', $todayEnd)
        ->orderBy('date', 'asc')
        ->take(3)
        ->get();
    } catch (\Throwable $e) {
      $upcomingTop3 = collect();
    }

    // Helper to pick an event image from common fields
    $pickEventImage = function($event) {
      return $event->image_url
          ?? $event->banner_image
          ?? $event->thumbnail
          ?? $event->cover_image
          ?? null;
    };

    $eventsIndexUrl = \Illuminate\Support\Facades\Route::has('events.index')
      ? route('events.index')
      : url('/events');
  ?>

  <div class="container">
    <div class="section-title" style="text-align:center; margin-bottom: 2rem;">
      <h2 id="events-heading" style="font-weight: 700; color: #64b5f6; font-size: 2rem; margin-bottom: 0.5rem;"><i class="fas fa-calendar-alt" aria-hidden="true"></i> Upcoming Events</h2>
      <p style="color: var(--cool-gray); font-size: 1rem;">Join our upcoming workshops and community events</p>
    </div>

    <?php if($upcomingTop3->count()): ?>
      <div class="cards-grid">
        <?php $__currentLoopData = $upcomingTop3; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $title = $event->title ?? 'Untitled Event';
            $image = $pickEventImage($event);
            $showUrl = \Illuminate\Support\Facades\Route::has('events.show')
              ? route('events.show', $event->slug ?? $event->id)
              : url('/events/'.($event->slug ?? $event->id));
            $start = $event->date; // cast to Carbon in model
            $end   = $event->ends_at;
            $timeText = '';
            if ($start) {
              $timeText = $start->format('g:ia');
              if ($end) { $timeText .= ' - ' . ($start->isSameDay($end) ? $end->format('g:ia') : $end->format('M j, Y g:ia')); }
            }
            $day = $start ? $start->format('d') : '';
            $month = $start ? strtoupper($start->format('M')) : '';
            $category = $event->topic ?? null;
            $excerpt = \Illuminate\Support\Str::limit(strip_tags($event->description ?? ''), 140);
            $ctaUrl = !empty($event->registration_url) ? $event->registration_url : $showUrl;
            $ctaText = !empty($event->registration_url) ? 'Join Event' : 'View Event';
          ?>

          <article class="card card-style-2" itemscope itemtype="https://schema.org/Event" itemprop="itemListElement">
            <?php if($image): ?>
              <img src="<?php echo e($image); ?>" alt="<?php echo e($title); ?>" class="card-image" loading="lazy" fetchpriority="low">
            <?php else: ?>
              <img src="https://via.placeholder.com/1200x700.png?text=Event" alt="<?php echo e($title); ?>" class="card-image" loading="lazy" fetchpriority="low">
            <?php endif; ?>
            <?php if($category): ?>
              <span class="event-category"><?php echo e($category); ?></span>
            <?php endif; ?>
            <?php if($start): ?>
              <div class="event-date-badge">
                <span class="day"><?php echo e($day); ?></span>
                <span class="month"><?php echo e($month); ?></span>
              </div>
            <?php endif; ?>

            <div class="card-content">
              <h3 class="card-title" itemprop="name"><?php echo e($title); ?></h3>
              <meta itemprop="description" content="<?php echo e($excerpt); ?>">
              <?php if($start): ?>
                <meta itemprop="startDate" content="<?php echo e($start->toISOString()); ?>">
              <?php endif; ?>
              <div class="event-meta">
                <?php if($timeText): ?>
                  <span class="event-date"><i class="far fa-clock"></i> <?php echo e($timeText); ?></span>
                <?php endif; ?>
                <?php if(!empty($event->location)): ?>
                  <span class="event-location"><i class="fas fa-map-marker-alt"></i> <?php echo e($event->location); ?></span>
                <?php endif; ?>
              </div>
              <?php if(!empty($excerpt)): ?>
                <p class="card-body"><?php echo e($excerpt); ?></p>
              <?php endif; ?>
              <a href="<?php echo e($ctaUrl); ?>" class="card-button"><?php echo e($ctaText); ?> <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php else: ?>
      <div class="text-muted">No upcoming events.</div>
    <?php endif; ?>
    <div class="text-center mt-3" style="padding-top:1rem !important; display: flex; justify-content: center;">
      <a href="<?php echo e($eventsIndexUrl); ?>" class="btn-outline-large">
        <i class="fas fa-calendar-alt"></i>
        <span>View all events</span>
        <i class="fas fa-arrow-right"></i>
      </a>
    </div>
  </div>
</section>

<!-- FAQs -->
<section id="faq-section" role="region" aria-labelledby="faq-heading" itemscope itemtype="https://schema.org/FAQPage" style="padding:2rem 0;">
  <?php
    try {
      $faqs = \App\Models\Faq::query()->where('is_active', true)->latest()->take(6)->get();
    } catch (\Throwable $e) {
      $faqs = collect();
    }
  ?>

  <div class="container">
    <div class="section-title" style="text-align:center; margin-bottom: 2rem;">
      <h2 id="faq-heading" style="font-weight: 700; color: #64b5f6; font-size: 2rem; margin-bottom: 0.5rem;"><i class="fas fa-question-circle" aria-hidden="true"></i> Frequently Asked Questions</h2>
      <p style="color: var(--cool-gray); font-size: 1rem;">Find answers to common questions about our platform</p>
    </div>

    <?php if($faqs->count()): ?>
      <div class="faq-accordion">
        <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <details class="faq-item" <?php if($i===0): ?> open <?php endif; ?> itemscope itemtype="https://schema.org/Question" itemprop="mainEntity">
            <summary class="faq-q" itemprop="name"><?php echo e($f->question); ?></summary>
            <div class="faq-a" itemscope itemtype="https://schema.org/Answer" itemprop="acceptedAnswer">
              <div itemprop="text"><?php echo nl2br(e($f->answer)); ?></div>
            </div>
          </details>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php else: ?>
      <div class="text-muted" style="text-align:center">No FAQs yet.</div>
    <?php endif; ?>
  </div>
</section>

<style>
  /* FAQ styles (scoped) */
  #faq-section .faq-accordion{display:grid;gap:.75rem}
  #faq-section .faq-item{background:#112240;border:1px solid rgba(136,146,176,0.2);border-radius:12px;overflow:hidden}
  #faq-section .faq-q{cursor:pointer;padding:1rem 1.25rem;list-style:none;display:flex;align-items:center;gap:.75rem;font-weight:700;color:#e6f1ff}
  #faq-section .faq-q::-webkit-details-marker{display:none}
  #faq-section .faq-q:after{content:'+';margin-left:auto;color:#64b5f6;font-weight:800}
  #faq-section .faq-item[open] .faq-q:after{content:'−'}
  #faq-section .faq-a{padding:0 1.25rem 1rem;color:#94a3b8;line-height:1.6}
  @media (max-width:768px){#faq-section .faq-q{padding:0.9rem 1rem}#faq-section .faq-a{padding:0 1rem 1rem}}

  /* Light Mode FAQs */
  [data-theme="light"] #faq-section .faq-item {
      background: #FFFFFF;
      border: 1px solid rgba(46, 120, 197, 0.2);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  }
  [data-theme="light"] #faq-section .faq-q {
      color: var(--primary-blue);
  }
  [data-theme="light"] #faq-section .faq-q:after {
      color: var(--primary-blue);
  }
  [data-theme="light"] #faq-section .faq-a {
      color: var(--cool-gray);
  }
</style>

<?php $__env->startPush('styles'); ?>
<style>
/* Article image and fallback avatar */
.post-thumb {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-top-left-radius: .5rem;
  border-top-right-radius: .5rem;
}

.post-avatar {
  width: 100%;
  height: 200px;
  border-top-left-radius: .5rem;
  border-top-right-radius: .5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #0ea5e9 0%, #6366f1 100%);
  color: #ffffff;
}

.post-avatar span {
  font-size: 3rem;
  line-height: 1;
  font-weight: 800;
  letter-spacing: .04em;
  text-shadow: 0 2px 8px rgba(0,0,0,.25);
}


  /* Stats */
  .stats-grid {
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1.25rem;
  }
  
  /* Mobile Responsive Styles */
  @media (max-width: 768px) {
    .container {
      width: 90%;
      padding: 1.5rem 0;
      margin: 0 auto;
    }
    
    .hero-slide {
      padding: 0 5%;
    }
    
    .slide-content {
      max-width: 100%;
      padding: 0 1rem;
    }
    
    .main-title {
      font-size: 2.2rem !important;
    }
    
    .hero-text {
      font-size: 1rem !important;
    }
    
    .cta-buttons {
      flex-direction: column;
      align-items: stretch;
      gap: 0.75rem;
    }
    
    .btn {
      width: 100%;
      justify-content: center;
      padding: 12px 20px;
      font-size: 0.9rem;
    }
    
    .stats-grid {
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
    }
    
    .stat-card {
      padding: 1.25rem 1rem;
    }
    
    .stat-value {
      font-size: 1.75rem;
    }
    
    /* Articles and Courses Cards */
    #articles-section .cards-grid,
    #courses-section .cards-grid {
      grid-template-columns: 1fr;
      gap: 1.5rem;
    }
    
    #articles-section .card-title,
    #courses-section .card-title {
      font-size: 1.1rem;
      padding: 1rem 1rem 0.5rem;
    }
    
    #articles-section .card-content,
    #courses-section .card-content {
      padding: 1rem;
    }
    
    /* Testimonials */
    .testimonials-carousel-wrapper {
      padding: 0 3rem;
    }
    
    .testimonial-slide {
      flex: 0 0 100%;
      min-width: 100%;
    }
    
    .testimonial-content {
      padding: 1.25rem;
    }
    
    /* Partners */
    #partners-section .partners-grid {
      grid-template-columns: repeat(2, 1fr);
      gap: 1rem;
    }
    
    /* Events */
    #events-section .cards-grid {
      grid-template-columns: 1fr;
      gap: 1.5rem;
    }
    
    #events-section .card-image {
      height: 160px;
    }
    
    /* About Section */
    #about-section .aboutx-card {
      flex-direction: column;
      max-width: 100%;
    }
    
    #about-section .aboutx-image {
      width: 100%;
      height: 300px;
    }
    
    #about-section .aboutx-content {
      padding: 1.5rem;
    }
    
    #about-section .aboutx-title {
      font-size: 2rem;
    }
    
    #about-section .aboutx-features {
      grid-template-columns: 1fr;
    }
    
    /* FAQ */
    #faq-section .faq-q {
      padding: 0.9rem 1rem;
      font-size: 0.95rem;
    }
    
    #faq-section .faq-a {
      padding: 0 1rem 1rem;
      font-size: 0.9rem;
    }
  }
  
  @media (max-width: 480px) {
    .container {
      width: 85%;
      padding: 1rem 0;
      margin: 0 auto;
    }
    
    .hero-slide {
      padding: 0 4%;
    }
    
    .slide-content {
      padding: 0 1.5rem;
    }
    
    .main-title {
      font-size: 1.8rem !important;
    }
    
    .hero-text {
      font-size: 0.95rem !important;
    }
    
    .btn {
      padding: 10px 16px;
      font-size: 0.85rem;
    }
    
    .stats-grid {
      grid-template-columns: repeat(2, 1fr);
      gap: 0.75rem;
    }
    
    .stat-card {
      padding: 1rem 0.75rem;
    }
    
    .stat-value {
      font-size: 1.5rem;
    }
    
    .stat-label {
      font-size: 0.85rem;
    }
    
    /* Cards */
    #articles-section .card-content,
    #courses-section .card-content {
      padding: 0.875rem;
    }
    
    #articles-section .card-title,
    #courses-section .card-title {
      font-size: 1rem;
      padding: 0.875rem 0.875rem 0.5rem;
    }
    
    /* Testimonials */
    .testimonial-slide {
      flex: 0 0 100%;
      min-width: 100%;
    }
    
    .testimonial-content {
      padding: 1rem;
    }
    
    .testimonial-avatar-home,
    .testimonial-avatar-placeholder-home {
      width: 40px;
      height: 40px;
      font-size: 1rem;
    }
    
    /* Partners */
    #partners-section .partners-grid {
      grid-template-columns: repeat(2, 1fr);
      gap: 0.75rem;
    }
    
    #partners-section .partner-item {
      min-height: 70px;
      padding: 8px;
    }
    
    /* About Section */
    #about-section .aboutx-image {
      height: 250px;
    }
    
    #about-section .aboutx-hex {
      width: 200px;
      height: 230px;
    }
    
    #about-section .aboutx-hex-inner {
      width: 180px;
      height: 210px;
    }
    
    #about-section .aboutx-content {
      padding: 1.25rem;
    }
    
    #about-section .aboutx-title {
      font-size: 1.75rem;
    }
    
    #about-section .aboutx-badge {
      position: static;
      margin-bottom: 1rem;
      align-self: flex-start;
    }
    
    /* Events */
    #events-section .event-date-badge {
      width: 50px;
      height: 60px;
    }
    
    #events-section .event-date-badge .day {
      font-size: 1rem;
    }
    
    #events-section .event-date-badge .month {
      font-size: 0.65rem;
    }
  }
  .stat-card {
    text-align:center; padding: 1.5rem;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: var(--radius);
  }
  .stat-value { font-size: 2rem; font-weight: 800; color: var(--diamond-white); }
  .stat-label { color: var(--cool-gray); }

  /* Light Mode Stats */
  [data-theme="light"] .stat-card {
      background: #FFFFFF;
      border: 1px solid rgba(46, 120, 197, 0.2);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
  }
  [data-theme="light"] .stat-value {
      color: var(--primary-blue);
  }
  [data-theme="light"] .stat-label {
      color: var(--cool-gray);
  }


  /* Course image and fallback avatar */
.course-thumb {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-top-left-radius: .5rem;
  border-top-right-radius: .5rem;
}

.course-avatar {
  width: 100%;
  height: 200px;
  border-top-left-radius: .5rem;
  border-top-right-radius: .5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #10b981 0%, #3b82f6 100%);
  color: #ffffff;
}

.course-avatar span {
  font-size: 2.5rem;
  line-height: 1;
  font-weight: 800;
  letter-spacing: .04em;
  text-shadow: 0 2px 8px rgba(0,0,0,.25);
}


/* Event image and fallback avatar */
.event-thumb {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-top-left-radius: .5rem;
  border-top-right-radius: .5rem;
}

.event-avatar {
  width: 100%;
  height: 200px;
  border-top-left-radius: .5rem;
  border-top-right-radius: .5rem;
  display: flex;
  align-items: center;
  justify-content: center;
  background: linear-gradient(135deg, #f59e0b 0%, #ef4444 100%);
  color: #ffffff;
}

.event-avatar span {
  font-size: 2.5rem;
  line-height: 1;
  font-weight: 800;
  letter-spacing: .04em;
  text-shadow: 0 2px 8px rgba(0,0,0,.25);
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
(function(){
  var root = document.querySelector('.hero-rtl');
  if(!root) return;
  var slides = root.querySelectorAll('.fade-slide');
  var dots = root.querySelectorAll('.hero-dot');
  var count = slides.length;
  var idx = 0;
  var intv = parseInt(root.getAttribute('data-interval')||'6000',10);
  function show(i){
    var nextIdx = (i+count)%count;
    if(nextIdx===idx) return;
    root.classList.add('is-transitioning');
    slides[idx].classList.remove('is-active');
    slides[nextIdx].classList.add('is-active');
    dots.forEach(function(d,j){ d.style.background = j===nextIdx ? '#64b5f6' : 'rgba(255,255,255,.6)'; d.classList.toggle('is-active', j===nextIdx); });
    idx = nextIdx;
    setTimeout(function(){ root.classList.remove('is-transitioning'); }, 700);
  }
  function nextSlide(){ show(idx+1); }
  var timer = setInterval(nextSlide, intv);
  dots.forEach(function(d){ d.addEventListener('click', function(){ clearInterval(timer); show(parseInt(d.getAttribute('data-index'),10)); timer=setInterval(nextSlide,intv); }); });
})();
</script>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views/index.blade.php ENDPATH**/ ?>