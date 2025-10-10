<div class="space-y-6">
  {{-- Title --}}
  <div class="form-group">
    <x-input-label for="title" value="Resource Title" class="form-label" />
    <x-text-input
      id="title"
      name="title"
      type="text"
      class="mt-1 block w-100 form-control"
      :value="old('title', $item->title ?? '')"
      required
    />
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
  </div>

  {{-- Type (Dropdown with Other) --}}
  @php
    $presetTypes = ['Book','Video','Tutorial'];
    $currentType = old('type', $item->type ?? '');
    $isPreset = in_array($currentType, $presetTypes, true);
    $initialSelect = $isPreset ? $currentType : 'Other';
    $initialOther = $isPreset ? '' : $currentType;
  @endphp

  <div class="form-group">
    <x-input-label for="type_select" value="Resource Type" class="form-label" />
    <select id="type_select" class="mt-1 block w-100 form-control">
      <option value="Book" {{ $initialSelect === 'Book' ? 'selected' : '' }}>Book</option>
      <option value="Video" {{ $initialSelect === 'Video' ? 'selected' : '' }}>Video</option>
      <option value="Tutorial" {{ $initialSelect === 'Tutorial' ? 'selected' : '' }}>Tutorial</option>
      <option value="Other" {{ $initialSelect === 'Other' ? 'selected' : '' }}>Other</option>
    </select>

    {{-- Final value submitted to backend --}}
    <input type="hidden" id="type" name="type" value="{{ old('type', $item->type ?? '') }}">

    {{-- Custom type when "Other" is selected --}}
    <div id="type_other_wrap" class="mt-2 {{ $initialSelect === 'Other' ? '' : 'd-none' }}">
      <x-input-label for="type_other" value="Specify type" class="form-label" />
      <x-text-input
        id="type_other"
        type="text"
        class="mt-1 block w-100 form-control"
        placeholder="e.g., Guide, Cheatsheet, Podcast..."
        value="{{ old('type_other', $initialOther) }}"
      />
      <small class="text-muted">Will be saved as the resource type.</small>
    </div>

    <x-input-error :messages="$errors->get('type')" class="mt-2" />
  </div>

  {{-- Description --}}
  <div class="form-group">
    <x-input-label for="description" value="Description" class="form-label" />
    <textarea
      id="description"
      name="description"
      rows="5"
      class="mt-1 block w-100 form-control"
      style="background-color: var(--bs-primary-bg-subtle, #0b1220); color: #d1d5db; border-color: #4b5563;"
      placeholder="Write a concise description of this resource..."
    >{{ old('description', $item->description ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-2" />
  </div>

  {{-- Resource URL --}}
  <div class="form-group">
    <x-input-label for="file_url" value="Resource URL (e.g., PDF link, YouTube URL)" class="form-label" />
    <x-text-input
      id="file_url"
      name="file_url"
      type="url"
      class="mt-1 block w-100 form-control"
      :value="old('file_url', $item->file_url ?? '')"
      required
    />
    <x-input-error :messages="$errors->get('file_url')" class="mt-2" />
  </div>

  {{-- Image Upload --}}
  <div class="form-group">
    <x-input-label for="image_url" value="Cover Image" class="form-label" />
    <input
      id="image_url"
      name="image_url"
      type="file"
      class="mt-1 block w-100 form-control"
      accept="image/*"
    />
    @if (isset($item) && !empty($item->image_url))
      <div class="mt-3">
        <img src="{{ $item->image_url }}" alt="Current Image" class="rounded" style="max-width: 240px; height: auto;">
      </div>
    @endif
    <x-input-error :messages="$errors->get('image_url')" class="mt-2" />
  </div>

  {{-- Submit --}}
  <x-primary-button>{{ isset($item->id) ? 'Update Resource' : 'Create Resource' }}</x-primary-button>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const selectEl = document.getElementById('type_select');
    const hiddenType = document.getElementById('type');
    const otherWrap = document.getElementById('type_other_wrap');
    const otherInput = document.getElementById('type_other');

    function syncType() {
      const val = selectEl.value;
      if (val === 'Other') {
        otherWrap.classList.remove('d-none');
        // If custom empty, keep existing hidden value; otherwise set to custom
        const custom = (otherInput.value || '').trim();
        if (custom.length > 0) {
          hiddenType.value = custom;
        } else if (!hiddenType.value || ['Book','Video','Tutorial','Other'].includes(hiddenType.value)) {
          hiddenType.value = '';
        }
      } else {
        otherWrap.classList.add('d-none');
        hiddenType.value = val;
      }
    }

    // Update hidden when custom changes
    otherInput && otherInput.addEventListener('input', function () {
      if (selectEl.value === 'Other') {
        hiddenType.value = otherInput.value.trim();
      }
    });

    // Change handler for select
    selectEl && selectEl.addEventListener('change', syncType);

    // Initial sync
    syncType();
  });
</script>