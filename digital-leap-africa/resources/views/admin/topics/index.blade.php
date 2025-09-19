<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-gray-100 m-0">
            Manage Topics for: <span class="text-info">{{ $course->title }}</span>
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container d-flex flex-column gap-3">
            {{-- This can be removed in favor of the global flash message component --}}
            {{-- @if(session('success'))
                <div class="bg-success text-white p-4 rounded">{{ session('success') }}</div>
            @endif --}}

            <!-- Form to Add New Topic -->
            <div class="bg-primary-light shadow-sm rounded">
                <div class="p-4">
                    <h3 class="h6 fw-semibold text-white mb-2">Add New Topic</h3>
                    <form method="POST" action="{{ route('admin.courses.topics.store', $course) }}" class="mt-2">
                        @csrf
                        <div class="row g-2 align-items-end">
                            <div class="col">
                                <x-input-label for="title" value="Topic Title" class="visually-hidden" />
                                <x-text-input id="title" name="title" type="text" class="mt-1 w-100" placeholder="e.g., Introduction to PHP" required />
                            </div>
                            <div class="col-auto">
                                <x-primary-button>Add Topic</x-primary-button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- List of Existing Topics -->
            <div class="bg-primary-light shadow-sm rounded">
                <div class="p-4 text-gray-100">
                    <h3 class="h6 fw-semibold text-white mb-3">Existing Topics</h3>
                    @if($course->topics->isEmpty())
                        <p class="mb-0">No topics have been added to this course yet.</p>
                    @else
                        <ul class="list-unstyled d-flex flex-column gap-2 mb-0">
                            @foreach ($course->topics as $topic)
                                <li class="d-flex justify-content-between align-items-center bg-primary p-3 rounded">
                                    <span class="fw-semibold">{{ $topic->title }}</span>
                                    <div class="d-flex align-items-center gap-3">
                                        <a href="{{ route('admin.topics.lessons.index', $topic) }}" class="link-info text-decoration-none fw-semibold">
                                            Manage Lessons ({{ $topic->lessons->count() }})
                                        </a>
                                        <form method="POST" action="{{ route('admin.topics.destroy', $topic) }}" onsubmit="return confirm('Are you sure?');" class="m-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link link-danger p-0 align-baseline">Delete</button>
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