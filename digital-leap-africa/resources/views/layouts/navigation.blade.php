<nav class="navbar navbar-expand-lg navbar-dark navbar-glass border-bottom border-dark-subtle">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}" style="padding-left: 1rem;">
      @if(!empty($siteSettings['logo_url']))
        <img
          src="{{ $siteSettings['logo_url'] }}"
          alt="{{ $siteSettings['site_name'] ?? 'Site Logo' }}"
          class="me-2 brand-logo"
          style="height:44px;width:44px;object-fit:cover;border-radius:8px;"
        >
      @endif
      <span class="fw-semibold">{{ $siteSettings['site_name'] ?? config('app.name', 'Laravel') }}</span>
    </a>

    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="mainNavbar">
      <!-- Left Nav -->
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
            {{ __('Home') }}
          </x-nav-link>
        </li>

        <li class="nav-item">
          <x-nav-link :href="route('courses.index')" :active="request()->routeIs('courses.*')">
            {{ __('Courses') }}
          </x-nav-link>
        </li>

        <li class="nav-item">
          <x-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.*')">
            {{ __('Projects') }}
          </x-nav-link>
        </li>

        <!-- Resources: eLibrary + Blog -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="resourcesDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Resources
          </a>
          <ul class="dropdown-menu dropdown-menu-glass" aria-labelledby="resourcesDropdown">
            <li>
              <a class="dropdown-item" href="{{ \Illuminate\Support\Facades\Route::has('elibrary.index') ? route('elibrary.index') : url('/elibrary') }}">
                eLibrary
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ \Illuminate\Support\Facades\Route::has('blog.index') ? route('blog.index') : url('/blog') }}">
                Blog / Articles
              </a>
            </li>
          </ul>
        </li>

        <!-- Community: Events + Forum + Job Board -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="communityDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Community
          </a>
          <ul class="dropdown-menu dropdown-menu-glass" aria-labelledby="communityDropdown">
            <li>
              <a class="dropdown-item" href="{{ \Illuminate\Support\Facades\Route::has('events.index') ? route('events.index') : url('/events') }}">
                Events
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ \Illuminate\Support\Facades\Route::has('forum.index') ? route('forum.index') : url('/forum') }}">
                Forum
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ \Illuminate\Support\Facades\Route::has('jobs.index') ? route('jobs.index') : url('/jobs') }}">
                Job Board
              </a>
            </li>
          </ul>
        </li>

        <!-- Support: Contact + Donate -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="supportDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Support
          </a>
          <ul class="dropdown-menu dropdown-menu-glass" aria-labelledby="supportDropdown">
            <li>
              <a class="dropdown-item" href="{{ \Illuminate\Support\Facades\Route::has('contact') ? route('contact') : url('/contact') }}">
                Contact
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ \Illuminate\Support\Facades\Route::has('donate') ? route('donate') : url('/donate') }}">
                Donate
              </a>
            </li>
          </ul>
        </li>

        @auth
          @if(Auth::user()->role === 'admin')
            {{-- Admin users get a dropdown with both dashboards --}}
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="dashboardDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Dashboard
              </a>
              <ul class="dropdown-menu dropdown-menu-glass" aria-labelledby="dashboardDropdown">
                <li>
                  <a class="dropdown-item" href="{{ route('dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>User Dashboard
                  </a>
                </li>
                <li>
                  <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-shield-alt me-2"></i>Admin Panel
                  </a>
                </li>
              </ul>
            </li>
          @else
            {{-- Normal users get a simple Dashboard link --}}
            <li class="nav-item">
              <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
              </x-nav-link>
            </li>
          @endif
        @endauth
      </ul>

      <!-- Right Nav (Auth) -->
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-gray-300" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user-circle me-1"></i>{{ Auth::user()?->name ?? 'User' }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-glass" aria-labelledby="userDropdown">
              <li>
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                  <i class="fas fa-user-edit me-2"></i>{{ __('Edit Profile') }}
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                  @csrf
                  <button class="dropdown-item text-danger" type="submit">
                    <i class="fas fa-sign-out-alt me-2"></i>{{ __('Log Out') }}
                  </button>
                </form>
              </li>
            </ul>
          </li>
        @endauth

        @guest
          <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">{{ __('Log in') }}</a></li>
          <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">{{ __('Register') }}</a></li>
        @endguest
      </ul>
    </div>
  </div>
</nav>

@push('styles')
<style>
/* Darker glass navbar */
.navbar-glass {
  background: rgba(10, 12, 20, 0.65) !important; /* darker */
  backdrop-filter: blur(12px) saturate(130%);
  -webkit-backdrop-filter: blur(12px) saturate(130%);
  border-color: rgba(255,255,255,0.08) !important;
}

/* Dropdown glass look */
.dropdown-menu-glass {
  background: rgba(15, 18, 28, 0.85);
  backdrop-filter: blur(10px);
  -webkit-backdrop-filter: blur(10px);
  border: 1px solid rgba(255,255,255,0.08);
}
.dropdown-menu-glass .dropdown-item {
  color: #dbe1ea;
}
.dropdown-menu-glass .dropdown-item:hover {
  background: rgba(255,255,255,0.06);
  color: #fff;
}

/* Brand/logo tweaks */
.navbar-brand { 
  color: #e9eef6 !important;
  transition: none !important;
}
.navbar-brand .brand-logo {
  box-shadow: 0 2px 10px rgba(0,0,0,.35);
  border: 1px solid rgba(255,255,255,0.2);
  display: block;
  object-fit: cover;
  transition: none !important;
  animation: none !important;
}

/* Link contrast */
.navbar-dark .navbar-nav .nav-link {
  color: #cfd6e4;
}
.navbar-dark .navbar-nav .nav-link:hover,
.navbar-dark .navbar-nav .nav-link:focus,
.navbar-dark .navbar-nav .nav-link.active {
  color: #ffffff;
}

/* Light Mode Styles - Ultra Specific to Override Everything */
[data-theme="light"] .navbar.navbar-glass {
  background: rgba(255, 255, 255, 0.85) !important;
  border-color: rgba(46, 120, 197, 0.2) !important;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

/* Brand/Platform Name */
[data-theme="light"] .navbar .navbar-brand,
[data-theme="light"] .navbar-brand {
  color: #1A202C !important;
}

[data-theme="light"] .navbar .navbar-brand:hover,
[data-theme="light"] .navbar .navbar-brand:focus,
[data-theme="light"] .navbar-brand:hover,
[data-theme="light"] .navbar-brand:focus {
  color: #2E78C5 !important;
}

[data-theme="light"] .navbar .navbar-brand:hover span,
[data-theme="light"] .navbar-brand:hover span {
  color: #2E78C5 !important;
}

/* All Navigation Links */
[data-theme="light"] .navbar-dark .navbar-nav .nav-link,
[data-theme="light"] .navbar .navbar-nav .nav-link {
  color: #4A5568 !important;
}

[data-theme="light"] .navbar-dark .navbar-nav .nav-link:hover,
[data-theme="light"] .navbar-dark .navbar-nav .nav-link:focus,
[data-theme="light"] .navbar .navbar-nav .nav-link:hover,
[data-theme="light"] .navbar .navbar-nav .nav-link:focus {
  color: #2E78C5 !important;
}

[data-theme="light"] .navbar-dark .navbar-nav .nav-link.active,
[data-theme="light"] .navbar .navbar-nav .nav-link.active {
  color: #2E78C5 !important;
  font-weight: 600;
}

/* Dropdown Toggles */
[data-theme="light"] .navbar .nav-link.dropdown-toggle,
[data-theme="light"] .nav-link.dropdown-toggle {
  color: #4A5568 !important;
}

[data-theme="light"] .navbar .nav-link.dropdown-toggle:hover,
[data-theme="light"] .navbar .nav-link.dropdown-toggle:focus,
[data-theme="light"] .nav-link.dropdown-toggle:hover,
[data-theme="light"] .nav-link.dropdown-toggle:focus {
  color: #2E78C5 !important;
}

/* Dropdown Menus */
[data-theme="light"] .dropdown-menu-glass,
[data-theme="light"] .dropdown-menu.dropdown-menu-glass {
  background: rgba(255, 255, 255, 0.95) !important;
  border: 1px solid rgba(46, 120, 197, 0.2) !important;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1) !important;
}

[data-theme="light"] .dropdown-menu-glass .dropdown-item,
[data-theme="light"] .dropdown-menu.dropdown-menu-glass .dropdown-item {
  color: #1A202C !important;
}

[data-theme="light"] .dropdown-menu-glass .dropdown-item:hover,
[data-theme="light"] .dropdown-menu-glass .dropdown-item:focus,
[data-theme="light"] .dropdown-menu.dropdown-menu-glass .dropdown-item:hover,
[data-theme="light"] .dropdown-menu.dropdown-menu-glass .dropdown-item:focus {
  background: rgba(46, 120, 197, 0.1) !important;
  color: #2E78C5 !important;
}

/* User Dropdown */
[data-theme="light"] .navbar .text-gray-300,
[data-theme="light"] .text-gray-300,
[data-theme="light"] #userDropdown {
  color: #4A5568 !important;
}

[data-theme="light"] .navbar .text-gray-300:hover,
[data-theme="light"] .navbar .text-gray-300:focus,
[data-theme="light"] #userDropdown:hover,
[data-theme="light"] #userDropdown:focus {
  color: #2E78C5 !important;
}

[data-theme="light"] .dropdown-divider {
  border-color: rgba(46, 120, 197, 0.2) !important;
}
</style>
@endpush