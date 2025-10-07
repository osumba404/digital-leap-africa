<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $siteSettings['meta_title'] ?? $siteSettings['site_name'] ?? config('app.name', 'Digital Leap Africa') }}</title>
    
    @if(!empty($siteSettings['meta_description']))
    <meta name="description" content="{{ $siteSettings['meta_description'] }}">
    @endif
    
    @if(!empty($siteSettings['keywords']))
    <meta name="keywords" content="{{ $siteSettings['keywords'] }}">
    @endif
    
    @if(!empty($siteSettings['opengraph_image']))
    <meta property="og:image" content="{{ $siteSettings['opengraph_image'] }}">
    @endif
    
    @if(!empty($siteSettings['favicon']))
    <link rel="icon" type="image/x-icon" href="{{ $siteSettings['favicon'] }}">
    @endif
    
    @if(!empty($siteSettings['google_analytics_id']))
    <!-- Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $siteSettings['google_analytics_id'] }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $siteSettings['google_analytics_id'] }}');
    </script>
    @endif

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

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
            background: #1a237e;
            position: fixed; 
            top: 0;
            width: 100%;
            z-index: 1000;
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            height: var(--header-height);
            animation: slideDown 0.8s ease-out;
            transition: all 0.3s ease;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
        
        .site-header.scrolled {
            background: #0d47a1;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
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
        
        .menu-toggle-btn {
            display: none;
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
        }
        
        .brand:hover {
            transform: scale(1.05);
            color: #ffffff;
        }

        .brand img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary-blue), var(--deep-blue));
            padding: 6px;
            transition: all 0.3s ease;
            animation: bounce 2s infinite;
        }
        
        .brand:hover img {
            animation: glow 1s ease-in-out infinite;
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
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
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
        }

        .btn-primary {
            background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
            color: #07101a;
            padding: 0.5rem 1rem;
            border-radius: 999px;
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

        main {
            flex: 1;
            padding: 2rem 0;
        }

        .card {
            background: rgba(255, 255, 255, 0.02);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: var(--radius);
            padding: 1.5rem;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
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
            transition: border-color 0.2s;
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
            border-radius: 8px;
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
            width: 320px;
            max-width: 85vw;
            height: 100%;
            background: #1a237e;
            box-shadow: -4px 0 20px rgba(0, 0, 0, 0.7);
            z-index: 1002;
            overflow-y: auto;
            transform: translateX(100%); 
            transition: transform 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            backdrop-filter: blur(10px);
            border-left: 2px solid rgba(255, 255, 255, 0.2);
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
            gap: 0.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            list-style: none;
            margin: 0;
            padding-left: 0;
        }
        
        .off-canvas-sidebar .nav-links a {
            display: block;
            padding: 1rem 1.5rem;
            font-size: 1.1rem;
            font-weight: 500;
            transition: all 0.3s ease;
            border-radius: 8px;
            margin: 0.25rem 0;
            color: #ffffff;
            width: 100%;
            position: relative;
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

        @media (max-width: 1200px) {
            .nav-links {
                gap: 1rem;
            }
            .nav-links a {
                font-size: 0.9rem;
            }
        }
        
        @media (max-width: 992px) {
            .menu-toggle-btn {
                display: flex !important;
            }
            .nav-main-group {
                display: none !important;
            }
        }
        
        @media (min-width: 993px) {
            .menu-toggle-btn {
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
        
        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            animation: fadeInUp 1s ease-out;
        }
        
        .footer-text {
            color: var(--cool-gray);
            font-size: 0.9rem;
            animation: fadeInLeft 0.8s ease-out 0.2s both;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
            animation: fadeInRight 0.8s ease-out 0.4s both;
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
            
            .footer-content {
                flex-direction: column;
                gap: 1rem;
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
            .stats-grid,
            .dashboard-grid,
            .quick-actions {
                grid-template-columns: 1fr !important;
                gap: 1rem !important;
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
    </style>

    @stack('styles')
</head>
<body>
    <header class="site-header">
        <nav class="nav">
            <a href="{{ url('/') }}" class="brand">
                <img 
                    src="{{ $siteSettings['logo_url'] ?? asset('images/logo.png') }}" 
                    alt="{{ $siteSettings['site_name'] ?? config('app.name') }} Logo"
                >
                <div>
                    <h1>{{ $siteSettings['site_name'] ?? config('app.name') }}</h1>
                    <span class="tagline">{{ $siteSettings['tagline'] ?? 'Digital Leap Africa' }}</span>
                </div>
            </a>

            <button class="menu-toggle-btn" aria-label="Toggle navigation" type="button" 
                    onclick="document.querySelector('.off-canvas-sidebar').classList.add('is-open'); document.querySelector('.sidebar-overlay').classList.add('is-open')">
                <i class="fas fa-bars"></i>
            </button>

            <div class="nav-main-group"> 
                <ul class="nav-links">
                    @auth
                        <li><a href="{{ route('dashboard') }}" class="@if(request()->routeIs('dashboard')) active @endif">Dashboard</a></li>
                    @endauth
                    <li><a href="{{ route('courses.index') }}" class="@if(request()->routeIs('courses.*')) active @endif">Courses</a></li>
                    <li><a href="{{ route('projects.index') }}" class="@if(request()->routeIs('projects.*')) active @endif">Projects</a></li>
                    <li><a href="{{ route('elibrary.index') }}" class="@if(request()->routeIs('elibrary.*')) active @endif">eLibrary</a></li>
                    <li><a href="{{ route('jobs.index') }}" class="@if(request()->routeIs('jobs.*')) active @endif">Jobs</a></li>
                    <li><a href="{{ route('forum.index') }}" class="@if(request()->routeIs('forum.*')) active @endif">Forum</a></li>
                    <li><a href="{{ route('articles.index') }}" class="@if(request()->routeIs('articles.*')) active @endif">Blog</a></li>
                </ul>

                <div class="nav-actions-group">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="btn-outline btn-sm is-admin">
                                <i class="fas fa-screwdriver-wrench me-1"></i> Admin
                            </a>
                        @endif
                        
                        <a href="{{ route('profile.edit') }}" class="user-profile-btn">
                            <span class="user-avatar-initial">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                            <span>{{ Auth::user()->name }}</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline logout-btn" title="Log Out">
                                <i class="fas fa-right-from-bracket me-1"></i>Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-outline">Log in</a>
                        <a href="{{ route('register') }}" class="btn-primary">Sign up</a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    <div class="off-canvas-sidebar">
        <div class="sidebar-header">
            <h3 class="sidebar-title">Menu</h3>
            <button class="close-btn" 
                    onclick="document.querySelector('.off-canvas-sidebar').classList.remove('is-open'); document.querySelector('.sidebar-overlay').classList.remove('is-open')">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div class="sidebar-content">
            <ul class="nav-links">
                @auth
                    <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                @endauth
                <li><a href="{{ route('courses.index') }}">Courses</a></li>
                <li><a href="{{ route('projects.index') }}">Projects</a></li>
                <li><a href="{{ route('elibrary.index') }}">eLibrary</a></li>
                <li><a href="{{ route('articles.index') }}">Blog</a></li>
                
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn-outline is-admin">
                            <i class="fas fa-screwdriver-wrench me-1"></i> Admin
                        </a>
                    @endif
                    
                    <a href="{{ route('profile.edit') }}" class="user-profile-btn">
                        <span class="user-avatar-initial">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
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
                    <a href="{{ route('login') }}" class="btn-outline">Log in</a>
                    <a href="{{ route('register') }}" class="btn-primary">Sign up</a>
                @endauth
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
            <div class="footer-content">
                <div class="footer-text">
                    {!! $siteSettings['footer_text'] ?? ('&copy; ' . date('Y') . ' ' . ($siteSettings['site_name'] ?? config('app.name')) . '. All rights reserved.') !!}
                </div>
                <div class="social-links">
                    @if(!empty($siteSettings['twitter_url']))
                        <a href="{{ $siteSettings['twitter_url'] }}" class="social-link" title="Twitter/X" target="_blank"><i class="fab fa-twitter"></i></a>
                    @endif
                    @if(!empty($siteSettings['linkedin_url']))
                        <a href="{{ $siteSettings['linkedin_url'] }}" class="social-link" title="LinkedIn" target="_blank"><i class="fab fa-linkedin"></i></a>
                    @endif
                    @if(!empty($siteSettings['facebook_url']))
                        <a href="{{ $siteSettings['facebook_url'] }}" class="social-link" title="Facebook" target="_blank"><i class="fab fa-facebook"></i></a>
                    @endif
                    @if(!empty($siteSettings['instagram_url']))
                        <a href="{{ $siteSettings['instagram_url'] }}" class="social-link" title="Instagram" target="_blank"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if(!empty($siteSettings['youtube_url']))
                        <a href="{{ $siteSettings['youtube_url'] }}" class="social-link" title="YouTube" target="_blank"><i class="fab fa-youtube"></i></a>
                    @endif
                    @if(!empty($siteSettings['tiktok_url']))
                        <a href="{{ $siteSettings['tiktok_url'] }}" class="social-link" title="TikTok" target="_blank"><i class="fab fa-tiktok"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
    
    <script>
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
    </script>
</body>
</html>