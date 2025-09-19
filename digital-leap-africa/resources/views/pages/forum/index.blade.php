<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-gray-100 m-0">
            {{ __('Community Forum') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container" style="max-width: 64rem;">
            <div class="d-flex flex-column gap-3">
                @forelse ($threads as $thread)
                    <div class="bg-primary-light shadow-sm rounded">
                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="h5 fw-bold text-white mb-1">
                                        <a href="{{ route('forum.show', $thread->id) }}" class="link-info text-decoration-none">
                                            {{ $thread->title }}
                                        </a>
                                    </h3>
                                    <p class="small text-gray-400 mb-0">
                                        Started by {{ $thread->user->name }} &middot; 
                                        <span class="text-info">{{ $thread->created_at->diffForHumans() }}</span>
                                    </p>
                                </div>
                                <span class="badge bg-info text-white align-self-start">
                                    {{ $thread->replies_count }} Replies
                                </span>
                            </div>
                            <p class="mt-3 text-gray-300 mb-0">
                                {{ Str::limit($thread->body, 150) }}
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="bg-primary-light shadow-sm rounded">
                        <div class="p-4 text-center text-gray-400">
                            <p class="mb-0">No forum discussions yet. Be the first to start a thread!</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
