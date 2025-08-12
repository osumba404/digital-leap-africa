<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Main Course Info Card --}}
            <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                <img src="{{ $course->image_url ?? 'https://via.placeholder.com/1280x720.png/020b13/ffffff?text=DLA' }}" alt="{{ $course->title }}" class="w-full h-96 object-cover">
                <div class="p-6 md:p-10">
                    <p class="text-base text-gray-400">Instructor: {{ $course->instructor }}</p>
                    <h1 class="mt-2 text-3xl md:text-5xl font-bold text-white">{{ $course->title }}</h1>
                    <p class="mt-6 text-lg text-gray-300">
                        {{ $course->description }}
                    </p>
                    
                    {{-- Dynamic Enrollment Section --}}
                    <div class="mt-8">
                        @auth
                            @if(Auth::user()->courses()->where('course_id', $course->id)->exists())
                                {{-- User is enrolled, so we don't need a button here. The curriculum will show below. --}}
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
                        @guest
                            <a href="{{ route('login') }}"><button class="inline-flex items-center px-8 py-4 bg-gray-600 text-white text-base font-semibold rounded-md">Log In to Enroll</button></a>
                        @endguest
                        @if(session('success')) <p class="mt-4 text-green-400">{{ session('success') }}</p> @endif
                        @if(session('error')) <p class="mt-4 text-red-500">{{ session('error') }}</p> @endif
                    </div>
                </div>
            </div>

            {{-- NEW: Course Curriculum Section --}}
            {{-- This entire block will only be rendered if the user is logged in and enrolled. --}}
            @if(Auth::check() && Auth::user()->courses()->where('course_id', $course->id)->exists())
                <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 md:p-10">
                        <h2 class="text-2xl font-bold text-white mb-6">Course Curriculum</h2>
                        <div class="space-y-8">
                            {{-- Loop through each Topic --}}
                            @forelse ($course->topics as $topic)
                                <div class="bg-primary p-4 rounded-lg">
                                    <h3 class="text-xl font-semibold text-accent">{{ $topic->title }}</h3>
                                    <ul class="mt-4 space-y-3">
                                        {{-- Loop through each Lesson in the Topic --}}
                                        @forelse ($topic->lessons as $lesson)
                                            <li class="flex items-center text-gray-300">
                                                {{-- Display an icon based on the lesson type --}}
                                                @if($lesson->type == 'video')
                                                    <svg class="w-6 h-6 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                @elseif($lesson->type == 'assignment')
                                                    <svg class="w-6 h-6 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                                @else {{-- Default to 'note' icon --}}
                                                    <svg class="w-6 h-6 mr-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                                                @endif
                                                <span>{{ $lesson->title }}</span>
                                            </li>
                                        @empty
                                            <li class="text-gray-400">No lessons have been added to this topic yet.</li>
                                        @endforelse
                                    </ul>
                                </div>
                            @empty
                                <p class="text-gray-400">No topics have been added to this course yet. The instructor is working on it!</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>