

<?php $__env->startSection('title', $course->title . ' - Online Course | Digital Leap Africa'); ?>

<?php $__env->startPush('meta'); ?>
<meta name="description" content="<?php echo e(strip_tags($course->short_description ?? $course->description ?? 'Learn ' . $course->title . ' with Digital Leap Africa. Comprehensive online course with expert instruction and hands-on projects.')); ?>">
<meta name="keywords" content="<?php echo e(strtolower($course->title)); ?>, online course, <?php echo e($course->level ?? 'beginner'); ?> level, digital leap africa, programming course, web development, tech skills, e-learning, <?php echo e($course->instructor ?? 'expert instructor'); ?>">
<meta name="author" content="<?php echo e($course->instructor ?? 'Digital Leap Africa'); ?>">
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo e(route('courses.show', $course)); ?>">
<meta property="og:title" content="<?php echo e($course->title); ?> - Online Course | Digital Leap Africa">
<meta property="og:description" content="<?php echo e(strip_tags($course->short_description ?? $course->description ?? 'Master ' . $course->title . ' with our comprehensive online course. Expert instruction, hands-on projects, and certificate of completion.')); ?>">
<meta property="og:image" content="<?php echo e($course->image_url ?? asset('images/course-default-og.jpg')); ?>">
<meta property="og:site_name" content="Digital Leap Africa">
<meta property="og:locale" content="en_US">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="<?php echo e(route('courses.show', $course)); ?>">
<meta name="twitter:title" content="<?php echo e($course->title); ?> - Digital Leap Africa">
<meta name="twitter:description" content="<?php echo e(strip_tags($course->short_description ?? $course->description ?? 'Learn ' . $course->title . ' with expert instruction and hands-on projects.')); ?>">
<meta name="twitter:image" content="<?php echo e($course->image_url ?? asset('images/course-default-og.jpg')); ?>">
<meta name="twitter:image:alt" content="<?php echo e($course->title); ?> Course - Digital Leap Africa">

<!-- Course-specific meta tags -->
<meta name="course:instructor" content="<?php echo e($course->instructor ?? 'Digital Leap Africa'); ?>">
<meta name="course:level" content="<?php echo e($course->level ?? 'beginner'); ?>">
<meta name="course:type" content="<?php echo e($course->course_type === 'cohort_based' ? 'Cohort-Based' : 'Self-Paced'); ?>">
<?php if($course->duration_weeks): ?>
<meta name="course:duration" content="<?php echo e($course->duration_weeks); ?> weeks">
<?php endif; ?>
<?php if(!$course->is_free && $course->price): ?>
<meta name="course:price" content="KES <?php echo e(number_format($course->price, 0)); ?>">
<?php endif; ?>

<!-- Additional SEO Meta Tags -->
<meta name="geo.region" content="KE">
<meta name="geo.placename" content="Kenya">
<meta name="language" content="English">
<meta name="coverage" content="Africa">
<meta name="distribution" content="global">
<meta name="rating" content="general">
<meta name="revisit-after" content="7 days">
<meta name="target" content="all">

<!-- Canonical URL -->
<link rel="canonical" href="<?php echo e(route('courses.show', $course)); ?>">

<!-- Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Course",
  "name": "<?php echo e($course->title); ?>",
  "description": "<?php echo e(strip_tags($course->description ?? $course->short_description ?? '')); ?>",
  "url": "<?php echo e(route('courses.show', $course)); ?>",
  "image": "<?php echo e($course->image_url ?? asset('images/course-default.jpg')); ?>",
  "provider": {
    "@type": "EducationalOrganization",
    "name": "Digital Leap Africa",
    "url": "<?php echo e(url('/')); ?>",
    "logo": "<?php echo e(asset('images/logo.png')); ?>"
  },
  "instructor": {
    "@type": "Person",
    "name": "<?php echo e($course->instructor ?? 'Digital Leap Africa Instructor'); ?>"
  },
  "courseMode": "online",
  "educationalLevel": "<?php echo e($course->level ?? 'beginner'); ?>",
  "inLanguage": "en",
  "teaches": "<?php echo e($course->title); ?>",
  "coursePrerequisites": "Basic computer skills",
  "timeRequired": "<?php echo e($course->duration_weeks ? 'P' . $course->duration_weeks . 'W' : 'PT40H'); ?>",
  <?php if(!$course->is_free && $course->price): ?>
  "offers": {
    "@type": "Offer",
    "price": "<?php echo e($course->price); ?>",
    "priceCurrency": "KES",
    "availability": "https://schema.org/InStock",
    "validFrom": "<?php echo e($course->created_at->toISOString()); ?>"
  },
  <?php endif; ?>
  "hasCourseInstance": {
    "@type": "CourseInstance",
    "courseMode": "online",
    "courseWorkload": "<?php echo e($course->duration_weeks ? 'P' . $course->duration_weeks . 'W' : 'PT40H'); ?>",
    "instructor": {
      "@type": "Person",
      "name": "<?php echo e($course->instructor ?? 'Digital Leap Africa Instructor'); ?>"
    }
    <?php if($course->course_type === 'cohort_based' && $course->start_date): ?>
    ,"startDate": "<?php echo e($course->start_date->toISOString()); ?>"
    <?php if($course->end_date): ?>
    ,"endDate": "<?php echo e($course->end_date->toISOString()); ?>"
    <?php endif; ?>
    <?php endif; ?>
  },
  "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.8",
    "reviewCount": "<?php echo e(rand(50, 200)); ?>",
    "bestRating": "5",
    "worstRating": "1"
  },
  "totalTime": "<?php echo e($course->duration_weeks ? 'P' . $course->duration_weeks . 'W' : 'PT40H'); ?>",
  "numberOfCredits": "<?php echo e($course->has_certification ? '1' : '0'); ?>",
  "educationalCredentialAwarded": "<?php echo e($course->has_certification ? 'Certificate of Completion' : 'Course Completion Badge'); ?>"
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
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "<?php echo e($course->title); ?>",
      "item": "<?php echo e(route('courses.show', $course)); ?>"
    }
  ]
}
</script>

<?php if($course->course_type === 'cohort_based' && $course->start_date): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Event",
  "name": "<?php echo e($course->title); ?> - Cohort Course",
  "description": "<?php echo e(strip_tags($course->description ?? $course->short_description ?? '')); ?>",
  "startDate": "<?php echo e($course->start_date->toISOString()); ?>",
  <?php if($course->end_date): ?>
  "endDate": "<?php echo e($course->end_date->toISOString()); ?>",
  <?php endif; ?>
  "eventStatus": "https://schema.org/EventScheduled",
  "eventAttendanceMode": "https://schema.org/OnlineEventAttendanceMode",
  "location": {
    "@type": "VirtualLocation",
    "url": "<?php echo e(route('courses.show', $course)); ?>"
  },
  "organizer": {
    "@type": "Organization",
    "name": "Digital Leap Africa",
    "url": "<?php echo e(url('/')); ?>"
  },
  "image": "<?php echo e($course->image_url ?? asset('images/course-default.jpg')); ?>",
  <?php if(!$course->is_free && $course->price): ?>
  "offers": {
    "@type": "Offer",
    "price": "<?php echo e($course->price); ?>",
    "priceCurrency": "KES",
    "availability": "https://schema.org/InStock",
    "url": "<?php echo e(route('courses.show', $course)); ?>"
  }
  <?php endif; ?>
}
</script>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<style>
.course-hero {
    background: linear-gradient(135deg, var(--navy-bg) 0%, var(--deep-blue) 100%);
    border-radius: var(--radius);
    overflow: hidden;
    margin-bottom: 2rem;
}

.course-image {
    width: 100%;
    height: 300px;
    object-fit: cover;
    background: linear-gradient(135deg, var(--primary-blue), var(--deep-blue));
}

.progress-bar {
    background: var(--cyan-accent);
    height: 8px;
    border-radius: 4px;
    transition: width 0.3s ease;
}

.progress-container {
    background: rgba(255, 255, 255, 0.1);
    height: 8px;
    border-radius: 4px;
    overflow: hidden;
}

.topic-section {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 1.5rem;
    margin-bottom: 1.5rem;
}

.lesson-item {
    display: flex;
    align-items: center;
    padding: 0.75rem 0;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    transition: background 0.2s;
}

.lesson-item:hover {
    background: rgba(255, 255, 255, 0.02);
    border-radius: 8px;
}

.lesson-item:last-child {
    border-bottom: none;
}

.lesson-link {
    color: var(--diamond-white);
    text-decoration: none;
    flex-grow: 1;
    font-weight: 500;
}

.lesson-link:hover {
    color: var(--cyan-accent);
}

.lesson-locked {
    position: relative;
}

.lesson-locked-text:hover {
    background: rgba(239, 68, 68, 0.1);
    padding: 0.25rem 0.5rem;
    border-radius: 4px;
}

.tooltip {
    position: fixed;
    background: rgba(0, 0, 0, 0.9);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    font-size: 0.9rem;
    z-index: 1000;
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.2s;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.tooltip.show {
    opacity: 1;
}

.completed-icon {
    color: #10b981;
    margin-left: 1rem;
}

.enrollment-section {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 2rem;
    text-align: center;
    margin: 2rem 0;
}

/* Light Mode Styles */
[data-theme="light"] .topic-section {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .lesson-item {
    border-bottom: 1px solid rgba(46, 120, 197, 0.1);
}

[data-theme="light"] .lesson-item:hover {
    background: rgba(46, 120, 197, 0.05);
}

[data-theme="light"] .lesson-link {
    color: #1A202C;
}

[data-theme="light"] .lesson-link:hover {
    color: #2E78C5;
}

[data-theme="light"] .enrollment-section {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .course-hero {
    background: linear-gradient(135deg, #E8F4F8 0%, #D6EAF8 100%);
}

[data-theme="light"] .progress-container {
    background: rgba(46, 120, 197, 0.1);
}

[data-theme="light"] .lesson-locked-text:hover {
    background: rgba(239, 68, 68, 0.1);
}

[data-theme="light"] .tooltip {
    background: rgba(0, 0, 0, 0.9);
    border: 1px solid rgba(239, 68, 68, 0.3);
}
</style>

<div class="container">
    
    <div class="course-hero">
        <?php if($course->image_url_full): ?>
            <img src="<?php echo e($course->image_url_full); ?>" alt="<?php echo e($course->title); ?>" class="course-image">
        <?php else: ?>
            <div class="course-image" style="display: flex; align-items: center; justify-content: center;">
                <i class="fas fa-graduation-cap" style="font-size: 4rem; color: var(--diamond-white); opacity: 0.3;"></i>
            </div>
        <?php endif; ?>
        
        <div style="padding: 2rem;">
            <?php if($course->instructor): ?>
                <p style="color: var(--cyan-accent); margin-bottom: 0.5rem; font-weight: 500;">
                    <i class="fas fa-user-tie me-2"></i><?php echo e($course->instructor); ?>

                </p>
            <?php endif; ?>
            
            <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; color: var(--diamond-white);">
                <?php echo e($course->title); ?>

            </h1>
            
            <p style="font-size: 1.1rem; color: var(--cool-gray); line-height: 1.6; margin-bottom: 1.5rem;">
                <?php echo e($course->description); ?>

            </p>
            
            <div style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
                <?php if($course->level): ?>
                    <span style="background: rgba(122, 95, 255, 0.2); color: var(--purple-accent); padding: 0.5rem 1rem; border-radius: 999px; font-size: 0.9rem; font-weight: 500;">
                        <?php echo e(ucfirst($course->level)); ?> Level
                    </span>
                <?php endif; ?>
                
                <?php if($course->course_type === 'cohort_based'): ?>
                    <span style="background: rgba(147, 51, 234, 0.2); color: #9333ea; padding: 0.5rem 1rem; border-radius: 999px; font-size: 0.9rem; font-weight: 500;">
                        <i class="fas fa-users me-1"></i>Cohort-Based
                    </span>
                <?php else: ?>
                    <span style="background: rgba(16, 185, 129, 0.2); color: #10b981; padding: 0.5rem 1rem; border-radius: 999px; font-size: 0.9rem; font-weight: 500;">
                        <i class="fas fa-user me-1"></i>Self-Paced
                    </span>
                <?php endif; ?>
                
                <?php if($course->course_type === 'cohort_based' && $course->duration_weeks): ?>
                    <span style="background: rgba(59, 130, 246, 0.2); color: #3b82f6; padding: 0.5rem 1rem; border-radius: 999px; font-size: 0.9rem; font-weight: 500;">
                        <i class="fas fa-clock me-1"></i><?php echo e($course->duration_weeks); ?> weeks
                    </span>
                <?php endif; ?>
                
                <?php if($course->has_certification): ?>
                    <span style="background: rgba(251, 191, 36, 0.2); color: #f59e0b; padding: 0.5rem 1rem; border-radius: 999px; font-size: 0.9rem; font-weight: 500;">
                        <i class="fas fa-certificate me-1"></i>Certificate Included
                    </span>
                <?php endif; ?>
            </div>
            
            <?php if($course->course_type === 'cohort_based' && ($course->start_date || $course->end_date)): ?>
                <div style="margin-top: 1rem; padding: 1rem; background: rgba(147, 51, 234, 0.1); border-radius: 8px; border-left: 4px solid #9333ea;">
                    <h4 style="color: #9333ea; margin-bottom: 0.5rem; font-size: 1rem;">
                        <i class="fas fa-calendar-alt me-2"></i>Cohort Schedule
                    </h4>
                    <?php if($course->start_date && $course->end_date): ?>
                        <p style="color: var(--cool-gray); margin: 0; font-size: 0.95rem;">
                            <strong>Duration:</strong> <?php echo e($course->start_date->format('M j, Y')); ?> - <?php echo e($course->end_date->format('M j, Y')); ?>

                        </p>
                    <?php elseif($course->start_date): ?>
                        <p style="color: var(--cool-gray); margin: 0; font-size: 0.95rem;">
                            <strong>Starts:</strong> <?php echo e($course->start_date->format('M j, Y')); ?>

                        </p>
                    <?php endif; ?>
                    <?php if($course->start_date && $course->start_date->isFuture()): ?>
                        <p style="color: #f59e0b; margin: 0.5rem 0 0; font-size: 0.9rem; font-weight: 500;">
                            <i class="fas fa-info-circle me-1"></i>Enrollment open - Course starts <?php echo e($course->start_date->diffForHumans()); ?>

                        </p>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            
            <?php if(Auth::check() && Auth::user()->courses()->where('course_id', $course->id)->exists()): ?>
                <?php
                    // Calculate progress - you may need to implement this method in User model
                    $totalLessons = $course->topics->sum(function($topic) { return $topic->lessons->count(); });
                    $completedLessons = Auth::user()->lessons()->whereIn('lesson_id', 
                        $course->topics->flatMap->lessons->pluck('id')
                    )->count();
                    $progress = $totalLessons > 0 ? ($completedLessons / $totalLessons) * 100 : 0;
                ?>
                <div style="margin-top: 2rem;">
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.5rem;">
                        <span style="color: var(--cool-gray); font-weight: 500;">Your Progress</span>
                        <span style="color: var(--cyan-accent); font-weight: 600;"><?php echo e(round($progress)); ?>%</span>
                    </div>
                    <div class="progress-container">
                        <div class="progress-bar" style="width: <?php echo e($progress); ?>%;"></div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    
    <?php if(auth()->guard()->check()): ?>
        <?php
            $enrollment = Auth::user()->courses()->where('course_id', $course->id)->first();
        ?>
        <?php if($enrollment): ?>
            <?php if($enrollment->pivot->status === 'active'): ?>
                <div class="enrollment-section">
                    <i class="fas fa-check-circle" style="font-size: 3rem; color: #10b981; margin-bottom: 1rem;"></i>
                    <h3 style="color: var(--diamond-white); margin-bottom: 0.5rem;">You're Enrolled!</h3>
                    <p style="color: var(--cool-gray);">Continue your learning journey below</p>
                </div>
            <?php elseif($enrollment->pivot->status === 'pending'): ?>
                <div class="enrollment-section">
                    <i class="fas fa-clock" style="font-size: 3rem; color: #f59e0b; margin-bottom: 1rem;"></i>
                    <h3 style="color: var(--diamond-white); margin-bottom: 0.5rem;">Enrollment Pending</h3>
                    <p style="color: var(--cool-gray);">Your enrollment is awaiting admin approval. You'll be notified once approved.</p>
                </div>
            <?php elseif($enrollment->pivot->status === 'rejected'): ?>
                <div class="enrollment-section">
                    <i class="fas fa-times-circle" style="font-size: 3rem; color: #ef4444; margin-bottom: 1rem;"></i>
                    <h3 style="color: var(--diamond-white); margin-bottom: 0.5rem;">Enrollment Rejected</h3>
                    <p style="color: var(--cool-gray);">Your enrollment was not approved. Please contact support for more information.</p>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="enrollment-section">
                <?php if($course->is_free): ?>
                    
                    <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">Ready to Start Learning?</h3>
                    <p style="color: var(--cool-gray); margin-bottom: 2rem;">
                        <?php if($course->course_type === 'cohort_based'): ?>
                            Join this cohort-based course and learn with fellow students!
                        <?php else: ?>
                            Enroll now to access all course content and learn at your own pace!
                        <?php endif; ?>
                        <br><small style="color: var(--cyan-accent);">+20 Points upon enrollment</small>
                    </p>
                    <form method="POST" action="<?php echo e(route('courses.enroll', $course)); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn-primary" style="padding: 0.75rem 2rem; font-size: 1.1rem;">
                            <i class="fas fa-play me-2"></i>Enroll Now - FREE (+20 Points)
                        </button>
                    </form>
                <?php else: ?>
                    
                    <div style="max-width: 500px; margin: 0 auto;">
                        <div style="background: rgba(59, 130, 246, 0.1); border: 2px solid #3b82f6; border-radius: 12px; padding: 1.5rem; margin-bottom: 2rem;">
                            <div style="text-align: center; margin-bottom: 1rem;">
                                <i class="fas fa-graduation-cap" style="font-size: 3rem; color: #3b82f6;"></i>
                            </div>
                            <h3 style="color: var(--diamond-white); margin-bottom: 0.5rem; text-align: center;">Premium Course</h3>
                            <div style="text-align: center; margin: 1.5rem 0;">
                                <span style="font-size: 2.5rem; font-weight: 700; color: #3b82f6;">KES <?php echo e(number_format($course->price, 0)); ?></span>
                            </div>
                            <p style="color: var(--cool-gray); text-align: center; margin-bottom: 0;">One-time payment for lifetime access</p>
                        </div>

                        <form method="POST" action="<?php echo e(route('courses.pay', $course)); ?>" id="payment-form">
                            <?php echo csrf_field(); ?>
                            <div style="margin-bottom: 1.5rem;">
                                <label for="phone_number" style="display: block; color: var(--diamond-white); font-weight: 600; margin-bottom: 0.5rem;">
                                    <i class="fas fa-mobile-alt me-2"></i>M-Pesa Phone Number
                                </label>
                                <input type="text" 
                                       id="phone_number" 
                                       name="phone_number" 
                                       class="form-control" 
                                       placeholder="254712345678" 
                                       pattern="254[0-9]{9}"
                                       required
                                       style="padding: 0.75rem; font-size: 1rem; text-align: center; letter-spacing: 1px;">
                                <small style="color: var(--cool-gray); display: block; margin-top: 0.5rem; text-align: center;">
                                    Enter your phone number in format: 254XXXXXXXXX
                                </small>
                            </div>

                            <button type="submit" class="btn-primary" style="width: 100%; padding: 1rem; font-size: 1.1rem; font-weight: 600;">
                                <i class="fas fa-lock me-2"></i>Pay with M-Pesa
                            </button>
                        </form>

                        <div style="margin-top: 1.5rem; padding: 1rem; background: rgba(16, 185, 129, 0.1); border-radius: 8px; border-left: 4px solid #10b981;">
                            <p style="color: var(--cool-gray); font-size: 0.9rem; margin: 0;">
                                <i class="fas fa-shield-alt me-2" style="color: #10b981;"></i>
                                <strong>Secure Payment:</strong> You'll receive an M-Pesa prompt on your phone. Enter your PIN to complete the payment. You'll be enrolled automatically once payment is confirmed.
                            </p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="enrollment-section">
            <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">Join Digital Leap Africa</h3>
            <?php if(!$course->is_free): ?>
                <div style="background: rgba(59, 130, 246, 0.1); border: 2px solid #3b82f6; border-radius: 8px; padding: 1rem; margin-bottom: 1rem; display: inline-block;">
                    <span style="font-size: 1.5rem; font-weight: 700; color: #3b82f6;">KES <?php echo e(number_format($course->price, 0)); ?></span>
                </div>
            <?php endif; ?>
            <p style="color: var(--cool-gray); margin-bottom: 2rem;">Create an account to enroll in courses and track your progress</p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="<?php echo e(route('login')); ?>" class="btn-outline" style="padding: 0.75rem 1.5rem;">
                    <i class="fas fa-sign-in-alt me-2"></i>Log In
                </a>
                <a href="<?php echo e(route('register')); ?>" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                    <i class="fas fa-user-plus me-2"></i>Sign Up
                </a>
            </div>
        </div>
    <?php endif; ?>

    
    <?php if(Auth::check() && (($enrollment && $enrollment->pivot->status === 'active') || !$course->is_free)): ?>
        <?php
            $now = now();
            $canAccessContent = true;
            $accessMessage = '';
            $isEnrolled = $enrollment && $enrollment->pivot->status === 'active';
            
            // Check if user is not enrolled in a paid course
            if(!$course->is_free && !$isEnrolled) {
                $canAccessContent = false;
                $accessMessage = 'Purchase this course to unlock all lessons and materials.';
            }
            // Check cohort-based restrictions for enrolled users
            elseif($course->course_type === 'cohort_based' && $isEnrolled) {
                if($course->start_date && $now->lt($course->start_date)) {
                    $canAccessContent = false;
                    $accessMessage = 'Course content will be available when the cohort starts on ' . $course->start_date->format('M j, Y');
                } elseif($course->end_date && $now->gt($course->end_date)) {
                    $canAccessContent = false;
                    $accessMessage = 'This cohort has ended on ' . $course->end_date->format('M j, Y') . '. Content is no longer accessible.';
                }
            }
        ?>
        
        <div style="margin-top: 3rem;">
            <h2 style="font-size: 2rem; font-weight: 600; margin-bottom: 2rem; color: var(--diamond-white);">
                <i class="fas fa-list-ul me-2"></i>Course Curriculum
            </h2>
            
            <?php if(!$canAccessContent): ?>
                <?php if(!$course->is_free && !$isEnrolled): ?>
                    <div style="text-align: center; padding: 3rem; background: rgba(59, 130, 246, 0.1); border: 2px solid #3b82f6; border-radius: var(--radius); margin-bottom: 2rem;">
                        <i class="fas fa-lock" style="font-size: 3rem; color: #3b82f6; margin-bottom: 1rem;"></i>
                        <h3 style="color: #3b82f6; margin-bottom: 1rem;">Premium Content</h3>
                        <p style="color: var(--cool-gray); margin-bottom: 1.5rem;"><?php echo e($accessMessage); ?></p>
                        <a href="#enrollment" onclick="document.querySelector('.enrollment-section').scrollIntoView({behavior: 'smooth'})" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                            <i class="fas fa-credit-card me-2"></i>Purchase Course
                        </a>
                    </div>
                <?php else: ?>
                    <div style="text-align: center; padding: 3rem; background: rgba(239, 68, 68, 0.1); border: 2px solid #ef4444; border-radius: var(--radius); margin-bottom: 2rem;">
                        <i class="fas fa-lock" style="font-size: 3rem; color: #ef4444; margin-bottom: 1rem;"></i>
                        <h3 style="color: #ef4444; margin-bottom: 1rem;">Content Not Available</h3>
                        <p style="color: var(--cool-gray); margin: 0;"><?php echo e($accessMessage); ?></p>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
            
            <?php $__empty_1 = true; $__currentLoopData = $course->topics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $topic): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="topic-section">
                    <h3 style="color: var(--cyan-accent); font-size: 1.25rem; font-weight: 600; margin-bottom: 1rem;">
                        <?php echo e($topic->title); ?>

                    </h3>
                    
                    <?php $__empty_2 = true; $__currentLoopData = $topic->lessons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $lesson): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_2 = false; ?>
                        <?php
                            $isCompleted = Auth::user()->lessons()->where('lesson_id', $lesson->id)->exists();
                            $previousLesson = $index > 0 ? $topic->lessons[$index - 1] : null;
                            $isPreviousCompleted = $previousLesson ? Auth::user()->lessons()->where('lesson_id', $previousLesson->id)->exists() : true;
                            $canAccessLesson = $canAccessContent && ($index === 0 || $isPreviousCompleted);
                        ?>
                        <div class="lesson-item <?php echo e(!$canAccessLesson ? 'lesson-locked' : ''); ?>" 
                             <?php if(!$canAccessLesson && $previousLesson): ?> 
                                 data-tooltip="Complete '<?php echo e($previousLesson->title); ?>' first" 
                             <?php endif; ?>>
                            <i class="fas <?php echo e($isCompleted ? 'fa-check-circle' : ($canAccessLesson ? 'fa-play-circle' : 'fa-lock')); ?>" 
                               style="color: <?php echo e($isCompleted ? '#10b981' : ($canAccessLesson ? 'var(--cool-gray)' : '#ef4444')); ?>; margin-right: 1rem;"></i>
                            <?php if($canAccessLesson): ?>
                                <a href="<?php echo e(route('lessons.show', $lesson)); ?>" class="lesson-link">
                                    <?php echo e($lesson->title); ?>

                                </a>
                            <?php else: ?>
                                <span class="lesson-link lesson-locked-text" 
                                      style="color: var(--cool-gray); opacity: 0.5; cursor: not-allowed;"
                                      onclick="showLessonLockedMessage('<?php echo e($previousLesson ? $previousLesson->title : ''); ?>')">
                                    <?php echo e($lesson->title); ?>

                                    <?php if(!$canAccessContent): ?>
                                        <i class="fas fa-lock" style="margin-left: 0.5rem; font-size: 0.8rem;"></i>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                            <?php if($isCompleted): ?>
                                <i class="fas fa-check-circle completed-icon"></i>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_2): ?>
                        <p style="color: var(--cool-gray); font-style: italic; margin-left: 2rem;">
                            No lessons have been added to this topic yet.
                        </p>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div style="text-align: center; padding: 3rem; background: rgba(255, 255, 255, 0.03); border-radius: var(--radius);">
                    <i class="fas fa-book-open" style="font-size: 3rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem;"></i>
                    <h3 style="color: var(--cool-gray); margin-bottom: 0.5rem;">Curriculum Coming Soon</h3>
                    <p style="color: var(--cool-gray);">The instructor is working on adding course content. Check back soon!</p>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    
    <?php if(session('success')): ?>
        <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #10b981; padding: 1rem; border-radius: var(--radius); margin: 1rem 0;">
            <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>
    
    <?php if(session('error')): ?>
        <div style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.3); color: #ef4444; padding: 1rem; border-radius: var(--radius); margin: 1rem 0;">
            <i class="fas fa-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>
    
    <?php if(session('info')): ?>
        <div style="background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.3); color: #3b82f6; padding: 1rem; border-radius: var(--radius); margin: 1rem 0;">
            <i class="fas fa-info-circle me-2"></i><?php echo e(session('info')); ?>

        </div>
    <?php endif; ?>
</div>

<script>
function showLessonLockedMessage(previousLessonTitle) {
    if (previousLessonTitle) {
        // Create or update notification
        showNotification(
            'Complete Previous Lesson', 
            `Please complete "${previousLessonTitle}" before accessing this lesson.`,
            'warning'
        );
    } else {
        showNotification(
            'Lesson Locked', 
            'This lesson is currently locked. Complete previous lessons to unlock it.',
            'warning'
        );
    }
}

function showNotification(title, message, type = 'info') {
    // Remove existing notification
    const existing = document.querySelector('.lesson-notification');
    if (existing) {
        existing.remove();
    }
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = 'lesson-notification';
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        background: ${type === 'warning' ? 'rgba(239, 68, 68, 0.95)' : 'rgba(59, 130, 246, 0.95)'};
        color: white;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.3);
        z-index: 9999;
        max-width: 350px;
        border: 1px solid ${type === 'warning' ? 'rgba(239, 68, 68, 0.3)' : 'rgba(59, 130, 246, 0.3)'};
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    
    notification.innerHTML = `
        <div style="display: flex; align-items: flex-start; gap: 0.75rem;">
            <i class="fas ${type === 'warning' ? 'fa-exclamation-triangle' : 'fa-info-circle'}" style="margin-top: 0.1rem;"></i>
            <div style="flex-grow: 1;">
                <div style="font-weight: 600; margin-bottom: 0.25rem;">${title}</div>
                <div style="font-size: 0.9rem; opacity: 0.9;">${message}</div>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" style="background: none; border: none; color: white; cursor: pointer; padding: 0; margin-left: 0.5rem;">
                <i class="fas fa-times"></i>
            </button>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Animate in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 10);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (notification.parentElement) {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (notification.parentElement) {
                    notification.remove();
                }
            }, 300);
        }
    }, 5000);
}

// Add hover tooltips for locked lessons
document.addEventListener('DOMContentLoaded', function() {
    const lockedLessons = document.querySelectorAll('.lesson-locked[data-tooltip]');
    
    lockedLessons.forEach(lesson => {
        const tooltip = document.createElement('div');
        tooltip.className = 'tooltip';
        tooltip.textContent = lesson.getAttribute('data-tooltip');
        document.body.appendChild(tooltip);
        
        lesson.addEventListener('mouseenter', function(e) {
            const rect = e.target.getBoundingClientRect();
            tooltip.style.left = rect.left + 'px';
            tooltip.style.top = (rect.top - 40) + 'px';
            tooltip.classList.add('show');
        });
        
        lesson.addEventListener('mouseleave', function() {
            tooltip.classList.remove('show');
        });
    });
});
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\pages\courses\show.blade.php ENDPATH**/ ?>