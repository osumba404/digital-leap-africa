@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')
<section class="container">
    <div class="card" style="text-align:center;">
        <div style="font-size:4rem; font-weight:800; color:#ef4444;">404</div>
        <h1 style="margin:0;">Page not found</h1>
        <p class="text-muted" style="margin-top:0.5rem;">
            The page you’re looking for doesn’t exist or may have been moved.
        </p>

        <div style="display:flex; gap:0.75rem; justify-content:center; margin-top:1rem;">
            <a class="btn-primary" href="{{ route('home') }}">
                <i class="fas fa-home me-2"></i>Go to Home
            </a>
            <a class="btn-outline" href="{{ url()->previous() }}">
                <i class="fas fa-arrow-left me-2"></i>Go Back
            </a>
        </div>

        @auth
            <div class="text-muted small" style="margin-top:1rem;">
                If you believe this is an error, please contact the admin or check your route configuration.
            </div>
        @endauth
    </div>
</section>
@endsection