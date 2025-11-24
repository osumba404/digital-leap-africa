@csrf
<div class="d-flex flex-column gap-3">
  <div>
    <x-input-label for="title" value="Title" />
    <x-text-input id="title" name="title" type="text" class="mt-1"
      :value="old('title', $event->title ?? '')" required />
    <x-input-error :messages="$errors->get('title')" class="mt-1" />
  </div>
  <div>
    <x-input-label for="location" value="Location" />
    <x-text-input id="location" name="location" type="text" class="mt-1"
      :value="old('location', $event->location ?? '')" required />
    <x-input-error :messages="$errors->get('location')" class="mt-1" />
  </div>
  <div>
    <x-input-label for="topic" value="Topic (e.g. AI/ML, Web Development)" />
    <x-text-input id="topic" name="topic" type="text" class="mt-1"
      :value="old('topic', $event->topic ?? '')" placeholder="AI/ML" />
    <x-input-error :messages="$errors->get('topic')" class="mt-1" />
  </div>
  <div class="row g-3">
    <div class="col-12 col-md-6">
      <x-input-label for="date" value="Starts At" />
      <x-text-input id="date" name="date" type="datetime-local" class="mt-1"
        :value="old('date', isset($event) && $event->date ? (is_string($event->date) ? \Carbon\Carbon::parse($event->date)->format('Y-m-d\TH:i') : $event->date->format('Y-m-d\TH:i')) : '')" required />
      <x-input-error :messages="$errors->get('date')" class="mt-1" />
    </div>
    <div class="col-12 col-md-6">
      <x-input-label for="ends_at" value="Ends At (optional)" />
      <x-text-input id="ends_at" name="ends_at" type="datetime-local" class="mt-1"
        :value="old('ends_at', isset($event) && $event->ends_at ? (is_string($event->ends_at) ? \Carbon\Carbon::parse($event->ends_at)->format('Y-m-d\TH:i') : $event->ends_at->format('Y-m-d\TH:i')) : '')" />
      <x-input-error :messages="$errors->get('ends_at')" class="mt-1" />
    </div>
  </div>
  <div>
    <x-input-label for="registration_url" value="Registration URL (optional)" />
    <x-text-input id="registration_url" name="registration_url" type="url" class="mt-1"
      :value="old('registration_url', $event->registration_url ?? '')" />
    <x-input-error :messages="$errors->get('registration_url')" class="mt-1" />
  </div>
  <div>
    <x-input-label for="slug" value="Slug (optional; auto-generates if blank)" />
    <x-text-input id="slug" name="slug" type="text" class="mt-1"
      :value="old('slug', $event->slug ?? '')" placeholder="my-awesome-event" />
    <x-input-error :messages="$errors->get('slug')" class="mt-1" />
  </div>
  <div>
    <x-input-label for="image_file" value="Event Image (JPG/PNG/WebP)" />
    <input id="image_file" name="image_file" type="file" accept="image/*" class="form-control bg-primary-light text-gray-200 border-0 mt-1">
    <x-input-error :messages="$errors->get('image_file')" class="mt-1" />

  @if(!empty($event?->image_path))
    <div class="mt-2">
      <div class="text-muted small mb-1">Current image:</div>
      <img src="{{ $event->image_path }}" alt="Current event image" style="max-height:140px;border-radius:8px;" />
    </div>
  @endif
</div>
  <div>
    <x-input-label for="description" value="Description" />
    <textarea id="description" name="description" class="form-control bg-primary-light text-gray-200 border-0 mt-1" rows="6">{{ old('description', $event->description ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-1" />
  </div>
  <x-primary-button>{{ isset($event) ? 'Update Event' : 'Create Event' }}</x-primary-button>
</div>





