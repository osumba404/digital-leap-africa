@extends('layouts.app')

@section('styles')
<style>
    /* ========== Admin Layout ========== */
    .admin-container {
        display: flex;
        min-height: calc(100vh - 80px);
    }

    /* Sidebar */
    .admin-sidebar {
        width: 260px;
        background: rgba(12, 18, 28, 0.9);
        backdrop-filter: blur(6px);
        border-right: 1px solid rgba(255, 255, 255, 0.05);
        padding: 1.5rem 0;
        position: sticky;
        top: 80px;
        height: calc(100vh - 80px);
        overflow-y: auto;
    }

    .admin-sidebar-header {
        padding: 0 1.5rem 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        margin-bottom: 1rem;
    }

    .admin-sidebar-header h2 {
        font-size: 1.1rem;
        font-weight: 600;
        margin: 0;
        color: var(--diamond-white);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .admin-sidebar-header h2 i {
        color: var(--cyan-accent);
    }

    .admin-nav {
        padding: 0 1rem;
    }

    .nav-section {
        margin-bottom: 1.5rem;
    }

    .nav-section h3 {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--cool-gray);
        margin: 0 0 0.75rem 0.5rem;
        font-weight: 600;
    }

    .nav-link {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.6rem 1rem;
        color: var(--diamond-white);
        text-decoration: none;
        border-radius: 8px;
        margin-bottom: 0.25rem;
        transition: all 0.2s;
        font-size: 0.9rem;
    }

    .nav-link i {
        width: 20px;
        text-align: center;
        opacity: 0.8;
    }

    .nav-link:hover, .nav-link.active {
        background: rgba(255, 255, 255, 0.05);
        color: var(--cyan-accent);
    }

    .nav-link.active {
        font-weight: 500;
        border-left: 3px solid var(--cyan-accent);
        padding-left: calc(1rem - 3px);
    }

    .nav-link.active i {
        opacity: 1;
    }

    /* Main Content */
    .admin-main {
        flex: 1;
        padding: 2rem;
        background: linear-gradient(180deg, #0a111a 0%, #0c121c 100%);
    }

    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .admin-header h1 {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
        color: var(--diamond-white);
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .admin-header-actions {
        display: flex;
        gap: 1rem;
    }

    /* Cards */
    .admin-card {
        background: rgba(255, 255, 255, 0.02);
        border: 1px solid rgba(255, 255, 255, 0.05);
        border-radius: var(--radius);
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }

    .admin-card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .admin-card-header h2 {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
        color: var(--diamond-white);
    }

    /* Tables */
    .admin-table {
        width: 100%;
        border-collapse: collapse;
    }

    .admin-table th {
        text-align: left;
        padding: 0.75rem 1rem;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: var(--cool-gray);
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .admin-table td {
        padding: 1rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.03);
        vertical-align: middle;
        color: var(--diamond-white);
        font-size: 0.95rem;
    }

    .admin-table tr:last-child td {
        border-bottom: none;
    }

    .admin-table tr:hover td {
        background: rgba(255, 255, 255, 0.02);
    }

    /* Forms */
    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.05);
    }

    /* Responsive */
    @media (max-width: 992px) {
        .admin-sidebar {
            width: 220px;
        }
        
        .admin-main {
            padding: 1.5rem;
        }
    }

    @media (max-width: 768px) {
        .admin-container {
            flex-direction: column;
        }
        
        .admin-sidebar {
            width: 100%;
            height: auto;
            position: static;
            border-right: none;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            padding: 1rem 0;
        }
        
        .admin-sidebar-header {
            padding: 0 1rem 1rem;
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
        
        .nav-section h3 {
            display: none;
        }
        
        .admin-main {
            padding: 1.25rem;
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
@append

@section('content')
<div class="admin-container">
    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="admin-sidebar-header">
            <h2><i class="fas fa-shield-alt"></i> Admin Panel</h2>
        </div>
        
        <nav class="admin-nav">
            <div class="nav-section">
                <h3>Main</h3>
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Dashboard</span>
                </a>
                <a href="{{ route('admin.settings') }}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
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
                <a href="{{ route('admin.lessons.index') }}" class="nav-link {{ request()->routeIs('admin.lessons.*') ? 'active' : '' }}">
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
                <a href="{{ route('admin.elibrary.index') }}" class="nav-link {{ request()->routeIs('admin.elibrary.*') ? 'active' : '' }}">
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
