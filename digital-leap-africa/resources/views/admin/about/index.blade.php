@extends('admin.layouts.app')

@section('title', 'About Page Management')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-8">
        <h1 class="text-2xl font-bold text-gray-800">About Page Management</h1>
        <a href="{{ route('admin.about.sections.create') }}" 
           class="bg-primary-600 text-white px-4 py-2 rounded-md hover:bg-primary-700 transition">
            Add New Section
        </a>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="divide-y divide-gray-200">
            @foreach($sections as $section)
            <div class="p-6 hover:bg-gray-50">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-medium text-gray-900">{{ $section->title }}</h3>
                        <p class="text-sm text-gray-500">{{ $section->subtitle }}</p>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.about.sections.edit', $section) }}" 
                           class="text-blue-600 hover:text-blue-900">
                            Edit
                        </a>
                        <form action="{{ route('admin.about.sections.destroy', $section) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900 ml-2">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection