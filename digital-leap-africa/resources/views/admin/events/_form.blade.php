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
    <x-input-label for="date" value="Date & Time" />
    <x-text-input id="date" name="date" type="datetime-local" class="mt-1"
      :value="old('date', isset($event) && $event->date ? (is_string($event->date) ? \Carbon\Carbon::parse($event->date)->format('Y-m-d\TH:i') : $event->date->format('Y-m-d\TH:i')) : '')" required />
    <x-input-error :messages="$errors->get('date')" class="mt-1" />
  </div>
  <div>
    <x-input-label for="registration_url" value="Registration URL (optional)" />
    <x-text-input id="registration_url" name="registration_url" type="url" class="mt-1"
      :value="old('registration_url', $event->registration_url ?? '')" />
    <x-input-error :messages="$errors->get('registration_url')" class="mt-1" />
  </div>
  <div>
    <x-input-label for="description" value="Description" />
    <textarea id="description" name="description" class="form-control bg-primary-light text-gray-200 border-0 mt-1" rows="6">{{ old('description', $event->description ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-1" />
  </div>
  <x-primary-button>{{ isset($event) ? 'Update Event' : 'Create Event' }}</x-primary-button>
</div>