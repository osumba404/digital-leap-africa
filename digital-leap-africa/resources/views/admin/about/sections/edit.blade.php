@extends('admin.layout')

@section('admin-content')
<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="card-header bg-primary-dark text-white">
        <h5 class="m-0">Edit Section</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.about.sections.update', $section) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label for="section_type" class="form-label text-gray-200">Section Type</label>
                <select class="form-control bg-primary-light border-0 text-gray-200" id="section_type" name="section_type" required>
                    <option value="">Select Type</option>
                    <option value="about" {{ old('section_type', $section->section_type) == 'about' ? 'selected' : '' }}>About</option>
                    <option value="mission" {{ old('section_type', $section->section_type) == 'mission' ? 'selected' : '' }}>Mission</option>
                    <option value="vision" {{ old('section_type', $section->section_type) == 'vision' ? 'selected' : '' }}>Vision</option>
                    <option value="values" {{ old('section_type', $section->section_type) == 'values' ? 'selected' : '' }}>Values</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="title" class="form-label text-gray-200">Title</label>
                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="title" 
                       name="title" value="{{ old('title', $section->title) }}" required>
            </div>
            
            <div class="mb-3">
                <label for="mini_title" class="form-label text-gray-200">Subtitle</label>
                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="mini_title" 
                       name="mini_title" value="{{ old('mini_title', $section->mini_title) }}">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label text-gray-200">Image</label>
                @if($section->image_path)
                    <div class="mb-2">
                        <img src="{{ $section->image_url }}" alt="{{ $section->title }}"
                            class="img-thumbnail" style="max-width: 300px; background: white; padding: 8px;">
                    </div>
                @endif
                <input class="form-control bg-primary-light border-0 text-gray-200" type="file"
                    id="image" name="image" accept="image/*">
                <small class="text-gray-400">Leave empty to keep the current image. Max 4MB.</small>
            </div>
            
            <div class="mb-3">
                <label for="content" class="form-label text-gray-200">Content</label>
                <textarea class="form-control bg-primary-light border-0 text-gray-200" id="content" 
                          name="content" rows="5" required>{{ old('content', $section->content) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="bullet_points_text" class="form-label text-gray-200">Key Points (one per line)</label>
                <textarea class="form-control bg-primary-light border-0 text-gray-200" id="bullet_points_text" name="bullet_points_text" rows="4" placeholder="Point one&#10;Point two&#10;Point three">{{ old('bullet_points_text', isset($section->bullet_points) && is_array($section->bullet_points) ? implode("\n", $section->bullet_points) : '') }}</textarea>
                <small class="text-gray-400">Leave blank if not needed. Each new line becomes a bullet.</small>
            </div>
            
            <div class="mb-3">
                <label for="order" class="form-label text-gray-200">Order</label>
                <input type="number" class="form-control bg-primary-light border-0 text-gray-200" id="order" 
                       name="order" value="{{ old('order', $section->order) }}">
            </div>
            
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="is_active" 
                       name="is_active" value="1" {{ old('is_active', $section->is_active) ? 'checked' : '' }}>
                <label class="form-check-label text-gray-200" for="is_active">
                    Active
                </label>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Section</button>
                <a href="{{ route('admin.about.sections.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection