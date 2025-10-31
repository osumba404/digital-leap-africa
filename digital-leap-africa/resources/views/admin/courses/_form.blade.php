<div class="admin-form">
    <div class="form-section">
        <h3 class="form-section-title">Course Information</h3>
        
        <div class="form-group">
            <label for="title" class="form-label">Course Title</label>
            <input type="text" id="title" name="title" class="form-control" 
                   value="{{ old('title', $course->title ?? '') }}" required>
        </div>

        <div class="form-group">
            <label for="slug" class="form-label">URL Slug</label>
            <input type="text" id="slug" name="slug" class="form-control" 
                   value="{{ old('slug', $course->slug ?? '') }}" required>
            <small style="color: var(--cool-gray); font-size: 0.85rem;">
                Used in the course URL. Leave blank to auto-generate from title.
            </small>
        </div>

        <div class="form-group">
            <label for="description" class="form-label">Description</label>
            <textarea id="description" name="description" class="form-control" rows="4" required>{{ old('description', $course->description ?? '') }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
            <div class="form-group">
                <label for="instructor" class="form-label">Instructor</label>
                <select id="instructor" name="instructor" class="form-control" required>
                    <option value="">Select Instructor</option>
                    @foreach(($instructors ?? []) as $instructor)
                        <option value="{{ $instructor->name }}" 
                            {{ old('instructor', $course->instructor ?? '') === $instructor->name ? 'selected' : '' }}>
                            {{ $instructor->name }}
                        </option>
                    @endforeach
                </select>
                <small style="color: var(--cool-gray); font-size: 0.85rem;">Sourced from users with role "admin".</small>
            </div>

            <div class="form-group">
                <label for="level" class="form-label">Difficulty Level</label>
                <select id="level" name="level" class="form-control">
                    <option value="">Select Level</option>
                    <option value="beginner" {{ old('level', $course->level ?? '') === 'beginner' ? 'selected' : '' }}>Beginner</option>
                    <option value="intermediate" {{ old('level', $course->level ?? '') === 'intermediate' ? 'selected' : '' }}>Intermediate</option>
                    <option value="advanced" {{ old('level', $course->level ?? '') === 'advanced' ? 'selected' : '' }}>Advanced</option>
                </select>
            </div>
        </div>

        <div class="form-group" style="margin-top: 0.5rem;">
            <label class="form-label" for="active">Active</label>
            <div style="display:flex; align-items:center; gap:0.5rem;">
                <input type="checkbox" id="active" name="active" value="1" 
                       {{ old('active', isset($course) ? (int)($course->active ?? 1) : 1) ? 'checked' : '' }}>
                <span style="color: var(--cool-gray);">Toggle to make this course active/inactive</span>
            </div>
        </div>

        <div class="form-group" style="margin-top: 0.5rem;">
            <label class="form-label" for="is_free">Is Free</label>
            <div style="display:flex; align-items:center; gap:0.5rem;">
                <input type="checkbox" id="is_free" name="is_free" value="1"
                       {{ old('is_free', isset($course) ? (int)($course->is_free ?? 0) : 0) ? 'checked' : '' }}>
                <span style="color: var(--cool-gray);">Toggle if this course is free</span>
            </div>
        </div>

        <div class="form-group" id="price-field" style="margin-top: 1rem; display: {{ old('is_free', isset($course) ? (int)($course->is_free ?? 0) : 0) ? 'none' : 'block' }};">
            <label for="price" class="form-label">Price (KES)</label>
            <input type="number" id="price" name="price" class="form-control" 
                   value="{{ old('price', $course->price ?? 0) }}" 
                   min="0" step="0.01" placeholder="0.00">
            <small style="color: var(--cool-gray); font-size: 0.85rem;">Enter the course price in Kenyan Shillings (KES)</small>
        </div>
    </div>

    <div class="form-section">
        <h3 class="form-section-title">Media & Resources</h3>
        
        <div class="form-group">
            <label for="image_url" class="form-label">Course Image</label>
            <input type="file" id="image_url" name="image_url" accept="image/*" class="form-control">
            <small style="color: var(--cool-gray); font-size: 0.85rem;">Upload an image from your computer.</small>
            @if(!empty($course?->image_url))
                <div style="margin-top:0.5rem;">
                    <div class="text-muted small">Current image:</div>
                    <img src="{{ $course->image_url }}" alt="Course image" style="max-height:140px;border-radius:8px;">
                </div>
            @endif
        </div>
    </div>

    <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
        <a href="{{ route('admin.courses.index') }}" class="btn-outline">Cancel</a>
        <button type="submit" class="btn-primary">
            <i class="fas fa-save me-2"></i>{{ isset($course) ? 'Update Course' : 'Create Course' }}
        </button>
    </div>
</div>