<div class="form-group">
    <label for="badge_name">Badge Name *</label>
    <input 
        type="text" 
        id="badge_name" 
        name="badge_name" 
        class="form-control" 
        value="{{ old('badge_name', $badge->badge_name ?? '') }}" 
        required
    >
    @error('badge_name')
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="description">Description</label>
    <textarea 
        id="description" 
        name="description" 
        class="form-control" 
        rows="4"
        placeholder="Describe what this badge represents and how users can earn it..."
    >{{ old('description', $badge->description ?? '') }}</textarea>
    @error('description')
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="badge_image">Badge Image</label>
    @if(isset($badge) && $badge->img_url)
        <div style="margin-bottom: 1rem;">
            <img src="{{ $badge->img_url }}" alt="Current badge image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 8px; border: 2px solid rgba(0, 201, 255, 0.3);">
            <p style="font-size: 0.85rem; color: var(--cool-gray); margin-top: 0.5rem;">Current image (upload a new one to replace)</p>
        </div>
    @endif
    <input 
        type="file" 
        id="badge_image" 
        name="badge_image" 
        class="form-control" 
        accept="image/*"
    >
    <small style="color: var(--cool-gray); font-size: 0.85rem; display: block; margin-top: 0.5rem;">
        Accepted formats: JPG, PNG, GIF, SVG (Max: 2MB)
    </small>
    @error('badge_image')
        <span class="error-message">{{ $message }}</span>
    @enderror
</div>

<div class="form-actions">
    <button type="submit" class="btn-primary">
        <i class="fas fa-save"></i> {{ isset($badge) ? 'Update Badge' : 'Create Badge' }}
    </button>
    <a href="{{ route('admin.badges.index') }}" class="btn-outline">
        <i class="fas fa-times"></i> Cancel
    </a>
</div>