<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $siteSettings['site_name'] ?? config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-primary">
            <div>
                <a href="/">
                    {{-- This now dynamically loads the logo from Site Settings --}}
                    @if(!empty($siteSettings['logo_url']))
                        <img src="{{ $siteSettings['logo_url'] }}" alt="{{ $siteSettings['site_name'] ?? 'Site Logo' }}" class="h-16 w-auto bg-white p-2 rounded-lg">
                    @else
                        <h1 class="text-4xl font-bold text-white">{{ $siteSettings['site_name'] ?? config('app.name', 'Laravel') }}</h1>
                    @endif
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-primary-light shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>