<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ $lesson->topic->course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-10 text-gray-100">
                    <h1 class="text-3xl font-bold text-white">{{ $lesson->title }}</h1>
                    <span class="mt-2 text-sm text-gray-400">Part of: {{ $lesson->topic->title }}</span>

                    {{-- This is for displaying content like notes or videos --}}
                    <div class="mt-8 prose prose-invert max-w-none">
                        @if($lesson->type === 'video' && $lesson->video_url)
                            <div class="aspect-w-16 aspect-h-9">
                                {{-- A simple way to embed YouTube videos --}}
                                <iframe src="https://www.youtube.com/embed/{{ basename(parse_url($lesson->video_url, PHP_URL_PATH)) }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                            </div>
                        @endif

                        {{-- nl2br converts newlines to <br> tags, e() escapes HTML --}}
                        {!! nl2br(e($lesson->content)) !!}
                    </div>

                    {{-- NEW: "Mark as Complete" button and status section --}}
                    <div class="mt-10 border-t border-gray-700 pt-6">
                        @if(Auth::user()->lessons()->where('lesson_id', $lesson->id)->exists())
                            <div class="flex items-center text-green-400 font-semibold">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                You have completed this lesson.
                            </div>
                        @else
                            <form method="POST" action="{{ route('lessons.complete', $lesson) }}">
                                @csrf
                                <x-primary-button>Mark as Complete</x-primary-button>
                            </form>
                        @endif
                        
                        {{-- Link to go back to the main course page --}}
                        <div class="mt-6">
                            <a href="{{ route('courses.show', $lesson->topic->course) }}" class="text-sm text-accent hover:underline">&larr; Back to Course Curriculum</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>