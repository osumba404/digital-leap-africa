

<?php $__env->startSection('title', 'Digital Library - Learning Resources & Educational Materials | Digital Leap Africa'); ?>
<?php $__env->startSection('meta_description', 'Access our comprehensive digital library with books, videos, tutorials, and educational resources for web development, programming, and technology skills in Africa.'); ?>
<?php $__env->startSection('meta_keywords', 'digital library, learning resources, educational materials, programming books, web development tutorials, technology resources, online learning Africa, digital education'); ?>
<?php $__env->startSection('canonical', route('elibrary.index')); ?>

<?php $__env->startPush('meta'); ?>
<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo e(route('elibrary.index')); ?>">
<meta property="og:title" content="Digital Library - Learning Resources & Educational Materials">
<meta property="og:description" content="Access our comprehensive digital library with books, videos, tutorials, and educational resources for web development, programming, and technology skills.">
<meta property="og:image" content="<?php echo e(asset('images/elibrary-og-image.jpg')); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="Digital Leap Africa">
<meta property="og:locale" content="en_US">

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?php echo e(route('elibrary.index')); ?>">
<meta property="twitter:title" content="Digital Library - Learning Resources & Educational Materials">
<meta property="twitter:description" content="Access our comprehensive digital library with books, videos, tutorials, and educational resources for web development and technology skills.">
<meta property="twitter:image" content="<?php echo e(asset('images/elibrary-og-image.jpg')); ?>">
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

<!-- Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "Digital Leap Africa Library",
  "description": "Comprehensive digital library with educational resources, books, videos, and tutorials for technology and programming skills",
  "url": "<?php echo e(route('elibrary.index')); ?>",
  "publisher": {
    "@type": "Organization",
    "name": "Digital Leap Africa",
    "url": "<?php echo e(url('/')); ?>",
    "logo": {
      "@type": "ImageObject",
      "url": "<?php echo e(asset('images/logo.png')); ?>"
    }
  },
  "mainEntity": {
    "@type": "ItemList",
    "numberOfItems": <?php echo e($elibraryItems->total() ?? $elibraryItems->count()); ?>,
    "itemListElement": [
      <?php if($elibraryItems->count()): ?>
        <?php $__currentLoopData = $elibraryItems->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          {
            "@type": "CreativeWork",
            "position": <?php echo e($index + 1); ?>,
            "name": "<?php echo e(addslashes($item->title)); ?>",
            "description": "<?php echo e(addslashes(Str::limit($item->description ?? '', 160))); ?>",
            "url": "<?php echo e($item->file_url ?? route('elibrary.index')); ?>",
            "author": {
              "@type": "Person",
              "name": "<?php echo e($item->author ?? 'Digital Leap Africa'); ?>"
            },
            "genre": "<?php echo e(ucfirst($item->type ?? 'Educational Resource')); ?>",
            "educationalLevel": "Intermediate",
            "learningResourceType": "<?php echo e(ucfirst($item->type ?? 'Resource')); ?>"
          }<?php echo e($index < min(4, $elibraryItems->count() - 1) ? ',' : ''); ?>

        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
    ]
  }
}
</script>

<!-- Educational Organization Schema -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "Digital Leap Africa",
  "url": "<?php echo e(url('/')); ?>",
  "logo": "<?php echo e(asset('images/logo.png')); ?>",
  "description": "Leading digital education platform in Africa providing comprehensive learning resources and technology training",
  "address": {
    "@type": "PostalAddress",
    "addressCountry": "Kenya",
    "addressRegion": "Nairobi"
  },
  "hasOfferCatalog": {
    "@type": "OfferCatalog",
    "name": "Digital Library Resources",
    "itemListElement": [
      {
        "@type": "Offer",
        "itemOffered": {
          "@type": "Course",
          "name": "Programming & Web Development Resources",
          "description": "Comprehensive collection of books, videos, and tutorials for learning programming and web development"
        }
      }
    ]
  }
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
      "name": "Digital Library",
      "item": "<?php echo e(route('elibrary.index')); ?>"
    }
  ]
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<style>
.library-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 2rem;
    margin: 2rem 0;
}

@media (min-width: 640px) {
    .library-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .library-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.resource-card {
    background-color: #112240;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(2,12,27,0.7);
    transition: all .4s cubic-bezier(0.175,0.885,0.32,1.275);
    height: 100%;
    display: flex;
    flex-direction: column;
    padding: 0;
}

.resource-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(2,12,27,0.9);
}

.resource-image-container {
    position: relative;
    overflow: hidden;
    margin: 0;
    padding: 0;
    line-height: 0;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
}

.resource-image {
    width: 100%;
    height: 200px;
    object-fit: cover;
    display: block;
    margin: 0;
    transition: transform .5s ease;
}

.resource-card:hover .resource-image {
    transform: scale(1.05);
}

.resource-title {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(transparent, rgba(10,25,47,0.95));
    padding: 1.25rem 1.25rem .6rem;
    margin: 0;
    font-size: 1.1rem;
    font-weight: 700;
    line-height: 1.35;
    text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    color: var(--diamond-white);
}

.resource-content {
    padding: 1.25rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

.resource-type {
    position: absolute;
    top: 1rem;
    right: 1rem;
    padding: .5rem 1rem;
    border-radius: 25px;
    font-weight: 800;
    font-size: .8rem;
    z-index: 10;
    box-shadow: 0 4px 15px rgba(0,0,0,0.4);
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.2);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
    background: linear-gradient(135deg, #8b5cf6, #6366f1);
    color: #fff;
}

.resource-type:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 20px rgba(0,0,0,0.5);
}

.resource-description {
    color: #8892b0;
    line-height: 1.6;
    margin-bottom: 1rem;
    flex-grow: 1;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.resource-meta {
    display: flex;
    justify-content: space-between;
    color: #8892b0;
    font-size: .85rem;
    margin-bottom: .85rem;
    border-bottom: 1px solid rgba(136,146,176,0.2);
    padding-bottom: .6rem;
}

.resource-button {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: transparent;
    color: #3b82f6;
    padding: .6rem 1.2rem;
    border: 1px solid #3b82f6;
    border-radius: 6px;
    text-decoration: none;
    font-size: .9rem;
    font-weight: 600;
    transition: all .3s ease;
    cursor: pointer;
    gap: .5rem;
}

.resource-button:hover {
    background-color: rgba(59,130,246,.1);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(59,130,246,.2);
}

.filter-tabs {
    display: flex;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
    justify-content: center;
}

.filter-tab {
    padding: 0.5rem 1rem;
    border-radius: 999px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--cool-gray);
    text-decoration: none;
    transition: all 0.2s;
    font-weight: 500;
}

.filter-tab:hover,
.filter-tab.active {
    background: var(--cyan-accent);
    color: var(--navy-bg);
    border-color: var(--cyan-accent);
}

/* Light Mode Styles */
[data-theme="light"] .resource-card {
    background-color: #FFFFFF;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    border: 1px solid rgba(46, 120, 197, 0.15);
}

[data-theme="light"] .resource-card:hover {
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
}

[data-theme="light"] .resource-title {
    background: linear-gradient(transparent, rgba(230, 242, 255, 0.95));
    color: var(--diamond-white);
}

[data-theme="light"] .resource-description,
[data-theme="light"] .resource-meta {
    color: var(--cool-gray);
}

[data-theme="light"] .resource-button {
    color: var(--primary-blue);
    border-color: var(--primary-blue);
}

[data-theme="light"] .resource-button:hover {
    background-color: rgba(46, 120, 197, 0.1);
    box-shadow: 0 4px 12px rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .filter-tab {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    color: #1A202C;
}

[data-theme="light"] .filter-tab:hover {
    background: rgba(46, 120, 197, 0.1);
    border-color: rgba(46, 120, 197, 0.4);
}

[data-theme="light"] .filter-tab.active {
    background: #2E78C5;
    color: #FFFFFF;
    border-color: #2E78C5;
}

[data-theme="light"] h1 {
    color: #1A202C;
}

[data-theme="light"] .container > div > p {
    color: #4A5568 !important;
}

[data-theme="light"] .resource-image {
    background: linear-gradient(135deg, #E8F4F8, #D6EAF8);
}

/* Search Bar Styles */
.search-input:focus {
    border-color: rgba(100, 181, 246, 0.6) !important;
    box-shadow: 0 0 0 3px rgba(100, 181, 246, 0.1) !important;
}

.search-btn:hover {
    transform: translateY(-50%) scale(1.05) !important;
    box-shadow: 0 4px 12px rgba(100, 181, 246, 0.3) !important;
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

<div class="container">
    <div style="text-align: center; margin-bottom: 3rem;">
        <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem;">Digital Library</h1>
        <p style="color: var(--cool-gray); font-size: 1.1rem;">Access a vast collection of learning resources, books, and materials</p>
    </div>

    
    <div class="filter-tabs">
        <a href="?type=all" class="filter-tab <?php echo e(request('type', 'all') === 'all' ? 'active' : ''); ?>">
            <i class="fas fa-th me-2"></i>All Resources
        </a>
        <a href="?type=book" class="filter-tab <?php echo e(request('type') === 'book' ? 'active' : ''); ?>">
            <i class="fas fa-book me-2"></i>Books
        </a>
        <a href="?type=video" class="filter-tab <?php echo e(request('type') === 'video' ? 'active' : ''); ?>">
            <i class="fas fa-video me-2"></i>Videos
        </a>
        <!-- <a href="?type=article" class="filter-tab <?php echo e(request('type') === 'article' ? 'active' : ''); ?>">
            <i class="fas fa-newspaper me-2"></i>Articles
        </a> -->
        <a href="?type=tutorial" class="filter-tab <?php echo e(request('type') === 'tutorial' ? 'active' : ''); ?>">
            <i class="fas fa-chalkboard-teacher me-2"></i>Tutorials
        </a>
    </div>

    
    <div class="search-container" style="max-width: 500px; margin: 0 auto 2rem; position: relative;">
        <form method="GET" action="<?php echo e(route('elibrary.index')); ?>" style="position: relative;">
            <?php if(request('type')): ?>
                <input type="hidden" name="type" value="<?php echo e(request('type')); ?>">
            <?php endif; ?>
            <input type="text" 
                   name="search" 
                   value="<?php echo e($search ?? ''); ?>" 
                   placeholder="Search resources..." 
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
                <a href="<?php echo e(route('elibrary.index')); ?><?php echo e(request('type') ? '?type=' . request('type') : ''); ?>" style="color: #64b5f6; text-decoration: none; margin-left: 0.5rem;">
                    <i class="fas fa-times"></i> Clear
                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php if($elibraryItems->count() > 0): ?>
        <div class="library-grid">
            <?php $__currentLoopData = $elibraryItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="resource-card">
                    <div class="resource-image-container">
                        <?php if($item->image_url): ?>
                            <img src="<?php echo e($item->image_url); ?>" alt="<?php echo e($item->title); ?>" class="resource-image">
                        <?php else: ?>
                            <img src="https://via.placeholder.com/1000x600.png?text=Resource" alt="<?php echo e($item->title); ?>" class="resource-image">
                        <?php endif; ?>
                        <?php if($item->type): ?>
                            <span class="resource-type"><?php echo e($item->type); ?></span>
                        <?php endif; ?>
                        <h3 class="resource-title"><?php echo html_entity_decode($item->title); ?></h3>
                    </div>
                    <div class="resource-content">
                        <div class="resource-meta">
                            <?php if($item->author): ?>
                                <span><i class="fas fa-user"></i> <?php echo e($item->author); ?></span>
                            <?php endif; ?>
                            <span><i class="fas fa-file-alt"></i> <?php echo e(ucfirst($item->type ?? 'Resource')); ?></span>
                        </div>
                        
                        <p class="resource-description">
                            <?php echo html_entity_decode(Str::limit($item->description, 140)); ?>

                        </p>
                        
                        <?php if($item->file_url): ?>
                            <a href="<?php echo e($item->file_url); ?>" target="_blank" class="resource-button">
                                Access Resource <i class="fas fa-external-link-alt"></i>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        
        <?php if(method_exists($elibraryItems, 'links')): ?>
            <div class="pagination-wrapper" style="display: flex; justify-content: center; margin-top: 3rem;">
                <div class="pagination-container" style="background: var(--charcoal); border-radius: 12px; padding: 1rem; border: 1px solid rgba(100, 181, 246, 0.1);">
                    <?php echo e($elibraryItems->appends(request()->query())->links()); ?>

                </div>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div style="text-align: center; padding: 4rem 0;">
            <i class="fas fa-book-open" style="font-size: 4rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem;"></i>
            <h3 style="color: var(--cool-gray); margin-bottom: 1rem;">No Resources Available</h3>
            <p style="color: var(--cool-gray); margin-bottom: 2rem;">We're working on adding more resources to our library. Check back soon!</p>
            <a href="<?php echo e(route('courses.index')); ?>" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                <i class="fas fa-graduation-cap me-2"></i>Explore Courses
            </a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\pages\elibrary\index.blade.php ENDPATH**/ ?>