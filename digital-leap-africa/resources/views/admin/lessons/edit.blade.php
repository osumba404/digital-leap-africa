<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-100 leading-tight">
            Edit Lesson: <span class="text-accent">{{ $lesson->title }}</span>
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-primary-light shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-100">
                    <form method="POST" action="{{ route('admin.topics.lessons.update', [$topic, $lesson]) }}">
                        @method('PATCH')
                        @csrf
                        @include('admin.lessons._form')
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>