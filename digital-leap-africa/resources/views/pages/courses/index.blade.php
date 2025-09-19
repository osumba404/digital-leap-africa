<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-gray-100 m-0">
            {{ __('Our Courses') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">
            <div class="row g-4">
                @foreach ($courses as $course)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card bg-primary-light h-100 border-0 shadow-sm">
                            <a href="{{ route('courses.show', $course) }}" class="text-decoration-none">
                                <img src="{{ $course->image_url }}" alt="{{ $course->title }}" class="card-img-top" style="height: 12rem; object-fit: cover;">
                            </a>
                            <div class="card-body">
                                <h3 class="h5 text-white mb-1">
                                    <a href="{{ route('courses.show', $course) }}" class="link-light text-decoration-none">{{ $course->title }}</a>
                                </h3>
                                <p class="small text-gray-400 mb-2">By {{ $course->instructor }}</p>
                                <p class="text-gray-300 mb-3">
                                    {{ Str::limit($course->description, 100) }}
                                </p>
                                <div class="d-flex justify-content-end">
                                    <a href="{{ route('courses.show', $course) }}" class="btn btn-secondary text-white">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="col-12">
                    {{ $courses->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>