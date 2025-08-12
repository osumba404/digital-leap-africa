<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Manage Topics for: <span class="text-accent">{{ $course->title }}</span>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- This can be removed in favor of the global flash message component --}}
            {{-- @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg">{{ session('success') }}</div>
            @endif --}}

            <!-- Form to Add New Topic -->
            <div class="bg-primary-light shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-white">Add New Topic</h3>
                    <form method="POST" action="{{ route('admin.courses.topics.store', $course) }}" class="mt-4">
                        @csrf
                        <div class="flex items-center space-x-4">
                            <div class="flex-grow">
                                <x-input-label for="title" value="Topic Title" class="sr-only" />
                                <x-text-input id="title" name="title" type="text" class="w-full" placeholder="e.g., Introduction to PHP" required />
                            </div>
                            <x-primary-button>Add Topic</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- List of Existing Topics -->
            <div class="bg-primary-light shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                     <h3 class="text-lg font-semibold text-white mb-4">Existing Topics</h3>
                    @if($course->topics->isEmpty())
                        <p>No topics have been added to this course yet.</p>
                    @else
                        <ul class="space-y-4">
                            @foreach ($course->topics as $topic)
                                <li class="flex justify-between items-center bg-primary p-4 rounded-md">
                                    <span class="font-semibold">{{ $topic->title }}</span>
                                    <div class="flex items-center space-x-4">
                                        {{-- THIS IS THE UPDATED LINK --}}
                                        <a href="{{ route('admin.topics.lessons.index', $topic) }}" class="text-accent hover:underline font-semibold">
                                            Manage Lessons ({{ $topic->lessons->count() }})
                                        </a>
                                        <form method="POST" action="{{ route('admin.topics.destroy', $topic) }}" onsubmit="return confirm('Are you sure?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-400">Delete</button>
                                        </form>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>