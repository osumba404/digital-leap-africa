@extends('admin.layout')

@section('title', 'Manage About Page')

@section('content')
<div class="space-y-8">
    @foreach($sections as $section)
        <div class="bg-gray-50 p-6 rounded-lg shadow">
            <form action="{{ route('admin.content.about.update', $section->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                @method('PUT')
                
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">
                        {{ ucfirst($section->section_type) }} Section
                    </h3>
                    <div class="flex items-center">
                        <label class="inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ $section->is_active ? 'checked' : '' }}>
                            <div class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            <span class="ms-3 text-sm font-medium text-gray-700">Active</span>
                        </label>
                    </div>
                </div>

                @if($section->section_type !== 'mission' && $section->section_type !== 'vision')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label for="mini_title_{{ $section->id }}" class="block text-sm font-medium text-gray-700">Mini Title</label>
                                <input type="text" name="mini_title" id="mini_title_{{ $section->id }}" 
                                       value="{{ old('mini_title', $section->mini_title) }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="title_{{ $section->id }}" class="block text-sm font-medium text-gray-700">Title</label>
                                <input type="text" name="title" id="title_{{ $section->id }}" 
                                       value="{{ old('title', $section->title) }}" required
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                            </div>

                            <div>
                                <label for="content_{{ $section->id }}" class="block text-sm font-medium text-gray-700">Content</label>
                                <textarea name="content" id="content_{{ $section->id }}" rows="6" 
                                          class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">{{ old('content', $section->content) }}</textarea>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Current Image</label>
                                @if($section->image_path)
                                    <img src="{{ asset('storage/' . $section->image_path) }}" alt="{{ $section->title }}" class="mt-2 h-48 w-full object-cover rounded-md">
                                @else
                                    <div class="mt-2 flex items-center justify-center h-48 bg-gray-100 rounded-md">
                                        <span class="text-gray-400">No image uploaded</span>
                                    </div>
                                @endif
                            </div>
                            
                            <div>
                                <label for="image_{{ $section->id }}" class="block text-sm font-medium text-gray-700">Update Image</label>
                                <input type="file" name="image" id="image_{{ $section->id }}" 
                                       class="mt-1 block w-full text-sm text-gray-500
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-md file:border-0
                                              file:text-sm file:font-semibold
                                              file:bg-primary-50 file:text-primary-700
                                              hover:file:bg-primary-100">
                                <p class="mt-1 text-xs text-gray-500">Recommended size: 800x600px</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="space-y-4">
                        <div>
                            <label for="title_{{ $section->id }}" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title_{{ $section->id }}" 
                                   value="{{ old('title', $section->title) }}" required
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">
                        </div>

                        <div>
                            <label for="content_{{ $section->id }}" class="block text-sm font-medium text-gray-700">Content</label>
                            <textarea name="content" id="content_{{ $section->id }}" rows="4" 
                                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-primary-500 focus:ring-primary-500 sm:text-sm">{{ old('content', $section->content) }}</textarea>
                        </div>
                    </div>
                @endif

                <div class="flex justify-end pt-4">
                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        Update {{ ucfirst($section->section_type) }} Section
                    </button>
                </div>
            </form>
        </div>
    @endforeach
</div>

@push('scripts')
<script>
    // Add any necessary JavaScript here
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize any plugins or add event listeners
    });
</script>
@endpush

@endsection
