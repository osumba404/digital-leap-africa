<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-primary-light overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <h3 class="text-2xl">Welcome, Admin!</h3>
                    <p class="mt-4">From here you can manage all aspects of the Digital Leap Africa platform.</p>
                    
                    <div class="mt-6 border-t border-gray-700 pt-4 space-y-4">
                        <h4 class="text-lg font-semibold">Content Management</h4>
                        <div>
                            <a href="{{ route('admin.jobs.index') }}" class="text-accent hover:text-white underline">Manage Job Listings</a>
                        </div>
                        <div>
                            <a href="{{ route('admin.courses.index') }}" class="text-accent hover:text-white underline">Manage Courses</a>
                        </div>
                        <div>
                            <a href="{{ route('admin.projects.index') }}" class="text-accent hover:text-white underline">Manage Projects</a>
                        </div>
                        <div>
                            <a href="{{ route('admin.elibrary-resources.index') }}" class="text-accent hover:text-white underline">Manage eLibrary</a>
                        </div>

                        {{-- Add a heading to separate the sections --}}
                        <h4 class="text-lg font-semibold pt-4">Configuration</h4>
                        <div>
                            <a href="{{ route('admin.settings.index') }}" class="text-accent hover:text-white underline">Site Settings</a>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>