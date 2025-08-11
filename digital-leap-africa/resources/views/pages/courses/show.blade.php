<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="w-full h-96 object-cover">
                <div class="p-6 md:p-10">
                    <p class="text-base text-gray-400">Instructor: {{ $course->instructor }}</p>
                    <h1 class="mt-2 text-3xl md:text-5xl font-bold text-white">{{ $course->title }}</h1>
                    <p class="mt-6 text-lg text-gray-300">
                        {{ $course->description }}
                    </p>
                    <div class="mt-8">
                        <button class="inline-flex items-center px-8 py-4 bg-accent hover:bg-secondary-dark text-white text-base font-semibold rounded-md">
                            Enroll Now
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>