@extends('admin.layout')

@section('title', 'Edit Topic')

@section('content')
    <div class="p-6">
        <h2 class="text-2xl font-semibold mb-4">Edit Topic: {{ $topic->title }}</h2>
        
        <form action="{{ route('admin.courses.topics.update', [$course, $topic]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Title
                </label>
                <input type="text" name="title" id="title" value="{{ old('title', $topic->title) }}" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                    Description
                </label>
                <textarea name="description" id="description" rows="3"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ old('description', $topic->description) }}</textarea>
            </div>
            
            <div class="mb-4">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" 
                        {{ $topic->is_active ? 'checked' : '' }}
                        class="form-checkbox">
                    <span class="ml-2 text-gray-700">Active</span>
                </label>
            </div>
            
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Topic
                </button>
                <a href="{{ route('admin.courses.edit', $course) }}" class="text-gray-600 hover:text-gray-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
@endsection