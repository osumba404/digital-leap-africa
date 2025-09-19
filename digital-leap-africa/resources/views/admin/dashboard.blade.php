<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-gray-100 m-0">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="bg-primary-light shadow-sm rounded">
                <div class="p-4 text-gray-200">
                    <h3 class="h4">Welcome, Admin!</h3>
                    <p class="mt-2 mb-0">From here you can manage all aspects of the Digital Leap Africa platform.</p>
                    
                    <div class="mt-3 pt-3 border-top border-dark-subtle d-flex flex-column gap-2">
                        <h4 class="h6 fw-semibold">Content Management</h4>
                        <div>
                            <a href="{{ route('admin.jobs.index') }}" class="link-info text-decoration-none">Manage Job Listings</a>
                        </div>
                        <div>
                            <a href="{{ route('admin.courses.index') }}" class="link-info text-decoration-none">Manage Courses</a>
                        </div>
                        <div>
                            <a href="{{ route('admin.projects.index') }}" class="link-info text-decoration-none">Manage Projects</a>
                        </div>
                        <div>
                            <a href="{{ route('admin.elibrary-resources.index') }}" class="link-info text-decoration-none">Manage eLibrary</a>
                        </div>
                        <div>
                            <a href="{{ route('admin.events.index') }}" class="link-info text-decoration-none">Manage Events</a>
                        </div>
                        <div>
                            <a href="{{ route('admin.forum.index') }}" class="link-info text-decoration-none">Manage Forum</a>
                        </div>

                        <h4 class="h6 fw-semibold pt-2">Configuration</h4>
                        <div>
                            <a href="{{ route('admin.settings.index') }}" class="link-info text-decoration-none">Site Settings</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>