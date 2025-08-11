<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Community Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($projects as $project)
                    <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                        <a href="{{ route('projects.show', $project) }}">
                            <img src="{{ $project->image_url }}" alt="{{ $project->title }}" class="w-full h-64 object-cover">
                        </a>
                        <div class="p-6">
                            <h3 class="text-2xl font-bold text-white">
                                <a href="{{ route('projects.show', $project) }}">{{ $project->title }}</a>
                            </h3>
                            <p class="mt-4 text-gray-300">
                                {{ Str::limit($project->description, 120) }}
                            </p>
                            <div class="mt-6 flex justify-end">
                                <a href="{{ route('projects.show', $project) }}">
                                    <button class="inline-flex items-center px-4 py-2 bg-secondary hover:bg-secondary-dark text-white text-xs font-semibold rounded-md">
                                        Learn More
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