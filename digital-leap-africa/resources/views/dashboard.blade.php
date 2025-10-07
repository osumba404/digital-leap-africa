<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-gray-800 m-0">
            {{ __('My Learning Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            {{-- Personalized Welcome and Progress Status --}}
            <div class="mb-4">
                {{-- Assumes you are using Laravel Auth and the Auth facade is available --}}
                <h1 class="text-3xl font-bold text-gray-900 mb-2">
                    Welcome back, {{ Auth::user()->name ?? 'Learner' }}!
                </h1>
                <p class="text-gray-600">
                    Keep up the great work! Ready to take the next **Leap**?
                </p>
            </div>

            {{-- Key Learning Metrics (Stat Cards) --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Card 1: Courses Enrolled --}}
                <div class="bg-white p-5 shadow-lg rounded-xl border-l-4 border-indigo-500">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-500 uppercase">Courses Enrolled</p>
                            {{-- Replace '5' with actual dynamic data (e.g., $coursesEnrolled) --}}
                            <p class="h2 font-bold text-gray-900 mt-1">5</p>
                        </div>
                        <i class="bi bi-book-fill fs-3 text-indigo-400"></i>
                    </div>
                </div>

                {{-- Card 2: Modules Completed --}}
                <div class="bg-white p-5 shadow-lg rounded-xl border-l-4 border-green-500">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-500 uppercase">Modules Completed</p>
                            {{-- Replace '42' with actual dynamic data (e.g., $modulesCompleted) --}}
                            <p class="h2 font-bold text-gray-900 mt-1">42</p>
                        </div>
                        <i class="bi bi-check-circle-fill fs-3 text-green-400"></i>
                    </div>
                </div>

                {{-- Card 3: Next Certification --}}
                <div class="bg-white p-5 shadow-lg rounded-xl border-l-4 border-yellow-500">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <p class="text-sm font-semibold text-gray-500 uppercase">Certification Progress</p>
                            {{-- Replace '75%' with actual dynamic data (e.g., $certProgress) --}}
                            <p class="h2 font-bold text-gray-900 mt-1">75%</p>
                        </div>
                        <i class="bi bi-patch-check-fill fs-3 text-yellow-400"></i>
                    </div>
                </div>
            </div>

            {{-- Main Content Area: Quick Access to Courses or Progress Chart --}}
            <div class="bg-white overflow-hidden shadow-xl rounded-xl">
                <div class="p-6 text-gray-900">
                    <h3 class="fw-semibold text-xl mb-3 border-bottom pb-2">Continue Learning</h3>
                    
                    {{-- This section can show the last course the user was on --}}
                    <div class="d-flex align-items-center justify-content-between p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="text-lg font-medium text-gray-800">Introduction to Digital Marketing</p>
                            <p class="text-sm text-gray-500">Module 3: SEO Basics (70% Complete)</p>
                        </div>
                        <a href="/courses/123/module/3" class="btn btn-primary">
                            Resume Course
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>