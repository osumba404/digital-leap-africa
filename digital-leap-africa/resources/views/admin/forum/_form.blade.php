@csrf
<div class="d-flex flex-column gap-3">
  <div>
    <x-input-label for="title" value="Title" />
    <x-text-input id="title" name="title" type="text" class="mt-1"
      :value="old('title', $thread->title ?? '')" required />
    <x-input-error :messages="$errors->get('title')" class="mt-1" />
  </div>
  <div>
    <x-input-label for="body" value="Body" />
    <textarea id="body" name="body" class="form-control bg-primary-light text-gray-200 border-0 mt-1" rows="8">{{ old('body', $thread->body ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('body')" class="mt-1" />
  </div>
  <x-primary-button>{{ isset($thread) ? 'Update Thread' : 'Create Thread' }}</x-primary-button>
</div>