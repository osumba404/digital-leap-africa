<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('eLibrary Resources') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($elibraryItems as $item)
                    <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg flex flex-col">
                        <img src="{{ $item->image_url }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                        <div class="p-6 flex flex-col flex-grow">
                            <span class="text-xs font-semibold uppercase text-accent">{{ $item->type }}</span>
                            <h3 class="mt-2 text-xl font-bold text-white">
                                {{ $item->title }}
                            </h3>
                            <p class="mt-4 text-gray-300 flex-grow">
                                {{ $item->description }}
                            </p>
                            <div class="mt-6">
                                <a href="{{ $item->file_url }}" target="_blank">
                                    <button class="w-full text-center px-4 py-2 bg-secondary hover:bg-secondary-dark text-white text-sm font-semibold rounded-md">
                                        Access Resource
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