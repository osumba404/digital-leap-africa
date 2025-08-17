<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Community Forum') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                @forelse ($threads as $thread)
                    <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold text-white">
                                        <a href="{{ route('forum.show', $thread->id) }}" class="hover:text-accent">
                                            {{ $thread->title }}
                                        </a>
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-400">
                                        Started by {{ $thread->user->name }} &middot; 
                                        <span class="text-accent">{{ $thread->created_at->diffForHumans() }}</span>
                                    </p>
                                </div>
                                <span class="px-3 py-1 bg-accent text-white text-xs rounded-md">
                                    {{ $thread->replies_count }} Replies
                                </span>
                            </div>
                            <p class="mt-4 text-gray-300 line-clamp-2">
                                {{ Str::limit($thread->body, 150) }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-center text-gray-400">
                            <p>No forum discussions yet. Be the first to start a thread!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
