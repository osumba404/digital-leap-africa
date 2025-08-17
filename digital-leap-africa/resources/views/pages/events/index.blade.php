<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Events') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                @forelse ($events as $event)
                    <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold text-white">{{ $event->title }}</h3>
                                    <p class="mt-1 text-sm text-gray-400">
                                        {{ $event->location }} &middot; 
                                        <span class="text-accent">{{ $event->date->format('M d, Y h:i A') }}</span>
                                    </p>
                                </div>
                                @if($event->registration_url)
                                    <a href="{{ $event->registration_url }}" target="_blank">
                                        <button class="px-4 py-2 bg-accent hover:bg-secondary-dark text-white text-xs font-semibold rounded-md">
                                            Register
                                        </button>
                                    </a>
                                @endif
                            </div>
                            <p class="mt-4 text-gray-300">
                                {{ $event->description }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-center text-gray-400">
                            <p>No upcoming events at this time. Please check back later.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
