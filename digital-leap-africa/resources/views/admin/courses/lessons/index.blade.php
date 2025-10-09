<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Manage Lessons for: <span class="text-accent">{{ $topic->title }}</span>
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- Form to Add New Lesson -->
            <div class="bg-primary-light shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-white">Add New Lesson</h3>
                    <form method="POST" action="{{ route('admin.topics.lessons.store', $topic) }}" class="mt-4">
                        @csrf
                        @include('admin.lessons._form')
                    </form>
                </div>
            </div>
            <!-- List of Existing Lessons -->
            <div class="bg-primary-light shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h3 class="text-lg font-semibold text-white mb-4">Existing Lessons</h3>
                    @forelse($topic->lessons as $item)
                        <div class="flex justify-between items-center bg-primary p-4 rounded-md @if(!$loop->last) mb-4 @endif">
                            <div>
                                <span class="font-semibold">{{ $item->title }}</span>
                                <span class="ml-4 text-xs uppercase bg-accent text-white px-2 py-1 rounded-full">{{ $item->type }}</span>
                            </div>
                            <div class="flex items-center space-x-4">
                                <a href="{{ route('admin.topics.lessons.edit', [$topic, $item]) }}" class="text-accent hover:text-white">Edit</a>
                                <form method="POST" action="{{ route('admin.topics.lessons.destroy', [$topic, $item]) }}" onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-400">Delete</button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <p>No lessons have been added to this topic yet.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>