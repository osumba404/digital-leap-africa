<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $siteSettings['site_name'] ?? config('app.name', 'Digital Leap Africa') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        /* ========== Color palette variables ========== */
        :root {
            --primary-blue: #2E78C5; 	    /* main brand */
            --deep-blue: 	#1E4C7C; 	    /* secondary */
            --navy-bg: 	    #0C121C; 	    /* hero / background */
            --diamond-white:#F5F7FA; 	    /* light text / cards */
            --cool-gray: 	#AEB8C2; 	    /* neutral text */
            --charcoal: 	#252A32; 	    /* dark surfaces */
            --cyan-accent: #00C9FF; 	    /* bright accent */
            --purple-accent:#7A5FFF; 	    /* optional accent */
            --radius: 12px;
            --max-width: 1100px;
            --header-height: 4rem; /* Defines fixed height for the header */
        }

        /* ========== Base ========== */
        * { box-sizing: border-box; }
        html, body { height: 100%; }
        body {
            margin: 0;
            font-family: "Inter", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
            background: linear-gradient(180deg, #07101a 0%, var(--navy-bg) 100%);
            color: var(--diamond-white);
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            line-height: 1.6;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            /* FIX: Add padding to the body equal to the header height to prevent content overlap */
            padding-top: var(--header-height);
        }

        .container {
            width: 90%;
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 2rem 0;
        }

        /* ========== Navigation (Fixed) ========== */
        .site-header {
            padding: 1rem 0;
            background: rgba(12, 18, 28, 0.9);
            /* FIX: Change position from sticky to fixed */
            position: fixed; 
            top: 0;
            width: 100%; /* Ensure it covers the full width */
            z-index: 30;
            backdrop-filter: blur(6px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            height: var(--header-height); 
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
            max-width: var(--max-width);
            margin: 0 auto;
            width: 90%;
            padding: 0 1rem;
        }
        
        .menu-toggle-btn {
            display: none; /* Hidden by default on desktop */
            background: transparent;
            border: none;
            color: var(--diamond-white);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.25rem 0.5rem;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: var(--diamond-white);
        }

        .brand img {
            width: 40px;
            height: 40px;
            object-fit: contain;
            border-radius: 8px;
            background: linear-gradient(135deg, var(--primary-blue), var(--deep-blue));
            padding: 6px;
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

        /* Group for Links and Actions (Desktop) */
        .nav-main-group {
            display: flex;
            align-items: center;
            gap: 2rem;
            flex-grow: 1; 
            justify-content: flex-end; 
        }

        .nav-links {
            display: flex;
            gap: 1.5rem;
            margin: 0;
            padding: 0;
            list-style: none;
            align-items: center;
            margin-right: auto; /* Pushes the actions group to the far right */
        }

        .nav-links a {
            color: var(--diamond-white);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            opacity: 0.9;
            transition: opacity 0.2s, color 0.2s, border-bottom 0.2s;
        }

        .nav-links a:hover {
            opacity: 1;
            color: var(--cyan-accent);
        }
        
        .nav-links a.active {
            opacity: 1;
            color: var(--cyan-accent);
            border-bottom: 2px solid var(--cyan-accent);
            padding-bottom: 0.25rem;
        }

        .nav-actions-group {
            display: flex;
            align-items: center;
            gap: 0.75rem; /* Space between buttons/avatar */
        }
        
        /* User Profile Chip (Authenticated State) */
        .user-profile-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.35rem 0.75rem;
            border-radius: 999px; /* Pill shape */
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--diamond-white);
            font-weight: 500;
            text-decoration: none;
            transition: background 0.2s;
        }

        .user-profile-btn:hover {
            background: rgba(255, 255, 255, 0.15);
        }

        .user-avatar-initial {
            width: 28px;
            height: 28px;
            background: var(--primary-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-weight: 700;
            color: var(--diamond-white);
            flex-shrink: 0;
        }

        /* Buttons (Keep original primary/outline styles) */
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
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.3);
            color: #07101a;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--diamond-white);
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
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
            color: var(--diamond-white);
        }
        
        .logout-btn {
            padding: 0.5rem; /* Make the logout icon button square on desktop */
            border-radius: 50%;
        }
        
        .logout-btn i {
            margin: 0;
        }
        
        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.85rem;
        }

        /* ========== Main Content & Others (Keep original styles) ========== */
        main {
            flex: 1;
            padding: 2rem 0;
        }

        /* ========== Cards ========== */
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

        /* ========== Forms ========== */
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

        /* ========== Tables ========== */
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

        /* ========== Buttons ========== */
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

        .btn-sm {
            padding: 0.35rem 0.75rem;
            font-size: 0.85rem;
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

        /* ========== Admin Specific ========== */
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
        
        /* ========================================= */
        /* === OFF-CANVAS MOBILE SIDEBAR STYLES === */
        /* ========================================= */

        /* Sidebar Base Styling */
        .off-canvas-sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 300px; /* Adjust as needed */
            max-width: 90vw;
            height: 100%;
            background: var(--navy-bg); /* Use your dark background color */
            box-shadow: -4px 0 15px rgba(0, 0, 0, 0.5);
            z-index: 50; /* Higher than the header */
            overflow-y: auto;
            
            /* Initially hide the sidebar off-screen */
            transform: translateX(100%); 
            transition: transform 0.3s ease-out;
        }

        /* State when the sidebar is open */
        .off-canvas-sidebar.is-open {
            transform: translateX(0);
        }

        /* Sidebar Overlay (for dimming the background) */
        .sidebar-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            z-index: 40; /* Below the sidebar, above the header */
            display: none;
        }

        .sidebar-overlay.is-open {
            display: block;
        }
        
        /* Sidebar Header and Close Button */
        .sidebar-header {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .close-btn {
            background: none;
            border: none;
            color: var(--diamond-white);
            font-size: 2.5rem;
            cursor: pointer;
            line-height: 1;
            padding: 0;
            opacity: 0.8;
            transition: opacity 0.2s;
        }
        
        .close-btn:hover {
            opacity: 1;
        }

        /* Sidebar Content and Links (Styled for Off-Canvas) */
        .sidebar-content {
            padding: 1.5rem;
        }

        .off-canvas-sidebar .nav-links {
            flex-direction: column;
            align-items: flex-start;
            width: 100%;
            gap: 1rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            list-style: none; /* Override default list style */
        }
        
        .off-canvas-sidebar .nav-links a {
            display: block;
            padding: 0.5rem 0;
            font-size: 1.1rem;
            font-weight: 500;
        }

        /* Sidebar Categories Styling */
        .sidebar-categories {
            margin-top: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-categories h2 {
            font-size: 1rem;
            color: var(--cool-gray);
            margin-bottom: 1rem;
            text-transform: uppercase;
            font-weight: 600;
        }

        .category-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .category-list li a {
            display: block;
            padding: 0.5rem 0;
            color: var(--diamond-white);
            text-decoration: none;
            transition: color 0.2s;
            font-size: 1.1rem;
        }

        .category-list li a:hover {
            color: var(--cyan-accent);
        }

        /* Mobile Auth Actions Styling */
        .off-canvas-sidebar .nav-actions-group {
             flex-direction: column;
             width: 100%;
             gap: 0.75rem;
             margin-top: 1.5rem;
        }
        
        .off-canvas-sidebar .nav-actions-group > * {
            width: 100%;
        }

        /* Ensure .menu-toggle-btn is visible only on mobile */
        @media (max-width: 992px) {
            .menu-toggle-btn {
                display: block;
            }
            /* Hide the desktop nav links on mobile */
            .nav-main-group {
                display: none;
            }
        }
        
        /* Remove original conflicting media query */
        @media (max-width: 768px) {
            /* This block is intentionally left empty */
        }
    </style>

    @stack('styles')
</head>
<body>
    <header class="site-header">
        <nav class="nav">
            <a href="{{ url('/') }}" class="brand">
                {{-- FIX: Use dynamic logo_url setting --}}
                <img 
                    src="{{ $siteSettings['logo_url'] ?? asset('images/logo.png') }}" 
                    alt="{{ $siteSettings['site_name'] ?? config('app.name') }} Logo"
                >
                <div>
                    <h1>{{ $siteSettings['site_name'] ?? config('app.name') }}</h1>
                    <span class="tagline">Digital Leap Africa</span>
                </div>
            </a>

            {{-- Button to open the off-canvas sidebar --}}
            <button class="menu-toggle-btn" aria-label="Toggle navigation" type="button" 
                    onclick="document.querySelector('.off-canvas-sidebar').classList.add('is-open'); document.querySelector('.sidebar-overlay').classList.add('is-open')">
                <i class="fas fa-bars">=</i>
            </button>

            {{-- Desktop Navigation (Only visible on large screens) --}}
            <div class="nav-main-group d-none d-lg-flex"> 
                
                <ul class="nav-links">
                    <li><a href="{{ route('courses.index') }}" class="@if(request()->routeIs('courses.*')) active @endif">Courses</a></li>
                    <li><a href="{{ route('projects.index') }}" class="@if(request()->routeIs('projects.*')) active @endif">Projects</a></li>
                    <li><a href="{{ route('jobs.index') }}" class="@if(request()->routeIs('jobs.*')) active @endif">Jobs</a></li>
                    <li><a href="{{ route('elibrary.index') }}" class="@if(request()->routeIs('elibrary.*')) active @endif">eLibrary</a></li>
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
                                <i class="fas fa-right-from-bracket"></i>
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

    {{-- =================================== --}}
    {{-- == OFF-CANVAS SIDEBAR (Mobile) == --}}
    {{-- =================================== --}}
    <div class="off-canvas-sidebar">
        <div class="sidebar-header">
            <button class="close-btn" 
                    onclick="document.querySelector('.off-canvas-sidebar').classList.remove('is-open'); document.querySelector('.sidebar-overlay').classList.remove('is-open')">
                &times; 
            </button>
        </div>
        
        <div class="sidebar-content">
            {{-- 1. Main Nav Links (Mobile) --}}
            <ul class="nav-links">
                <li><a href="{{ route('courses.index') }}">Courses</a></li>
                <li><a href="{{ route('projects.index') }}">Projects</a></li>
                <li><a href="{{ route('jobs.index') }}">Jobs</a></li>
                <li><a href="{{ route('elibrary.index') }}">eLibrary</a></li>
                <li><a href="{{ route('articles.index') }}">Blog</a></li>
            </ul>

            
            {{-- 3. Auth Actions (Mobile) --}}
            <div class="nav-actions-group">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="btn-outline is-admin">
                            <i class="fas fa-screwdriver-wrench me-1"></i> Admin
                        </a>
                    @endif
                    
                    {{-- User Profile Chip --}}
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

    {{-- Sidebar Overlay (for dimming the background) --}}
    <div class="sidebar-overlay" 
         onclick="document.querySelector('.off-canvas-sidebar').classList.remove('is-open'); this.classList.remove('is-open')">
    </div>

    {{-- =================================== --}}
    {{-- ========= MAIN CONTENT ========== --}}
    {{-- =================================== --}}
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
    
    {{-- =================================== --}}
    {{-- =========== FOOTER ============== --}}
    {{-- =================================== --}}
    <footer class="mt-auto py-4 border-top border-dark">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    {{-- FIX: DISPLAY CUSTOM FOOTER TEXT OR FALLBACK TO DEFAULT COPYRIGHT --}}
                    {!! $siteSettings['footer_text'] ?? ('&copy; ' . date('Y') . ' ' . ($siteSettings['site_name'] ?? config('app.name')) . '. All rights reserved.') !!}
                </div>
                <div class="social-links">
                    <a href="#" class="text-muted me-3"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="text-muted me-3"><i class="bi bi-linkedin"></i></a>
                    <a href="#" class="text-muted"><i class="bi bi-github"></i></a>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')
</body>
</html>