<x-app-layout>
    {{-- This header content is passed to the $header slot in app.blade.php --}}
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Welcome to Digital Leap Africa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-10 text-gray-100">
                    <h1 class="text-3xl md:text-5xl font-bold text-white">The Future of African Youth is Digital.</h1>
                    <p class="mt-4 text-lg md:text-xl">
                        Our mission is to empower African youth through technology education, collaboration, and professional opportunities. This is a demonstration of a dynamic section.
                    </p>
                    <div class="mt-8">
                        <a href="{{ route('register') }}">
                           <button class="inline-flex items-center px-6 py-3 bg-accent border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-secondary-dark focus:bg-secondary-dark active:bg-secondary-dark focus:outline-none focus:ring-2 focus:ring-accent focus:ring-offset-2 transition ease-in-out duration-150">
                                Get Started Today
                           </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>