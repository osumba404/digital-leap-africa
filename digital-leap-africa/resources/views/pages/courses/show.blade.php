<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-gray-100 m-0">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            {{-- Main Course Info Card --}}
            <div class="bg-primary-light shadow-sm rounded overflow-hidden mb-4">
                <img src="{{ $course->image_url ?? 'https://via.placeholder.com/1280x720.png/020b13/ffffff?text=DLA' }}" alt="{{ $course->title }}" class="w-100" style="height: 24rem; object-fit: cover;">
                <div class="p-4 p-md-5">
                    <p class="mb-1 text-gray-400">Instructor: {{ $course->instructor }}</p>
                    <h1 class="display-5 fw-bold text-white mb-3">{{ $course->title }}</h1>
                    <p class="fs-5 text-gray-300 mb-0">
                        {{ $course->description }}
                    </p>

                    {{-- Progress Bar for Enrolled Users --}}
                    @if(Auth::check() && Auth::user()->courses()->where('course_id', $course->id)->exists())
                        @php
                            $progress = Auth::user()->getCourseProgress($course);
                        @endphp
                        <div class="mt-4">
                            <h4 class="small fw-semibold text-gray-300 mb-1">YOUR PROGRESS</h4>
                            <div class="progress bg-primary" style="height: 10px;">
                                <div class="progress-bar bg-info" role="progressbar" style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <p class="mt-1 small text-gray-400 mb-0">{{ round($progress) }}% Complete</p>
                        </div>
                    @endif
                    
                    {{-- Dynamic Enrollment Section --}}
                    <div class="mt-4">
                        @auth
                            @if(Auth::user()->courses()->where('course_id', $course->id)->exists())
                                <p class="text-success fw-bold fs-5 mb-0">You are enrolled in this course.</p>
                            @else
                                <form method="POST" action="{{ route('courses.enroll', $course) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-info text-white fw-semibold px-4 py-2">
                                        Enroll Now (+50 Points)
                                    </button>
                                </form>
                            @endif
                        @endauth
                        @guest
                            <a href="{{ route('login') }}" class="btn btn-secondary text-white fw-semibold px-4 py-2">Log In to Enroll</a>
                        @endguest
                        @if(session('success')) <p class="mt-3 text-success">{{ session('success') }}</p> @endif
                        @if(session('error')) <p class="mt-3 text-danger">{{ session('error') }}</p> @endif
                    </div>
                </div>
            </div>

            {{-- Course Curriculum Section --}}
            @if(Auth::check() && Auth::user()->courses()->where('course_id', $course->id)->exists())
                <div class="bg-primary-light shadow-sm rounded">
                    <div class="p-4 p-md-5">
                        <h2 class="h3 fw-bold text-white mb-4">Course Curriculum</h2>
                        <div class="d-flex flex-column gap-4">
                            @forelse ($course->topics as $topic)
                                <div class="bg-primary p-3 rounded">
                                    <h3 class="h5 fw-semibold" style="color: var(--bs-info);">{{ $topic->title }}</h3>
                                    <ul class="list-unstyled mt-3 mb-0 d-flex flex-column gap-2">
                                        @forelse ($topic->lessons as $lesson)
                                            <li class="d-flex align-items-center text-gray-300">
                                                {{-- Icon placeholder can be added here if needed --}}
                                                <a href="{{ route('lessons.show', $lesson) }}" class="flex-grow-1 ms-2 link-info text-decoration-none">
                                                    {{ $lesson->title }}
                                                </a>
                                                @if(Auth::user()->lessons()->where('lesson_id', $lesson->id)->exists())
                                                    <svg class="ms-2" width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                @endif
                                            </li>
                                        @empty
                                            <li class="ms-4 text-gray-400">No lessons have been added to this topic yet.</li>
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