<!DOCTYPE html>
<html lang="en" prefix="og: https://ogp.me/ns#">
<head>
    <!-- Essential Meta Tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- Primary SEO Meta Tags -->
    <title>@yield('title', 'Digital Leap Africa - Premier Tech Education Platform in Africa | Programming Courses & Career Development')</title>
    <meta name="description" content="@yield('meta_description', 'Transform your tech career with Digital Leap Africa. Expert-led programming courses, web development training, and career opportunities across Kenya, Nigeria, Ghana, and all of Africa. Join 10,000+ successful graduates.')">
    <meta name="keywords" content="@yield('meta_keywords', 'programming courses Africa, web development Kenya, tech education Nigeria, coding bootcamp Ghana, software development training, digital skills Africa, tech careers Kenya, programming jobs Nigeria, web developer course, full stack development Africa')">
    <meta name="author" content="Digital Leap Africa">
    <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
    <meta name="googlebot" content="index, follow">
    <meta name="bingbot" content="index, follow">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="@yield('canonical', url()->current())">
    
    <!-- Geo Targeting -->
    <meta name="geo.region" content="KE">
    <meta name="geo.country" content="Kenya">
    <meta name="geo.placename" content="Nairobi">
    <meta name="ICBM" content="-1.286389, 36.817223">
    
    <!-- Language and Locale -->
    <meta name="language" content="English">
    <meta http-equiv="content-language" content="en-KE">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="@yield('og_type', 'website')">
    <meta property="og:site_name" content="Digital Leap Africa">
    <meta property="og:title" content="@yield('og_title', 'Digital Leap Africa - Premier Tech Education Platform in Africa')">
    <meta property="og:description" content="@yield('og_description', 'Transform your tech career with expert-led programming courses, web development training, and career opportunities across Africa. Join 10,000+ successful graduates.')">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:image" content="@yield('og_image', asset('images/og-default.jpg'))">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="Digital Leap Africa - Empowering African Tech Talent">
    <meta property="og:locale" content="en_KE">
    <meta property="og:locale:alternate" content="en_NG">
    <meta property="og:locale:alternate" content="en_GH">
    <meta property="fb:app_id" content="YOUR_FACEBOOK_APP_ID">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@DigitalLeapAfrica">
    <meta name="twitter:creator" content="@DigitalLeapAfrica">
    <meta name="twitter:title" content="@yield('twitter_title', 'Digital Leap Africa - Premier Tech Education Platform in Africa')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Transform your tech career with expert-led programming courses and career opportunities across Africa.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/twitter-card.jpg'))">
    <meta name="twitter:image:alt" content="Digital Leap Africa - Empowering African Tech Talent">
    
    <!-- Additional Social Meta -->
    <meta property="article:publisher" content="https://www.facebook.com/DigitalLeapAfrica">
    <meta name="twitter:domain" content="digitalleap.africa">
    
    <!-- Favicon and Icons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon-16x16.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon-32x32.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    
    <!-- Theme and App Meta -->
    <meta name="theme-color" content="#0a192f">
    <meta name="msapplication-TileColor" content="#0a192f">
    <meta name="msapplication-config" content="{{ asset('browserconfig.xml') }}">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="apple-mobile-web-app-title" content="Digital Leap Africa">
    
    <!-- Preconnect for Performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="dns-prefetch" href="//www.google-analytics.com">
    <link rel="dns-prefetch" href="//www.googletagmanager.com">
    
    <!-- Structured Data - Organization -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "EducationalOrganization",
        "name": "Digital Leap Africa",
        "alternateName": "DLA",
        "url": "https://digitalleap.africa",
        "logo": {
            "@type": "ImageObject",
            "url": "https://digitalleap.africa/images/logo.png",
            "width": 300,
            "height": 100
        },
        "description": "Premier technology education platform empowering African youth with programming skills, web development training, and career opportunities across Kenya, Nigeria, Ghana, and all of Africa.",
        "foundingDate": "2023",
        "address": {
            "@type": "PostalAddress",
            "addressCountry": "Kenya",
            "addressRegion": "Nairobi",
            "addressLocality": "Nairobi"
        },
        "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+254-700-000-000",
            "contactType": "customer service",
            "email": "info@digitalleap.africa",
            "availableLanguage": ["English", "Swahili"]
        },
        "sameAs": [
            "https://www.facebook.com/DigitalLeapAfrica",
            "https://twitter.com/DigitalLeapAfrica",
            "https://www.linkedin.com/company/digital-leap-africa",
            "https://www.youtube.com/c/DigitalLeapAfrica",
            "https://www.instagram.com/digitalleapafrica"
        ],
        "hasOfferCatalog": {
            "@type": "OfferCatalog",
            "name": "Programming Courses",
            "itemListElement": [
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Course",
                        "name": "Full Stack Web Development",
                        "description": "Comprehensive web development training covering HTML, CSS, JavaScript, React, Node.js, and database management",
                        "provider": {
                            "@type": "Organization",
                            "name": "Digital Leap Africa"
                        }
                    }
                },
                {
                    "@type": "Offer",
                    "itemOffered": {
                        "@type": "Course",
                        "name": "Python Programming",
                        "description": "Complete Python programming course from basics to advanced topics including data science and web development",
                        "provider": {
                            "@type": "Organization",
                            "name": "Digital Leap Africa"
                        }
                    }
                }
            ]
        },
        "areaServed": [
            {
                "@type": "Country",
                "name": "Kenya"
            },
            {
                "@type": "Country", 
                "name": "Nigeria"
            },
            {
                "@type": "Country",
                "name": "Ghana"
            },
            {
                "@type": "Continent",
                "name": "Africa"
            }
        ]
    }
    </script>
    
    <!-- Structured Data - Website -->
    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "Digital Leap Africa",
        "url": "https://digitalleap.africa",
        "description": "Premier tech education platform in Africa offering programming courses, career development, and job opportunities",
        "publisher": {
            "@type": "Organization",
            "name": "Digital Leap Africa"
        },
        "potentialAction": {
            "@type": "SearchAction",
            "target": {
                "@type": "EntryPoint",
                "urlTemplate": "https://digitalleap.africa/search?q={search_term_string}"
            },
            "query-input": "required name=search_term_string"
        },
        "mainEntity": {
            "@type": "ItemList",
            "itemListElement": [
                {
                    "@type": "SiteNavigationElement",
                    "position": 1,
                    "name": "Courses",
                    "url": "https://digitalleap.africa/courses"
                },
                {
                    "@type": "SiteNavigationElement", 
                    "position": 2,
                    "name": "Projects",
                    "url": "https://digitalleap.africa/projects"
                },
                {
                    "@type": "SiteNavigationElement",
                    "position": 3,
                    "name": "Jobs",
                    "url": "https://digitalleap.africa/jobs"
                },
                {
                    "@type": "SiteNavigationElement",
                    "position": 4,
                    "name": "Events",
                    "url": "https://digitalleap.africa/events"
                }
            ]
        }
    }
    </script>
    
    @stack('structured-data')
    
    <!-- Google Analytics 4 -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'GA_MEASUREMENT_ID', {
            page_title: document.title,
            page_location: window.location.href,
            custom_map: {
                'custom_parameter_1': 'course_category',
                'custom_parameter_2': 'user_type'
            }
        });
    </script>
    
    <!-- Microsoft Clarity -->
    <script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "CLARITY_PROJECT_ID");
    </script>
    
    @stack('head')
</head>