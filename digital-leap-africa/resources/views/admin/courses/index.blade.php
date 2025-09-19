<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-semibold fs-4 text-gray-100 m-0">
                {{ __('Manage Courses') }}
            </h2>
            <a href="{{ route('admin.courses.create') }}" class="btn btn-primary btn-sm">+ Add New Course</a>
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
                                    <th class="py-2">Instructor</th>
                                    <th class="py-2 text-center">Content / Topics</th>
                                    <th class="py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr class="border-bottom border-dark-subtle">
                                        <td class="py-2">{{ $course->title }}</td>
                                        <td class="py-2">{{ $course->instructor }}</td>
                                        <td class="py-2 text-center">
                                            <a href="{{ route('admin.courses.topics.index', $course) }}" class="link-info text-decoration-none fw-semibold">
                                                Manage ({{ $course->topics->count() }})
                                            </a>
                                        </td>
                                        <td class="py-2">
                                            <a href="{{ route('admin.courses.edit', $course) }}" class="link-info text-decoration-none">Edit</a>
                                            <form method="POST" action="{{ route('admin.courses.destroy', $course) }}" class="d-inline ms-3" onsubmit="return confirm('Are you sure you want to delete this course?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-link link-danger p-0 align-baseline">Delete</button>
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
    </div>
</x-app-layout>