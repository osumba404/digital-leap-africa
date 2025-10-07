@extends('admin.layout')

@section('title', 'Course Topics')

@section('content')
<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Topics for {{ $course->title }}</h2>
        <a href="{{ route('admin.courses.topics.create', $course) }}" 
           class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Add New Topic
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <ul class="divide-y divide-gray-200">
            @forelse($topics as $topic)
                <li class="px-6 py-4 hover:bg-gray-50">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 min-w-0">
                            <div class="text-sm font-medium text-gray-900 truncate">
                                {{ $topic->title }}
                                @if(!$topic->is_active)
                                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        Inactive
                                    </span>
                                @endif
                            </div>
                            @if($topic->description)
                                <p class="text-sm text-gray-500 truncate mt-1">
                                    {{ $topic->description }}
                                </p>
                            @endif
                        </div>
                        <div class="ml-4 flex-shrink-0 flex space-x-2">
                            <a href="{{ route('admin.courses.topics.edit', [$course, $topic]) }}" 
                               class="text-indigo-600 hover:text-indigo-900">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.courses.topics.destroy', [$course, $topic]) }}" method="POST" 
                                  onsubmit="return confirm('Are you sure you want to delete this topic?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            @empty
                <li class="px-6 py-4 text-center text-gray-500">
                    No topics found. Create your first topic!
                </li>
            @endforelse
        </ul>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.courses.edit', $course) }}" 
           class="text-gray-600 hover:text-gray-800 inline-flex items-center">
            <svg class="h-5 w-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Course
        </a>
    </div>
</div>
@endsection