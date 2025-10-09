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
  <!-- Event Image (with Cropper) -->
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

  <!-- Crop workspace -->
  <input type="hidden" name="image_cropped_data" id="image_cropped_data" />
  <div id="cropperContainer" class="mt-3" style="display:none;">
    <div class="row g-3">
      <div class="col-12 col-md-8">
        <div class="ratio ratio-16x9 bg-dark-subtle" style="border-radius:8px;overflow:hidden;">
          <img id="cropperImage" alt="Crop target" style="max-width:100%; display:block;">
        </div>
      </div>
      <div class="col-12 col-md-4">
        <div class="mb-2">
          <div class="text-muted small">Preview</div>
          <div class="crop-preview" style="width:100%;height:160px;overflow:hidden;border-radius:8px;background:#111;border:1px solid rgba(255,255,255,0.1);"></div>
        </div>
        <div class="d-flex gap-2 flex-wrap">
          <button type="button" class="btn btn-sm btn-primary" id="btnApplyCrop">
            <i class="fas fa-crop me-1"></i>Apply Crop
          </button>
          <button type="button" class="btn btn-sm btn-outline-light" id="btnResetCrop">Reset</button>
        </div>
      </div>
    </div>
  </div>
</div>
  <div>
    <x-input-label for="description" value="Description" />
    <textarea id="description" name="description" class="form-control bg-primary-light text-gray-200 border-0 mt-1" rows="6">{{ old('description', $event->description ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('description')" class="mt-1" />
  </div>
  <x-primary-button>{{ isset($event) ? 'Update Event' : 'Create Event' }}</x-primary-button>
</div>





@push('styles')
<link href="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.css" rel="stylesheet" />
<style>
  .crop-preview img { max-width: 100%; }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/cropperjs@1.6.2/dist/cropper.min.js"></script>
<script>
(function(){
  const fileInput = document.getElementById('image_file');
  const container = document.getElementById('cropperContainer');
  const imgEl = document.getElementById('cropperImage');
  const previewBox = document.querySelector('.crop-preview');
  const btnApply = document.getElementById('btnApplyCrop');
  const btnReset = document.getElementById('btnResetCrop');
  const hiddenData = document.getElementById('image_cropped_data');
  let cropper = null;

  function destroyCropper(){
    if (cropper) { cropper.destroy(); cropper = null; }
    imgEl.src = '';
    hiddenData.value = '';
    container.style.display = 'none';
    if (previewBox) previewBox.innerHTML = '';
  }

  fileInput?.addEventListener('change', function(e){
    const file = e.target.files && e.target.files[0];
    if (!file) { destroyCropper(); return; }
    const url = URL.createObjectURL(file);
    imgEl.src = url;
    container.style.display = '';
    imgEl.onload = function() {
      if (cropper) cropper.destroy();
      cropper = new Cropper(imgEl, {
        aspectRatio: 16/9,
        viewMode: 1,
        dragMode: 'move',
        autoCropArea: 1,
        background: false,
        preview: previewBox,
      });
    };
  });

  btnApply?.addEventListener('click', function(){
    if (!cropper) return;
    const canvas = cropper.getCroppedCanvas({
      width: 1600,
      height: 900,
      imageSmoothingQuality: 'high'
    });
    if (!canvas) return;
    hiddenData.value = canvas.toDataURL('image/jpeg', 0.9);
  });

  btnReset?.addEventListener('click', function(){
    destroyCropper();
    if (fileInput) fileInput.value = '';
  });

  const form = fileInput?.closest('form');
  form?.addEventListener('submit', function(){
    if (container.style.display !== 'none' && cropper && !hiddenData.value) {
      const canvas = cropper.getCroppedCanvas({ width: 1600, height: 900, imageSmoothingQuality: 'high' });
      if (canvas) hiddenData.value = canvas.toDataURL('image/jpeg', 0.9);
    }
  });
})();
</script>
@endpush