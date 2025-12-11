<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO Meta Tags -->
    <title>@yield('title', $siteSettings['meta_title'] ?? 'Digital Leap Africa - Premier Tech Education Platform in Africa | Programming Courses & Career Development')</title>
    <meta name="description" content="@yield('meta_description', $siteSettings['meta_description'] ?? 'Empowering African youth through comprehensive e-learning courses, job opportunities, and vibrant community. Join Digital Leap Africa for tech skills, career development, and professional growth.')">
    <meta name="keywords" content="@yield('meta_keywords', $siteSettings['keywords'] ?? 'programming courses Africa, web development Kenya, tech education Nigeria, coding bootcamp Ghana, software development training, digital skills Africa, tech careers Kenya, programming jobs Nigeria, web developer course, full stack development Africa')">
    <meta name="author" content="Digital Leap Africa">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical', url()->current())">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="Digital Leap Africa">
    <meta property="og:title" content="@yield('og_title', $siteSettings['meta_title'] ?? 'Digital Leap Africa - Premier Tech Education Platform in Africa')">
    <meta property="og:description" content="@yield('og_description', $siteSettings['meta_description'] ?? 'Transform your tech career with expert-led programming courses, web development training, and career opportunities across Africa.')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:image" content="@yield('og_image', $siteSettings['opengraph_image'] ?? asset('images/og-default.jpg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:locale" content="en_KE">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@DigitalLeapAfrica">
    <meta name="twitter:creator" content="@DigitalLeapAfrica">
    <meta name="twitter:title" content="@yield('twitter_title', $siteSettings['meta_title'] ?? 'Digital Leap Africa - Premier Tech Education Platform in Africa')">
    <meta name="twitter:description" content="@yield('twitter_description', $siteSettings['meta_description'] ?? 'Transform your tech career with expert-led programming courses and career opportunities across Africa.')">
    <meta name="twitter:image" content="@yield('twitter_image', $siteSettings['opengraph_image'] ?? asset('images/twitter-card.jpg'))">
    
    <!-- Favicon -->
    @if(!empty($siteSettings['favicon']))
    <link rel="icon" type="image/x-icon" href="{{ $siteSettings['favicon'] }}">
    @endif
    
    @stack('meta')
    
    <!-- Structured Data - Organization -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "Digital Leap Africa",
        "url": "{{ url('/') }}",
        "logo": "{{ $siteSettings['logo_url'] ?? asset('images/logo.png') }}",
        "description": "Premier technology education platform empowering African youth with programming skills, web development training, and career opportunities across Kenya, Nigeria, Ghana, and all of Africa.",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "Kenya",
            "addressRegion": "Nairobi"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "email": "{{ $siteSettings['contact_email'] ?? 'info@digitalleap.africa' }}",
            "contactType": "customer service"
        },
        "sameAs": [
            @if(!empty($siteSettings['facebook_url']))"{{ $siteSettings['facebook_url'] }}",@endif
            @if(!empty($siteSettings['twitter_url']))"{{ $siteSettings['twitter_url'] }}",@endif
            @if(!empty($siteSettings['linkedin_url']))"{{ $siteSettings['linkedin_url'] }}",@endif
            @if(!empty($siteSettings['youtube_url']))"{{ $siteSettings['youtube_url'] }}",@endif
            @if(!empty($siteSettings['instagram_url']))"{{ $siteSettings['instagram_url'] }}"@endif
        ]
    }
    </script>
    
    @stack('structured-data')
    
    @if(!empty($siteSettings['google_analytics_id']))
    <!-- Google Analytics 4 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $siteSettings['google_analytics_id'] }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $siteSettings['google_analytics_id'] }}', {
            page_title: document.title,
            page_location: window.location.href
        });
    </script>
    @endif

    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    
    <!-- Critical CSS - Inline to prevent FOUC and CLS -->
    <style>
        /* Prevent FOUC */
        html{visibility:visible;opacity:1;background:#0C121C}
        [data-theme="light"] html{background:#F8FAFC}
        body{margin:0;background:linear-gradient(180deg,#07101a 0%,#0C121C 100%);color:#F5F7FA;font-family:system-ui,-apple-system,sans-serif;padding-top:4rem;min-height:100vh}
        [data-theme="light"] body{background:linear-gradient(180deg,#E6F2FF 0%,#F8FAFC 100%) !important;color:#1a202c}
        main{background:var(--navy-bg,#0C121C)}
        [data-theme="light"] main{background:#F8FAFC !important}
        .site-header{position:fixed;top:0;left:0;right:0;width:100%;background:linear-gradient(135deg,#252A32 0%,#0C121C 100%);z-index:1000;height:4rem;border-bottom:1px solid rgba(0,201,255,.2)}
        [data-theme="light"] .site-header{background:#FFFFFF;border-bottom:1px solid rgba(46,120,197,.2)}
        .site-footer{margin-top:auto;background:linear-gradient(135deg,#252A32 0%,#0C121C 100%);border-top:1px solid rgba(255,255,255,.1)}
        [data-theme="light"] .site-footer{background:#FFFFFF;border-top:1px solid rgba(46,120,197,.1)}
        .nav{display:flex;align-items:center;justify-content:space-between;max-width:1100px;margin:0 auto;width:90%;padding:0 1rem;height:100%}
        .brand{display:flex;align-items:center;gap:.75rem;color:#fff;text-decoration:none}
        [data-theme="light"] .brand{color:#2E78C5}
        .brand h1{font-size:1.1rem;margin:0;font-weight:700}
        .container{width:90%;max-width:1100px;margin:0 auto;padding:2rem 0}
        /* Reserve space for images to prevent CLS */
        img{max-width:100%;height:auto}
        .hero-carousel{min-height:100vh}
        .stat-card,.article-card,.course-horizontal-card{min-height:200px}
    </style>
    
    <!-- Fonts and Icons - Async Load -->
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet"></noscript>
    <link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"></noscript>

    <style>
        /* ========== Color palette variables ========== */
        :root {
            --primary-blue: {{ $siteSettings['primary_color'] ?? '#2E78C5' }};
            --deep-blue: 	#1E4C7C;
            --navy-bg: 	    #0C121C;
            --diamond-white:#F5F7FA;
            --cool-gray: 	#AEB8C2;
            --charcoal: 	#252A32;
            --cyan-accent: {{ $siteSettings['secondary_color'] ?? '#00C9FF' }};
            --purple-accent:#7A5FFF;
            --radius: 12px;
            --max-width: 1100px;
            --header-height: 4rem;
        }
        
        /* ========== Light Mode Variables ========== */
        [data-theme="light"] {
            --primary-blue: {{ $siteSettings['primary_color'] ?? '#2E78C5' }};
            --deep-blue: 	#1E4C7C;
            --navy-bg: 	    #FFFFFF;
            --diamond-white:#1a202c;
            --cool-gray: 	#4A5568;
            --charcoal: 	#FFFFFF;
            --cyan-accent: {{ $siteSettings['secondary_color'] ?? '#0088CC' }};
            --purple-accent:#6B46C1;
        }

        /* ========== Base ========== */
        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: "{{ $siteSettings['font_family'] ?? 'Inter' }}", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(180deg, #07101a 0%, var(--navy-bg) 100%);
            color: var(--diamond-white);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            padding-top: var(--header-height);
            transition: background 0.3s ease, color 0.3s ease;
        }
        
        [data-theme="light"] body {
            background: #FFFFFF !important;
        }
        
        [data-theme="light"] main {
            background: #FFFFFF !important;
        }
        
        /* Force light mode backgrounds */
        [data-theme="light"] * {
            --navy-bg: #FFFFFF !important;
            --charcoal: #FFFFFF !important;
        }
        
        [data-theme="light"] .hero-section,
        [data-theme="light"] .stats-section,
        [data-theme="light"] .articles-section,
        [data-theme="light"] .courses-section,
        [data-theme="light"] section {
            background: #FFFFFF !important;
        }
        
        [data-theme="light"] .hero-background {
            background: #FFFFFF !important;
        }

        .container {
            width: 90%;
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 2rem 0;
        }

        /* Animations */
        @keyframes slideDown {
            from {
                transform: translateY(-100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        
        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.8);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
        
        @keyframes glow {
            0%, 100% {
                box-shadow: 0 0 5px rgba(0, 201, 255, 0.3);
            }
            50% {
                box-shadow: 0 0 20px rgba(0, 201, 255, 0.6);
            }
        }

        /* ========== Navigation (Fixed) ========== */
        .site-header {
            padding: 1rem 0;
            background: linear-gradient(135deg, var(--charcoal) 0%, var(--navy-bg) 100%);
            position: fixed; 
            top: 0;
            width: 100%;
            z-index: 1000;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0, 201, 255, 0.2);
            height: var(--header-height);
            animation: slideDown 0.8s ease-out;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
        }
        
        /* Light Mode - Plain White Background */
        [data-theme="light"] .site-header {
            background: #FFFFFF;
            border-bottom: 1px solid rgba(46, 120, 197, 0.2);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        
        [data-theme="light"] .site-header.scrolled {
            background: #FFFFFF;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
            border-bottom-color: rgba(46, 120, 197, 0.3);
        }
        
        .site-header.scrolled {
            background: linear-gradient(135deg, #1a1f28 0%, var(--charcoal) 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.6);
            border-bottom-color: rgba(0, 201, 255, 0.3);
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            max-width: var(--max-width);
            margin: 0 auto;
            width: 90%;
            padding: 0 1rem;
            gap: 1rem;
        }
        
        .mobile-nav-actions {
            display: none;
            align-items: center;
            gap: 0.5rem;
        }
        
        .menu-toggle-btn {
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.4);
            color: #ffffff;
            font-size: 1.2rem;
            cursor: pointer;
            padding: 0.6rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            min-width: 44px;
            min-height: 44px;
            z-index: 1001;
            position: relative;
        }
        
        [data-theme="light"] .menu-toggle-btn {
            background: rgba(46, 120, 197, 0.1);
            border: 2px solid rgba(46, 120, 197, 0.3);
            color: var(--primary-blue);
        }
        
        .menu-toggle-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.6);
            transform: scale(1.05);
        }
        
        .menu-toggle-btn:focus {
            outline: 2px solid #64b5f6;
            outline-offset: 2px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: #ffffff;
            animation: fadeInScale 1s ease-out 0.2s both;
            transition: transform 0.3s ease;
            flex-shrink: 0;
            margin-right: 2rem;
            padding-left: 1rem;
        }
        
        [data-theme="light"] .brand {
            color: var(--primary-blue);
        }
        
        .brand:hover {
            transform: scale(1.05);
            color: #ffffff;
        }

        .brand img {
            width: 44px;
            height: 44px;
            object-fit: cover;
            border-radius: 0;
            background: transparent;
            padding: 0;
            transition: none;
            animation: none;
        }
        
        .brand:hover img {
            animation: none;
            transform: none;
        }

        .brand h1 {
            font-size: 1.1rem;
            margin: 0;
            letter-spacing: 0.5px;
            font-weight: 700;
            line-height: 1.2;
        }

        .brand .tagline {
            font-size: 0.7rem;
            color: var(--cool-gray);
            margin-top: 2px;
            display: block;
            line-height: 1;
        }
        
        [data-theme="light"] .brand .tagline {
            color: var(--cool-gray);
        }

        .nav-main-group {
            display: flex;
            align-items: center;
            flex: 1;
            justify-content: center;
            gap: 1rem;
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            margin: 0;
            padding: 0;
            list-style: none;
            align-items: center;
        }
        
        .nav-links li {
            animation: fadeInScale 0.6s ease-out both;
        }
        
        .nav-links li:nth-child(1) { animation-delay: 0.3s; }
        .nav-links li:nth-child(2) { animation-delay: 0.4s; }
        .nav-links li:nth-child(3) { animation-delay: 0.5s; }
        .nav-links li:nth-child(4) { animation-delay: 0.6s; }
        .nav-links li:nth-child(5) { animation-delay: 0.7s; }
        .nav-links li:nth-child(6) { animation-delay: 0.8s; }
        .nav-links li:nth-child(7) { animation-delay: 0.9s; }

        .nav-links a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            opacity: 1;
            transition: all 0.3s ease;
            position: relative;
            padding: 0.5rem 0;
        }
        
        [data-theme="light"] .nav-links a {
            color: var(--primary-blue);
        }
        
        .nav-links a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: #64b5f6;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .nav-links a:hover {
            opacity: 1;
            color: #64b5f6;
            transform: translateY(-2px);
        }
        
        .nav-links a:hover::after {
            width: 100%;
        }
        
        .nav-links a.active {
            opacity: 1;
            color: #64b5f6;
        }
        
        .nav-links a.active::after {
            width: 100%;
        }

        .nav-actions-group {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            animation: slideInRight 0.8s ease-out 0.5s both;
            flex-shrink: 0;
        }
        
        .user-profile-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 0.75rem;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        [data-theme="light"] .user-profile-btn {
            background: rgba(46, 120, 197, 0.1);
            border: 1px solid rgba(46, 120, 197, 0.3);
            color: var(--primary-blue);
        }
        
        .user-profile-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(0, 201, 255, 0.1), transparent);
            transition: left 0.5s;
        }

        .user-profile-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            color: #ffffff;
        }
        
        .user-profile-btn:hover::before {
            left: 100%;
        }

        .user-avatar-initial {
            width: 28px;
            height: 28px;
            background: #2E78C5;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
            color: #ffffff;
            flex-shrink: 0;
            position: relative;
        }
        
        .user-avatar-container {
            position: relative;
            display: inline-block;
        }
        
        .verification-badge {
            position: absolute;
            bottom: -2px;
            right: -2px;
            width: 14px;
            height: 14px;
            background: #22c55e;
            border: 2px solid var(--navy-bg);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.6rem;
            color: white;
            z-index: 1;
        }
        
        [data-theme="light"] .verification-badge {
            border-color: #FFFFFF;
        }

        .btn-primary {
            background: var(--cyan-accent);
            color: #07101a;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.2);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 201, 255, 0.4);
            color: #07101a;
        }
        
        .btn-primary i {
            color: #ffffff;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #ffffff;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        
        [data-theme="light"] .btn-outline {
            border: 1px solid var(--primary-blue);
            color: var(--primary-blue);
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: #64b5f6;
            color: #64b5f6;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        
        .logout-btn {
            padding: 0.5rem;
            border-radius: 50%;
        }
        
        .logout-btn i {
            margin: 0;
        }
        
        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.85rem;
        }

        .theme-toggle-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1.1rem;
        }
        
        .theme-toggle-btn:hover {
            background: rgba(255, 255, 255, 0.2);
            transform: scale(1.1) rotate(20deg);
        }
        
        [data-theme="light"] .theme-toggle-btn {
            background: rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.1);
            color: var(--primary-blue);
        }
        
        [data-theme="light"] .theme-toggle-btn:hover {
            background: rgba(0, 0, 0, 0.1);
        }

        main {
            flex: 1;
            padding: 2rem 0;
        }

        .card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius);
            padding: 1.5rem;
            transition: transform 0.2s, box-shadow 0.2s, background 0.3s ease, border-color 0.3s ease;
        }
        
        [data-theme="light"] .card {
            background: #F8FBFF;
            border: 2px solid var(--deep-blue);
            box-shadow: 0 4px 16px rgba(46, 120, 197, 0.15);
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
        }
        
        [data-theme="light"] .card:hover {
            border-color: var(--deep-blue);
            box-shadow: 0 12px 32px rgba(30, 76, 124, 0.25);
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--diamond-white);
        }

        .form-control {
            width: 100%;
            padding: 0.6rem 0.8rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: var(--diamond-white);
            font-family: inherit;
            font-size: 1rem;
            transition: border-color 0.2s, background 0.3s ease;
        }
        
        [data-theme="light"] .form-control {
            background: #FFFFFF;
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: var(--diamond-white);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--cyan-accent);
            box-shadow: 0 0 0 2px rgba(0, 201, 255, 0.2);
        }

        textarea.form-control {
            min-height: 120px;
            resize: vertical;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            color: var(--diamond-white);
        }

        .table th {
            text-align: left;
            padding: 0.75rem 1rem;
            font-weight: 600;
            color: var(--cool-gray);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            vertical-align: middle;
        }

        .table tr:last-child td {
            border-bottom: none;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.5rem 1rem;
            border-radius: 18px;
            font-weight: 500;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            border: none;
        }

        .btn-danger {
            background: #dc3545;
            color: white;
        }

        .btn-danger:hover {
            background: #c82333;
            color: white;
        }

        .btn-edit {
            background: rgba(255, 255, 255, 0.05);
            color: var(--cyan-accent);
            border: 1px solid rgba(0, 201, 255, 0.2);
        }

        .btn-edit:hover {
            background: rgba(0, 201, 255, 0.1);
            color: var(--cyan-accent);
        }

        .admin-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .admin-header h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--diamond-white);
        }

        .alert {
            padding: 1rem 1.5rem;
            border-radius: var(--radius);
            margin-bottom: 1rem;
            border: 1px solid;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            border-color: rgba(16, 185, 129, 0.3);
            color: #10b981;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border-color: rgba(239, 68, 68, 0.3);
            color: #ef4444;
        }

        .alert-warning {
            background: rgba(251, 191, 36, 0.1);
            border-color: rgba(251, 191, 36, 0.3);
            color: #fbbf24;
        }

        .alert-info {
            background: rgba(59, 130, 246, 0.1);
            border-color: rgba(59, 130, 246, 0.3);
            color: #3b82f6;
        }

        .alert ul {
            margin: 0;
            padding-left: 1.5rem;
        }

        .alert li {
            margin-bottom: 0.25rem;
        }
        
        /* ========== OFF-CANVAS MOBILE SIDEBAR ========== */
        .off-canvas-sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 215px;
            max-width: 75vw;
            max-height: 75vh;
            background: linear-gradient(180deg, var(--charcoal) 0%, var(--navy-bg) 100%);
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.7);
            z-index: 1002;
            overflow-y: auto;
            transform: translateX(100%); 
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            backdrop-filter: blur(10px);
            border-left: 2px solid rgba(0, 201, 255, 0.2);
            border-radius: 0 0 0 20px;
        }

        .off-canvas-sidebar.is-open {
            transform: translateX(0);
        }

        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 1001;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .sidebar-overlay.is-open {
            opacity: 1;
            visibility: visible;
        }
        
        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 1.5rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            background: rgba(255, 255, 255, 0.05);
        }
        
        .sidebar-title {
            color: #ffffff;
            font-weight: 600;
            font-size: 1.1rem;
            margin: 0;
        }

        .close-btn {
            background: rgba(255, 255, 255, 0.15);
            border: 2px solid rgba(255, 255, 255, 0.4);
            color: #ffffff;
            font-size: 1.2rem;
            cursor: pointer;
            line-height: 1;
            padding: 0.6rem;
            border-radius: 8px;
            transition: all 0.3s ease;
            min-width: 40px;
            min-height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .close-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            border-color: rgba(255, 255, 255, 0.6);
            transform: scale(1.1);
        }
        
        .close-btn:focus {
            outline: 2px solid #64b5f6;
            outline-offset: 2px;
        }

        .sidebar-content {
            padding: 1.5rem;
        }

        .off-canvas-sidebar .nav-links {
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
            gap: 0;
            padding-bottom: 1rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            list-style: none;
            margin: 0;
            padding-left: 0;
        }
        
        .off-canvas-sidebar .nav-links a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            font-size: 0.95rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 0;
            margin: 0;
            color: #ffffff;
            width: 100%;
            position: relative;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .off-canvas-sidebar .nav-links a i {
            width: 18px;
            font-size: 0.9rem;
            color: var(--cyan-accent);
            opacity: 0.8;
            flex-shrink: 0;
        }
        
        .off-canvas-sidebar .nav-links a::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 4px;
            background: #64b5f6;
            transform: scaleY(0);
            transition: transform 0.3s ease;
        }
        
        .off-canvas-sidebar .nav-links a:hover {
            background: rgba(100, 181, 246, 0.15);
            color: #64b5f6;
            transform: translateX(8px);
        }
        
        .off-canvas-sidebar .nav-links a:hover::before {
            transform: scaleY(1);
        }

        .off-canvas-sidebar .nav-actions-group {
             flex-direction: column;
             width: 100%;
             gap: 0.75rem;
             margin-top: 1.5rem;
        }
        
        .off-canvas-sidebar .nav-actions-group > * {
            width: 100%;
        }
        
        .off-canvas-sidebar .btn-outline,
        .off-canvas-sidebar .btn-primary {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1rem;
            font-size: 0.85rem;
            font-weight: 500;
            border-radius: 8px !important;
            text-decoration: none;
            transition: all 0.3s ease;
            justify-content: flex-start;
        }
        
        .off-canvas-sidebar .btn-outline {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
        }
        
        .off-canvas-sidebar .btn-primary {
            background: rgba(0, 201, 255, 0.1);
            border: 1px solid rgba(0, 201, 255, 0.3);
            color: var(--cyan-accent);
        }
        
        .off-canvas-sidebar .btn-outline i,
        .off-canvas-sidebar .btn-primary i {
            width: 18px;
            font-size: 0.9rem;
            flex-shrink: 0;
        }
        
        .off-canvas-sidebar .btn-primary i {
            color: #ffffff;
        }
        
        /* Light Mode Mobile Menu Styles */
        [data-theme="light"] .off-canvas-sidebar {
            background: #FFFFFF;
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.1);
            border-left: 2px solid rgba(46, 120, 197, 0.2);
        }
        
        [data-theme="light"] .sidebar-overlay {
            background: rgba(0, 0, 0, 0.3);
        }
        
        [data-theme="light"] .sidebar-header {
            border-bottom: 2px solid rgba(46, 120, 197, 0.2);
            background: rgba(46, 120, 197, 0.05);
        }
        
        [data-theme="light"] .sidebar-title {
            color: var(--primary-blue);
        }
        
        [data-theme="light"] .close-btn {
            background: rgba(46, 120, 197, 0.1);
            border: 2px solid rgba(46, 120, 197, 0.3);
            color: var(--primary-blue);
        }
        
        [data-theme="light"] .close-btn:hover {
            background: rgba(46, 120, 197, 0.2);
            border-color: rgba(46, 120, 197, 0.5);
        }
        
        [data-theme="light"] .off-canvas-sidebar .nav-links {
            border-bottom: 2px solid rgba(46, 120, 197, 0.2);
        }
        
        [data-theme="light"] .off-canvas-sidebar .nav-links a {
            color: var(--primary-blue);
            background: rgba(46, 120, 197, 0.05);
            border: 1px solid rgba(46, 120, 197, 0.1);
        }
        
        [data-theme="light"] .off-canvas-sidebar .nav-links a i {
            color: var(--primary-blue);
        }
        
        [data-theme="light"] .off-canvas-sidebar .nav-links a:hover {
            background: rgba(46, 120, 197, 0.15);
            border-color: rgba(46, 120, 197, 0.3);
            color: var(--primary-blue);
        }
        
        [data-theme="light"] .off-canvas-sidebar .nav-links a::before {
            background: var(--primary-blue);
        }

        @media (max-width: 1200px) {
            .nav-links {
                gap: 1rem;
            }
            .nav-links a {
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 992px) {
            .mobile-nav-actions {
                display: flex !important;
            }
            .nav-main-group {
                display: none !important;
            }
        }
        
        @media (min-width: 993px) {
            .mobile-nav-actions {
                display: none !important;
            }
            .nav-main-group {
                display: flex !important;
            }
        }
        
        /* Footer Styles */
        .site-footer {
            margin-top: auto;
            padding: 2rem 0;
            background: linear-gradient(135deg, var(--charcoal) 0%, var(--navy-bg) 100%);
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
        }
        
        .site-footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, var(--cyan-accent), transparent);
        }
        
        .footer-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 3rem;
            margin-bottom: 2.5rem;
            animation: fadeInUp 1s ease-out;
        }
        
        .footer-section {
            animation: fadeInUp 0.8s ease-out both;
        }
        
        .footer-section:nth-child(1) { animation-delay: 0.1s; }
        .footer-section:nth-child(2) { animation-delay: 0.2s; }
        .footer-section:nth-child(3) { animation-delay: 0.3s; }
        .footer-section:nth-child(4) { animation-delay: 0.4s; }
        
        .footer-heading {
            color: var(--cyan-accent);
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 1.25rem;
            position: relative;
            padding-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .footer-heading::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: 0;
            width: 40px;
            height: 2px;
            background: var(--cyan-accent);
        }
        
        .footer-description {
            color: var(--cool-gray);
            font-size: 0.9rem;
            line-height: 1.6;
            margin-bottom: 1rem;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 0.85rem;
        }
        
        .footer-links li {
            margin-bottom: 0;
        }
        
        .footer-links a {
            color: var(--cool-gray);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.65rem;
            cursor: pointer;
        }
        
        .footer-links a:hover {
            color: var(--diamond-white);
        }
        
        .footer-links i {
            font-size: 0.85rem;
            width: 18px;
            color: var(--cyan-accent);
            opacity: 0.7;
        }
        
        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            flex-wrap: wrap;
            gap: 1rem;
        }
        
        .footer-text {
            color: var(--cool-gray);
            font-size: 0.85rem;
        }
        
        .footer-credits {
            color: var(--cool-gray);
            font-size: 0.85rem;
        }
        
        .social-links {
            display: flex;
            gap: 0.75rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }
        
        .social-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            color: var(--cool-gray);
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .social-link:hover {
            background: var(--cyan-accent);
            color: var(--navy-bg);
            transform: translateY(-3px) scale(1.1);
            box-shadow: 0 5px 15px rgba(0, 201, 255, 0.4);
        }
        
        .social-link:nth-child(1):hover { background: #1da1f2; }
        .social-link:nth-child(2):hover { background: #0077b5; }
        .social-link:nth-child(3):hover { background: #333; }
        .social-link:nth-child(4):hover { background: #1877f2; }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes fadeInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* Mobile responsive styles for all pages */
        @media (max-width: 768px) {
            .container {
                width: 95%;
                padding: 1rem 0;
            }
            
            .nav {
                width: 95%;
                padding: 0 0.5rem;
            }
            
            .nav-links {
                gap: 1rem;
            }
            
            .nav-actions-group {
                gap: 0.5rem;
            }
            
            .user-profile-btn {
                padding: 0.25rem 0.5rem;
                font-size: 0.85rem;
            }
            
            .user-profile-btn span:last-child {
                display: none;
            }
            
            .footer-grid {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            
            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }
            
            .social-links {
                gap: 0.75rem;
            }
            
            .social-link {
                width: 35px;
                height: 35px;
            }
            
            .brand h1 {
                font-size: 1rem;
            }
            
            .brand .tagline {
                font-size: 0.65rem;
            }
            
            .hero-section {
                padding: 2rem 0 !important;
                margin: -1rem -2.5% 2rem !important;
            }
            
            .hero-section h1 {
                font-size: 2rem !important;
            }
            
            .hero-section p {
                font-size: 1rem !important;
            }
            
            .feature-grid,
            .dashboard-grid,
            .quick-actions {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
            }
            
            /* Stats grid uses 2 columns on mobile */
            .dashboard-grid {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0.75rem !important;
            }
            
            .stat-card {
                padding: 0.75rem !important;
                min-height: auto !important;
            }
            
            .stat-number {
                font-size: 1.25rem !important;
                margin-bottom: 0.15rem !important;
            }
            
            .stat-label {
                font-size: 0.65rem !important;
                line-height: 1.2 !important;
            }
            
            .quick-actions {
                grid-template-columns: repeat(2, 1fr) !important;
                gap: 0.5rem !important;
            }
            
            .action-card {
                padding: 0.75rem 0.5rem !important;
            }
            
            .action-icon {
                font-size: 1.25rem !important;
                margin-bottom: 0.4rem !important;
            }
            
            .action-card h3 {
                font-size: 0.75rem !important;
            }
            
            .action-card p {
                font-size: 0.7rem !important;
            }
            
            .job-header,
            .course-header {
                flex-direction: column !important;
                align-items: flex-start !important;
                gap: 1rem !important;
            }
            
            .job-meta,
            .course-meta {
                flex-direction: column !important;
                gap: 0.5rem !important;
            }
            
            .table {
                font-size: 0.9rem;
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            
            .table th,
            .table td {
                padding: 0.75rem 0.5rem;
                min-width: 100px;
            }
            
            .card {
                padding: 1rem;
            }
            
            .btn {
                padding: 0.6rem 1rem;
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 480px) {
            .container {
                width: 98%;
                padding: 0.5rem 0;
            }
            
            .nav {
                width: 98%;
                padding: 0 0.25rem;
            }
            
            .nav-actions-group {
                gap: 0.25rem;
            }
            
            .btn {
                font-size: 0.8rem;
            }
            
            .social-link {
                width: 32px;
                height: 32px;
                font-size: 0.9rem;
            }
            
            .brand img {
                width: 32px;
                height: 32px;
            }
            
            .brand h1 {
                font-size: 0.9rem;
            }
            
            .brand .tagline {
                font-size: 0.6rem;
            }
            
            .hero-section {
                padding: 1.5rem 0 !important;
            }
            
            .hero-section h1 {
                font-size: 1.75rem !important;
            }
            
            .hero-section p {
                font-size: 0.95rem !important;
            }
            
            .feature-card,
            .stat-card,
            .job-card,
            .course-card {
                padding: 1.25rem !important;
            }
            
            .btn {
                padding: 0.5rem 0.75rem;
                font-size: 0.85rem;
            }
            
            .table {
                font-size: 0.8rem;
            }
            
            .table th,
            .table td {
                padding: 0.5rem 0.25rem;
                min-width: 80px;
            }
            
            .card {
                padding: 0.75rem;
            }
            
            .form-control {
                padding: 0.5rem 0.6rem;
                font-size: 0.9rem;
            }
        }


        
        /* Light Mode Styles for Navigation Dropdowns */
        [data-theme="light"] .nav-actions-group .dropdown-menu {
            background: rgba(255, 255, 255, 0.98) !important;
            border: 1px solid rgba(46, 120, 197, 0.3) !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
        }

        [data-theme="light"] .nav-actions-group .dropdown-menu li a {
            color: #1A202C !important;
        }

        [data-theme="light"] .nav-actions-group .dropdown-menu li a:hover {
            background: rgba(46, 120, 197, 0.1) !important;
            color: #2E78C5 !important;
        }

        [data-theme="light"] .nav-actions-group .dropdown-menu li a i {
            color: #2E78C5 !important;
        }

        [data-theme="light"] .nav-actions-group .dropdown-menu hr {
            border-color: rgba(46, 120, 197, 0.2) !important;
        }

        [data-theme="light"] .nav-actions-group .dropdown-menu button {
            color: #ef4444 !important;
        }

        [data-theme="light"] .nav-actions-group .dropdown-menu button:hover {
            background: rgba(239, 68, 68, 0.1) !important;
        }

        /* Notification Bell Styles */
        .notification-bell {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--diamond-white);
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
        }

        .notification-bell:hover {
            background: rgba(0, 201, 255, 0.1);
            border-color: var(--cyan-accent);
            transform: scale(1.05);
        }

        .notification-bell i {
            font-size: 1.1rem;
        }

        .notification-badge {
            position: absolute;
            top: -4px;
            right: -4px;
            background: linear-gradient(135deg, #ff6b6b, #ee5a6f);
            color: white;
            font-size: 0.7rem;
            font-weight: 700;
            min-width: 18px;
            height: 18px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 4px;
            box-shadow: 0 2px 8px rgba(255, 107, 107, 0.4);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
        }

        .notification-dropdown {
            display: none;
            position: absolute;
            top: calc(100% + 0.5rem);
            right: 0;
            background: linear-gradient(135deg, var(--charcoal) 0%, var(--navy-bg) 100%);
            border: 1px solid rgba(0, 201, 255, 0.2);
            border-radius: 12px;
            min-width: 360px;
            max-width: 400px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
            z-index: 1003;
            overflow: hidden;
        }

        .notification-dropdown.show {
            display: block;
        }

        .notification-header {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .notification-header h3 {
            margin: 0;
            font-size: 1.1rem;
            color: var(--diamond-white);
            font-weight: 600;
        }

        .mark-all-read {
            color: var(--cyan-accent);
            font-size: 0.85rem;
            cursor: pointer;
            text-decoration: none;
            transition: color 0.2s;
        }

        .mark-all-read:hover {
            color: var(--diamond-white);
        }

        .notification-list {
            max-height: 400px;
            overflow-y: auto;
        }

        .notification-item {
            padding: 1rem 1.25rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
            display: block;
            color: inherit;
        }

        .notification-item:hover {
            background: rgba(0, 201, 255, 0.05);
        }

        .notification-item.unread {
            background: rgba(0, 201, 255, 0.03);
            border-left: 3px solid var(--cyan-accent);
        }

        .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            margin-right: 0.75rem;
            flex-shrink: 0;
        }

        .notification-icon.course {
            background: rgba(0, 201, 255, 0.1);
            color: var(--cyan-accent);
        }

        .notification-icon.badge {
            background: rgba(255, 215, 0, 0.1);
            color: #ffd700;
        }

        .notification-icon.testimonial {
            background: rgba(124, 77, 255, 0.1);
            color: var(--purple-accent);
        }

        .notification-icon.forum {
            background: rgba(34, 197, 94, 0.1);
            color: #22c55e;
        }

        .notification-icon.article {
            background: rgba(249, 115, 22, 0.1);
            color: #f97316;
        }

        .notification-content {
            flex: 1;
        }

        .notification-title {
            font-weight: 600;
            color: var(--diamond-white);
            margin-bottom: 0.25rem;
            font-size: 0.95rem;
        }

        .notification-message {
            color: var(--cool-gray);
            font-size: 0.85rem;
            line-height: 1.4;
        }

        .notification-time {
            color: var(--cool-gray);
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        .notification-empty {
            padding: 3rem 1.5rem;
            text-align: center;
            color: var(--cool-gray);
        }

        .notification-empty i {
            font-size: 3rem;
            margin-bottom: 1rem;
            opacity: 0.3;
        }

        .notification-footer {
            padding: 0.75rem 1.25rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .view-all-notifications {
            color: var(--cyan-accent);
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: color 0.2s;
        }

        .view-all-notifications:hover {
            color: var(--diamond-white);
        }

        /* Light Mode Styles for Notifications */
        [data-theme="light"] .notification-bell {
            background: rgba(46, 120, 197, 0.05);
            border: 1px solid rgba(46, 120, 197, 0.2);
            color: #1A202C;
        }

        [data-theme="light"] .notification-bell:hover {
            background: rgba(46, 120, 197, 0.1);
            border-color: #2E78C5;
        }

        [data-theme="light"] .notification-dropdown {
            background: #FFFFFF;
            border: 1px solid rgba(46, 120, 197, 0.2);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        [data-theme="light"] .notification-header {
            border-bottom: 1px solid rgba(46, 120, 197, 0.1);
        }

        [data-theme="light"] .notification-header h3 {
            color: #1A202C;
        }

        [data-theme="light"] .notification-item {
            border-bottom: 1px solid rgba(46, 120, 197, 0.05);
        }

        [data-theme="light"] .notification-item:hover {
            background: rgba(46, 120, 197, 0.05);
        }

        [data-theme="light"] .notification-item.unread {
            background: rgba(46, 120, 197, 0.03);
            border-left: 3px solid #2E78C5;
        }

        [data-theme="light"] .notification-title {
            color: #1A202C;
        }

        [data-theme="light"] .notification-message,
        [data-theme="light"] .notification-time {
            color: #4A5568;
        }

        [data-theme="light"] .notification-footer {
            border-top: 1px solid rgba(46, 120, 197, 0.1);
        }

        [data-theme="light"] .notification-empty {
            color: #4A5568;
        }

        @media (max-width: 768px) {
            .notification-dropdown {
                min-width: 320px;
                right: -50px;
            }
            
            #mobileNotificationDropdown {
                right: -20px;
            }
        }

        @media (max-width: 480px) {
            .notification-dropdown {
                min-width: 280px;
                max-width: 90vw;
                right: -80px;
            }
            
            #mobileNotificationDropdown {
                min-width: 280px;
                max-width: calc(100vw - 2rem);
                right: -60px;
            }
        }
        

    </style>

    <!-- AdSense Code -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5953090781208260"
         crossorigin="anonymous"></script>
    
    <!-- Theme Color -->
    <meta name="theme-color" content="#0a192f">
    
    @stack('styles')
    

</head>
<body>
    <header class="site-header">
        <nav class="nav">
            <a href="{{ url('/') }}" class="brand">
            @if(!empty($siteSettings['logo_url']))
            <img
                src="{{ url($siteSettings['logo_url']) }}"
                alt="{{ $siteSettings['site_name'] ?? 'Site Logo' }}"
                class="site-logo"
                style="height:44px;width:44px;object-fit:cover;border-radius:50%;box-shadow:0 2px 10px rgba(0,0,0,.35);border:1px solid rgba(255,255,255,0.2);"
            >
            @endif
                <div>
                    <h1>{{ $siteSettings['site_name'] ?? config('app.name') }}</h1>
                    <span class="tagline">{{ $siteSettings['tagline'] ?? 'Digital Leap Africa' }}</span>
                </div>
            </a>

            <div class="mobile-nav-actions" style="display: flex; align-items: center; gap: 0.5rem;">
                @auth
                    {{-- Mobile Notification Bell --}}
                    <div class="dropdown" style="position:relative;display:inline-block;">
                        <a href="#" class="notification-bell" id="mobileNotificationBell" onclick="toggleNotifications(event)" style="width: 36px; height: 36px; font-size: 1rem;">
                            <i class="fas fa-bell"></i>
                            @php
                                try {
                                    $unreadCount = auth()->check() ? auth()->user()->notifications()->where('is_read', false)->count() : 0;
                                } catch (\Exception $e) {
                                    $unreadCount = 0;
                                }
                            @endphp
                            @if($unreadCount > 0)
                                <span class="notification-badge">{{ $unreadCount > 99 ? '99+' : $unreadCount }}</span>
                            @endif
                        </a>
                        
                        <div class="notification-dropdown" id="mobileNotificationDropdown">
                            <div class="notification-header">
                                <h3>Notifications</h3>
                                @if($unreadCount > 0)
                                    <a href="#" class="mark-all-read" onclick="markAllAsRead(event)">Mark all read</a>
                                @endif
                            </div>
                            
                            <div class="notification-list">
                                @php
                                    try {
                                        $notifications = auth()->check() ? auth()->user()->notifications()->latest()->take(10)->get() : collect();
                                    } catch (\Exception $e) {
                                        $notifications = collect();
                                    }
                                @endphp
                                
                                @forelse($notifications as $notification)
                                    <a href="{{ $notification->url }}" 
                                       class="notification-item {{ !$notification->is_read ? 'unread' : '' }}" 
                                       onclick="markAsRead(event, {{ $notification->id }})" 
                                       style="display:flex;align-items:start;">
                                        <div class="notification-icon {{ $notification->type }}">
                                            @if($notification->type === 'course_enrollment')
                                                <i class="fas fa-graduation-cap"></i>
                                            @elseif($notification->type === 'badge_earned')
                                                <i class="fas fa-medal"></i>
                                            @elseif($notification->type === 'testimonial_approved')
                                                <i class="fas fa-check-circle"></i>
                                            @elseif($notification->type === 'forum_reply')
                                                <i class="fas fa-comment"></i>
                                            @elseif($notification->type === 'new_course')
                                                <i class="fas fa-book"></i>
                                            @elseif($notification->type === 'new_article')
                                                <i class="fas fa-newspaper"></i>
                                            @endif
                                        </div>
                                        <div class="notification-content">
                                            <div class="notification-title">{{ $notification->title }}</div>
                                            <div class="notification-message">{{ $notification->message }}</div>
                                            <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                                        </div>
                                    </a>
                                @empty
                                    <div class="notification-empty">
                                        <i class="fas fa-bell-slash"></i>
                                        <p>No notifications yet</p>
                                    </div>
                                @endforelse
                            </div>
                            
                            @if($notifications->count() > 0)
                                <div class="notification-footer">
                                    <a href="{{ route('notifications.index') }}" class="view-all-notifications">View all notifications</a>
                                </div>
                            @endif
                        </div>
                    </div>
                @endauth
                
                <button class="menu-toggle-btn" aria-label="Toggle navigation" type="button" 
                        onclick="document.querySelector('.off-canvas-sidebar').classList.add('is-open'); document.querySelector('.sidebar-overlay').classList.add('is-open')">
                    <i class="fas fa-bars"></i>
                </button>
            </div>

            

            <div class="nav-main-group"> 
                <ul class="nav-links">
                    <li><a href="{{ route('home') }}" class="@if(request()->routeIs('home')) active @endif">Home</a></li>
                    <li><a href="{{ route('about') }}" class="@if(request()->routeIs('about')) active @endif">About</a></li>
                    <li><a href="{{ route('courses.index') }}" class="@if(request()->routeIs('courses.*')) active @endif">Courses</a></li>
                    <li><a href="{{ route('blog.index') }}" class="@if(request()->routeIs('blog.*')) active @endif">Blog</a></li>

                    

                    <li class="dropdown" onmouseenter="clearTimeout(this.hideTimer); this.querySelector('.dropdown-menu').style.display='block'" onmouseleave="this.hideTimer = setTimeout(() => this.querySelector('.dropdown-menu').style.display='none', 300)">
                        <a href="#" class="@if(request()->routeIs('elibrary.*') || request()->routeIs('events.*') || request()->routeIs('jobs.*') || request()->routeIs('forum.*')) active @endif" style="display:flex;align-items:center;gap:.35rem;">
                            Resources<i class="fas fa-chevron-down" style="font-size:.75rem;"></i>
                        </a>
                        <ul class="dropdown-menu" style="display:none;position:absolute;margin-top:.5rem;background:linear-gradient(135deg, var(--charcoal) 0%, var(--navy-bg) 100%);border:1px solid rgba(0,201,255,.2);border-radius:8px;min-width:220px;box-shadow:0 10px 20px rgba(0,0,0,.5);padding:.4rem 0;z-index:1002;">
                            <li><a href="{{ route('elibrary.index') }}" class="@if(request()->routeIs('elibrary.*')) active @endif" style="display:block;padding:.5rem 1rem;">eLibrary</a></li>
                            <li><a href="{{ route('events.index') }}" class="@if(request()->routeIs('events.*')) active @endif" style="display:block;padding:.5rem 1rem;">Events</a></li>
                            <li><a href="{{ route('forum.index') }}" class="@if(request()->routeIs('forum.*')) active @endif" style="display:block;padding:.5rem 1rem;">Forum</a></li>
                        </ul>
                    </li>

                    <!-- <li class="dropdown" onmouseenter="this.querySelector('.dropdown-menu').style.display='block'" onmouseleave="this.querySelector('.dropdown-menu').style.display='none'">
                        <a href="#" class="@if(request()->routeIs('blog.*') || request()->routeIs('contact') || request()->routeIs('donate')) active @endif" style="display:flex;align-items:center;gap:.35rem;">
                            More▾<i class="fas fa-chevron-down" style="font-size:.75rem;"></i>
                        </a>
                        <ul class="dropdown-menu" style="display:none;position:absolute;margin-top:.5rem;background:#0d47a1;border:1px solid rgba(255,255,255,.15);border-radius:8px;min-width:200px;box-shadow:0 10px 20px rgba(0,0,0,.35);padding:.4rem 0;z-index:1002;">
                            <li><a href="{{ route('projects.index') }}" class="@if(request()->routeIs('projects.*')) active @endif" style="display:block;padding:.5rem 1rem;">Projects</a></li>
                            <li><a href="{{ route('jobs.index') }}" class="@if(request()->routeIs('jobs.*')) active @endif" style="display:block;padding:.5rem 1rem;">Jobs</a></li>
                            <li><a href="{{ route('forum.index') }}" class="@if(request()->routeIs('forum.*')) active @endif" style="display:block;padding:.5rem 1rem;">Forum</a></li>
                            <li><a href="{{ route('contact') }}" class="@if(request()->routeIs('contact')) active @endif" style="display:block;padding:.5rem 1rem;">Contact</a></li>
                            <li><a href="{{ route('donate') }}" class="@if(request()->routeIs('donate')) active @endif" style="display:block;padding:.5rem 1rem;">Donate</a></li>
                            
                        </ul>
                    </li> -->
                
                    <!-- @auth
                        <li><a href="{{ route('dashboard') }}" class="@if(request()->routeIs('dashboard')) active @endif">Dashboard</a></li>
                    @endauth   -->
                     
                </ul>

                <div class="nav-actions-group">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            {{-- Admin users get a dropdown --}}
                            <div class="dropdown" style="position:relative;display:inline-block;" 
                                 onmouseenter="clearTimeout(this.hideTimer); this.querySelector('.dropdown-menu').style.display='block'" 
                                 onmouseleave="this.hideTimer = setTimeout(() => this.querySelector('.dropdown-menu').style.display='none', 300)">
                                <a href="#" class="btn-outline btn-sm" style="display:flex;align-items:center;gap:.35rem;">
                                    <i class="fas fa-tachometer-alt"></i> Dashboard <i class="fas fa-chevron-down" style="font-size:.75rem;"></i>
                                </a>
                                <ul class="dropdown-menu" style="display:none;position:absolute;margin-top:.5rem;background:linear-gradient(135deg, var(--charcoal) 0%, var(--navy-bg) 100%);border:1px solid rgba(0,201,255,.2);border-radius:8px;min-width:200px;box-shadow:0 10px 20px rgba(0,0,0,.5);padding:.4rem 0;z-index:1002;right:0;">
                                    <li>
                                        <a href="{{ route('dashboard') }}" style="display:block;padding:.5rem 1rem;color:#dbe1ea;text-decoration:none;">
                                            <i class="fas fa-gauge me-2"></i>User Dashboard
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}" style="display:block;padding:.5rem 1rem;color:#dbe1ea;text-decoration:none;">
                                            <i class="fas fa-shield-alt me-2"></i>Admin Panel
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @else
                            {{-- Normal users get a simple link --}}
                            <a href="{{ route('dashboard') }}" class="btn-outline btn-sm">
                                <i class="fas fa-tachometer-alt me-1"></i> Dashboard
                            </a>
                        @endif
                        
                        {{-- Notification Bell --}}
                        <div class="dropdown" style="position:relative;display:inline-block;">
                            <a href="#" class="notification-bell" id="notificationBell" onclick="toggleNotifications(event)">
                                <i class="fas fa-bell"></i>
                                @php
                                    try {
                                        $unreadCount = auth()->check() ? auth()->user()->notifications()->where('is_read', false)->count() : 0;
                                    } catch (\Exception $e) {
                                        $unreadCount = 0; // Fallback if notifications table doesn't exist
                                    }
                                @endphp
                                @if($unreadCount > 0)
                                    <span class="notification-badge">{{ $unreadCount > 99 ? '99+' : $unreadCount }}</span>
                                @endif
                            </a>
                            
                            <div class="notification-dropdown" id="notificationDropdown">
                                <div class="notification-header">
                                    <h3>Notifications</h3>
                                    @if($unreadCount > 0)
                                        <a href="#" class="mark-all-read" onclick="markAllAsRead(event)">Mark all read</a>
                                    @endif
                                </div>
                                
                                <div class="notification-list" id="notificationList">
                                    @php
                                        try {
                                            $notifications = auth()->check() ? auth()->user()->notifications()->latest()->take(10)->get() : collect();
                                        } catch (\Exception $e) {
                                            $notifications = collect(); // Fallback if notifications table doesn't exist
                                        }
                                    @endphp
                                    
                                    @forelse($notifications as $notification)
                                        <a href="{{ $notification->url }}" 
                                           class="notification-item {{ !$notification->is_read ? 'unread' : '' }}" 
                                           onclick="markAsRead(event, {{ $notification->id }})" 
                                           style="display:flex;align-items:start;">
                                            <div class="notification-icon {{ $notification->type }}">
                                                @if($notification->type === 'course_enrollment')
                                                    <i class="fas fa-graduation-cap"></i>
                                                @elseif($notification->type === 'badge_earned')
                                                    <i class="fas fa-medal"></i>
                                                @elseif($notification->type === 'testimonial_approved')
                                                    <i class="fas fa-check-circle"></i>
                                                @elseif($notification->type === 'forum_reply')
                                                    <i class="fas fa-comment"></i>
                                                @elseif($notification->type === 'new_course')
                                                    <i class="fas fa-book"></i>
                                                @elseif($notification->type === 'new_article')
                                                    <i class="fas fa-newspaper"></i>
                                                @endif
                                            </div>
                                            <div class="notification-content">
                                                <div class="notification-title">{{ $notification->title }}</div>
                                                <div class="notification-message">{{ $notification->message }}</div>
                                                <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                                            </div>
                                        </a>
                                    @empty
                                        <div class="notification-empty">
                                            <i class="fas fa-bell-slash"></i>
                                            <p>No notifications yet</p>
                                        </div>
                                    @endforelse
                                </div>
                                
                                @if($notifications->count() > 0)
                                    <div class="notification-footer">
                                        <a href="{{ route('notifications.index') }}" class="view-all-notifications">View all notifications</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        {{-- Profile dropdown with logout --}}
                        <div class="dropdown" style="position:relative;display:inline-block;" 
                             onmouseenter="clearTimeout(this.hideTimer); this.querySelector('.dropdown-menu').style.display='block'" 
                             onmouseleave="this.hideTimer = setTimeout(() => this.querySelector('.dropdown-menu').style.display='none', 300)">
                            <a href="#" class="user-profile-btn" style="display:flex;align-items:center;gap:.5rem;">
                                <div class="user-avatar-container">
                                    <span class="user-avatar-initial">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                    @if(Auth::user()->email_verified_at)
                                        <span class="verification-badge">
                                            <i class="fas fa-check"></i>
                                        </span>
                                    @endif
                                </div>
                                <span>{{ Auth::user()->name }}</span>
                                <i class="fas fa-chevron-down" style="font-size:.75rem;"></i>
                            </a>
                            <ul class="dropdown-menu" style="display:none;position:absolute;margin-top:.5rem;background:linear-gradient(135deg, var(--charcoal) 0%, var(--navy-bg) 100%);border:1px solid rgba(0,201,255,.2);border-radius:8px;min-width:200px;box-shadow:0 10px 20px rgba(0,0,0,.5);padding:.4rem 0;z-index:1002;right:0;">
                                <li>
                                    <a href="{{ route('profile.edit') }}" style="display:block;padding:.5rem 1rem;color:#dbe1ea;text-decoration:none;">
                                        <i class="fas fa-user me-2"></i>Profile
                                    </a>
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                                        @csrf
                                        <button type="submit" style="display:block;width:100%;padding:.5rem 1rem;background:none;border:none;color:#ff6b6b;text-align:left;cursor:pointer;">
                                            <i class="fas fa-sign-out-alt me-2"></i>Log Out
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn-outline">Log in</a>
                        <a href="{{ route('register') }}" class="btn-primary">Sign up</a>
                    @endauth
                    
                    <!-- Theme Toggle -->
                    {{-- <button class="theme-toggle-btn" id="themeToggle" aria-label="Toggle theme" title="Toggle light/dark mode">
                        <i class="fas fa-moon" id="themeIcon"></i>
                    </button> --}}
                </div>
            </div>
        </nav>
    </header>

    <div class="off-canvas-sidebar">
        <button class="close-btn" style="position: absolute; top: 1rem; right: 1rem; z-index: 1003;" 
                onclick="document.querySelector('.off-canvas-sidebar').classList.remove('is-open'); document.querySelector('.sidebar-overlay').classList.remove('is-open')">
            <i class="fas fa-times"></i>
        </button>
        
        <div class="sidebar-content" style="padding-top: 1rem;">
            <ul class="nav-links">
               
                <li><a href="{{ route('home') }}"><i class="fas fa-home"></i>Home</a></li>
                <li><a href="{{ route('about') }}"><i class="fas fa-info-circle"></i>About</a></li>
                <li><a href="{{ route('courses.index') }}"><i class="fas fa-graduation-cap"></i>Courses</a></li>
                <li><a href="{{ route('elibrary.index') }}"><i class="fas fa-book"></i>eLibrary</a></li>
                <li><a href="{{ route('events.index') }}"><i class="fas fa-calendar-days"></i>Events</a></li>
                <li><a href="{{ route('forum.index') }}"><i class="fas fa-comments"></i>Forum</a></li>
                <li><a href="{{ route('blog.index') }}"><i class="fas fa-newspaper"></i>Blog</a></li>


                @auth
                    <li><a href="{{ route('dashboard') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
                @endauth
                
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn-outline is-admin">
                            <i class="fas fa-screwdriver-wrench"></i> Admin
                        </a>
                    @endif
                    
                    <a href="{{ route('profile.edit') }}" class="user-profile-btn">
                        <div class="user-avatar-container">
                            <span class="user-avatar-initial">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            @if(Auth::user()->email_verified_at)
                                <span class="verification-badge">
                                    <i class="fas fa-check"></i>
                                </span>
                            @endif
                        </div>
                        <span>{{ Auth::user()->name }}</span>
                    </a>

                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline logout-btn">
                            <i class="fas fa-right-from-bracket"></i>
                            <span>{{ __('Log Out') }}</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-outline">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>Log in</span>
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-outline">
                        <i class="fas fa-user-plus"></i>
                        <span>Sign up</span>
                    </a>
                @endauth
                
                <!-- Theme Toggle Mobile -->
                {{-- <button class="theme-toggle-btn" onclick="toggleTheme()" aria-label="Toggle theme" title="Toggle light/dark mode" style="margin-top: 1rem;">
                    <i class="fas fa-moon" id="themeIconMobile"></i>
                </button> --}}
            </div>
        </div>
    </div>

    <div class="sidebar-overlay" 
         onclick="document.querySelector('.off-canvas-sidebar').classList.remove('is-open'); this.classList.remove('is-open')">
    </div>

    <main class="container">
        @if(session('success'))
            <div class="alert alert-success mb-4" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger mb-4">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (View::hasSection('content'))
            @yield('content')
        @else
            {{ $slot ?? '' }}
        @endif
    </main>
    
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <!-- About Section -->
                <div class="footer-section">
                    <h3 class="footer-heading">Our Socials</h3>
                    <p class="footer-description">
                    </p>
                    <div class="social-links">
                        @if(!empty($siteSettings['twitter_url']))
                            <a href="{{ $siteSettings['twitter_url'] }}" class="social-link" title="Twitter/X" target="_blank" rel="noopener"><i class="fa-brands fa-x-twitter"></i></a>
                        @endif
                        @if(!empty($siteSettings['linkedin_url']))
                            <a href="{{ $siteSettings['linkedin_url'] }}" class="social-link" title="LinkedIn" target="_blank" rel="noopener"><i class="fa-brands fa-linkedin-in"></i></a>
                        @endif
                        @if(!empty($siteSettings['facebook_url']))
                            <a href="{{ $siteSettings['facebook_url'] }}" class="social-link" title="Facebook" target="_blank" rel="noopener"><i class="fa-brands fa-facebook-f"></i></a>
                        @endif
                        @if(!empty($siteSettings['instagram_url']))
                            <a href="{{ $siteSettings['instagram_url'] }}" class="social-link" title="Instagram" target="_blank" rel="noopener"><i class="fa-brands fa-instagram"></i></a>
                        @endif
                        @if(!empty($siteSettings['youtube_url']))
                            <a href="{{ $siteSettings['youtube_url'] }}" class="social-link" title="YouTube" target="_blank" rel="noopener"><i class="fa-brands fa-youtube"></i></a>
                        @endif
                        @if(!empty($siteSettings['tiktok_url']))
                            <a href="{{ $siteSettings['tiktok_url'] }}" class="social-link" title="TikTok" target="_blank" rel="noopener"><i class="fa-brands fa-tiktok"></i></a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="footer-section">
                    <h3 class="footer-heading">Quick Links</h3>
                    <ul class="footer-links">
                        
                        @if(Route::has('courses.index'))
                            <li><a href="{{ route('courses.index') }}"><i class="fas fa-graduation-cap"></i> Courses</a></li>
                        @endif
                        @if(Route::has('articles.index'))
                            <li><a href="{{ route('articles.index') }}"><i class="fas fa-newspaper"></i> Articles</a></li>
                        @endif
                        @if(Route::has('forum.index'))
                            <li><a href="{{ route('forum.index') }}"><i class="fas fa-comments"></i> Forum</a></li>
                        @endif
                        <li><a href="{{ route('testimonials.index') }}"><i class="fas fa-quote-left"></i> Testimonials</a></li>
                    </ul>
                </div>

                <!-- Resources -->
                <div class="footer-section">
                    <h3 class="footer-heading">Resources</h3>
                    <ul class="footer-links">
                        @if(Route::has('elibrary.index'))
                            <li><a href="{{ route('elibrary.index') }}"><i class="fas fa-book"></i> eLibrary</a></li>
                        @endif
                        @if(Route::has('events.index'))
                            <li><a href="{{ route('events.index') }}"><i class="fas fa-calendar-days"></i> Events</a></li>
                        @endif                       
                        @auth
                            <li><a href="{{ route('dashboard') }}"><i class="fas fa-gauge"></i> Dashboard</a></li>
                        @endauth
                    </ul>
                </div>

                <!-- Legal & Contact -->
                <div class="footer-section">
                    <h3 class="footer-heading">Legal & Contact</h3>
                    <ul class="footer-links">
                        <li><a href="{{ route('about') }}"><i class="fas fa-info-circle"></i> About Us</a></li>
                        <li><a href="{{ route('contact') }}"><i class="fas fa-envelope"></i> Contact</a></li>
                        <li><a href="{{ route('privacy.policy') }}"><i class="fas fa-shield-alt"></i> Privacy Policy</a></li>
                        <li><a href="{{ route('terms.service') }}"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                        @if(!empty($siteSettings['contact_email']))
                            <li><a href="mailto:{{ $siteSettings['contact_email'] }}"><i class="fas fa-envelope"></i> {{ $siteSettings['contact_email'] }}</a></li>
                        @endif
                        @if(!empty($siteSettings['contact_phone']))
                            <li><a href="tel:{{ $siteSettings['contact_phone'] }}"><i class="fas fa-phone"></i> {{ $siteSettings['contact_phone'] }}</a></li>
                        @endif
                    </ul>
                </div>
            </div>

            <!-- Footer Bottom -->
            <div class="footer-bottom">
                <div class="footer-text">
                    {!! $siteSettings['footer_text'] ?? ('&copy; ' . date('Y') . ' ' . ($siteSettings['site_name'] ?? config('app.name')) . '. All rights reserved.') !!}
                </div>
                <div class="footer-credits">
                    <span>Built by Africans <i class="fas fa-heart" style="color: #ff6b6b;"></i> for Africa</span>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
    
    <!-- Defer non-critical scripts -->
    <script defer>
        // Theme Toggle Functionality
        function toggleTheme() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'light' ? 'dark' : 'light';
            
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            
            // Update icons
            updateThemeIcons(newTheme);
        }
        
        function updateThemeIcons(theme) {
            const icons = document.querySelectorAll('#themeIcon, #themeIconMobile');
            icons.forEach(icon => {
                if (theme === 'light') {
                    icon.classList.remove('fa-moon');
                    icon.classList.add('fa-sun');
                } else {
                    icon.classList.remove('fa-sun');
                    icon.classList.add('fa-moon');
                }
            });
        }
        
        // Load saved theme on page load
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'dark';
            document.documentElement.setAttribute('data-theme', savedTheme);
            updateThemeIcons(savedTheme);
            
            // Add click event to theme toggle button
            const themeToggle = document.getElementById('themeToggle');
            if (themeToggle) {
                themeToggle.addEventListener('click', toggleTheme);
            }
        });
        
        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('.site-header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
        
        // Mobile menu animations
        const menuToggle = document.querySelector('.menu-toggle-btn');
        const sidebar = document.querySelector('.off-canvas-sidebar');
        const overlay = document.querySelector('.sidebar-overlay');
        
        if (menuToggle) {
            menuToggle.addEventListener('click', function() {
                sidebar.classList.add('is-open');
                overlay.classList.add('is-open');
                document.body.style.overflow = 'hidden';
            });
        }
        
        function closeSidebar() {
            sidebar.classList.remove('is-open');
            overlay.classList.remove('is-open');
            document.body.style.overflow = '';
        }
        
        if (overlay) {
            overlay.addEventListener('click', closeSidebar);
        }
        
        const closeBtn = document.querySelector('.close-btn');
        if (closeBtn) {
            closeBtn.addEventListener('click', closeSidebar);
        }
        
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
        
        // Notification Functions
        function toggleNotifications(event) {
            event.preventDefault();
            
            // Determine which dropdown to toggle based on the clicked element
            const clickedBell = event.currentTarget;
            let dropdown;
            
            if (clickedBell.id === 'mobileNotificationBell') {
                dropdown = document.getElementById('mobileNotificationDropdown');
                // Close desktop dropdown if open
                const desktopDropdown = document.getElementById('notificationDropdown');
                if (desktopDropdown) desktopDropdown.classList.remove('show');
            } else {
                dropdown = document.getElementById('notificationDropdown');
                // Close mobile dropdown if open
                const mobileDropdown = document.getElementById('mobileNotificationDropdown');
                if (mobileDropdown) mobileDropdown.classList.remove('show');
            }
            
            if (dropdown) {
                dropdown.classList.toggle('show');
                
                // Close dropdown when clicking outside
                if (dropdown.classList.contains('show')) {
                    setTimeout(() => {
                        document.addEventListener('click', closeNotificationsOnClickOutside);
                    }, 0);
                }
            }
        }
        
        function closeNotificationsOnClickOutside(event) {
            const desktopDropdown = document.getElementById('notificationDropdown');
            const mobileDropdown = document.getElementById('mobileNotificationDropdown');
            const desktopBell = document.getElementById('notificationBell');
            const mobileBell = document.getElementById('mobileNotificationBell');
            
            let shouldClose = true;
            
            // Check if click is inside any dropdown or bell
            if ((desktopDropdown && desktopDropdown.contains(event.target)) ||
                (mobileDropdown && mobileDropdown.contains(event.target)) ||
                (desktopBell && desktopBell.contains(event.target)) ||
                (mobileBell && mobileBell.contains(event.target))) {
                shouldClose = false;
            }
            
            if (shouldClose) {
                if (desktopDropdown) desktopDropdown.classList.remove('show');
                if (mobileDropdown) mobileDropdown.classList.remove('show');
                document.removeEventListener('click', closeNotificationsOnClickOutside);
            }
        }
        
        function markAsRead(event, notificationId) {
            event.preventDefault();
            
            fetch(`/notifications/${notificationId}/read`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(response => {
                if (response.ok) {
                    // Update UI - remove unread class
                    const item = event.currentTarget;
                    item.classList.remove('unread');
                    
                    // Update badge count
                    updateNotificationBadge();
                    
                    // Navigate to the URL after a short delay
                    const url = item.getAttribute('href');
                    if (url && url !== '#') {
                        setTimeout(() => {
                            window.location.href = url;
                        }, 200);
                    }
                }
            }).catch(error => console.error('Error:', error));
        }
        
        function markAllAsRead(event) {
            event.preventDefault();
            
            fetch('/notifications/mark-all-read', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            }).then(response => {
                if (response.ok) {
                    // Remove all unread classes
                    document.querySelectorAll('.notification-item.unread').forEach(item => {
                        item.classList.remove('unread');
                    });
                    
                    // Hide mark all read button
                    event.target.style.display = 'none';
                    
                    // Update badge
                    updateNotificationBadge();
                }
            }).catch(error => console.error('Error:', error));
        }
        
        function updateNotificationBadge() {
            fetch('/notifications/unread-count')
                .then(response => response.json())
                .then(data => {
                    const badge = document.querySelector('.notification-badge');
                    if (data.count > 0) {
                        if (badge) {
                            badge.textContent = data.count > 99 ? '99+' : data.count;
                        } else {
                            // Create badge if it doesn't exist
                            const bell = document.getElementById('notificationBell');
                            const newBadge = document.createElement('span');
                            newBadge.className = 'notification-badge';
                            newBadge.textContent = data.count > 99 ? '99+' : data.count;
                            bell.appendChild(newBadge);
                        }
                    } else {
                        if (badge) {
                            badge.remove();
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>
</body>
</html>