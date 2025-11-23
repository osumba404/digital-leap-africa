

<?php $__env->startSection('title', 'About Digital Leap Africa - Empowering African Youth Through Technology Education'); ?>

<?php $__env->startPush('meta'); ?>
<meta name="description" content="Learn about Digital Leap Africa's mission to empower African youth through comprehensive e-learning, technology education, and community building. Meet our team and discover our vision for Africa's digital future.">
<meta name="keywords" content="about Digital Leap Africa, African education technology, e-learning platform Africa, tech education mission, digital skills Africa, African youth empowerment, online learning Kenya, technology training Africa">
<meta name="author" content="Digital Leap Africa">
<meta name="robots" content="index, follow">
<meta name="googlebot" content="index, follow">

<!-- Open Graph / Facebook -->
<meta property="og:type" content="website">
<meta property="og:url" content="<?php echo e(route('about')); ?>">
<meta property="og:title" content="About Digital Leap Africa - Empowering African Youth Through Technology">
<meta property="og:description" content="Discover Digital Leap Africa's mission to transform education across Africa through innovative e-learning solutions, community building, and technology empowerment.">
<meta property="og:image" content="<?php echo e(asset('images/about-og-image.jpg')); ?>">
<meta property="og:site_name" content="Digital Leap Africa">
<meta property="og:locale" content="en_US">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:url" content="<?php echo e(route('about')); ?>">
<meta name="twitter:title" content="About Digital Leap Africa - Empowering African Youth">
<meta name="twitter:description" content="Learn about our mission to transform education across Africa through innovative e-learning solutions and community building.">
<meta name="twitter:image" content="<?php echo e(asset('images/about-og-image.jpg')); ?>">
<meta name="twitter:image:alt" content="Digital Leap Africa Team - Empowering African Youth Through Technology">

<!-- Additional Social Media Tags -->
<meta property="article:section" content="About">
<meta property="article:tag" content="Education,Technology,Africa,Mission,Team">
<meta name="pinterest-rich-pin" content="true">

<!-- Geographic and Language Tags -->
<meta name="geo.region" content="KE">
<meta name="geo.placename" content="Kenya">
<meta name="language" content="English">
<meta name="coverage" content="Africa">

<!-- Canonical URL -->
<link rel="canonical" href="<?php echo e(route('about')); ?>">

<!-- Breadcrumb Schema -->
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
      "name": "About",
      "item": "<?php echo e(route('about')); ?>"
    }
  ]
}
</script>

<!-- Preload critical images -->
<?php
  $about = \App\Models\AboutSection::where('section_type', 'about')->active()->first();
  $mission = \App\Models\AboutSection::where('section_type','mission')->active()->first();
  $vision = \App\Models\AboutSection::where('section_type','vision')->active()->first();
  $teamMembers = \App\Models\TeamMember::active()->ordered()->take(2)->get();
?>
<?php if($about && $about->image_url): ?>
<link rel="preload" as="image" href="<?php echo e($about->image_url); ?>" fetchpriority="high">
<?php endif; ?>
<?php if($mission && $mission->image_url): ?>
<link rel="preload" as="image" href="<?php echo e($mission->image_url); ?>" fetchpriority="low">
<?php endif; ?>
<?php if($vision && $vision->image_url): ?>
<link rel="preload" as="image" href="<?php echo e($vision->image_url); ?>" fetchpriority="low">
<?php endif; ?>
<?php $__currentLoopData = $teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <?php if($member->image_url): ?>
<link rel="preload" as="image" href="<?php echo e($member->image_url); ?>" fetchpriority="low">
  <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<!-- Organization Schema with Mission & Vision -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "EducationalOrganization",
  "name": "Digital Leap Africa",
  "alternateName": "DLA",
  "description": "Empowering African youth through comprehensive e-learning courses, technology education, and community building initiatives.",
  "url": "<?php echo e(url('/')); ?>",
  "logo": "<?php echo e(asset('images/logo.png')); ?>",
  "foundingDate": "2024",
  <?php if($mission): ?>
  "mission": "<?php echo e(strip_tags($mission->content)); ?>",
  <?php endif; ?>
  <?php if($vision): ?>
  "vision": "<?php echo e(strip_tags($vision->content)); ?>",
  <?php endif; ?>
  "address": {
    "@type": "PostalAddress",
    "addressCountry": "Kenya",
    "addressRegion": "Nairobi",
    "addressLocality": "Nairobi"
  },
  "contactPoint": {
    "@type": "ContactPoint",
    "contactType": "customer service",
    "email": "info@digitalleapafrica.com",
    "availableLanguage": "English"
  },
  "sameAs": [
    "https://facebook.com/digitalleapafrica",
    "https://twitter.com/digitalleapafrica",
    "https://linkedin.com/company/digitalleapafrica",
    "https://instagram.com/digitalleapafrica"
  ],
  "areaServed": {
    "@type": "Place",
    "name": "Africa"
  },
  "knowsAbout": [
    "E-learning",
    "Programming Education",
    "Web Development Training",
    "Digital Marketing",
    "Technology Education",
    "Career Development",
    "Community Building",
    "African Youth Empowerment"
  ],
  "hasOfferCatalog": {
    "@type": "OfferCatalog",
    "name": "Educational Services",
    "itemListElement": [
      {
        "@type": "Course",
        "name": "Programming Courses",
        "description": "Comprehensive programming and web development courses"
      },
      {
        "@type": "Course",
        "name": "Digital Skills Training",
        "description": "Essential digital skills for the modern workforce"
      }
    ]
  }
}
</script>

<!-- Team Members Schema -->
<?php $allTeamMembers = \App\Models\TeamMember::active()->ordered()->get(); ?>
<?php if($allTeamMembers->count()): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "Digital Leap Africa Team Members",
  "description": "Meet our dedicated team driving digital transformation across Africa",
  "numberOfItems": <?php echo e($allTeamMembers->count()); ?>,
  "itemListElement": [
    <?php $__currentLoopData = $allTeamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    {
      "@type": "Person",
      "position": <?php echo e($index + 1); ?>,
      "name": "<?php echo e($member->name); ?>",
      "jobTitle": "<?php echo e($member->role); ?>",
      "description": "<?php echo e(strip_tags($member->bio)); ?>",
      "worksFor": {
        "@type": "Organization",
        "name": "Digital Leap Africa"
      }
      <?php if($member->email): ?>
      ,"email": "<?php echo e($member->email); ?>"
      <?php endif; ?>
      <?php if($member->image_url): ?>
      ,"image": "<?php echo e($member->image_url); ?>"
      <?php endif; ?>
      <?php if($member->linkedin_url || $member->twitter_url || $member->facebook_url): ?>
      ,"sameAs": [
        <?php if($member->linkedin_url): ?>"<?php echo e($member->linkedin_url); ?>"<?php endif; ?>
        <?php if($member->twitter_url): ?><?php if($member->linkedin_url): ?>,<?php endif; ?>"<?php echo e($member->twitter_url); ?>"<?php endif; ?>
        <?php if($member->facebook_url): ?><?php if($member->linkedin_url || $member->twitter_url): ?>,<?php endif; ?>"<?php echo e($member->facebook_url); ?>"<?php endif; ?>
      ]
      <?php endif; ?>
    }<?php if(!$loop->last): ?>,<?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  ]
}
</script>
<?php endif; ?>

<!-- Values Schema -->
<?php $values = \App\Models\AboutSection::where('section_type','values')->active()->ordered()->get(); ?>
<?php if($values->count()): ?>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "Digital Leap Africa Core Values",
  "description": "Principles that shape our culture and impact",
  "numberOfItems": <?php echo e($values->count()); ?>,
  "itemListElement": [
    <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    {
      "@type": "Thing",
      "position": <?php echo e($index + 1); ?>,
      "name": "<?php echo e($value->title); ?>",
      "description": "<?php echo e(strip_tags($value->content)); ?>"
      <?php if($value->image_url): ?>
      ,"image": "<?php echo e($value->image_url); ?>"
      <?php endif; ?>
    }<?php if(!$loop->last): ?>,<?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  ]
}
</script>
<?php endif; ?>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
<style>
  /* Page sections */
  .section { padding: 2.5rem 0; }
  .section-title { text-align:center; margin-bottom: 0 !important; }
  .section-title h1, .section-title h2 { font-weight: 700; color: #64b5f6; }
  .section-title p { color: var(--cool-gray); }

  /* Grid & cards (aligned to Courses page style) */
  .about-grid {
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
    gap: 2rem;
  }
  .team-grid { display:grid; grid-template-columns: repeat(2, 1fr); gap: 2rem; max-width: 1400px; margin: 0 auto; }
  @media (max-width: 991.98px){ .team-grid { gap: 1.5rem; } }
  @media (max-width: 768px){ .team-grid { grid-template-columns: 1fr; gap: 1rem; max-width: 800px; } }
  .partner-grid { display:grid; grid-template-columns: repeat(auto-fit, minmax(160px,1fr)); gap: 1.25rem; align-items:center; }

  .card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 100px 16px 100px 16px;
    overflow: hidden;
    transition: transform 0.3s, box-shadow 0.3s;
    box-shadow: -2px 0 16px rgba(59,130,246,.35), 0 6px 18px rgba(59,130,246,.25);
  }
  .card:hover { transform: translateY(-5px); box-shadow: 0 12px 34px rgba(0, 0, 0, 0.35); }
  .card-body { padding: 1.5rem; }
  .card-title { font-size: 1.35rem; font-weight: 700; color: var(--diamond-white); margin-bottom: .75rem; }
  .card-text { color: var(--cool-gray); line-height: 1.6; }

  .media {
    width: 100%;
    height: 240px;
    object-fit: cover;
    background: linear-gradient(135deg, var(--primary-blue), var(--deep-blue));
    border-radius: 100px 16px 100px 16px;
    box-shadow: -8px 12px 28px rgba(37,99,235,.35);
  }

  /* Stats */
  .stats-grid {
    display:grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1.25rem;
  }
  .stat-card {
    text-align:center; padding: 1.5rem;
    background: rgba(255,255,255,0.03);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: var(--radius);
  }
  .stat-value { font-size: 2rem; font-weight: 800; color: var(--diamond-white); }
  .stat-label { color: var(--cool-gray); }

  @media (max-width: 768px) {
    .stats-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  /* Partners */
  .partner-card {
    background: rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.1);
    border-radius: var(--radius);
    padding: 1.25rem;
    display:flex; align-items:center; justify-content:center;
    transition: transform .3s, box-shadow .3s, filter .3s, opacity .3s;
    filter: grayscale(100%); opacity: .8;
  }
  .partner-card:hover { transform: translateY(-4px); box-shadow: 0 10px 30px rgba(0,0,0,0.3); filter: grayscale(0%); opacity: 1; }

  /* Utilities */
  .muted { color: var(--cool-gray); }

  /* Subtle in-view animation (optional) */
  .fade-in-up { opacity: 0; transform: translateY(12px); transition: opacity .4s ease, transform .4s ease; }
  .fade-in-up.visible { opacity: 1; transform: translateY(0); }
  /* Accent mini labels */
  .muted { color: var(--cool-gray); }
  .section-title p { color: var(--cool-gray); }

  /* Responsive tweaks to keep cards elegant on small screens */
  @media (max-width: 767.98px){
    .media{ height: 220px; }
    .card-title{ font-size: 1.25rem; }
  }
  /* Tighten About header spacing */
  .about-hero{padding: .75rem 0 .75rem !important}
  .about-hero .section-title{margin: 0 0 .75rem 0 !important}
  .about-hero .section-title h1{margin:0 !important}

  /* About split card with edge-to-edge media */
  .about-card{display:flex;flex-direction:row;align-items:stretch;border:1px solid rgba(255,255,255,0.08);border-radius:100px 16px 100px 16px;overflow:hidden;background:rgba(255,255,255,0.03)}
  .about-media{position:relative;flex:0 0 48% !important;max-width:48% !important}
  .about-visual{position:relative;height:100%;width:100% !important;margin:0 !important;border-radius:100px 16px 100px 16px;overflow:hidden;background:linear-gradient(135deg,var(--primary-blue),var(--deep-blue));border-top:3px solid var(--primary-blue);border-left:3px solid var(--primary-blue);border-bottom:3px solid var(--primary-blue);box-shadow:-2px 0 16px rgba(59,130,246,.35),0 -6px 18px rgba(59,130,246,.25),0 6px 18px rgba(59,130,246,.25)}
  .about-img{display:block;width:100% !important;height:100% !important;object-fit:cover}
  .about-content{flex:1 1 auto !important;display:flex}

  @media (max-width: 768px){
    .about-card{flex-direction:column}
    .about-media,.about-content{max-width:100% !important;flex-basis:100% !important}
    .about-visual{border-radius:24px}
  }

  /* Team card */
  .tm-card{background:#1e293b;border-radius:16px;overflow:hidden;box-shadow:0 10px 25px rgba(0,0,0,0.3);transition:all .3s ease;max-width:800px;max-height:360px;width:100%;height:100%;display:flex;border:1px solid rgba(255,255,255,0.05)}
  .tm-card:hover{transform:translateY(-5px);box-shadow:0 12px 25px rgba(0,0,0,0.4)}
  .tm-image-container{min-width:40% !important; max-width:40% !important; overflow:hidden;position:relative}
  .tm-image-container img{width:100% !important;height:100% !important;object-fit:cover;transition:all .3s ease;display:block}
  .tm-card:hover .tm-image-container img{transform:scale(1.03)}
  .tm-image-overlay{position:absolute;bottom:0;left:0;width:100%;height:40%;background:linear-gradient(to top, rgba(30,41,59,0.9), transparent);pointer-events:none}
  .tm-content{padding:20px;flex-grow:1;display:flex;flex-direction:column;justify-content:space-between;position:relative;overflow:hidden}
  .tm-name{font-size:1.3rem;color:#f1f5f9;margin-bottom:0 !important; margin-top: -0.25rem; font-weight:700;background:linear-gradient(90deg,#3b82f6,#60a5fa);-webkit-background-clip:text;-webkit-text-fill-color:transparent;line-height:1.2}
  .tm-position{color:#fff;background:#3b82f6;padding:5px 12px;border-radius:8px;font-size:.75rem;font-weight:500;display:inline-block;margin-bottom:15px;position:relative}
  .tm-position::after{content:'';position:absolute;bottom:-8px;left:0;width:45px;height:3px;background:#3b82f6;border-radius:2px}
  .tm-bio{color:#94a3b8;line-height:1.3;margin-bottom:15px;font-size:.9rem;max-width:100%;overflow:hidden}

  /* Mobile adjustments - keep 2 columns but smaller */
  @media (max-width: 768px) {
    .tm-card{max-height:240px;border-radius:12px}
    .tm-content{padding:12px}
    .tm-name{font-size:1rem;margin-top:0}
    .tm-position{padding:4px 8px;font-size:.65rem;margin-bottom:10px}
    .tm-position::after{width:30px;height:2px;bottom:-6px}
    .tm-bio{font-size:.75rem;line-height:1.2;margin-bottom:10px}
    .socials{gap:6px;margin-bottom:10px}
    .socials a{width:28px;height:28px;font-size:.75rem;border-radius:8px}
    .contact-item{padding:4px 8px;font-size:.7rem;gap:6px}
    .contact-item i{font-size:.7rem}
  }
  
  @media (max-width: 480px) {
    .tm-card{max-height:200px;border-radius:10px}
    .tm-image-container{min-width:35% !important; max-width:35% !important}
    .tm-content{padding:10px}
    .tm-name{font-size:.85rem}
    .tm-position{padding:3px 6px;font-size:.6rem;margin-bottom:8px}
    .tm-position::after{width:25px;height:1.5px;bottom:-5px}
    .tm-bio{font-size:.7rem;margin-bottom:8px}
    .socials{gap:4px;margin-bottom:8px}
    .socials a{width:24px;height:24px;font-size:.7rem;border-radius:6px}
    .contact-item{padding:3px 6px;font-size:.65rem}
    .contact-item i{font-size:.65rem}
  }

  /* Socials and contact (from template) */
  .socials{display:flex;gap:8px;margin-bottom:15px}
  .socials a{display:flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:10px;background:rgba(59,130,246,0.1);color:#60a5fa;transition:all .3s ease;text-decoration:none;border:1px solid rgba(59,130,246,0.2);font-size:.9rem}
  .socials a:hover{background:#3b82f6;color:#fff;transform:translateY(-3px);box-shadow:0 4px 10px rgba(59,130,246,0.4)}
  .contact-info{display:flex;flex-direction:column;gap:8px}
  .contact-item{display:flex;align-items:center;gap:8px;color:#94a3b8;font-size:.8rem;padding:6px 10px;background:rgba(255,255,255,0.05);border-radius:8px;transition:all .3s ease}
  .contact-item:hover{background:rgba(255,255,255,0.08)}
  .contact-item i{color:#3b82f6;font-size:.8rem}

  /* Remove the old mobile breakpoint that switched to column layout */

  /* Make images truly flush with the card edges */
  .media{border-radius:0 !important;margin:0 !important}

  /* ========== Light Mode Styles ========== */
  [data-theme="light"] .card {
      background: #FFFFFF;
      border: 1px solid rgba(46, 120, 197, 0.2);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
  }
  [data-theme="light"] .card:hover {
      box-shadow: 0 12px 34px rgba(0, 0, 0, 0.12);
  }
  [data-theme="light"] .card-title {
      color: var(--primary-blue);
  }
  [data-theme="light"] .card-text {
      color: var(--cool-gray);
  }

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

  /* Light Mode Partners */
  [data-theme="light"] .partner-card {
      background: #FFFFFF;
      border: 1px solid rgba(46, 120, 197, 0.2);
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
      filter: grayscale(50%);
  }
  [data-theme="light"] .partner-card:hover {
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      filter: grayscale(0%);
  }

  /* Light Mode About Card */
  [data-theme="light"] .about-card {
      background: #FFFFFF;
      border: 1px solid rgba(46, 120, 197, 0.2);
  }
  [data-theme="light"] .about-visual {
      border-color: var(--primary-blue);
      box-shadow: -2px 0 16px rgba(46, 120, 197, 0.2), 0 -6px 18px rgba(46, 120, 197, 0.15), 0 6px 18px rgba(46, 120, 197, 0.15);
  }

  /* Light Mode Team Cards */
  [data-theme="light"] .tm-card {
      background: #FFFFFF;
      border: 1px solid rgba(46, 120, 197, 0.2);
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
  }
  [data-theme="light"] .tm-card:hover {
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.12);
  }
  [data-theme="light"] .tm-name {
      color: var(--primary-blue);
      background: linear-gradient(90deg, var(--primary-blue), var(--cyan-accent));
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
  }
  [data-theme="light"] .tm-position {
      background: var(--primary-blue);
      color: #FFFFFF;
  }
  [data-theme="light"] .tm-position::after {
      background: var(--primary-blue);
  }
  [data-theme="light"] .tm-bio {
      color: var(--cool-gray);
  }
  [data-theme="light"] .socials a {
      background: rgba(46, 120, 197, 0.1);
      border-color: rgba(46, 120, 197, 0.2);
      color: var(--primary-blue);
  }
  [data-theme="light"] .socials a:hover {
      background: var(--primary-blue);
      color: #FFFFFF;
  }
  [data-theme="light"] .contact-item {
      background: rgba(46, 120, 197, 0.05);
      color: var(--cool-gray);
  }
  [data-theme="light"] .contact-item:hover {
      background: rgba(46, 120, 197, 0.1);
  }
  [data-theme="light"] .contact-item i {
      color: var(--primary-blue);
  }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
  
  <section class="section about-hero">
    <div class="container">
      <div class="section-title">
        <h1 style="font-size: 2.5rem;">About Us</h1>
        
      </div>
    </div>
  </section>

  
  <?php $about = \App\Models\AboutSection::where('section_type', 'about')->active()->first(); ?>
  <?php if($about): ?>
  <section class="section">
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
      
      .about-card {
          background: rgba(255, 255, 255, 0.03);
          border-radius: 16px;
          overflow: hidden;
          box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
          transition: transform 0.3s ease, box-shadow 0.3s ease;
          border: 1px solid rgba(255, 255, 255, 0.1);
          max-width: 1000px;
          width: 100%;
          position: relative;
          display: flex;
          flex-direction: row;
          min-height: 400px;
          margin: 0 auto;
      }
      
      .about-card:hover {
          transform: translateY(-5px);
          box-shadow: 0 12px 35px rgba(0, 0, 0, 0.4);
      }
      
      .about-card-image-section {
          width: 40%;
          position: relative;
          display: flex;
      }
      
      .about-card-image {
          flex: 1;
          background-color: var(--medium-blue);
          display: flex;
          align-items: center;
          justify-content: center;
          overflow: hidden;
          position: relative;
      }
      
      .about-card-image img {
          width: 100%;
          height: 100%;
          object-fit: cover;
          transition: transform 0.7s ease;
      }
      
      .about-card:hover .about-card-image img {
          transform: scale(1.05);
      }
      
      .about-image-overlay {
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
      
      .about-icon-circle {
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
      
      .about-overlay-text {
          font-size: 0.95rem;
          line-height: 1.4;
      }
      
      .about-card-content-section {
          width: 60%;
          display: flex;
          flex-direction: column;
      }
      
      .about-card-header {
          padding: 30px 30px 20px;
          position: relative;
      }
      
      .about-mini-title {
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
      
      .about-title {
          font-size: 1.8rem;
          font-weight: 700;
          margin-bottom: 12px;
          background: linear-gradient(to right, #ffffff, #a8c2e0);
          -webkit-background-clip: text;
          background-clip: text;
          color: transparent;
          line-height: 1.2;
      }
      
      .about-tagline {
          font-size: 1.05rem;
          color: var(--text-muted);
          margin-bottom: 5px;
          font-style: italic;
      }
      
      .about-card-content {
          padding: 0 30px 20px;
          color: var(--text-light);
          flex-grow: 1;
          display: flex;
          flex-direction: column;
          justify-content: space-between;
      }
      
      .about-card-content p {
          margin-bottom: 25px;
          font-size: 1rem;
          line-height: 1.6;
      }
      
      .about-bullets {
          margin-top: 5px;
          list-style: none;
          padding: 0;
      }
      
      .about-bullets li {
          margin-bottom: 15px;
          position: relative;
          padding-left: 35px;
          display: flex;
          align-items: flex-start;
      }
      
      .about-bullets li:before {
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
      
      .about-bullets li:nth-child(1):before { content: "1"; }
      .about-bullets li:nth-child(2):before { content: "2"; }
      .about-bullets li:nth-child(3):before { content: "3"; }
      .about-bullets li:nth-child(4):before { content: "4"; }
      
      .about-bullet-text {
          flex: 1;
      }
      
      .about-bullet-title {
          font-weight: 600;
          color: var(--accent-light);
          margin-bottom: 3px;
          font-size: 0.95rem;
      }
      
      .about-mobile-header {
          display: none;
          padding: 25px 25px 15px;
          text-align: center;
      }
      
      @media (max-width: 900px) {
          .about-card {
              flex-direction: column;
              max-width: 500px;
              min-height: auto;
          }
          
          .about-card-image-section,
          .about-card-content-section {
              width: 100%;
          }
          
          .about-card-image {
              height: 250px;
          }
          
          .about-card-header {
              display: none;
          }
          
          .about-mobile-header {
              display: block;
          }
          
          .about-card-content {
              padding: 20px 25px;
          }
      }
      
      @media (max-width: 480px) {
          .about-mobile-header,
          .about-card-content {
              padding-left: 20px;
              padding-right: 20px;
          }
          
          .about-title {
              font-size: 1.6rem;
          }
          
          .about-mobile-header .about-title {
              font-size: 1.7rem;
          }
      }

      /* Light Mode */
      [data-theme="light"] .about-card {
          background: linear-gradient(145deg, #FFFFFF, #F8FAFC);
          border-color: var(--primary-blue);
          box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
      }
      [data-theme="light"] .about-card:hover {
          box-shadow: 0 20px 45px rgba(0, 0, 0, 0.15);
      }
      [data-theme="light"] .about-card::before {
          background: linear-gradient(90deg, var(--primary-blue), var(--cyan-accent));
      }
      [data-theme="light"] .about-mini-title {
          color: var(--primary-blue);
          background: rgba(46, 120, 197, 0.15);
      }
      [data-theme="light"] .about-title {
          background: linear-gradient(to right, var(--primary-blue), var(--deep-blue));
          -webkit-background-clip: text;
          background-clip: text;
          color: transparent;
      }
      [data-theme="light"] .about-tagline,
      [data-theme="light"] .about-card-content p {
          color: var(--cool-gray);
      }
      [data-theme="light"] .about-bullet-title {
          color: var(--primary-blue);
      }
      [data-theme="light"] .about-bullets li:before {
          background: rgba(46, 120, 197, 0.2);
          color: var(--primary-blue);
      }
    </style>
    <div class="container">
      <div class="about-card fade-in-up">
          <!-- Mobile header (only visible on small screens) -->
          <div class="about-mobile-header">
              <div class="about-mini-title"><?php echo e($about->mini_title ?? 'Our Approach'); ?></div>
              <h1 class="about-title"><?php echo e($about->title); ?></h1>
          </div>
          
          <div class="about-card-image-section">
              <div class="about-card-image">
                  <?php if($about->image_path): ?>
                      <img src="<?php echo e($about->image_url); ?>" alt="<?php echo e($about->title); ?>" width="400" height="400" loading="eager" fetchpriority="high">
                  <?php else: ?>
                      <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="<?php echo e($about->title); ?>" loading="lazy" fetchpriority="high">
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
          </div>
      </div>
    </div>
  </section>
  <?php endif; ?>

  
  <?php
    $stats = [
      ['label'=>'Courses',  'value'=> \App\Models\Course::count(),      'icon'=>'fa-book-open'],
      ['label'=>'Articles', 'value'=> \App\Models\Article::count(),     'icon'=>'fa-diagram-project'],
      ['label'=>'Partners', 'value'=> \App\Models\Partner::count(),     'icon'=>'fa-handshake'],
      ['label'=>'Members',  'value'=> \App\Models\User::count(),        'icon'=>'fa-users'],
    ];
  ?>
  <section class="section">
    <div class="container">
      <div class="stats-grid">
        <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="stat-card fade-in-up">
            <div style="font-size:1.25rem;color:var(--cyan-accent);margin-bottom:.25rem;">
              <i class="fa-solid <?php echo e($s['icon']); ?>"></i>
            </div>
            <div class="stat-value"><?php echo e(number_format($s['value'])); ?></div>
            <div class="stat-label"><?php echo e($s['label']); ?></div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </section>

  
  <?php
    $mission = \App\Models\AboutSection::where('section_type','mission')->active()->first();
    $vision  = \App\Models\AboutSection::where('section_type','vision')->active()->first();
  ?>
  <?php if($mission || $vision): ?>
  <section class="section">
    <style>
      :root {
        --dark-bg: #0a0f1c;
        --card-bg: #131a2a;
        --accent-blue: #3b82f6;
        --neon-blue: #00d4ff;
        --light-blue: #60a5fa;
        --text-primary: #f1f5f9;
        --text-secondary: #94a3b8;
        --shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        --transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
      }
      .cards-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 30px; max-width: 1000px; width: 100%; margin: 0 auto; }
      /* Vision Card - Top Image Layout */
      .vision-card { background: var(--card-bg); border-radius: 18px; overflow: hidden; box-shadow: var(--shadow); transition: var(--transition); height: 420px; position: relative; border: 1px solid rgba(59, 130, 246, 0.1); display: flex; flex-direction: column; }
      /* Removed hover border glow on vision-card */
      .vision-card::before { display: none; }
      .vision-card:hover::before { display: none; }
      .vision-header { height: 40%; position: relative; overflow: hidden; }
      .vision-image { width: 100%; height: 100%; position: relative; }
      .vision-image img { width: 100%; height: 100%; object-fit: cover; transition: var(--transition); filter: brightness(0.7); }
      .vision-card:hover .vision-image img { transform: scale(1.06); filter: brightness(0.9); }
      .vision-overlay { position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(to bottom, transparent, rgba(19, 26, 42, 0.9)); display: flex; align-items: flex-end; padding: 20px; }
      .vision-title { font-size: 1.8rem; color: var(--text-primary); font-weight: 700; background: linear-gradient(90deg, var(--accent-blue), var(--neon-blue)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
      .vision-content { padding: 25px; flex-grow: 1; display: flex; flex-direction: column; justify-content: center; position: relative; }
      .vision-subtitle { color: var(--text-secondary); font-size: 0.95rem; margin-bottom: 15px; font-weight: 500; }
      .vision-body { color: var(--text-secondary); line-height: 1.6; font-size: 0.9rem; margin-bottom: 20px; }
      .vision-goals { display: block; grid-template-columns: 1fr 1fr; gap: 8px; }
      .vision-goal { display: flex; align-items: center; gap: 8px; color: var(--text-secondary); font-size: 0.8rem; line-height: 1.3; margin-bottom: 6px; }
      .vision-goal i { color: var(--accent-blue); font-size: 0.8rem; }
      .vision-icon { position: absolute; bottom: 20px; right: 20px; width: 40px; height: 40px; background: linear-gradient(45deg, var(--accent-blue), var(--neon-blue)); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1rem; box-shadow: 0 3px 10px rgba(59, 130, 246, 0.3); }
      /* Geometric Split Card */
      .geometric-card { background: var(--card-bg); border-radius: 18px; overflow: hidden; box-shadow: var(--shadow); transition: var(--transition); height: 420px; display: flex; position: relative; border: 1px solid rgba(59, 130, 246, 0.1); }
      .geometric-card::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: linear-gradient(45deg, transparent 40%, rgba(59, 130, 246, 0.1) 100%); clip-path: polygon(0 0, 100% 0, 100% 80%, 0 100%); z-index: 1; }
      .geometric-content { padding: 25px; flex: 1; display: flex; flex-direction: column; justify-content: center; position: relative; z-index: 2; }
      .geometric-title { font-size: 1.8rem; color: var(--text-primary); margin-bottom: 12px; font-weight: 700; background: linear-gradient(90deg, var(--accent-blue), var(--neon-blue)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
      .geometric-subtitle { color: var(--text-secondary); font-size: 0.95rem; margin-bottom: 20px; font-weight: 500; }
      .geometric-body { color: var(--text-secondary); line-height: 1.6; font-size: 0.9rem; margin-bottom: 25px; }
      .geometric-image { flex: 0 0 42%; position: relative; overflow: hidden; }
      .geometric-image img { width: 100%; height: 100%; object-fit: cover; transition: var(--transition); clip-path: polygon(0 0, 100% 0, 100% 100%, 25% 100%); }
      .geometric-card:hover .geometric-image img { transform: scale(1.05); }
      .timeline-features { display: flex; flex-direction: column; gap: 6px; }
      .timeline-feature { display: flex; align-items: center; gap: 8px; color: var(--text-secondary); font-size: 0.8rem; line-height: 1.3; margin-bottom: 4px; }
      .timeline-feature i { color: var(--accent-blue); font-size: 0.8rem; }
      /* Responsive adjustments */
      @media (max-width: 900px) {
        .cards-container { grid-template-columns: 1fr; gap: 25px; max-width: 500px; }
        .vision-card, .geometric-card { height: auto; flex-direction: column; }
        .vision-header { height: 200px; }
        .geometric-image { flex: 0 0 200px; order: -1; }
        .geometric-image img { clip-path: polygon(0 0, 100% 0, 100% 100%, 0 85%); }
      }
      @media (max-width: 480px) {
        .cards-container { grid-template-columns: 1fr; }
        .vision-content, .geometric-content { padding: 20px; }
        .vision-title, .geometric-title { font-size: 1.6rem; }
        .vision-goals { grid-template-columns: 1fr; gap: 10px; }
        .vision-icon { bottom: 15px; right: 15px; width: 35px; height: 35px; font-size: 0.9rem; }
      }

      /* Light Mode Mission/Vision Cards */
      [data-theme="light"] .vision-card {
          background: #FFFFFF;
          border: 1px solid rgba(46, 120, 197, 0.2);
          box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
      }
      [data-theme="light"] .vision-title {
          color: var(--primary-blue);
          background: linear-gradient(90deg, var(--primary-blue), var(--cyan-accent));
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
      }
      [data-theme="light"] .vision-subtitle,
      [data-theme="light"] .vision-body,
      [data-theme="light"] .vision-goal {
          color: var(--cool-gray);
      }
      [data-theme="light"] .vision-goal i {
          color: var(--primary-blue);
      }
      [data-theme="light"] .vision-overlay {
          background: linear-gradient(to bottom, transparent, rgba(230, 242, 255, 0.95));
      }

      [data-theme="light"] .geometric-card {
          background: #FFFFFF;
          border: 1px solid rgba(46, 120, 197, 0.2);
          box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
      }
      [data-theme="light"] .geometric-card::before {
          background: linear-gradient(45deg, transparent 40%, rgba(46, 120, 197, 0.05) 100%);
      }
      [data-theme="light"] .geometric-title {
          color: var(--primary-blue);
          background: linear-gradient(90deg, var(--primary-blue), var(--cyan-accent));
          -webkit-background-clip: text;
          -webkit-text-fill-color: transparent;
      }
      [data-theme="light"] .geometric-subtitle,
      [data-theme="light"] .geometric-body,
      [data-theme="light"] .timeline-feature {
          color: var(--cool-gray);
      }
      [data-theme="light"] .timeline-feature i {
          color: var(--primary-blue);
      }
    </style>
    <div class="container">
      <div class="cards-container">
        <?php if($mission): ?>
        <!-- Mission as Vision Card -->
        <div class="vision-card fade-in-up">
          <div class="vision-header">
            <div class="vision-image">
              <?php if(!empty($mission->image_path)): ?>
                <img src="<?php echo e($mission->image_url); ?>" alt="<?php echo e($mission->title); ?>" width="600" height="360" loading="lazy" fetchpriority="low">
              <?php else: ?>
                <img src="https://via.placeholder.com/1000x600.png?text=Mission" alt="<?php echo e($mission->title); ?>" loading="lazy" fetchpriority="low">
              <?php endif; ?>
            </div>
            <div class="vision-overlay">
              <h2 class="vision-title"><?php echo e($mission->title); ?></h2>
            </div>
          </div>
          <div class="vision-content">
            <?php if(!empty($mission->mini_title)): ?>
              <p class="vision-subtitle"><?php echo e($mission->mini_title); ?></p>
            <?php endif; ?>
            <p class="vision-body"><?php echo nl2br(e($mission->content)); ?></p>
            <?php if(!empty($mission->bullet_points) && is_array($mission->bullet_points) && count($mission->bullet_points)): ?>
              <div class="vision-goals">
                <?php $__currentLoopData = $mission->bullet_points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="vision-goal">
                    <i class="fas fa-star"></i>
                    <span><?php echo e($bp); ?></span>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            <?php endif; ?>
            <div class="vision-icon"><i class="fas fa-bullseye"></i></div>
          </div>
        </div>
        <?php endif; ?>

        <?php if($vision): ?>
        <!-- Vision as Geometric Split Card -->
        <div class="geometric-card fade-in-up">
          <div class="geometric-content">
            <h2 class="geometric-title"><?php echo e($vision->title); ?></h2>
            <?php if(!empty($vision->mini_title)): ?>
              <p class="geometric-subtitle"><?php echo e($vision->mini_title); ?></p>
            <?php endif; ?>
            <p class="geometric-body"><?php echo nl2br(e($vision->content)); ?></p>
            <?php if(!empty($vision->bullet_points) && is_array($vision->bullet_points) && count($vision->bullet_points)): ?>
              <div class="timeline-features">
                <?php $__currentLoopData = $vision->bullet_points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="timeline-feature">
                    <i class="fas fa-check"></i>
                    <span><?php echo e($bp); ?></span>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            <?php endif; ?>
          </div>
          <div class="geometric-image">
            <?php if(!empty($vision->image_path)): ?>
              <img src="<?php echo e($vision->image_url); ?>" alt="<?php echo e($vision->title); ?>" width="600" height="360" loading="lazy" fetchpriority="low">
            <?php else: ?>
              <img src="https://via.placeholder.com/1000x600.png?text=Vision" alt="<?php echo e($vision->title); ?>" loading="lazy" fetchpriority="low">
            <?php endif; ?>
          </div>
        </div>
        <?php endif; ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  
  <?php $values = \App\Models\AboutSection::where('section_type','values')->active()->ordered()->get(); ?>
  <?php if($values->count()): ?>
  <section class="section">
    <div class="container">
      <div class="section-title fade-in-up">
        <h2 style="font-size:2rem;">Our Values</h2>
        <p>Principles that shape our culture and impact.</p>
      </div>
      <div class="cards-container">
        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="vision-card fade-in-up">
          <div class="vision-header">
            <div class="vision-image">
              <?php if(!empty($value->image_path)): ?>
                <img src="<?php echo e($value->image_url); ?>" alt="<?php echo e($value->title); ?>" loading="lazy" fetchpriority="low">
              <?php else: ?>
                <img src="https://via.placeholder.com/1000x600.png?text=Value" alt="<?php echo e($value->title); ?>" loading="lazy" fetchpriority="low">
              <?php endif; ?>
            </div>
            <div class="vision-overlay">
              <h2 class="vision-title"><?php echo e($value->title); ?></h2>
            </div>
          </div>
          <div class="vision-content">
            <?php if(!empty($value->mini_title)): ?>
              <p class="vision-subtitle"><?php echo e($value->mini_title); ?></p>
            <?php endif; ?>
            <p class="vision-body"><?php echo nl2br(e($value->content)); ?></p>
            <?php if(!empty($value->bullet_points) && is_array($value->bullet_points) && count($value->bullet_points)): ?>
              <div class="vision-goals">
                <?php $__currentLoopData = $value->bullet_points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bp): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <div class="vision-goal">
                    <i class="fas fa-star"></i>
                    <span><?php echo e($bp); ?></span>
                  </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>
            <?php endif; ?>
            <div class="vision-icon"><i class="fas fa-bullseye"></i></div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
  </section>
  <?php endif; ?>

  
  <section class="section">
    <div class="container">
      <div class="section-title fade-in-up">
        <h2 style="font-size:2rem;">Meet Our Team</h2>
        <p>Our dedicated team is driving digital transformation across Africa.</p>
      </div>
      <?php $teamMembers = \App\Models\TeamMember::active()->ordered()->get(); ?>
      <?php if($teamMembers->count()): ?>
      <div class="team-grid">
        <?php $__currentLoopData = $teamMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="tm-card fade-in-up">
          <div class="tm-image-container">
            <?php if($member->image_path): ?>
              <img src="<?php echo e($member->image_url); ?>" alt="<?php echo e($member->name); ?>" width="320" height="360" loading="lazy" fetchpriority="low">
            <?php else: ?>
              <img src="https://via.placeholder.com/600x600.png?text=Profile" alt="<?php echo e($member->name); ?>" loading="lazy" fetchpriority="low">
            <?php endif; ?>
            <div class="tm-image-overlay"></div>
          </div>
          <div class="tm-content">
            <div>
              <h3 class="tm-name"><?php echo e($member->name); ?></h3>
              <p class="tm-position"><?php echo e($member->role); ?></p>
              <p class="tm-bio"><?php echo e(Str::limit($member->bio, 180)); ?></p>
            </div>
            <div>
              <div class="socials">
                <?php if(!empty($member->instagram_url)): ?>
                  <a href="<?php echo e($member->instagram_url); ?>" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                <?php endif; ?>
                <?php if(!empty($member->facebook_url)): ?>
                  <a href="<?php echo e($member->facebook_url); ?>" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                <?php endif; ?>
                <?php if(!empty($member->twitter_url)): ?>
                  <a href="<?php echo e($member->twitter_url); ?>" target="_blank" aria-label="Twitter"><i class="fab fa-x-twitter"></i></a>
                <?php endif; ?>
                <?php if(!empty($member->linkedin_url)): ?>
                  <a href="<?php echo e($member->linkedin_url); ?>" target="_blank" aria-label="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                <?php endif; ?>
              </div>
              <div class="contact-info">
                <?php if(!empty($member->email)): ?>
                  <div class="contact-item">
                    <i class="fas fa-envelope"></i>
                    <span><?php echo e($member->email); ?></span>
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php else: ?>
        <div class="muted" style="text-align:center; padding: 3rem 0;">No team members found.</div>
      <?php endif; ?>
    </div>
  </section>

  
  <section class="section">
    <div class="container">
      <div class="section-title fade-in-up">
        <h2 style="font-size:2rem;">Our Partners</h2>
        <p>We collaborate with leading organizations to amplify impact.</p>
      </div>
      <?php $partners = \App\Models\Partner::active()->ordered()->get(); ?>
      <?php if($partners->count()): ?>
      <div class="partner-grid">
        <?php $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $partner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <a href="<?php echo e($partner->website_url); ?>" target="_blank" class="partner-card fade-in-up">
            <?php if($partner->logo_path): ?>
              <img src="<?php echo e($partner->logo_url); ?>" alt="<?php echo e($partner->name); ?>" style="max-height: 42px; width:auto; object-fit:contain;" loading="lazy" fetchpriority="low">
            <?php else: ?>
              <span class="muted"><?php echo e($partner->name); ?></span>
            <?php endif; ?>
          </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
      <?php else: ?>
        <div class="muted" style="text-align:center; padding: 3rem 0;">No partners found.</div>
      <?php endif; ?>
    </div>
  </section>

  
  <section class="section">
    <div class="container" style="text-align:center;">
      <h2 style="font-size:2rem; font-weight:700; color:var(--diamond-white); margin-bottom: .75rem;">Ready to join our mission?</h2>
      <p class="muted" style="margin-bottom: 1.25rem;">Become a partner, volunteer, or support our initiatives.</p>
      <div style="display:flex; gap:.75rem; justify-content:center; flex-wrap:wrap;">
        <a class="btn-outline btn-wide" href="<?php echo e(route('partners.apply')); ?>"><i class="fas fa-handshake" style="margin-right: 0.5rem;"></i>Become a Partner</a>
        <a href="<?php echo e(route('contact')); ?>" class="btn-outline">Contact Us</a>
        <a href="<?php echo e(route('donate')); ?>" class="btn-outline">Donate Now</a>
      </div>
    </div>
  </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
  // Reveal elements on scroll
  document.addEventListener('DOMContentLoaded', function() {
    const fadeElements = document.querySelectorAll('.fade-in-up');
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => { if (entry.isIntersecting) entry.target.classList.add('visible'); });
    }, { threshold: 0.1 });
    fadeElements.forEach(el => observer.observe(el));
  });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views/about.blade.php ENDPATH**/ ?>