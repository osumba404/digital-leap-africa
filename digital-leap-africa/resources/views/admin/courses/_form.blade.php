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
                <input type="text" id="instructor" name="instructor" class="form-control" 
                       value="{{ old('instructor', $course->instructor ?? '') }}">
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
    </div>

    <div class="form-section">
        <h3 class="form-section-title">Media & Resources</h3>
        
        <div class="form-group">
            <label for="image_url" class="form-label">Course Image URL</label>
            <input type="url" id="image_url" name="image_url" class="form-control" 
                   value="{{ old('image_url', $course->image_url ?? '') }}">
            <small style="color: var(--cool-gray); font-size: 0.85rem;">
                Enter a URL to an image that represents this course.
            </small>
        </div>
    </div>

    <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
        <a href="{{ route('admin.courses.index') }}" class="btn-outline">Cancel</a>
        <button type="submit" class="btn-primary">
            <i class="fas fa-save me-2"></i>{{ isset($course) ? 'Update Course' : 'Create Course' }}
        </button>
    </div>
</div>