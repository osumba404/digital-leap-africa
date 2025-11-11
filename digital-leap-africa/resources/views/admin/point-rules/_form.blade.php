<div class="mb-3">
    <label for="name" class="form-label text-gray-200">Rule Name</label>
    <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="name" name="name" value="{{ old('name', $pointRule->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="action" class="form-label text-gray-200">Action</label>
    <select class="form-control bg-primary-light border-0 text-gray-200" id="action" name="action" required>
        <option value="">Select Action</option>
        <option value="lesson_complete" {{ old('action', $pointRule->action ?? '') == 'lesson_complete' ? 'selected' : '' }}>Lesson Complete</option>
        <option value="course_complete" {{ old('action', $pointRule->action ?? '') == 'course_complete' ? 'selected' : '' }}>Course Complete</option>
        <option value="course_enroll" {{ old('action', $pointRule->action ?? '') == 'course_enroll' ? 'selected' : '' }}>Course Enrollment</option>
        <option value="forum_post" {{ old('action', $pointRule->action ?? '') == 'forum_post' ? 'selected' : '' }}>Forum Post</option>
        <option value="forum_reply" {{ old('action', $pointRule->action ?? '') == 'forum_reply' ? 'selected' : '' }}>Forum Reply</option>
        <option value="daily_login" {{ old('action', $pointRule->action ?? '') == 'daily_login' ? 'selected' : '' }}>Daily Login</option>
        <option value="profile_complete" {{ old('action', $pointRule->action ?? '') == 'profile_complete' ? 'selected' : '' }}>Profile Complete</option>
    </select>
</div>

<div class="mb-3">
    <label for="points" class="form-label text-gray-200">Points</label>
    <input type="number" class="form-control bg-primary-light border-0 text-gray-200" id="points" name="points" value="{{ old('points', $pointRule->points ?? '') }}" required>
    <small class="text-gray-400">Use negative numbers for penalties</small>
</div>

<div class="mb-3">
    <label for="description" class="form-label text-gray-200">Description</label>
    <textarea class="form-control bg-primary-light border-0 text-gray-200" id="description" name="description" rows="3">{{ old('description', $pointRule->description ?? '') }}</textarea>
    <small class="text-gray-400">Optional description of when this rule applies</small>
</div>

<div class="form-check form-switch mb-3">
    <input class="form-check-input" type="checkbox" id="active" name="active" value="1" {{ old('active', $pointRule->active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label text-gray-200" for="active">
        Active Rule
    </label>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-2"></i>Save Rule
    </button>
    <a href="{{ route('admin.point-rules.index') }}" class="btn btn-secondary">Cancel</a>
</div>