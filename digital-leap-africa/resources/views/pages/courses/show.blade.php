<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                <img src="{{ $course->image_url ?? 'https://via.placeholder.com/1280x720.png/020b13/ffffff?text=DLA' }}" alt="{{ $course->title }}" class="w-full h-96 object-cover">
                <div class="p-6 md:p-10">
                    <p class="text-base text-gray-400">Instructor: {{ $course->instructor }}</p>
                    <h1 class="mt-2 text-3xl md:text-5xl font-bold text-white">{{ $course->title }}</h1>
                    <p class="mt-6 text-lg text-gray-300">
                        {{ $course->description }}
                    </p>
                    
                    {{-- This is the new, dynamic enrollment section --}}
                    <div class="mt-8">
                        {{-- Check if user is authenticated --}}
                        @auth
                            {{-- Check if user is already enrolled --}}
                            @if(Auth::user()->courses()->where('course_id', $course->id)->exists())
                                <p class="text-green-400 font-bold text-lg">You are enrolled in this course.</p>
                            @else
                                <form method="POST" action="{{ route('courses.enroll', $course) }}">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-8 py-4 bg-accent hover:bg-secondary-dark text-white text-base font-semibold rounded-md transition ease-in-out duration-150">
                                        Enroll Now (+50 Points)
                                    </button>
                                </form>
                            @endif
                        @endauth

                        {{-- If user is a guest, show a link to the login page --}}
                        @guest
                            <a href="{{ route('login') }}">
                                <button class="inline-flex items-center px-8 py-4 bg-gray-600 text-white text-base font-semibold rounded-md">
                                    Log In to Enroll
                                </button>
                            </a>
                        @endguest

                        {{-- Display success/error messages from the controller --}}
                        @if(session('success'))
                            <p class="mt-4 text-green-400">{{ session('success') }}</p>
                        @endif
                        @if(session('error'))
                            <p class="mt-4 text-red-500">{{ session('error') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>