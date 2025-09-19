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

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Theme overrides (map existing palette) -->
        <style>
            :root {
                --bs-primary: #020b13; /* primary */
                --bs-secondary: #2e67b2; /* secondary */
                --bs-info: #4489d2; /* accent */
            }
            body { font-family: 'Figtree', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol"; }
            .bg-primary-light { background-color: #020b12 !important; }
            .text-gray-200 { color: #e5e7eb !important; }
            .text-gray-300 { color: #d1d5db !important; }
            .text-gray-400 { color: #9ca3af !important; }
        </style>

        <!-- Scripts: Bootstrap Bundle (includes Popper) -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    </head>
    <body class="d-flex flex-column min-vh-100 bg-primary text-gray-200">
        <div class="d-flex flex-column flex-grow-1">

            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-primary-light border-bottom border-dark-subtle">
                    <div class="container py-4">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="flex-grow-1">
                <div class="container py-4">
                    {{ $slot }}
                </div>
            </main>

            {{-- Use the component syntax for the footer --}}
            <x-footer />

            {{-- The global flash message component --}}
            <x-flash-message />

        </div>
    </body>
</html>