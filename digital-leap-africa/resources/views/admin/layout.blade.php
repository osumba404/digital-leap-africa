@extends('layouts.app')

@push('styles')

<style>
/* ========== CRITICAL: Light Mode Sidebar Text Fixes ========== */
[data-theme="light"] #adminSidebar .sidebar-header,
[data-theme="light"] #adminSidebar .sidebar-header *:not(button):not(i) {
    color: #2e78c5 !important;
}

[data-theme="light"] #adminSidebar .sidebar-header i,
[data-theme="light"] #adminSidebar .toggle-btn i {
    color: #2e78c5 !important;
}

[data-theme="light"] #adminSidebar .sidebar-label {
    color: #1a202c !important;
}

[data-theme="light"] #adminSidebar .sidebar-link {
    color: #1a202c !important;
}

[data-theme="light"] #adminSidebar .sidebar-link.active {
    color: #2e78c5 !important;
}

[data-theme="light"] #adminSidebar .sidebar-link i {
    color: #2e78c5 !important;
}

.admin-layout {
    background: linear-gradient(135deg, var(--navy-bg) 0%, var(--charcoal) 100%);
    min-height: calc(100vh - var(--header-height));
    padding: 0;
}

.admin-container {
    max-width: 1600px;
    margin: 0;
    padding: 0;
}

.admin-shell {
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 0.2rem;
    align-items: start;
    padding-left: -200px;
}

/* Enhanced Sidebar */
.admin-sidebar {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 6px;
    height: fit-content;
    position: sticky;
    top: calc(var(--header-height) + 16px);
    padding: 0.2rem;
    
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    min-height: 400px;
    backdrop-filter: blur(10px);
}

.admin-sidebar.collapsed {
    width: 60px;
}

.admin-sidebar.collapsed .sidebar-header {
    justify-content: center;
    padding: 0.5rem;
}

.admin-sidebar.collapsed .sidebar-header strong {
    display: none;
}

.admin-sidebar.collapsed .sidebar-label {
    opacity: 0;
    width: 0;
    overflow: hidden;
}

.admin-sidebar.collapsed .sidebar-link {
    justify-content: center;
    padding: 0.75rem;
}

.sidebar-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0.75rem 0.5rem 0.75rem 0.75rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    margin-bottom: 0.5rem;
}

.sidebar-header strong {
    color: var(--diamond-white);
    font-size: 0.9rem;
    font-weight: 600;
    white-space: nowrap;
}

.toggle-btn {
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    color: var(--diamond-white);
    border-radius: 8px;
    height: 32px;
    width: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.toggle-btn:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: scale(1.05);
}

.admin-sidebar.collapsed .toggle-btn i {
    transform: rotate(180deg);
}

.sidebar-nav {
    list-style: none;
    padding: 0.25rem 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 0.125rem;
}

.sidebar-link {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    color: var(--diamond-white);
    text-decoration: none;
    border-radius: 8px;
    transition: all 0.2s ease;
    border: 1px solid transparent;
    position: relative;
    overflow: hidden;
}

.sidebar-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(0, 201, 255, 0.1), transparent);
    transition: left 0.5s;
}

.sidebar-link:hover::before {
    left: 100%;
}

.sidebar-link:hover {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(0, 201, 255, 0.2);
    transform: translateX(2px);
}

.sidebar-link.active {
    background: rgba(0, 201, 255, 0.12);
    border-color: rgba(0, 201, 255, 0.35);
    box-shadow: 0 2px 8px rgba(0, 201, 255, 0.2);
}

.sidebar-link i {
    color: var(--cyan-accent);
    width: 20px;
    text-align: center;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.sidebar-label {
    white-space: nowrap;
    font-size: 0.85rem;
    font-weight: 500;
    transition: all 0.3s ease;
}

/* Enhanced Content Area */
.admin-content {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.05);
    border-radius: 6px;
    padding: 0.8rem;
    min-height: 600px;
    backdrop-filter: blur(10px);
}

/* Compact Header */
.admin-header {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    text-align: center;
}

.admin-title {
    font-size: 2rem;
    font-weight: 700;
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.25rem;
}

.admin-subtitle {
    color: var(--cool-gray);
    font-size: 1rem;
}

/* Compact Navigation Grid */
.admin-nav {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 0.75rem;
    margin-bottom: 2rem;
}

.admin-nav-item {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.05);
    border-radius: 10px;
    padding: 1.25rem;
    text-align: center;
    text-decoration: none;
    color: var(--diamond-white);
    transition: all 0.3s ease;
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
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
}

.admin-nav-icon {
    font-size: 1.75rem;
    color: var(--cyan-accent);
    margin-bottom: 0.75rem;
    display: block;
}

.admin-nav-title {
    font-weight: 600;
    margin-bottom: 0.25rem;
    font-size: 0.95rem;
}

.admin-nav-desc {
    font-size: 0.8rem;
    color: var(--cool-gray);
    margin: 0;
    line-height: 1.3;
}

/* Enhanced Tables */
.table-responsive {
    overflow-x: auto;
    -webkit-overflow-scrolling: touch;
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.05);
}

.data-table {
    width: 100%;
    border-collapse: collapse;
    margin: 0;
    font-size: 0.9rem;
}

.data-table th {
    background: rgba(255, 255, 255, 0.03);
    padding: 0.875rem;
    text-align: left;
    font-weight: 600;
    color: var(--cool-gray);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    white-space: nowrap;
}

.data-table td {
    padding: 0.875rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    color: var(--diamond-white);
    vertical-align: middle;
}

.data-table tr:last-child td {
    border-bottom: none;
}

.data-table tr:hover {
    background: rgba(255, 255, 255, 0.02);
}

/* Enhanced Page Header */
.page-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.page-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--diamond-white);
    margin: 0;
}

.page-actions {
    display: flex;
    gap: 0.75rem;
    align-items: center;
    flex-wrap: wrap;
}

/* Status Badges */
.status-badge {
    padding: 0.25rem 0.625rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 500;
    white-space: nowrap;
}

.status-active {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
    border: 1px solid rgba(34, 197, 94, 0.3);
}

.status-inactive {
    background: rgba(156, 163, 175, 0.2);
    color: #9ca3af;
    border: 1px solid rgba(156, 163, 175, 0.3);
}

.status-draft {
    background: rgba(251, 191, 36, 0.2);
    color: #fbbf24;
    border: 1px solid rgba(251, 191, 36, 0.3);
}

/* Enhanced Forms */
.admin-form {
    max-width: 600px;
}

.form-section {
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.form-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
    padding-bottom: 0;
}

.form-section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--diamond-white);
    margin-bottom: 1rem;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .admin-shell {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .admin-sidebar {
        position: static;
        width: 100% !important;
        height: auto;
    }
    
    .admin-sidebar.collapsed .sidebar-label {
        opacity: 1;
        width: auto;
        overflow: visible;
    }
    
    .admin-sidebar.collapsed .sidebar-link {
        justify-content: flex-start;
    }
    
    .sidebar-nav {
        flex-direction: row;
        overflow-x: auto;
        padding: 0.5rem;
        gap: 0.5rem;
    }
    
    .sidebar-link {
        flex-shrink: 0;
        min-width: fit-content;
    }
}

@media (max-width: 768px) {
    .admin-layout {
        padding: 0.5rem 0;
    }
    
    .admin-container {
        padding: 0 0.5rem;
    }
    
    .admin-header {
        padding: 1.25rem;
        margin-bottom: 1rem;
    }
    
    .admin-title {
        font-size: 1.75rem;
    }
    
    .admin-content {
        padding: 1.25rem;
    }
    
    .admin-nav {
        grid-template-columns: 1fr;
        gap: 0.5rem;
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
        margin-bottom: 1.25rem;
    }
    
    .page-title {
        font-size: 1.25rem;
    }
    
    .page-actions {
        width: 100%;
        justify-content: flex-start;
    }
    
    .data-table {
        font-size: 0.8rem;
    }
    
    .data-table th,
    .data-table td {
        padding: 0.75rem 0.5rem;
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
        font-size: 1.5rem;
    }
    
    .admin-content {
        padding: 1rem;
    }
    
    .page-title {
        font-size: 1.1rem;
    }
    
    .data-table {
        font-size: 0.75rem;
    }
    
    .data-table th,
    .data-table td {
        padding: 0.5rem 0.25rem;
    }
}
</style>
@endpush

@section('content')
<div class="admin-layout">
    <div class="admin-container">
        @if(!isset($hideAdminHeader))
        {{-- <div class="admin-header">
            <h1 class="admin-title">
                <i class="fas fa-shield-alt me-2"></i>Admin Panel
            </h1>
            <p class="admin-subtitle">Manage your Digital Leap Africa platform</p>
        </div> --}}
        @endif



        <div class="admin-shell">
            <aside class="admin-sidebar" id="adminSidebar">
                <div class="sidebar-header">
                    <i class="fas fa-shield-alt me-2"></i>Admin Panel
                   
                    <button class="toggle-btn" id="sidebarToggle" title="Toggle menu">
                        <i class="fas fa-angles-left"></i>
                    </button>
                </div>
                <ul class="sidebar-nav">
                    <li>
                        <a class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="fas fa-gauge"></i><span class="sidebar-label">Dashboard</span>
                        </a>
                    </li>
                    <!-- <li>
                        <a class="sidebar-link {{ request()->routeIs('admin.content.*') ? 'active' : '' }}" href="{{ route('admin.content.index') }}">
                            <i class="fas fa-layer-group"></i><span class="sidebar-label">Content</span>
                        </a>
                    </li> -->
                    <li>
                        <a class="sidebar-link {{ request()->routeIs('admin.about.*') ? 'active' : '' }}" href="{{ route('admin.about.index') }}">
                            <i class="fas fa-circle-info"></i><span class="sidebar-label">About</span>
                        </a>
                    </li>
                    <li>
                        <a class="sidebar-link {{ request()->routeIs('admin.articles.*') ? 'active' : '' }}" href="{{ route('admin.articles.index') }}">
                            <i class="fas fa-newspaper"></i><span class="sidebar-label">Articles</span>
                        </a>
                    </li>
                    <li>
                        <a class="sidebar-link {{ request()->routeIs('admin.courses.*') ? 'active' : '' }}" href="{{ route('admin.courses.index') }}">
                            <i class="fas fa-graduation-cap"></i><span class="sidebar-label">Courses</span>
                        </a>
                    </li>
                    <li>
                        <a class="sidebar-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}" href="{{ route('admin.projects.index') }}">
                            <i class="fas fa-diagram-project"></i><span class="sidebar-label">Projects</span>
                        </a>
                    </li>
                    <li>
                        <a class="sidebar-link {{ request()->routeIs('admin.jobs.*') ? 'active' : '' }}" href="{{ route('admin.jobs.index') }}">
                            <i class="fas fa-briefcase"></i><span class="sidebar-label">Jobs</span>
                        </a>
                    </li>
                    <li>
                        <a class="sidebar-link {{ request()->routeIs('admin.events.*') ? 'active' : '' }}" href="{{ route('admin.events.index') }}">
                            <i class="fas fa-calendar-days"></i><span class="sidebar-label">Events</span>
                        </a>
                    </li>
                    <li>
                        <a class="sidebar-link {{ request()->routeIs('admin.forum.*') ? 'active' : '' }}" href="{{ route('admin.forum.index') }}">
                            <i class="fas fa-comments"></i><span class="sidebar-label">Forum</span>
                        </a>
                    </li>
                    <li>
                        <a class="sidebar-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}" href="{{ route('admin.testimonials.index') }}">
                            <i class="fas fa-quote-left"></i><span class="sidebar-label">Testimonials</span>
                        </a>
                    </li>
                    <li>
                        <a class="sidebar-link {{ request()->routeIs('admin.faqs.*') ? 'active' : '' }}" href="{{ route('admin.faqs.index') }}">
                            <i class="fas fa-circle-question"></i><span class="sidebar-label">FAQs</span>
                        </a>
                    </li>
                    <li>
                        <a class="sidebar-link {{ request()->routeIs('admin.elibrary-resources.*') ? 'active' : '' }}" href="{{ route('admin.elibrary-resources.index') }}">
                            <i class="fas fa-book"></i><span class="sidebar-label">eLibrary</span>
                        </a>
                    </li>
                    <li>
                        <a class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}" href="{{ route('admin.settings.index') }}">
                            <i class="fas fa-gear"></i><span class="sidebar-label">Settings</span>
                        </a>
                    </li>
                </ul>
            </aside>

            <div class="admin-content">
                @yield('admin-content')
            </div>
        </div>

    </div>
</div>

<script>
    (function(){
        const toggle = document.getElementById('sidebarToggle');
        const sidebar = document.getElementById('adminSidebar');
        if (toggle && sidebar) {
            toggle.addEventListener('click', function(){
                sidebar.classList.toggle('collapsed');
            });
        }
    })();
</script>

<script>
(function(){
    const toggle = document.getElementById('sidebarToggle');
    const sidebar = document.getElementById('adminSidebar');
    
    // Check for saved state in localStorage
    const savedState = localStorage.getItem('adminSidebarCollapsed');
    
    if (savedState === 'true') {
        sidebar.classList.add('collapsed');
    }
    
    if (toggle && sidebar) {
        toggle.addEventListener('click', function(){
            sidebar.classList.toggle('collapsed');
            
            // Save state to localStorage
            const isCollapsed = sidebar.classList.contains('collapsed');
            localStorage.setItem('adminSidebarCollapsed', isCollapsed);
            
            // Update icon
            const icon = toggle.querySelector('i');
            if (icon) {
                icon.className = isCollapsed ? 'fas fa-angles-right' : 'fas fa-angles-left';
            }
        });
    }
    
    // Enhanced hover effects for sidebar
    const sidebarLinks = document.querySelectorAll('.sidebar-link');
    sidebarLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(4px)';
        });
        
        link.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });
    
    // Auto-collapse sidebar on very small screens
    function handleResize() {
        if (window.innerWidth < 1024) {
            sidebar.classList.remove('collapsed');
        }
    }
    
    window.addEventListener('resize', handleResize);
    handleResize(); // Initial check
})();
</script>

<style>
/* ========== Light Mode Styles ========== */
[data-theme="light"] .admin-layout {
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

[data-theme="light"] .admin-sidebar {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .sidebar-header {
    border-bottom-color: rgba(46, 120, 197, 0.15);
    color: var(--primary-blue);
}

[data-theme="light"] .sidebar-header strong {
    color: var(--primary-blue);
}

[data-theme="light"] .toggle-btn {
    background: rgba(46, 120, 197, 0.1);
    border-color: rgba(46, 120, 197, 0.2);
    color: var(--primary-blue);
}

[data-theme="light"] .toggle-btn:hover {
    background: rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .sidebar-link {
    color: var(--charcoal);
}

[data-theme="light"] .sidebar-link:hover {
    background: rgba(46, 120, 197, 0.08);
    border-color: rgba(46, 120, 197, 0.3);
}

[data-theme="light"] .sidebar-link.active {
    background: rgba(46, 120, 197, 0.15);
    border-color: rgba(46, 120, 197, 0.4);
    box-shadow: 0 2px 8px rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .sidebar-link i {
    color: var(--primary-blue);
}

[data-theme="light"] .admin-content {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.15);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .admin-header {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .admin-nav-item {
    background: rgba(46, 120, 197, 0.05);
    border: 1px solid rgba(46, 120, 197, 0.15);
    color: var(--charcoal);
}

[data-theme="light"] .admin-nav-item:hover {
    background: rgba(46, 120, 197, 0.1);
    border-color: rgba(46, 120, 197, 0.3);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

[data-theme="light"] .admin-nav-icon {
    color: var(--primary-blue);
}

[data-theme="light"] .admin-nav-title {
    color: var(--primary-blue);
}

[data-theme="light"] .admin-nav-desc {
    color: var(--cool-gray);
}

[data-theme="light"] .table-responsive {
    border-color: rgba(46, 120, 197, 0.15);
}

[data-theme="light"] .data-table th {
    background: rgba(46, 120, 197, 0.08);
    color: var(--primary-blue);
    border-bottom-color: rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .data-table td {
    color: var(--charcoal);
    border-bottom-color: rgba(46, 120, 197, 0.1);
}

[data-theme="light"] .data-table tr:hover {
    background: rgba(46, 120, 197, 0.05);
}

[data-theme="light"] .page-header {
    border-bottom-color: rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .page-title {
    color: var(--primary-blue);
}

[data-theme="light"] .form-section {
    border-bottom-color: rgba(46, 120, 197, 0.15);
}

[data-theme="light"] .form-section-title {
    color: var(--primary-blue);
}

/* Fix inline styled text colors in light mode */
[data-theme="light"] h3,
[data-theme="light"] h2,
[data-theme="light"] p {
    color: var(--charcoal) !important;
}

/* Fix sidebar header text in light mode - ALL TEXT */
[data-theme="light"] .sidebar-header,
[data-theme="light"] .sidebar-header *,
[data-theme="light"] .sidebar-header i,
[data-theme="light"] .sidebar-header strong {
    color: var(--primary-blue) !important;
}

/* Fix sidebar label text - ALL MENU ITEMS */
[data-theme="light"] .sidebar-label,
[data-theme="light"] .sidebar-link {
    color: var(--charcoal) !important;
}

[data-theme="light"] .sidebar-link.active {
    color: var(--primary-blue) !important;
}

/* Fix button text colors */
[data-theme="light"] .btn-outline {
    color: var(--primary-blue);
    border-color: var(--primary-blue);
}

[data-theme="light"] .btn-outline:hover {
    background: var(--primary-blue);
    color: #FFFFFF;
}

/* Fix empty state text */
[data-theme="light"] div[style*="color: var(--cool-gray)"] {
    color: var(--cool-gray) !important;
}

/* Fix table font weights */
[data-theme="light"] td div[style*="font-weight: 600"] {
    color: var(--charcoal) !important;
}

/* Fix icon colors in light mode */
[data-theme="light"] .fas,
[data-theme="light"] .far,
[data-theme="light"] .fab {
    color: inherit;
}

[data-theme="light"] td .fas {
    color: var(--primary-blue);
}
</style>

@endsection