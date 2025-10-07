<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $siteSettings['site_name'] ?? config('app.name', 'Digital Leap Africa') }}</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Styles -->
    <style>
        /* ========== Color palette variables ========== */
        :root {
            --primary-blue: #2E78C5;      /* main brand */
            --deep-blue:   #1E4C7C;      /* secondary */
            --navy-bg:     #0C121C;      /* hero / background */
            --diamond-white:#F5F7FA;     /* light text / cards */
            --cool-gray:   #AEB8C2;      /* neutral text */
            --charcoal:    #252A32;      /* dark surfaces */
            --cyan-accent: #00C9FF;      /* bright accent */
            --purple-accent:#7A5FFF;     /* optional accent */
            --radius: 12px;
            --max-width: 1100px;
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
        }

        .container {
            width: 90%;
            max-width: var(--max-width);
            margin: 0 auto;
            padding: 2rem 0;
        }

        /* ========== Navigation ========== */
        .site-header {
            padding: 1rem 0;
            background: rgba(12, 18, 28, 0.9);
            position: sticky;
            top: 0;
            z-index: 30;
            backdrop-filter: blur(6px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1rem;
            max-width: var(--max-width);
            margin: 0 auto;
            width: 90%;
            padding: 0 1rem;
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

        .nav-links {
            display: flex;
            gap: 1.5rem;
            margin: 0;
            padding: 0;
            list-style: none;
            align-items: center;
        }

        .nav-links a {
            color: var(--diamond-white);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.95rem;
            opacity: 0.9;
            transition: opacity 0.2s;
        }

        .nav-links a:hover {
            opacity: 1;
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
            display: inline-block;
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
            display: inline-block;
        }

        .btn-outline:hover {
            background: rgba(255, 255, 255, 0.05);
            border-color: rgba(255, 255, 255, 0.2);
            color: var(--diamond-white);
        }

        /* ========== Main Content ========== */
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

        /* ========== Responsive ========== */
        @media (max-width: 768px) {
            .nav {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
                padding: 1rem;
            }

            .nav-links {
                width: 100%;
                flex-direction: column;
                gap: 0.5rem;
                align-items: flex-start;
            }

            .nav-actions {
                width: 100%;
                display: flex;
                gap: 0.75rem;
                margin-top: 0.5rem;
            }

            .btn, .btn-outline {
                flex: 1;
                text-align: center;
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <header class="site-header">
        <nav class="nav">
            <a href="{{ url('/') }}" class="brand">
                <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }} Logo">
                <div>
                    <h1>{{ $siteSettings['site_name'] ?? config('app.name') }}</h1>
                    <span class="tagline">Code to the future</span>
                </div>
            </a>

            <ul class="nav-links">
                <li><a href="{{ route('courses.index') }}">Courses</a></li>
                <li><a href="{{ route('projects.index') }}">Projects</a></li>
                <li><a href="{{ route('jobs.index') }}">Jobs</a></li>
                <li><a href="{{ route('elibrary.index') }}">eLibrary</a></li>
                <li><a href="{{ route('admin.articles.index') }}">Blog</a></li>
                
                @auth
                    @if(auth()->user()->role === 'admin')
                        <li><a href="{{ route('admin.dashboard') }}" class="text-cyan-accent">Admin</a></li>
                    @endif
                    <li class="nav-actions">
                        <a href="{{ route('profile.edit') }}" class="btn-outline">Profile</a>
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-actions">
                        <a href="{{ route('login') }}" class="btn-outline">Log in</a>
                        <a href="{{ route('register') }}" class="btn-primary">Sign up</a>
                    </li>
                @endauth
            </ul>
        </nav>
    </header>

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

    <footer class="mt-auto py-4 border-top border-dark">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted">
                    &copy; {{ date('Y') }} {{ $siteSettings['site_name'] ?? config('app.name') }}. All rights reserved.
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