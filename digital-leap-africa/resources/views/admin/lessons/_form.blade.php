<div x-data="{ type: '{{ old('type', $lesson->type) ?: 'note' }}' }" class="space-y-6">
    <!-- Title -->
    <div>
        <x-input-label for="title" value="Lesson Title" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $lesson->title)" required />
    </div>
    <!-- Lesson Type -->
    <div>
        <x-input-label for="type" value="Lesson Type" />
        <select x-model="type" id="type" name="type" class="mt-1 block w-full border-gray-600 bg-primary-light text-gray-200 focus:border-accent focus:ring-accent rounded-md shadow-sm">
            <option value="note">Note / Article</option>
            <option value="video">Video</option>
            <option value="assignment">Assignment</option>
            <option value="quiz">Quiz</option>
        </select>
    </div>
    <!-- Content (for Notes/Assignments) -->
    <div x-show="type === 'note' || type === 'assignment'">
        <x-input-label for="content" value="Content / Instructions" />
        <textarea id="content" name="content" class="mt-1 block w-full border-gray-600 bg-primary-light rounded-md shadow-sm text-gray-200" rows="10">{{ old('content', $lesson->content) }}</textarea>
    </div>
    <!-- Video URL (for Videos) -->
    <div x-show="type === 'video'">
        <x-input-label for="video_url" value="Video URL (e.g., YouTube, Vimeo)" />
        <x-text-input id="video_url" name="video_url" type="url" class="mt-1 block w-full" :value="old('video_url', $lesson->video_url)" />
    </div>
    <!-- Resource URL (for Assignments, etc.) -->
    <div x-show="type === 'assignment'">
        <x-input-label for="resource_url" value="Downloadable Resource URL (e.g., PDF)" />
        <x-text-input id="resource_url" name="resource_url" type="url" class="mt-1 block w-full" :value="old('resource_url', $lesson->resource_url)" />
    </div>
    <x-primary-button>{{ $lesson->exists ? 'Update Lesson' : 'Create Lesson' }}</x-primary-button>
</div>