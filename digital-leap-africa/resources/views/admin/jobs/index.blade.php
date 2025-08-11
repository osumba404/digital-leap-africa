<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-100 leading-tight">
                {{ __('Manage Jobs') }}
            </h2>
            <a href="{{ route('admin.jobs.create') }}">
                <x-primary-button>+ Add New Job</x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Session Success Message -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
                    {{ session('success') }}
                </div>
            @endif
            <div class="bg-primary-light shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="border-b border-gray-700">
                                <th class="p-2">Title</th>
                                <th class="p-2">Company</th>
                                <th class="p-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr class="border-b border-gray-700">
                                    <td class="p-2">{{ $job->title }}</td>
                                    <td class="p-2">{{ $job->company }}</td>
                                    <td class="p-2">
                                        <a href="{{ route('admin.jobs.edit', $job) }}" class="text-accent hover:text-white">Edit</a>
                                        <form method="POST" action="{{ route('admin.jobs.destroy', $job) }}" class="inline-block ml-4" onsubmit="return confirm('Are you sure you want to delete this job?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-400">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>