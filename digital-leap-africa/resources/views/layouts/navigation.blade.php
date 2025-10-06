<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #020b13;">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
             @if(!empty($siteSettings['logo_url']))
                <img src="{{ $siteSettings['logo_url'] }}" alt="{{ $siteSettings['site_name'] ?? 'Site Logo' }}" style="height: 40px;">
            @else
                {{ $siteSettings['site_name'] ?? config('app.name') }}
            @endif
        </a>

        <!-- Hamburger Toggler -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible Content -->
        <div class="collapse navbar-collapse" id="mainNavbar">
            <!-- Main Nav -->
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><x-nav-link :href="route('home')" :active="request()->routeIs('home')">Home</x-nav-link></li>
                <li class="nav-item"><x-nav-link :href="route('courses.index')" :active="request()->routeIs('courses.*')">Courses</x-nav-link></li>
                <li class="nav-item"><x-nav-link :href="route('projects.index')" :active="request()->routeIs('projects.*')">Projects</x-nav-link></li>
                <li class="nav-item"><x-nav-link :href="route('elibrary.index')" :active="request()->routeIs('elibrary.*')">eLibrary</x-nav-link></li>
                <li class="nav-item"><x-nav-link :href="route('jobs.index')" :active="request()->routeIs('jobs.*')">Job Board</x-nav-link></li>
            </ul>

            <!-- Auth Nav -->
            <div class="d-flex">
                @guest
                    <a href="{{ route('login') }}" class="btn btn-outline-light me-2">Log in</a>
                    <a href="{{ route('register') }}" class="btn" style="background-color: #2e67b2; color: white;">Sign up</a>
                @else
                    <x-dropdown>
                        <x-slot name="trigger">
                           <span class="text-white">{{ Auth::user()->name }}</span>
                        </x-slot>
                        <x-slot name="content">
                            <x-dropdown-link :href="route('dashboard')">Dashboard</x-dropdown-link>
                            <x-dropdown-link :href="route('profile.edit')">Profile</x-dropdown-link>
                            @if(Auth::user()->role === 'admin')
                                <div class="dropdown-divider"></div>
                                <x-dropdown-link :href="route('admin.dashboard')">Admin Panel</x-dropdown-link>
                            @endif
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endguest
            </div>
        </div>
    </div>
</nav>