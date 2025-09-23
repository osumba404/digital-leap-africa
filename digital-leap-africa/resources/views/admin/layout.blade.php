@extends('layouts.app')

@push('styles')
<style>
    /* ========== Admin Layout ========== */
    .admin-container {
        display: block;
        min-height: calc(100vh - 80px);
    }

    /* Sidebar */
    .admin-sidebar {
        width: 240px;
        background: rgba(12, 18, 28, 0.9);
        backdrop-filter: blur(6px);
        border-right: 1px solid rgba(255, 255, 255, 0.05);
        padding: 1rem 0.5rem;
        position: fixed;
        top: 80px;
        left: 0;
        height: calc(100vh - 80px);
        overflow-y: auto;
        z-index: 20;
    }

    .admin-sidebar-header {
        padding: 0 0.75rem 0.75rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .admin-sidebar-header h2 {
        font-size: 0.95rem;
        font-weight: 600;
        margin: 0;
        color: var(--diamond-white);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .sidebar-toggle {
        background: none;
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--diamond-white);
        width: 34px;
        height: 28px;
        border-radius: 6px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        opacity: 0.85;
    }

    .sidebar-toggle:hover { opacity: 1; }

    .admin-nav {
        padding: 0 0.5rem;
    }

    .nav-section {
        margin-bottom: 0.75rem;
    }

    .nav-section h3 {
        font-size: 0.65rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--cool-gray);
        margin: 0 0 0.5rem 0.5rem;
        font-weight: 600;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.45rem 0.65rem;
        color: var(--diamond-white);
        text-decoration: none;
        border-radius: 8px;
        margin-bottom: 0.2rem;
        transition: all 0.2s;
        font-size: 0.9rem;
    }

    .nav-link i {
        width: 18px;
        text-align: center;
        opacity: 0.8;
    }

    .nav-link:hover, .nav-link.active {
        background: rgba(255, 255, 255, 0.05);
        color: var(--cyan-accent);
    }

    .nav-link.active {
        font-weight: 500;
        border-left: 2px solid var(--cyan-accent);
        padding-left: calc(0.65rem - 2px);
    }

    .nav-link.active i {
        opacity: 1;
    }

    /* Main Content */
    .admin-main {
        margin-left: 240px;
        padding: 1.25rem 1.5rem;
        background: linear-gradient(180deg, #0a111a 0%, #0c121c 100%);
        min-height: calc(100vh - 80px);
    }

    /* Collapsed sidebar state */
    body.sidebar-collapsed .admin-sidebar { width: 72px; }
    body.sidebar-collapsed .admin-main { margin-left: 72px; }
    body.sidebar-collapsed .admin-sidebar-header h2 span.label { display: none; }
    body.sidebar-collapsed .nav-section h3 { display: none; }
    body.sidebar-collapsed .nav-link span { display: none; }
    body.sidebar-collapsed .nav-link { justify-content: center; }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    @media (max-width: 992px) {
        .admin-sidebar {
            width: 200px;
        }
        
        .admin-main {
            padding: 1rem;
        }
    }

    @media (max-width: 768px) {
        .admin-sidebar {
            width: 100%;
            height: auto;
            position: static;
            border-right: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding: 0.75rem 0;
        }
        
        .admin-sidebar-header {
            padding: 0 1rem 0.75rem;
        }
        
        .admin-nav {
            padding: 0 1rem;
            display: flex;
            overflow-x: auto;
            padding-bottom: 0.5rem;
        }
        
        .nav-section {
            min-width: max-content;
            margin-right: 2rem;
            margin-bottom: 0;
        }
        
        .nav-section h3 { display: none; }
        
        .admin-main {
            padding: 1rem;
            margin-left: 0;
        }
        
        .admin-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        
        .admin-header-actions {
            width: 100%;
            justify-content: space-between;
        }
    }

    /* Dark mode scrollbar */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.03);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.15);
    }
</style>
@endpush

@section('content')
<div class="admin-container">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-sidebar-header">
            <h2><i class="fas fa-shield-alt"></i> <span class="label">Admin Panel</span></h2>
            <button class="sidebar-toggle" id="sidebarToggle" title="Toggle sidebar"><i class="fas fa-bars"></i></button>
        </div>
        
        <nav class="admin-nav">
            <div class="nav-section">
                <h3>Main</h3>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="fas fa-cog"></i>
                    <span>Settings</span>
                </a>
            </div>
            
            <div class="nav-section">
                <h3>Content</h3>
                <a href="{{ route('admin.courses.index') }}" class="nav-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
                    <i class="fas fa-graduation-cap"></i>
                    <span>Courses</span>
                </a>
                <a href="{{ route('admin.courses.index') }}" class="nav-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}">
                    <i class="fas fa-book"></i>
                    <span>Lessons</span>
                </a>
                <a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}">
                    <i class="fas fa-project-diagram"></i>
                    <span>Projects</span>
                </a>
                <a href="{{ route('admin.jobs.index') }}" class="nav-link {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}">
                    <i class="fas fa-briefcase"></i>
                    <span>Jobs</span>
                </a>
                <a href="{{ route('admin.articles.index') }}" class="nav-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}">
                    <i class="fas fa-newspaper"></i>
                    <span>Articles</span>
                </a>
                <a href="{{ route('admin.elibrary-resources.index') }}" class="nav-link {{ request()->routeIs('admin.elibrary-resources.*') ? 'active' : '' }}">
                    <i class="fas fa-book-reader"></i>
                    <span>eLibrary</span>
                </a>
                <a href="{{ route('admin.events.index') }}" class="nav-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Events</span>
                </a>
                <a href="{{ route('admin.forum.index') }}" class="nav-link {{ request()->routeIs('admin.forum.*') ? 'active' : '' }}">
                    <i class="fas fa-comments"></i>
                    <span>Forum</span>
                </a>
            </div>
            
            <div class="nav-section">
                <h3>Users</h3>
                <a href="#" class="nav-link">
                    <i class="fas fa-users"></i>
                    <span>Manage Users</span>
                </a>
                <a href="#" class="nav-link">
                    <i class="fas fa-user-shield"></i>
                    <span>Roles & Permissions</span>
                </a>
            </div>
        </nav>
    </aside>
    
    <!-- Main Content -->
    <main class="admin-main">
        <div class="admin-header">
            <h1>@yield('title', 'Dashboard')</h1>
            <div class="admin-header-actions">
                @hasSection('header-actions')
                    @yield('header-actions')
                @endif
            </div>
        </div>
        
        @yield('admin-content')
    </main>
</div>
@overwrite

@push('scripts')
<script>
    (function() {
        const body = document.body;
        const toggle = document.getElementById('sidebarToggle');
        const key = 'adminSidebarCollapsed';
        const apply = (collapsed) => {
            if (collapsed) body.classList.add('sidebar-collapsed');
            else body.classList.remove('sidebar-collapsed');
        };
        // Init from storage
        apply(localStorage.getItem(key) === '1');
        if (toggle) {
            toggle.addEventListener('click', () => {
                const collapsed = !body.classList.contains('sidebar-collapsed');
                apply(collapsed);
                localStorage.setItem(key, collapsed ? '1' : '0');
            });
        }
    })();
</script>
@endpush
