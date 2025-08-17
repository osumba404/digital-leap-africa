<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Event Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-white">{{ $event->title }}</h1>
                    <p class="mt-2 text-gray-400 text-sm">
                        {{ $event->location }} &middot; 
                        <span class="text-accent">{{ $event->date->format('F j, Y, g:i a') }}</span>
                    </p>

                    <div class="mt-6 text-gray-300 leading-relaxed">
                        {!! nl2br(e($event->description)) !!}
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('events.index') }}">
                            <button class="px-4 py-2 bg-secondary-dark hover:bg-accent text-white text-xs font-semibold rounded-md">
                                ← Back to Events
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
