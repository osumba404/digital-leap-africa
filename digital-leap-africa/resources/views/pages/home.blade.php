<x-app-layout>
    {{-- This header content is passed to the $header slot in app.blade.php --}}
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-gray-100 m-0">
            {{ __('Welcome to Digital Leap Africa') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="bg-primary-light shadow-sm rounded">
                <div class="p-4 p-md-5 text-gray-100">
                    <h1 class="display-5 fw-bold text-white">The Future of African Youth is Digital.</h1>
                    <p class="mt-3 fs-5">
                        Our mission is to empower African youth through technology education, collaboration, and professional opportunities. This is a demonstration of a dynamic section.
                    </p>
                    <div class="mt-4">
                        <a href="{{ route('register') }}" class="btn btn-info text-white fw-semibold text-uppercase">
                            Get Started Today
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>