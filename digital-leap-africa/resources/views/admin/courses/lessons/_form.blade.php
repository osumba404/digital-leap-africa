@php
    $currentType = old('type', $lesson->type ?? 'note');
@endphp

<div class="d-flex flex-column gap-3">
    <!-- Title -->
    <div>
        <x-input-label for="title" value="Lesson Title" />
        <x-text-input id="title" name="title" type="text" class="mt-1" :value="old('title', $lesson->title)" required />
    </div>

    <!-- Lesson Type -->
    <div>
        <x-input-label for="type" value="Lesson Type" />
        <select id="type" name="type" class="form-select bg-primary-light text-gray-200 border-0 mt-1">
            <option value="note" {{ $currentType === 'note' ? 'selected' : '' }}>Note / Article</option>
            <option value="video" {{ $currentType === 'video' ? 'selected' : '' }}>Video</option>
            <option value="assignment" {{ $currentType === 'assignment' ? 'selected' : '' }}>Assignment</option>
            <option value="quiz" {{ $currentType === 'quiz' ? 'selected' : '' }}>Quiz</option>
        </select>
    </div>

    <!-- Content (for Notes/Assignments) -->
    <div id="group-content" class="{{ in_array($currentType, ['note','assignment']) ? '' : 'd-none' }}">
        <x-input-label for="content" value="Content / Instructions" />
        <textarea id="content" name="content" class="form-control bg-primary-light text-gray-200 border-0 mt-1" rows="10">{{ old('content', $lesson->content) }}</textarea>
    </div>

    <!-- Video URL (for Videos) -->
    <div id="group-video" class="{{ $currentType === 'video' ? '' : 'd-none' }}">
        <x-input-label for="video_url" value="Video URL (e.g., YouTube, Vimeo)" />
        <x-text-input id="video_url" name="video_url" type="url" class="mt-1" :value="old('video_url', $lesson->video_url)" />
    </div>

    <!-- Resource URL (for Assignments, etc.) -->
    <div id="group-resource" class="{{ $currentType === 'assignment' ? '' : 'd-none' }}">
        <x-input-label for="resource_url" value="Downloadable Resource URL (e.g., PDF)" />
        <x-text-input id="resource_url" name="resource_url" type="url" class="mt-1" :value="old('resource_url', $lesson->resource_url)" />
    </div>

    <x-primary-button>{{ $lesson->exists ? 'Update Lesson' : 'Create Lesson' }}</x-primary-button>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('type');
    const grpContent = document.getElementById('group-content');
    const grpVideo = document.getElementById('group-video');
    const grpResource = document.getElementById('group-resource');

    function updateVisibility() {
      const t = typeSelect.value;
      grpContent.classList.toggle('d-none', !(t === 'note' || t === 'assignment'));
      grpVideo.classList.toggle('d-none', t !== 'video');
      grpResource.classList.toggle('d-none', t !== 'assignment');
    }
    typeSelect.addEventListener('change', updateVisibility);
  });
</script>