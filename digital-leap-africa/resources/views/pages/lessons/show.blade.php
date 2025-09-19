<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-gray-100 m-0">
            {{ $lesson->topic->course->title }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="bg-primary-light shadow-sm rounded">
                <div class="p-4 p-md-5 text-gray-100">
                    <h1 class="h3 fw-bold text-white">{{ $lesson->title }}</h1>
                    <span class="d-block mt-1 small text-gray-400">Part of: {{ $lesson->topic->title }}</span>

                    {{-- Content: notes or video --}}
                    <div class="mt-4">
                        @if($lesson->type === 'video' && $lesson->video_url)
                            <div class="ratio ratio-16x9 mb-3">
                                <iframe src="https://www.youtube.com/embed/{{ basename(parse_url($lesson->video_url, PHP_URL_PATH)) }}" title="Lesson Video" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        @endif

                        <div class="text-gray-200">
                            {!! nl2br(e($lesson->content)) !!}
                        </div>
                    </div>

                    {{-- Mark as Complete section --}}
                    <div class="mt-4 border-top border-dark-subtle pt-3">
                        @if(Auth::user()->lessons()->where('lesson_id', $lesson->id)->exists())
                            <div class="d-flex align-items-center text-success fw-semibold">
                                <svg width="24" height="24" class="me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                You have completed this lesson.
                            </div>
                        @else
                            <form method="POST" action="{{ route('lessons.complete', $lesson) }}">
                                @csrf
                                <button type="submit" class="btn btn-primary">Mark as Complete</button>
                            </form>
                        @endif

                        <div class="mt-3">
                            <a href="{{ route('courses.show', $lesson->topic->course) }}" class="link-info small text-decoration-none">&larr; Back to Course Curriculum</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>