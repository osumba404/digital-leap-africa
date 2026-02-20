

<?php $__env->startSection('title', 'Online Courses - Digital Leap Africa | Programming, Web Development & Digital Skills Training'); ?>

<?php $__env->startPush('meta'); ?>
<meta name="description" content="Explore comprehensive online courses at Digital Leap Africa. Learn programming, web development, digital marketing, and essential tech skills. Free and premium courses available for African learners.">
<meta name="keywords" content="online courses Africa, programming courses Kenya, web development training, digital skills courses, e-learning platform Africa, tech education, coding bootcamp, software development courses, digital marketing training, free programming courses">
<meta name="author" content="Digital Leap Africa">
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo e(route('courses.index')); ?>">
<meta property="og:title" content="Online Courses - Digital Leap Africa | Programming & Digital Skills Training">
<meta property="og:description" content="Master programming, web development, and digital skills with our comprehensive online courses. Join thousands of African learners advancing their tech careers.">
<meta property="og:image" content="<?php echo e(asset('images/courses-og-image.jpg')); ?>">
<meta property="og:site_name" content="Digital Leap Africa">
<meta property="og:locale" content="en_US">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="<?php echo e(route('courses.index')); ?>">
<meta name="twitter:title" content="Online Courses - Digital Leap Africa">
<meta name="twitter:description" content="Master programming, web development, and digital skills with our comprehensive online courses designed for African learners.">
<meta name="twitter:image" content="<?php echo e(asset('images/courses-og-image.jpg')); ?>">
<meta name="twitter:image:alt" content="Digital Leap Africa Online Courses - Programming and Digital Skills Training">

<!-- Additional SEO Meta Tags -->
<meta name="geo.region" content="KE">
<meta name="geo.placename" content="Kenya">
<meta name="language" content="English">
<meta name="coverage" content="Africa">
<meta name="distribution" content="global">
<meta name="rating" content="general">
<meta name="revisit-after" content="3 days">
<meta name="target" content="all">

<!-- Canonical URL -->
<link rel="canonical" href="<?php echo e(route('courses.index')); ?>">

<!-- Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "CollectionPage",
  "name": "Online Courses - Digital Leap Africa",
  "description": "Comprehensive online courses in programming, web development, and digital skills for African learners",
  "url": "<?php echo e(route('courses.index')); ?>",
  "provider": {
    "@type": "EducationalOrganization",
    "name": "Digital Leap Africa",
    "url": "<?php echo e(url('/')); ?>"
  },
  "mainEntity": {
    "@type": "ItemList",
    "numberOfItems": "<?php echo e($courses->total() ?? $courses->count()); ?>",
    "itemListElement": [
      <?php if(isset($courses) && $courses->count() > 0): ?>
        <?php $__currentLoopData = $courses->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
          "educationalLevel": "<?php echo e($course->level ?? 'beginner'); ?>",
          "inLanguage": "en",
          <?php if(!$course->is_free && $course->price): ?>
          "offers": {
            "@type": "Offer",
            "price": "<?php echo e($course->price); ?>",
            "priceCurrency": "KES",
            "availability": "https://schema.org/InStock"
          },
          <?php endif; ?>
          "hasCourseInstance": {
            "@type": "CourseInstance",
            "courseMode": "online",
            "instructor": {
              "@type": "Person",
              "name": "<?php echo e($course->instructor ?? 'Digital Leap Africa Instructor'); ?>"
            }
          }
        }<?php if(!$loop->last): ?>,<?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>
    ]
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
    },
    {
      "@type": "ListItem",
      "position": 2,
      "name": "Courses",
      "item": "<?php echo e(route('courses.index')); ?>"
    }
  ]
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>






        
<style>
  /* Courses overlay card styles (scoped) */
  #courses-section .cards-grid{display:grid;grid-template-columns:1fr;gap:1.5rem}
  @media (min-width:640px){#courses-section .cards-grid{grid-template-columns:repeat(2,1fr)}}
  @media (min-width:1024px){#courses-section .cards-grid{grid-template-columns:repeat(3,1fr)}}
  @media (max-width:480px){#courses-section .cards-grid{gap:1rem}}
  #courses-section .card{background-color:#112240;border-radius:12px;overflow:hidden;box-shadow:0 10px 30px rgba(2,12,27,0.7);transition:all .4s cubic-bezier(0.175,0.885,0.32,1.275);height:100%;display:flex;flex-direction:column;padding:0}
  #courses-section .card:hover{transform:translateY(-8px);box-shadow:0 20px 40px rgba(2,12,27,0.9)}
  #courses-section .card-image-container{position:relative;overflow:hidden;margin:0;padding:0;line-height:0;border-top-left-radius:12px;border-top-right-radius:12px}
  #courses-section .card-image{width:100%;height:200px;object-fit:cover;display:block;margin:0;transition:transform .5s ease}
  #courses-section .card:hover .card-image{transform:scale(1.05)}
  #courses-section .card-title{position:absolute;bottom:0;left:0;right:0;background:linear-gradient(transparent, rgba(10,25,47,0.95));padding:1.25rem 1.25rem .6rem;margin:0;font-size:1.1rem;font-weight:700;line-height:1.35;text-shadow:0 2px 4px rgba(0,0,0,0.5)}
  #courses-section .card-content{padding:1.25rem;flex-grow:1;display:flex;flex-direction:column}
  #courses-section .card-body{color:#8892b0;line-height:1.6;margin-bottom:1rem;flex-grow:1;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
  #courses-section .card-meta{display:flex;justify-content:space-between;color:#8892b0;font-size:.85rem;margin-bottom:.85rem;border-bottom:1px solid rgba(136,146,176,0.2);padding-bottom:.6rem}
  #courses-section .card-button{display:inline-flex;align-items:center;justify-content:center;background-color:transparent;color:#3b82f6;padding:.6rem 1.2rem;border:1px solid #3b82f6;border-radius:6px;text-decoration:none;font-size:.9rem;font-weight:600;transition:all .3s ease;cursor:pointer;gap:.5rem}
  #courses-section .card-button:hover{background-color:rgba(59,130,246,.1);transform:translateY(-2px);box-shadow:0 4px 12px rgba(59,130,246,.2)}
  .btn-wide{width: 100%;}
  #courses-section .price-badge{position:absolute;top:1rem;right:1rem;padding:.5rem 1rem;border-radius:25px;font-weight:800;font-size:.8rem;z-index:10;box-shadow:0 4px 15px rgba(0,0,0,0.4);backdrop-filter:blur(10px);border:2px solid rgba(255,255,255,0.2);text-transform:uppercase;letter-spacing:0.5px;transition:all 0.3s ease}
  #courses-section .price-badge.free{background:linear-gradient(135deg,#10b981,#059669);color:#fff}
  #courses-section .price-badge.paid{background:linear-gradient(135deg,#3b82f6,#1d4ed8);color:#fff}
  #courses-section .price-badge:hover{transform:scale(1.05);box-shadow:0 6px 20px rgba(0,0,0,0.5)}
  @media (max-width:768px){#courses-section .cards-grid{grid-template-columns:repeat(auto-fill, minmax(280px,1fr));gap:1.5rem}#courses-section .card-title{font-size:1rem;padding:1rem 1rem .45rem}.search-container{margin:0 1rem 2rem!important}.search-input{font-size:0.9rem!important;padding:0.75rem 2.75rem 0.75rem 0.875rem!important}.search-btn{width:2.25rem!important;height:2.25rem!important;right:0.375rem!important}}

  /* Light Mode Courses */
  [data-theme="light"] #courses-section .card {
      background-color: #FFFFFF;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
      border: 1px solid rgba(46, 120, 197, 0.15);
  }
  [data-theme="light"] #courses-section .card:hover {
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
  }
  [data-theme="light"] #courses-section .card-title {
      background: linear-gradient(transparent, rgba(230, 242, 255, 0.95));
      color: var(--diamond-white);
  }
  [data-theme="light"] #courses-section .card-body,
  [data-theme="light"] #courses-section .card-meta {
      color: var(--cool-gray);
  }
  [data-theme="light"] #courses-section .card-button {
      color: var(--primary-blue);
      border-color: var(--primary-blue);
  }
  [data-theme="light"] #courses-section .card-button:hover {
      background-color: rgba(46, 120, 197, 0.1);
      box-shadow: 0 4px 12px rgba(46, 120, 197, 0.2);
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




<!-- Latest Courses -->
<section id="courses-section" style="padding:2rem 0;">
  <?php
    try {
      $courses = isset($courses) ? $courses : \App\Models\Course::query()->latest()->paginate(9);
    } catch (\Throwable $e) {
      $courses = collect();
    }
    $pickCourseImage = function($course) {
      return $course->image_url_full
          ?? $course->image_url
          ?? $course->thumbnail
          ?? $course->cover_image
          ?? $course->banner_image
          ?? null;
    };
  ?>

  <div class="container">
    <div class="text-center mb-3" style="text-align:center !important; color: #64b5f6; font-size: 22px">
      <h2 class="m-0">Available Courses</h2>
    </div>
    
    <!-- Search Bar -->
    <div class="search-container" style="max-width: 500px; margin: 0 auto 2rem; position: relative;">
      <form method="GET" action="<?php echo e(route('courses.index')); ?>" style="position: relative;">
        <input type="text" 
               name="search" 
               value="<?php echo e($search ?? ''); ?>" 
               placeholder="Search courses..." 
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
          <a href="<?php echo e(route('courses.index')); ?>" style="color: #64b5f6; text-decoration: none; margin-left: 0.5rem;">
            <i class="fas fa-times"></i> Clear
          </a>
        </div>
      <?php endif; ?>
    </div>

    <?php if($courses->count()): ?>
      <?php if($search && $courses->total() > 0): ?>
        <div style="text-align: center; margin-bottom: 1.5rem; color: var(--cool-gray);">
          Found <?php echo e($courses->total()); ?> course<?php echo e($courses->total() !== 1 ? 's' : ''); ?>

        </div>
      <?php endif; ?>
      <div class="cards-grid">
        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <?php
            $courseImage   = $pickCourseImage($course);
            $courseTitle   = $course->title ?? 'Untitled';
            $courseExcerpt = \Illuminate\Support\Str::limit(strip_tags($course->short_description ?? $course->description ?? $course->summary ?? ''), 140);
            $showUrl       = \Illuminate\Support\Facades\Route::has('courses.show') ? route('courses.show', $course) : url('/courses/'.$course->id);
            // Lessons count (relation preferred, fallback to *_count fields)
            $lessonsCount = 0;
            if (method_exists($course, 'lessons')) {
              $lessonsCount = $course->relationLoaded('lessons') ? $course->lessons->count() : $course->lessons()->count();
            } else {
              $lessonsCount = $course->lessons_count ?? $course->lectures_count ?? 0;
            }
            // Check if user is enrolled
            $isEnrolled = false;
            if (Auth::check()) {
              $isEnrolled = Auth::user()->courses()->where('course_id', $course->id)->exists();
            }
          ?>

          <div class="card">
            <div class="card-image-container">
              <?php if($courseImage): ?>
                <img src="<?php echo e($courseImage); ?>" alt="<?php echo e($courseTitle); ?>" class="card-image" width="400" height="200" loading="lazy" decoding="async">
              <?php else: ?>
                <div style="width:100%;height:200px;background:linear-gradient(135deg,#10b981,#3b82f6);display:flex;align-items:center;justify-content:center;color:#fff;font-size:2rem;">
                  <i class="fas fa-graduation-cap"></i>
                </div>
              <?php endif; ?>
              <?php if($course->is_free): ?>
                <span class="price-badge free">FREE</span>
              <?php else: ?>
                <span class="price-badge paid">KES <?php echo e(number_format($course->price, 0)); ?></span>
              <?php endif; ?>
              <h3 class="card-title"><?php echo e($courseTitle); ?></h3>
            </div>
            <div class="card-content">
              <div class="card-meta">
                <span><i class="fas fa-play-circle"></i> <?php echo e($lessonsCount); ?> lessons</span>
                <?php if($course->course_type === 'cohort_based'): ?>
                  <span><i class="fas fa-users"></i> Cohort-Based</span>
                <?php else: ?>
                  <span><i class="fas fa-user"></i> Self-Paced</span>
                <?php endif; ?>
              </div>
              <?php if($course->slots): ?>
                <?php
                  $remainingSlots = $course->getRemainingSlots();
                ?>
                <div style="margin-bottom: 1rem; padding: 0.5rem; background: rgba(<?php echo e($remainingSlots > 5 ? '16, 185, 129' : ($remainingSlots > 0 ? '251, 191, 36' : '239, 68, 68')); ?>, 0.1); border-radius: 6px; border-left: 3px solid <?php echo e($remainingSlots > 5 ? '#10b981' : ($remainingSlots > 0 ? '#f59e0b' : '#ef4444')); ?>;">
                  <div style="color: <?php echo e($remainingSlots > 5 ? '#10b981' : ($remainingSlots > 0 ? '#f59e0b' : '#ef4444')); ?>; font-size: 0.85rem; font-weight: 600;">
                    <i class="fas fa-users"></i> <?php echo e($remainingSlots); ?> slots remaining
                  </div>
                </div>
              <?php endif; ?>
              <?php if($course->course_type === 'cohort_based' && ($course->duration_weeks || $course->start_date)): ?>
                <div style="margin-bottom: 1rem; padding: 0.5rem; background: rgba(147, 51, 234, 0.1); border-radius: 6px; border-left: 3px solid #9333ea;">
                  <?php if($course->duration_weeks): ?>
                    <div style="color: #9333ea; font-size: 0.85rem; font-weight: 600;">
                      <i class="fas fa-clock"></i> <?php echo e($course->duration_weeks); ?> weeks duration
                    </div>
                  <?php endif; ?>
                  <?php if($course->start_date && $course->end_date): ?>
                    <div style="color: var(--cool-gray); font-size: 0.8rem; margin-top: 0.25rem;">
                      <?php echo e($course->start_date->format('M j')); ?> - <?php echo e($course->end_date->format('M j, Y')); ?>

                    </div>
                  <?php elseif($course->start_date): ?>
                    <div style="color: var(--cool-gray); font-size: 0.8rem; margin-top: 0.25rem;">
                      Starts <?php echo e($course->start_date->format('M j, Y')); ?>

                    </div>
                  <?php endif; ?>
                </div>
              <?php endif; ?>
              
              <?php if($course->has_certification): ?>
                <div style="margin-bottom: 1rem; padding: 0.5rem; background: rgba(251, 191, 36, 0.1); border-radius: 6px; border-left: 3px solid #f59e0b;">
                  <div style="color: #f59e0b; font-size: 0.85rem; font-weight: 600;">
                    <i class="fas fa-certificate"></i> Certificate of Completion
                  </div>
                  <div style="color: var(--cool-gray); font-size: 0.8rem; margin-top: 0.25rem;">
                    Earn a professional certificate upon course completion
                  </div>
                </div>
              <?php endif; ?>
              <p class="card-body"><?php echo e($courseExcerpt); ?></p>
              <?php if($isEnrolled): ?>
                <a class="card-button" href="<?php echo e($showUrl); ?>">
                  Continue Learning <i class="fas fa-arrow-right"></i>
                </a>
              <?php else: ?>
                <a class="card-button" href="<?php echo e($showUrl); ?>">
                  View Course <i class="fas fa-arrow-right"></i>
                </a>
              <?php endif; ?>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    <?php else: ?>
      <div style="text-align: center; padding: 3rem 1rem; color: var(--cool-gray);">
        <i class="fas fa-search" style="font-size: 3rem; opacity: 0.3; margin-bottom: 1rem;"></i>
        <?php if($search ?? false): ?>
          <h3 style="margin-bottom: 1rem;">No courses found for "<?php echo e($search); ?>"</h3>
          <p>Try searching with different keywords or <a href="<?php echo e(route('courses.index')); ?>" style="color: #64b5f6;">browse all courses</a></p>
        <?php else: ?>
          <h3 style="margin-bottom: 1rem;">No Courses Available</h3>
          <p>Check back soon for new courses!</p>
        <?php endif; ?>
      </div>
    <?php endif; ?>
    
    <?php if(method_exists($courses, 'links')): ?>
      <div class="pagination-wrapper" style="display: flex; justify-content: center; margin-top: 3rem;">
        <div class="pagination-container" style="background: var(--charcoal); border-radius: 12px; padding: 1rem; border: 1px solid rgba(100, 181, 246, 0.1);">
          <?php echo e($courses->links()); ?>

        </div>
      </div>
    <?php endif; ?>
   
  </div>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/pages/courses/index.blade.php ENDPATH**/ ?>