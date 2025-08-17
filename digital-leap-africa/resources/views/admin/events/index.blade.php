<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Manage Events') }}
            </h2>
            <a href="{{ route('admin.events.create') }}">
                <x-primary-button>+ Add New Event</x-primary-button>
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
                                    <th class="p-2">Date</th>
                                    <th class="p-2">Location</th>
                                    <th class="p-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr class="border-b border-gray-700">
                                        <td class="p-2">{{ $event->title }}</td>
                                        <td class="p-2">{{ $event->date->format('M d, Y H:i') }}</td>
                                        <td class="p-2">{{ $event->location }}</td>
                                        <td class="p-2">
                                            <a href="{{ route('admin.events.edit', $event) }}" class="text-accent hover:text-white">Edit</a>
                                            <form method="POST" action="{{ route('admin.events.destroy', $event) }}" class="inline-block ml-4" onsubmit="return confirm('Are you sure you want to delete this event?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500 hover:text-red-400">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($events->isEmpty())
                            <p class="text-center text-gray-400 mt-4">No events found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
