@csrf
<div class="space-y-6">
    <!-- Title -->
    <div>
        <x-input-label for="title" value="Job Title" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" :value="old('title', $job->title ?? '')" required />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>
    <!-- Company -->
    <div>
        <x-input-label for="company" value="Company Name" />
        <x-text-input id="company" name="company" type="text" class="mt-1 block w-full" :value="old('company', $job->company ?? '')" required />
        <x-input-error :messages="$errors->get('company')" class="mt-2" />
    </div>
    <!-- Location -->
    <div>
        <x-input-label for="location" value="Location" />
        <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $job->location ?? '')" required />
        <x-input-error :messages="$errors->get('location')" class="mt-2" />
    </div>
    <!-- Application URL -->
    <div>
        <x-input-label for="application_url" value="Application URL" />
        <x-text-input id="application_url" name="application_url" type="url" class="mt-1 block w-full" :value="old('application_url', $job->application_url ?? '')" required />
        <x-input-error :messages="$errors->get('application_url')" class="mt-2" />
    </div>
    <!-- Description -->
    <div>
        <x-input-label for="description" value="Job Description" />
        <textarea id="description" name="description" class="mt-1 block w-full border-gray-600 bg-primary-light focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-gray-200">{{ old('description', $job->description ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>
    <x-primary-button>{{ isset($job) ? 'Update Job' : 'Create Job' }}</x-primary-button>
</div>