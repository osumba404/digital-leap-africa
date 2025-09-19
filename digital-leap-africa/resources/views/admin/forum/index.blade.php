<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-semibold fs-4 text-gray-100 m-0">
                {{ __('Manage Forum Threads') }}
            </h2>
            <a href="{{ route('admin.forum.create') }}" class="btn btn-primary btn-sm">+ Add New Thread</a>
        </div>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="bg-primary-light shadow-sm rounded">
                <div class="p-4 text-gray-200">
                    <div class="table-responsive">
                        <table class="table table-sm table-borderless align-middle text-gray-200 mb-0">
                            <thead>
                                <tr class="border-bottom border-dark-subtle">
                                    <th class="py-2">Title</th>
                                    <th class="py-2">Author</th>
                                    <th class="py-2">Replies</th>
                                    <th class="py-2">Last Reply</th>
                                    <th class="py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($threads as $thread)
                                    <tr class="border-bottom border-dark-subtle">
                                        <td class="py-2">{{ $thread->title }}</td>
                                        <td class="py-2">{{ $thread->user->name ?? 'Unknown' }}</td>
                                        <td class="py-2">{{ $thread->replies_count }}</td>
                                        <td class="py-2">
                                            {{ optional($thread->latestReply)->created_at?->diffForHumans() ?? 'No replies yet' }}
                                        </td>
                                        <td class="py-2">
                                            <a href="{{ route('admin.forum.edit', $thread) }}" class="link-info text-decoration-none">Edit</a>
                                            <form method="POST" action="{{ route('admin.forum.destroy', $thread) }}" class="d-inline ms-3" onsubmit="return confirm('Are you sure you want to delete this thread?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link link-danger p-0 align-baseline">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($threads->isEmpty())
                            <p class="text-center text-gray-400 mt-3 mb-0">No forum threads found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
