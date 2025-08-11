<div class="space-y-6">
<!-- Title -->
<div>
<x-input-label for="title" value="Resource Title" />
<x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $item->title ?? '')" required />
</div>
<!-- Type -->
<div>
<x-input-label for="type" value="Resource Type (e.g., eBook, Video)" />
<x-text-input id="type" name="type" type="text" class="mt-1 block w-full" :value="old('type', $item->type ?? '')" required />
</div>
<!-- Description -->
<div>
<x-input-label for="description" value="Description" />
<textarea id="description" name="description" class="mt-1 block w-full border-gray-600 bg-primary-light rounded-md shadow-sm text-gray-200" rows="5">{{ old('description', $item->description ?? '') }}</textarea>
</div>
<!-- File URL -->
<div>
<x-input-label for="file_url" value="Resource URL (e.g., PDF link, YouTube URL)" />
<x-text-input id="file_url" name="file_url" type="url" class="mt-1 block w-full" :value="old('file_url', $item->file_url ?? '')" required />
</div>
<!-- Image Upload -->
<div>
<x-input-label for="image_url" value="Cover Image" />
<input id="image_url" name="image_url" type="file" class="mt-1 block w-full text-gray-300">
@if (isset($item) && $item->image_url)
<img src="{{ $item->image_url }}" alt="Current Image" class="w-48 h-auto rounded-md mt-4">
@endif
</div>
<x-primary-button>{{ isset($item->id) ? 'Update Resource' : 'Create Resource' }}</x-primary-button>
</div>