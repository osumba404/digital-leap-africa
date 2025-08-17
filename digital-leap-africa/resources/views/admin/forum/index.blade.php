<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Manage Forum Threads') }}
            </h2>
            <a href="{{ route('admin.forum.create') }}">
                <x-primary-button>+ Add New Thread</x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-primary-light shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-gray-700">
                                    <th class="p-2">Title</th>
                                    <th class="p-2">Author</th>
                                    <th class="p-2">Replies</th>
                                    <th class="p-2">Last Reply</th>
                                    <th class="p-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($threads as $thread)
                                    <tr class="border-b border-gray-700">
                                        <td class="p-2">{{ $thread->title }}</td>
                                        <td class="p-2">{{ $thread->user->name ?? 'Unknown' }}</td>
                                        <td class="p-2">{{ $thread->replies_count }}</td>
                                        <td class="p-2">
                                            {{ optional($thread->latestReply)->created_at?->diffForHumans() ?? 'No replies yet' }}
                                        </td>
                                        <td class="p-2">
                                            <a href="{{ route('admin.forum.edit', $thread) }}" class="text-accent hover:text-white">Edit</a>
                                            <form method="POST" action="{{ route('admin.forum.destroy', $thread) }}" class="inline-block ml-4" onsubmit="return confirm('Are you sure you want to delete this thread?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-400">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($threads->isEmpty())
                            <p class="text-center text-gray-400 mt-4">No forum threads found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
