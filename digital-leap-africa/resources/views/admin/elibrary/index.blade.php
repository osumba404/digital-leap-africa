<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-semibold fs-4 text-gray-100 m-0">{{ __('Manage eLibrary') }}</h2>
            <a href="{{ route('admin.elibrary-resources.create') }}" class="btn btn-primary btn-sm">+ Add New Resource</a>
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
                                    <th class="py-2">Type</th>
                                    <th class="py-2">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($elibraryItems as $item)
                                    <tr class="border-bottom border-dark-subtle">
                                        <td class="py-2">{{ $item->title }}</td>
                                        <td class="py-2">{{ $item->type }}</td>
                                        <td class="py-2">
                                            <a href="{{ route('admin.elibrary-resources.edit', $item) }}" class="link-info text-decoration-none">Edit</a>
                                            <form method="POST" action="{{ route('admin.elibrary-resources.destroy', $item) }}" class="d-inline ms-3" onsubmit="return confirm('Are you sure?');">
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