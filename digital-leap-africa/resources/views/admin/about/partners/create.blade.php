@extends('admin.layout')

@section('admin-content')
<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="card-header bg-primary-dark text-white">
        <h5 class="m-0">Add New Partner</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.about.partners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="name" class="form-label text-gray-200">Partner Name *</label>
                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="name" 
                       name="name" value="{{ old('name') }}" required>
            </div>
            
            <div class="mb-3">
                <label for="logo" class="form-label text-gray-200">Logo *</label>
                <input class="form-control bg-primary-light border-0 text-gray-200" type="file" 
                       id="logo" name="logo" accept="image/*" required>
                <small class="text-gray-400">Max size: 2MB. Formats: JPEG, PNG, JPG, GIF</small>
            </div>
            
            <div class="mb-3">
                <label for="website_url" class="form-label text-gray-200">Website URL</label>
                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="website_url" 
                       name="website_url" value="{{ old('website_url') }}" placeholder="https://example.com">
            </div>
            
            <div class="mb-3">
                <label for="order" class="form-label text-gray-200">Order</label>
                <input type="number" class="form-control bg-primary-light border-0 text-gray-200" id="order" 
                       name="order" value="{{ old('order', 0) }}">
            </div>
            
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="is_active" 
                       name="is_active" value="1" checked>
                <label class="form-check-label text-gray-200" for="is_active">
                    Active
                </label>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Add Partner</button>
                <a href="{{ route('admin.about.partners.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection