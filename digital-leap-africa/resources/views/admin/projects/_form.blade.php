{{-- The @csrf token will be in the parent form --}}
<div class="space-y-6">
    <!-- Title -->
    <div>
        <x-input-label for="title" value="Project Title" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $project->title ?? '')" required />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>
    <!-- Description -->
    <div>
        <x-input-label for="description" value="Project Description" />
        <textarea id="description" name="description" class="mt-1 block w-full border-gray-600 bg-primary-light text-gray-200 focus:border-accent focus:ring-accent rounded-md shadow-sm">{{ old('description', $project->description ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>
    <!-- GitHub URL -->
    <div>
        <x-input-label for="github_url" value="GitHub URL (Optional)" />
        <x-text-input id="github_url" name="github_url" type="url" class="mt-1 block w-full" :value="old('github_url', $project->github_url ?? '')" />
        <x-input-error :messages="$errors->get('github_url')" class="mt-2" />
    </div>
    <!-- Image Upload -->
    <div>
        <x-input-label for="image_url" value="Project Image" />
        <input id="image_url" name="image_url" type="file" class="mt-1 block w-full text-gray-300">
        <x-input-error :messages="$errors->get('image_url')" class="mt-2" />
        @if (isset($project) && $project->image_url)
            <div class="mt-4">
                <p class="text-sm text-gray-400">Current Image:</p>
                <img src="{{ $project->image_url }}" alt="Current Image" class="w-48 h-auto rounded-md mt-2">
            </div>
        @endif
    </div>
    <x-primary-button>{{ isset($project->id) ? 'Update Project' : 'Create Project' }}</x-primary-button>
</div>