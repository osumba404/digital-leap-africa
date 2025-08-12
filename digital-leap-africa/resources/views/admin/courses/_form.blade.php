@csrf
<div class="space-y-6">
    <!-- Title -->
    <div>
        <x-input-label for="title" value="Course Title" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $course->title ?? '')" required />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>
    <!-- Instructor -->
    <div>
        <x-input-label for="instructor" value="Instructor Name" />
        <x-text-input id="instructor" name="instructor" type="text" class="mt-1 block w-full" :value="old('instructor', $course->instructor ?? '')" required />
        <x-input-error :messages="$errors->get('instructor')" class="mt-2" />
    </div>
    <!-- Description -->
    <div>
        <x-input-label for="description" value="Course Description" />
        <textarea id="description" name="description" class="mt-1 block w-full border-gray-600 bg-primary-light text-gray-200 focus:border-accent focus:ring-accent rounded-md shadow-sm">{{ old('description', $course->description ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>
    <!-- Image Upload -->
    <div>
        <x-input-label for="image_url" value="Course Image" />
        <input id="image_url" name="image_url" type="file" class="mt-1 block w-full text-gray-300">
        <x-input-error :messages="$errors->get('image_url')" class="mt-2" />
        @if (isset($course) && $course->image_url)
            <div class="mt-4">
                <p class="text-sm text-gray-400">Current Image:</p>
                <img src="{{ $course->image_url }}" alt="Current Image" class="w-48 h-auto rounded-md mt-2">
            </div>
        @endif
    </div>
    <x-primary-button>{{ isset($course) ? 'Update Course' : 'Create Course' }}</x-primary-button>
</div>