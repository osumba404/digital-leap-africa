<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Job Board') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                @forelse ($jobs as $job)
                    <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold text-white">{{ $job->title }}</h3>
                                    <p class="mt-1 text-sm text-gray-400">
                                        {{ $job->company }} &middot; <span class="text-accent">{{ $job->location }}</span>
                                    </p>
                                </div>
                                <a href="{{ $job->application_url }}" target="_blank">
                                    <button class="px-4 py-2 bg-accent hover:bg-secondary-dark text-white text-xs font-semibold rounded-md">
                                        Apply
                                    </button>
                                </a>
                            </div>
                            <p class="mt-4 text-gray-300">
                                {{ $job->description }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-center text-gray-400">
                            <p>There are no open positions at this time. Please check back later.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>