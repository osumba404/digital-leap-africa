<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ $project->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-auto object-cover">
                <div class="p-6 md:p-10">
                    <h1 class="text-3xl md:text-5xl font-bold text-white">{{ $project->title }}</h1>
                    <p class="mt-8 text-lg text-gray-300">
                        {{ $project->description }}
                    </p>
                    <div class="mt-8">
                        <a href="{{ $project->github_url }}" target="_blank">
                            <button class="inline-flex items-center px-8 py-4 bg-accent hover:bg-secondary-dark text-white text-base font-semibold rounded-md">
                                View on GitHub
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>