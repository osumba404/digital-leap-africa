<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Our Courses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($courses as $course)
                    <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                        <a href="{{ route('courses.show', $course) }}">
                            <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="w-full h-48 object-cover">
                        </a>
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-white">
                                <a href="{{ route('courses.show', $course) }}">{{ $course->title }}</a>
                            </h3>
                            <p class="mt-2 text-sm text-gray-400">By {{ $course->instructor }}</p>
                            <p class="mt-4 text-gray-300">
                                {{ Str::limit($course->description, 100) }}
                            </p>
                            <div class="mt-6 flex justify-end">
                                <a href="{{ route('courses.show', $course) }}">
                                    <button class="inline-flex items-center px-4 py-2 bg-secondary hover:bg-secondary-dark text-white text-xs font-semibold rounded-md">
                                        View Details
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>