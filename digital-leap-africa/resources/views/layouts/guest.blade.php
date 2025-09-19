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

        <!-- Theme overrides -->
        <style>
            :root {
                --bs-primary: #020b13; /* primary */
                --bs-secondary: #2e67b2; /* secondary */
                --bs-info: #4489d2; /* accent */
            }
            body { font-family: 'Figtree', system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans"; }
            .bg-primary-light { background-color: #020b12 !important; }
            .text-gray-900 { color: #111827 !important; }
            .text-white { color: #ffffff !important; }
        </style>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
    </head>
    <body class="bg-primary text-white">
        <div class="min-vh-100 d-flex flex-column justify-content-center align-items-center py-5">
            <div class="mb-4 text-center">
                <a href="/" class="text-decoration-none">
                    @if(!empty($siteSettings['logo_url']))
                        <img src="{{ $siteSettings['logo_url'] }}" alt="{{ $siteSettings['site_name'] ?? 'Site Logo' }}" class="img-fluid bg-white p-2 rounded" style="height: 64px;">
                    @else
                        <h1 class="display-5 fw-bold text-white m-0">{{ $siteSettings['site_name'] ?? config('app.name', 'Laravel') }}</h1>
                    @endif
                </a>
            </div>

            <div class="w-100" style="max-width: 480px;">
                <div class="bg-primary-light shadow rounded p-4">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>