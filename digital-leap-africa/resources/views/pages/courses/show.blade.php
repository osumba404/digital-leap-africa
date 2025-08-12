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

                    {{-- NEW: Progress Bar for Enrolled Users --}}
                    @if(Auth::check() && Auth::user()->courses()->where('course_id', $course->id)->exists())
                        @php
                            $progress = Auth::user()->getCourseProgress($course);
                        @endphp
                        <div class="mt-6">
                            <h4 class="text-sm font-semibold text-gray-300">YOUR PROGRESS</h4>
                            <div class="mt-2 w-full bg-primary rounded-full h-2.5">
                                <div class="bg-accent h-2.5 rounded-full" style="width: {{ $progress }}%"></div>
                            </div>
                            <p class="mt-1 text-xs text-gray-400">{{ round($progress) }}% Complete</p>
                        </div>
                    @endif
                    
                    {{-- Dynamic Enrollment Section --}}
                    <div class="mt-8">
                        @auth
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
                        @guest
                            <a href="{{ route('login') }}"><button class="inline-flex items-center px-8 py-4 bg-gray-600 text-white text-base font-semibold rounded-md">Log In to Enroll</button></a>
                        @endguest
                        @if(session('success')) <p class="mt-4 text-green-400">{{ session('success') }}</p> @endif
                        @if(session('error')) <p class="mt-4 text-red-500">{{ session('error') }}</p> @endif
                    </div>
                </div>
            </div>

            {{-- Course Curriculum Section --}}
            @if(Auth::check() && Auth::user()->courses()->where('course_id', $course->id)->exists())
                <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 md:p-10">
                        <h2 class="text-2xl font-bold text-white mb-6">Course Curriculum</h2>
                        <div class="space-y-8">
                            @forelse ($course->topics as $topic)
                                <div class="bg-primary p-4 rounded-lg">
                                    <h3 class="text-xl font-semibold text-accent">{{ $topic->title }}</h3>
                                    <ul class="mt-4 space-y-3">
                                        @forelse ($topic->lessons as $lesson)
                                            <li class="flex items-center text-gray-300">
                                                {{-- ... icon ... --}}

                                                {{-- NEW: Turn the lesson title into a clickable link --}}
                                                <a href="{{ route('lessons.show', $lesson) }}" class="flex-grow ml-3 hover:text-accent hover:underline">
                                                    {{ $lesson->title }}
                                                </a>

                                                {{-- NEW: Show a checkmark if the lesson is complete --}}
                                                @if(Auth::user()->lessons()->where('lesson_id', $lesson->id)->exists())
                                                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                @endif
                                            </li>
                                        @empty
                                            <li class="text-gray-400 ml-9">No lessons have been added to this topic yet.</li>
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