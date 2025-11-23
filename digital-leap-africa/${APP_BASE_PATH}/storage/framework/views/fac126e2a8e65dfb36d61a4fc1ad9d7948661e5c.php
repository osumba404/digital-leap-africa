

<?php $__env->startSection('title', ($event->title ?? 'Event') . ' | Digital Leap Africa Events'); ?>
<?php $__env->startSection('meta_description', Str::limit(strip_tags($event->description ?? ''), 160)); ?>
<?php $__env->startSection('meta_keywords', implode(', ', array_merge([$event->topic ?? 'technology'], ['tech events', 'workshops', 'developer meetups', 'programming', 'digital transformation', 'Africa']))); ?>
<?php $__env->startSection('canonical', route('events.show', $event)); ?>

<?php $__env->startPush('meta'); ?>
<!-- Open Graph / Facebook -->
<meta property="og:type" content="event">
<meta property="og:url" content="<?php echo e(route('events.show', $event)); ?>">
<meta property="og:title" content="<?php echo e($event->title ?? 'Event'); ?>">
<meta property="og:description" content="<?php echo e(Str::limit(strip_tags($event->description ?? ''), 160)); ?>">
<meta property="og:image" content="<?php echo e($event->image_url ?? asset('images/event-default.jpg')); ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:site_name" content="Digital Leap Africa">
<meta property="og:locale" content="en_US">
<?php if($event->date): ?>
<meta property="event:start_time" content="<?php echo e($event->date->toISOString()); ?>">
<?php endif; ?>
<?php if($event->ends_at): ?>
<meta property="event:end_time" content="<?php echo e($event->ends_at->toISOString()); ?>">
<?php endif; ?>
<?php if($event->location): ?>
<meta property="event:location" content="<?php echo e($event->location); ?>">
<?php endif; ?>

<!-- Twitter -->
<meta property="twitter:card" content="summary_large_image">
<meta property="twitter:url" content="<?php echo e(route('events.show', $event)); ?>">
<meta property="twitter:title" content="<?php echo e($event->title ?? 'Event'); ?>">
<meta property="twitter:description" content="<?php echo e(Str::limit(strip_tags($event->description ?? ''), 160)); ?>">
<meta property="twitter:image" content="<?php echo e($event->image_url ?? asset('images/event-default.jpg')); ?>">
<meta property="twitter:creator" content="@DigitalLeapAfrica">
<meta property="twitter:site" content="@DigitalLeapAfrica">

<!-- Additional SEO -->
<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<meta name="author" content="Digital Leap Africa">
<meta name="publisher" content="Digital Leap Africa">
<meta name="geo.region" content="KE">
<meta name="geo.country" content="Kenya">
<meta name="geo.placename" content="<?php echo e($event->location ?? 'Nairobi'); ?>">
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

<!-- Event Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Event",
  "name": "<?php echo e(addslashes($event->title ?? 'Event')); ?>",
  "description": "<?php echo e(addslashes(Str::limit(strip_tags($event->description ?? ''), 200))); ?>",
  "url": "<?php echo e(route('events.show', $event)); ?>",
  <?php if($event->date): ?>
  "startDate": "<?php echo e($event->date->toISOString()); ?>",
  <?php endif; ?>
  <?php if($event->ends_at): ?>
  "endDate": "<?php echo e($event->ends_at->toISOString()); ?>",
  <?php endif; ?>
  "eventStatus": "<?php echo e($event->date && $event->date->isFuture() ? 'https://schema.org/EventScheduled' : ($event->date && $event->date->isPast() ? 'https://schema.org/EventPostponed' : 'https://schema.org/EventScheduled')); ?>",
  "eventAttendanceMode": "<?php echo e($event->location ? 'https://schema.org/OfflineEventAttendanceMode' : 'https://schema.org/OnlineEventAttendanceMode'); ?>",
  <?php if($event->image_url): ?>
  "image": {
    "@type": "ImageObject",
    "url": "<?php echo e($event->image_url); ?>",
    "width": 1200,
    "height": 630
  },
  <?php endif; ?>
  <?php if($event->location): ?>
  "location": {
    "@type": "Place",
    "name": "<?php echo e(addslashes($event->location)); ?>",
    "address": {
      "@type": "PostalAddress",
      "streetAddress": "<?php echo e(addslashes($event->location)); ?>",
      "addressCountry": "Kenya"
    }
  },
  <?php else: ?>
  "location": {
    "@type": "VirtualLocation",
    "url": "<?php echo e(route('events.show', $event)); ?>"
  },
  <?php endif; ?>
  "organizer": {
    "@type": "Organization",
    "name": "Digital Leap Africa",
    "url": "<?php echo e(url('/')); ?>",
    "logo": {
      "@type": "ImageObject",
      "url": "<?php echo e(asset('images/logo.png')); ?>"
    },
    "contactPoint": {
      "@type": "ContactPoint",
      "contactType": "customer service",
      "url": "<?php echo e(route('contact')); ?>"
    }
  },
  "offers": {
    "@type": "Offer",
    "price": "0",
    "priceCurrency": "USD",
    "availability": "https://schema.org/InStock",
    "url": "<?php echo e($event->registration_url ?? route('events.show', $event)); ?>",
    "validFrom": "<?php echo e($event->created_at->toISOString()); ?>"
  },
  <?php if($event->topic): ?>
  "about": {
    "@type": "Thing",
    "name": "<?php echo e($event->topic); ?>"
  },
  <?php endif; ?>
  "performer": {
    "@type": "Organization",
    "name": "Digital Leap Africa"
  },
  "audience": {
    "@type": "Audience",
    "audienceType": "Developers, Tech Enthusiasts, Students"
  },
  "inLanguage": "en-US",
  "isAccessibleForFree": true
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
      "name": "Events",
      "item": "<?php echo e(route('events.index')); ?>"
    },
    {
      "@type": "ListItem",
      "position": 3,
      "name": "<?php echo e($event->title ?? 'Event'); ?>",
      "item": "<?php echo e(route('events.show', $event)); ?>"
    }
  ]
}
</script>

<!-- WebPage Structured Data -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebPage",
  "name": "<?php echo e($event->title ?? 'Event'); ?>",
  "description": "<?php echo e(Str::limit(strip_tags($event->description ?? ''), 160)); ?>",
  "url": "<?php echo e(route('events.show', $event)); ?>",
  "mainEntity": {
    "@id": "<?php echo e(route('events.show', $event)); ?>#event"
  },
  "breadcrumb": {
    "@id": "<?php echo e(route('events.show', $event)); ?>#breadcrumb"
  },
  "isPartOf": {
    "@type": "WebSite",
    "name": "Digital Leap Africa",
    "url": "<?php echo e(url('/')); ?>"
  },
  "potentialAction": [
    {
      "@type": "ViewAction",
      "target": "<?php echo e(route('events.show', $event)); ?>"
    },
    {
      "@type": "ShareAction",
      "target": "<?php echo e(route('events.show', $event)); ?>"
    }
    <?php if($event->registration_url): ?>
    ,{
      "@type": "RegisterAction",
      "target": "<?php echo e($event->registration_url); ?>"
    }
    <?php endif; ?>
  ]
}
</script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<?php
    // Model casts ensure $event->date and $event->ends_at are Carbon|null
    $start = $event->date;
    $end   = $event->ends_at;
    $sameDay = ($start && $end) ? $start->isSameDay($end) : false;
    $whenText = $start ? $start->format('M j, Y g:ia') : '';
    if ($end) {
        $whenText .= $sameDay ? ' – ' . $end->format('g:ia') : ' – ' . $end->format('M j, Y g:ia');
    }
    
    // Determine event status
    $now = now();
    $isUpcoming = $start && $start->isFuture();
    $isPast = $end ? $end->isPast() : ($start && $start->isPast());
    $isOngoing = !$isUpcoming && !$isPast;
?>

<style>
    .event-hero {
        background: linear-gradient(135deg, rgba(10, 15, 28, 0.95) 0%, rgba(19, 26, 42, 0.9) 100%);
        padding: 3rem 0;
        margin: -2rem -5% 2rem;
        border-radius: 0 0 24px 24px;
        position: relative;
        overflow: hidden;
    }
    
    [data-theme="light"] .event-hero {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(230, 242, 255, 0.95) 100%);
        border-bottom: 2px solid rgba(46, 120, 197, 0.2);
    }
    
    .event-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: radial-gradient(circle at 20% 50%, rgba(0, 201, 255, 0.1) 0%, transparent 50%);
        pointer-events: none;
    }
    
    .event-hero-content {
        position: relative;
        z-index: 1;
    }
    
    .event-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--diamond-white);
        margin: 0 0 1rem 0;
        line-height: 1.2;
    }
    
    [data-theme="light"] .event-title {
        color: #1a202c;
    }
    
    .event-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1.5rem;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .event-meta-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--cool-gray);
        font-size: 1rem;
    }
    
    .event-meta-item i {
        color: var(--cyan-accent);
        font-size: 1.1rem;
    }
    
    [data-theme="light"] .event-meta-item {
        color: #4A5568;
    }
    
    [data-theme="light"] .event-meta-item i {
        color: var(--primary-blue);
    }
    
    .event-status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .event-status-badge.upcoming {
        background: rgba(59, 130, 246, 0.15);
        color: #64b5f6;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }
    
    .event-status-badge.ongoing {
        background: rgba(16, 185, 129, 0.15);
        color: #10b981;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }
    
    .event-status-badge.past {
        background: rgba(156, 163, 175, 0.15);
        color: #9ca3af;
        border: 1px solid rgba(156, 163, 175, 0.3);
    }
    
    [data-theme="light"] .event-status-badge.upcoming {
        background: rgba(46, 120, 197, 0.1);
        color: var(--primary-blue);
        border-color: rgba(46, 120, 197, 0.3);
    }
    
    [data-theme="light"] .event-status-badge.ongoing {
        background: rgba(16, 185, 129, 0.1);
        color: #059669;
        border-color: rgba(16, 185, 129, 0.3);
    }
    
    .event-topic-badge {
        background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
        color: #07101a;
        padding: 0.5rem 1rem;
        border-radius: 999px;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-block;
    }
    
    [data-theme="light"] .event-topic-badge {
        background: linear-gradient(90deg, var(--primary-blue), #6B46C1);
        color: #FFFFFF;
    }
    
    .event-image-container {
        margin: 2rem 0;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
    }
    
    [data-theme="light"] .event-image-container {
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(46, 120, 197, 0.2);
    }
    
    .event-image {
        width: 100%;
        max-height: 500px;
        object-fit: cover;
        display: block;
        will-change: transform;
        backface-visibility: hidden;
        transform: translateZ(0);
        aspect-ratio: 2/1;
    }
    
    .lazy-load {
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .lazy-load.loaded {
        opacity: 1;
    }
    
    .event-image.lazy-load {
        background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
        background-size: 200% 100%;
        animation: loading 1.5s infinite;
    }
    
    @keyframes loading {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
    
    [data-theme="light"] .event-image.lazy-load {
        background: linear-gradient(90deg, #f8f9fa 25%, #e9ecef 50%, #f8f9fa 75%);
        background-size: 200% 100%;
    }
    
    .event-content-card {
        background: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    
    [data-theme="light"] .event-content-card {
        background: #FFFFFF;
        border: 1px solid rgba(46, 120, 197, 0.2);
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
    }
    
    .event-description {
        color: var(--cool-gray);
        font-size: 1.1rem;
        line-height: 1.8;
        margin: 0;
    }
    
    [data-theme="light"] .event-description {
        color: #4A5568;
    }
    
    .event-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 1.5rem;
    }
    
    .btn-register {
        background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
        color: #07101a;
        padding: 0.75rem 2rem;
        border-radius: 999px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 14px rgba(0, 201, 255, 0.3);
    }
    
    .btn-register:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 201, 255, 0.4);
        color: #07101a;
    }
    
    [data-theme="light"] .btn-register {
        background: linear-gradient(90deg, var(--primary-blue), #6B46C1);
        color: #FFFFFF;
        box-shadow: 0 4px 14px rgba(46, 120, 197, 0.3);
    }
    
    [data-theme="light"] .btn-register:hover {
        box-shadow: 0 8px 25px rgba(46, 120, 197, 0.4);
        color: #FFFFFF;
    }
    
    .btn-back {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: var(--diamond-white);
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        margin-bottom: 2rem;
    }
    
    .btn-back:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.3);
        transform: translateX(-3px);
        color: var(--diamond-white);
    }
    
    [data-theme="light"] .btn-back {
        background: rgba(46, 120, 197, 0.05);
        border: 1px solid rgba(46, 120, 197, 0.3);
        color: var(--primary-blue);
    }
    
    [data-theme="light"] .btn-back:hover {
        background: rgba(46, 120, 197, 0.15);
        border-color: rgba(46, 120, 197, 0.5);
        color: var(--primary-blue);
    }
    
    @media (max-width: 768px) {
        .event-hero {
            padding: 2rem 0;
            margin: -1rem -2.5% 1.5rem;
        }
        
        .event-title {
            font-size: 1.75rem;
        }
        
        .event-meta {
            gap: 1rem;
        }
        
        .event-meta-item {
            font-size: 0.9rem;
        }
        
        .event-content-card {
            padding: 1.5rem;
        }
        
        .event-description {
            font-size: 1rem;
        }
    }
</style>

<section class="container">
    <a class="btn-back" href="<?php echo e(route('events.index')); ?>">
        <i class="fas fa-arrow-left"></i> Back to Events
    </a>

    <div class="event-hero">
        <div class="event-hero-content container">
            <h1 class="event-title"><?php echo e($event->title); ?></h1>
            
            <div class="event-meta">
                <div class="event-meta-item">
                    <i class="fas fa-calendar"></i>
                    <span><?php echo e($whenText); ?></span>
                </div>
                
                <?php if(!empty($event->location)): ?>
                    <div class="event-meta-item">
                        <i class="fas fa-location-dot"></i>
                        <span><?php echo e($event->location); ?></span>
                    </div>
                <?php endif; ?>
                
                <div>
                    <?php if($isUpcoming): ?>
                        <span class="event-status-badge upcoming">
                            <i class="fas fa-clock"></i> Upcoming
                        </span>
                    <?php elseif($isOngoing): ?>
                        <span class="event-status-badge ongoing">
                            <i class="fas fa-circle" style="font-size: 0.5rem;"></i> Happening Now
                        </span>
                    <?php else: ?>
                        <span class="event-status-badge past">
                            <i class="fas fa-check"></i> Completed
                        </span>
                    <?php endif; ?>
                </div>
            </div>
            
            <?php if(!empty($event->topic)): ?>
                <div>
                    <span class="event-topic-badge">
                        <i class="fas fa-tag"></i> <?php echo e($event->topic); ?>

                    </span>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if(!empty($event->image_url)): ?>
        <div class="event-image-container">
            <img class="event-image" src="<?php echo e($event->image_url); ?>" alt="<?php echo e($event->title); ?>">
        </div>
    <?php endif; ?>

    <?php if(!empty($event->description)): ?>
        <div class="event-content-card">
            <h2 style="color: var(--cyan-accent); margin-top: 0; margin-bottom: 1rem; font-size: 1.5rem;">
                <i class="fas fa-info-circle"></i> About This Event
            </h2>
            <div class="event-description">
                <?php echo nl2br(e($event->description)); ?>

            </div>
        </div>
    <?php endif; ?>

    <?php if(!empty($event->registration_url)): ?>
        <div class="event-content-card">
            <h2 style="color: var(--cyan-accent); margin-top: 0; margin-bottom: 1rem; font-size: 1.5rem;">
                <i class="fas fa-user-plus"></i> Registration
            </h2>
            <p class="event-description" style="margin-bottom: 1.5rem;">
                <?php if($isUpcoming): ?>
                    Secure your spot at this event! Registration is now open.
                <?php elseif($isOngoing): ?>
                    This event is currently happening. You may still be able to join!
                <?php else: ?>
                    This event has concluded. Check out our upcoming events.
                <?php endif; ?>
            </p>
            <div class="event-actions">
                <a class="btn-register" href="<?php echo e($event->registration_url); ?>" target="_blank" rel="noopener">
                    <i class="fas fa-external-link-alt"></i>
                    Join Event
                </a>
                <a class="btn-back" href="<?php echo e(route('events.index')); ?>" style="margin: 0;">
                    <i class="fas fa-calendar-days"></i> View All Events
                </a>
            </div>
        </div>
    <?php endif; ?>
</section>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\pages\events\show.blade.php ENDPATH**/ ?>