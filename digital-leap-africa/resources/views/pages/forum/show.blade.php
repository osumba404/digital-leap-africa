<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-gray-100 m-0">
            {{ __('Forum Thread') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container" style="max-width: 64rem;">
            <!-- Thread -->
            <div class="bg-primary-light shadow-sm rounded">
                <div class="p-4">
                    <h1 class="h3 fw-bold text-white mb-1">{{ $thread->title }}</h1>
                    <p class="small text-gray-400 mb-0">
                        Started by <span class="text-info fw-semibold">{{ $thread->user->name }}</span>
                        · {{ $thread->created_at->diffForHumans() }}
                    </p>

                    <div class="mt-3 text-gray-300">
                        {!! nl2br(e($thread->body)) !!}
                    </div>
                </div>
            </div>

            <!-- Replies -->
            <div class="mt-3 d-flex flex-column gap-2">
                @forelse ($thread->replies as $reply)
                    <div class="bg-primary-light shadow-sm rounded">
                        <div class="p-3">
                            <p class="small text-gray-400 mb-1">
                                <span class="fw-semibold text-info">{{ $reply->user->name }}</span>
                                · {{ $reply->created_at->diffForHumans() }}
                            </p>
                            <p class="text-gray-300 mb-0">{{ $reply->body }}</p>
                        </div>
                    </div>
                @empty
                    <div class="bg-primary-light shadow-sm rounded">
                        <div class="p-4 text-center text-gray-400">
                            <p class="mb-0">No replies yet. Be the first to contribute!</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Reply Form -->
            <div class="mt-3 bg-primary-light shadow-sm rounded">
                <div class="p-4">
                    <form method="POST" action="{{ route('forum.replies.store', $thread) }}">
                        @csrf
                        <div class="mb-3">
                            <textarea
                                name="body"
                                rows="4"
                                class="form-control bg-primary-light text-gray-200 border-0"
                                placeholder="Write your reply..."
                                required
                            ></textarea>
                        </div>
                        <div>
                            <button class="btn btn-info text-white btn-sm">
                                Post Reply
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Back -->
            <div class="mt-3">
                <a href="{{ route('forum.index') }}" class="btn btn-secondary btn-sm text-white">
                    ← Back to Forum
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
