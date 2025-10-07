@extends('layouts.app')

@push('styles')
<style>
.admin-layout {
    background: linear-gradient(135deg, var(--navy-bg) 0%, var(--charcoal) 100%);
    min-height: calc(100vh - var(--header-height));
    padding: 2rem 0;
}

.admin-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
}

.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
}

.admin-header {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 2rem;
    margin-bottom: 2rem;
    text-align: center;
}

.admin-title {
    font-size: 2.5rem;
    font-weight: 700;
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}

.admin-subtitle {
    color: var(--cool-gray);
    font-size: 1.1rem;
}

.admin-nav {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 3rem;
}

.admin-nav-item {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.05);
    border-radius: var(--radius);
    padding: 1.5rem;
    text-align: center;
    text-decoration: none;
    color: var(--diamond-white);
    transition: all 0.3s;
    position: relative;
    overflow: hidden;
}

.admin-nav-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 201, 255, 0.1), transparent);
    transition: left 0.5s;
}

.admin-nav-item:hover::before {
    left: 100%;
}

.admin-nav-item:hover {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(0, 201, 255, 0.3);
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
}

.admin-nav-icon {
    font-size: 2rem;
    color: var(--cyan-accent);
    margin-bottom: 1rem;
    display: block;
}

.admin-nav-title {
    font-weight: 600;
    margin-bottom: 0.5rem;
}

.admin-nav-desc {
    font-size: 0.9rem;
    color: var(--cool-gray);
    margin: 0;
}

.admin-content {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.05);
    border-radius: var(--radius);
    padding: 2rem;
}

.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.page-title {
    font-size: 1.75rem;
    font-weight: 600;
    color: var(--diamond-white);
    margin: 0;
}

.page-actions {
    display: flex;
    gap: 1rem;
    align-items: center;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 1rem;
}

.data-table th {
    background: rgba(255, 255, 255, 0.03);
    padding: 1rem;
    text-align: left;
    font-weight: 600;
    color: var(--cool-gray);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.data-table td {
    padding: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    color: var(--diamond-white);
}

.data-table tr:hover {
    background: rgba(255, 255, 255, 0.02);
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 500;
}

.status-active {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
}

.status-inactive {
    background: rgba(156, 163, 175, 0.2);
    color: #9ca3af;
}

.status-draft {
    background: rgba(251, 191, 36, 0.2);
    color: #fbbf24;
}

.admin-form {
    max-width: 600px;
}

.form-section {
    margin-bottom: 2rem;
    padding-bottom: 2rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.form-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.form-section-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--diamond-white);
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    .admin-layout {
        padding: 1rem 0;
    }
    
    .admin-container {
        padding: 0 0.5rem;
    }
    
    .admin-header {
        padding: 1.5rem;
    }
    
    .admin-title {
        font-size: 2rem;
    }
    
    .admin-content {
        padding: 1.5rem;
    }
    
    .admin-nav {
        grid-template-columns: 1fr;
        gap: 0.75rem;
    }
    
    .admin-nav-item {
        padding: 1rem;
    }
    
    .admin-nav-icon {
        font-size: 1.5rem;
    }
    
    .page-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .page-title {
        font-size: 1.5rem;
    }
    
    .page-actions {
        width: 100%;
        justify-content: flex-start;
    }
    
    .data-table {
        font-size: 0.85rem;
        display: block;
        overflow-x: auto;
        white-space: nowrap;
    }
    
    .data-table th,
    .data-table td {
        padding: 0.5rem 0.25rem;
        min-width: 80px;
    }
    
    .data-table th:first-child,
    .data-table td:first-child {
        min-width: 120px;
    }
    
    .admin-form {
        max-width: 100%;
    }
    
    .form-section {
        padding-bottom: 1.5rem;
        margin-bottom: 1.5rem;
    }
}

@media (max-width: 480px) {
    .admin-container {
        padding: 0 0.25rem;
    }
    
    .admin-header {
        padding: 1rem;
    }
    
    .admin-title {
        font-size: 1.75rem;
    }
    
    .admin-content {
        padding: 1rem;
    }
    
    .page-title {
        font-size: 1.25rem;
    }
    
    .data-table {
        font-size: 0.8rem;
    }
    
    .data-table th,
    .data-table td {
        padding: 0.4rem 0.2rem;
        min-width: 70px;
    }
    
    .btn-primary,
    .btn-outline {
        padding: 0.5rem 0.75rem;
        font-size: 0.9rem;
    }
    
    .status-badge {
        font-size: 0.7rem;
        padding: 0.2rem 0.5rem;
    }
}
</style>
@endpush

@section('content')
<div class="admin-layout">
    <div class="admin-container">
        @if(!isset($hideAdminHeader))
        <div class="admin-header">
            <h1 class="admin-title">
                <i class="fas fa-shield-alt me-2"></i>Admin Panel
            </h1>
            <p class="admin-subtitle">Manage your Digital Leap Africa platform</p>
        </div>
        @endif

        @hasSection('admin-nav')
            @yield('admin-nav')
        @else
            @if(!isset($hideAdminNav))
            <div class="admin-nav">
                <a href="{{ route('admin.dashboard') }}" class="admin-nav-item">
                    <i class="fas fa-tachometer-alt admin-nav-icon"></i>
                    <div class="admin-nav-title">Dashboard</div>
                    <p class="admin-nav-desc">Overview & Analytics</p>
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
                
                <a href="{{ route('admin.jobs.index') }}" class="admin-nav-item">
                    <i class="fas fa-briefcase admin-nav-icon"></i>
                    <div class="admin-nav-title">Jobs</div>
                    <p class="admin-nav-desc">Career Opportunities</p>
                </a>
                
                <a href="{{ route('admin.articles.index') }}" class="admin-nav-item">
                    <i class="fas fa-newspaper admin-nav-icon"></i>
                    <div class="admin-nav-title">Articles</div>
                    <p class="admin-nav-desc">Blog & News Content</p>
                </a>
                
                <a href="{{ route('admin.elibrary-resources.index') }}" class="admin-nav-item">
                    <i class="fas fa-book-reader admin-nav-icon"></i>
                    <div class="admin-nav-title">eLibrary</div>
                    <p class="admin-nav-desc">Digital Resources</p>
                </a>
                
                <a href="{{ route('admin.events.index') }}" class="admin-nav-item">
                    <i class="fas fa-calendar-alt admin-nav-icon"></i>
                    <div class="admin-nav-title">Events</div>
                    <p class="admin-nav-desc">Community Events</p>
                </a>
                
                <a href="{{ route('admin.settings.index') }}" class="admin-nav-item">
                    <i class="fas fa-cog admin-nav-icon"></i>
                    <div class="admin-nav-title">Settings</div>
                    <p class="admin-nav-desc">Site Configuration</p>
                </a>
            </div>
            @endif
        @endif

        <div class="admin-content">
            @yield('admin-content')
        </div>
    </div>
</div>
@endsection