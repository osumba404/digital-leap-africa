<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Forum Thread') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Thread -->
            <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h1 class="text-2xl font-bold text-white">{{ $thread->title }}</h1>
                    <p class="mt-2 text-sm text-gray-400">
                        Started by <span class="text-accent">{{ $thread->user->name }}</span> 
                        · {{ $thread->created_at->diffForHumans() }}
                    </p>

                    <div class="mt-6 text-gray-300 leading-relaxed">
                        {!! nl2br(e($thread->body)) !!}
                    </div>
                </div>
            </div>

            <!-- Replies -->
            <div class="mt-6 space-y-4">
                @forelse ($thread->replies as $reply)
                    <div class="bg-secondary-dark overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-4">
                            <p class="text-sm text-gray-400 mb-2">
                                <span class="font-semibold text-accent">{{ $reply->user->name }}</span> 
                                · {{ $reply->created_at->diffForHumans() }}
                            </p>
                            <p class="text-gray-300">{{ $reply->body }}</p>
                        </div>
                    </div>
                @empty
                    <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-center text-gray-400">
                            <p>No replies yet. Be the first to contribute!</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Reply Form -->
            <div class="mt-6 bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('forum.replies.store', $thread) }}">
                        @csrf
                        <textarea 
                            name="body" 
                            rows="4" 
                            class="w-full rounded-md bg-secondary-dark text-gray-100 border border-gray-700 p-2 focus:outline-none focus:ring focus:ring-accent"
                            placeholder="Write your reply..."
                            required
                        ></textarea>

                        <div class="mt-4">
                            <button class="px-4 py-2 bg-accent hover:bg-secondary-dark text-white text-xs font-semibold rounded-md">
                                Post Reply
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Back -->
            <div class="mt-6">
                <a href="{{ route('forum.index') }}">
                    <button class="px-4 py-2 bg-secondary-dark hover:bg-accent text-white text-xs font-semibold rounded-md">
                        ← Back to Forum
                    </button>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
