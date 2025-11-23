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

        <div class="form-group" style="margin-top: 1rem;">
            <label for="course_type" class="form-label">Course Type</label>
            <select id="course_type" name="course_type" class="form-control" required>
                <option value="self_paced" {{ old('course_type', $course->course_type ?? 'self_paced') === 'self_paced' ? 'selected' : '' }}>Self-Paced</option>
                <option value="cohort_based" {{ old('course_type', $course->course_type ?? '') === 'cohort_based' ? 'selected' : '' }}>Cohort-Based</option>
            </select>
            <small style="color: var(--cool-gray); font-size: 0.85rem;">Choose whether this is a self-paced or cohort-based course</small>
        </div>

        <div class="form-group" style="margin-top: 1rem;">
            <label class="form-label" for="has_certification">Certification</label>
            <div style="display:flex; align-items:center; gap:0.5rem;">
                <input type="checkbox" id="has_certification" name="has_certification" value="1"
                       {{ old('has_certification', isset($course) ? (int)($course->has_certification ?? 0) : 0) ? 'checked' : '' }}>
                <span style="color: var(--cool-gray);">Award certificate upon course completion</span>
            </div>
        </div>

        <div class="form-group" id="certificate-title-field" style="margin-top: 1rem; display: {{ old('has_certification', isset($course) ? (int)($course->has_certification ?? 0) : 0) ? 'block' : 'none' }};">
            <label for="certificate_title" class="form-label">Certificate Title</label>
            <input type="text" id="certificate_title" name="certificate_title" class="form-control" 
                   value="{{ old('certificate_title', $course->certificate_title ?? '') }}" 
                   placeholder="e.g., Web Development Fundamentals">
            <small style="color: var(--cool-gray); font-size: 0.85rem;">Title that will appear on the certificate</small>
        </div>

        <div id="cohort-fields" style="display: {{ old('course_type', $course->course_type ?? 'self_paced') === 'cohort_based' ? 'block' : 'none' }}; margin-top: 1rem;">
            <div class="form-group">
                <label for="duration_weeks" class="form-label">Duration (Weeks)</label>
                <input type="number" id="duration_weeks" name="duration_weeks" class="form-control" 
                       value="{{ old('duration_weeks', $course->duration_weeks ?? '') }}" 
                       min="1" max="52" placeholder="e.g., 8">
                <small style="color: var(--cool-gray); font-size: 0.85rem;">Course duration in weeks</small>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="start_date" class="form-label">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" 
                           value="{{ old('start_date', $course->start_date ? $course->start_date->format('Y-m-d') : '') }}">
                </div>

                <div class="form-group">
                    <label for="end_date" class="form-label">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" 
                           value="{{ old('end_date', $course->end_date ? $course->end_date->format('Y-m-d') : '') }}">
                </div>
            </div>
        </div>
    </div>

    <div class="form-section">
        <h3 class="form-section-title">Media & Resources</h3>
        
        <div class="form-group">
            <label for="image_url" class="form-label">Course Image</label>
            <input type="file" id="image_url" name="image_url" accept="image/*" class="form-control">
            <small style="color: var(--cool-gray); font-size: 0.85rem;">Upload an image from your computer.</small>
            @if(!empty($course?->image_url_full))
                <div style="margin-top:0.5rem;">
                    <div class="text-muted small">Current image:</div>
                    <img src="{{ $course->image_url_full }}" alt="Course image" style="max-height:140px;border-radius:8px;">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const courseTypeSelect = document.getElementById('course_type');
    const cohortFields = document.getElementById('cohort-fields');
    const isFreeCheckbox = document.getElementById('is_free');
    const priceField = document.getElementById('price-field');
    const hasCertificationCheckbox = document.getElementById('has_certification');
    const certificateTitleField = document.getElementById('certificate-title-field');
    
    // Toggle cohort fields based on course type
    courseTypeSelect.addEventListener('change', function() {
        cohortFields.style.display = this.value === 'cohort_based' ? 'block' : 'none';
    });
    
    // Toggle price field based on is_free checkbox
    isFreeCheckbox.addEventListener('change', function() {
        priceField.style.display = this.checked ? 'none' : 'block';
    });
    
    // Toggle certificate title field based on certification checkbox
    hasCertificationCheckbox.addEventListener('change', function() {
        certificateTitleField.style.display = this.checked ? 'block' : 'none';
    });
});
</script>