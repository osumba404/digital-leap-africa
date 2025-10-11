<nav class="navbar navbar-expand-lg navbar-dark navbar-glass border-bottom border-dark-subtle">
  <div class="container">
    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
      @if(!empty($siteSettings['logo_url']))
        <img
          src="{{ $siteSettings['logo_url'] }}"
          alt="{{ $siteSettings['site_name'] ?? 'Site Logo' }}"
          class="me-2 brand-logo rounded-circle"
          style="height:44px;width:44px;object-fit:cover;"
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
          <li class="nav-item">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
              {{ __('Dashboard') }}
            </x-nav-link>
          </li>
          @if(Auth::user()->role === 'admin')
            <li class="nav-item">
              <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.*')">
                {{ __('Admin Panel') }}
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
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-glass" aria-labelledby="userDropdown">
              <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                  @csrf
                  <button class="dropdown-item" type="submit">{{ __('Log Out') }}</button>
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
.navbar-brand { color: #e9eef6 !important; }
.navbar-brand .brand-logo {
  box-shadow: 0 2px 10px rgba(0,0,0,.35);
  border: 1px solid rgba(255,255,255,0.2);
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
</style>
@endpush