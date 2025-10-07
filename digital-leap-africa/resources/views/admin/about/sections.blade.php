@extends('admin.about.layout')

@section('about-content')
<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="text-gray-200 m-0">About Page Sections</h5>
        </div>
        
        @foreach($sections as $section)
            <div class="card mb-4 bg-primary-light border-0">
                <div class="card-header bg-primary-dark text-white d-flex justify-content-between align-items-center">
                    <span>{{ ucfirst($section->section_type) }} Section</span>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active_{{ $section->id }}" 
                               {{ $section->is_active ? 'checked' : '' }} disabled>
                        <label class="form-check-label" for="is_active_{{ $section->id }}">
                            {{ $section->is_active ? 'Active' : 'Inactive' }}
                        </label>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.about.sections.update', $section->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-3">
                            <label for="mini_title_{{ $section->id }}" class="form-label text-gray-200">Mini Title</label>
                            <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="mini_title_{{ $section->id }}" 
                                   name="mini_title" value="{{ old('mini_title', $section->mini_title) }}">
                        </div>
                        
                        <div class="mb-3">
                            <label for="title_{{ $section->id }}" class="form-label text-gray-200">Title</label>
                            <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="title_{{ $section->id }}" 
                                   name="title" value="{{ old('title', $section->title) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="content_{{ $section->id }}" class="form-label text-gray-200">Content</label>
                            <textarea class="form-control bg-primary-light border-0 text-gray-200" id="content_{{ $section->id }}" 
                                      name="content" rows="5" required>{{ old('content', $section->content) }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="image_{{ $section->id }}" class="form-label text-gray-200">
                                {{ $section->image_path ? 'Change Image' : 'Upload Image' }}
                            </label>
                            <input class="form-control bg-primary-light border-0 text-gray-200" type="file" 
                                   id="image_{{ $section->id }}" name="image">
                            @if($section->image_path)
                                <div class="mt-2">
                                    <img src="{{ $section->image_url }}" alt="{{ $section->title }}" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            @endif
                        </div>
                        
                        <div class="mb-3">
                            <label for="read_more_url_{{ $section->id }}" class="form-label text-gray-200">Read More URL</label>
                            <input type="url" class="form-control bg-primary-light border-0 text-gray-200" 
                                   id="read_more_url_{{ $section->id }}" name="read_more_url" 
                                   value="{{ old('read_more_url', $section->read_more_url) }}">
                        </div>
                        
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="is_active_switch_{{ $section->id }}" 
                                   name="is_active" value="1" {{ $section->is_active ? 'checked' : '' }}>
                            <label class="form-check-label text-gray-200" for="is_active_switch_{{ $section->id }}">
                                Active
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update {{ ucfirst($section->section_type) }} Section</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

@push('styles')
<style>
    .form-control:focus {
        background-color: #2d3748;
        color: #e2e8f0;
    }
    .form-control {
        color: #e2e8f0;
    }
    .form-control::placeholder {
        color: #a0aec0;
    }
</style>
@endpush
