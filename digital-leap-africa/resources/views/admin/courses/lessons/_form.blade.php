@php
  if (!isset($lesson)) {
      $lesson = new \App\Models\Lesson();
  }
@endphp
<div class="space-y-6">
  {{-- Title --}}
  <div class="form-group">
    <x-input-label for="title" value="Lesson Title" class="form-label" />
    <x-text-input id="title" name="title" type="text" class="mt-1 block w-100 form-control" value="{{ old('title', $lesson->title ?? '') }}" required />
    <x-input-error :messages="$errors->get('title')" class="mt-2" />
  </div>

  {{-- Type --}}
  <div class="form-group">
    <x-input-label for="type" value="Lesson Type" class="form-label" />
    <select id="type" name="type" class="mt-1 block w-100 form-control">
      @php $selectedType = old('type', $lesson->type ?? 'note'); @endphp
      <option value="note" {{ $selectedType === 'note' ? 'selected' : '' }}>Note</option>
      <option value="video" {{ $selectedType === 'video' ? 'selected' : '' }}>Video</option>
      <option value="assignment" {{ $selectedType === 'assignment' ? 'selected' : '' }}>Assignment</option>
      <option value="quiz" {{ $selectedType === 'quiz' ? 'selected' : '' }}>Quiz</option>
    </select>
    <x-input-error :messages="$errors->get('type')" class="mt-2" />
  </div>

  {{-- Content --}}
  <div id="group-content" class="form-group">
    <x-input-label for="content" value="Content / Description" class="form-label" />
    <textarea id="content" name="content" rows="5" class="mt-1 block w-100 form-control" placeholder="Write lesson content or description...">{{ old('content', $lesson->content ?? '') }}</textarea>
    <x-input-error :messages="$errors->get('content')" class="mt-2" />
  </div>

  {{-- Code Snippets --}}
  <div id="group-code" class="form-group">
    <div class="d-flex align-items-center justify-content-between">
      <x-input-label value="Code Snippets" class="form-label m-0" />
      <button type="button" id="add-code-snippet" class="btn btn-sm btn-outline">+ Add snippet</button>
    </div>
    <small class="text-muted d-block mb-2">Paste one or more code blocks. We’ll keep formatting.</small>

    <div id="code-snippets-container" class="d-flex flex-column gap-2">
      @foreach (($lesson->code_snippet ?? []) as $code_snippet)
        <textarea name="code_snippet[]"
                  rows="6"
                  class="block w-100 form-control font-mono"
                  placeholder="Paste code here...">{{ $code_snippet }}</textarea>
      @endforeach
      {{-- Initial snippet field --}}
      <textarea name="code_snippet[]"
                rows="6"
                class="block w-100 form-control font-mono"
                placeholder="Paste code here...">{{ old('code_snippet.0') }}</textarea>
    </div>
    <x-input-error :messages="$errors->get('code_snippet')" class="mt-2" />
  </div>

  {{-- Video URL --}}
  <div id="group-video" class="form-group d-none">
    <x-input-label for="video_url" value="Video URL (optional)" class="form-label" />
    <x-text-input id="video_url" name="video_url" type="url" class="mt-1 block w-100 form-control" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('video_url', $lesson->video_url ?? '') }}" />
    <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
  </div>

  {{-- Resource files --}}
  <div id="group-resource" class="form-group">
    <x-input-label value="Resource Files (any type)" class="form-label" />
    <input type="file" name="resource_files[]" class="mt-1 block w-100 form-control" multiple>
    <small class="text-muted">Upload one or more files (PDFs, ZIPs, etc.).</small>
    <x-input-error :messages="$errors->get('resource_files')" class="mt-2" />
  </div>

  @if(!empty($lesson->resource_url))
    <div class="form-group">
      <div class="text-sm text-gray-400">Existing resources:</div>
      <ul class="list-unstyled m-0 mt-2 d-flex flex-column gap-2">
        @foreach(($lesson->resource_url ?? []) as $path)
          <li class="d-flex align-items-center justify-content-between bg-primary-light p-2 rounded">
            <a class="link-info text-decoration-none" href="{{ $path }}" target="_blank" rel="noopener">
              <i class="fas fa-file-arrow-down me-2"></i>{{ basename($path) }}
            </a>
            @if(isset($topic, $lesson) && $lesson->exists && isset($topic->course))
              <form method="POST"
                    action="{{ route('admin.topics.lessons.resources.destroy', [$topic->course, $topic, $lesson, $loop->index]) }}"
                    onsubmit="return confirm('Remove this resource?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
              </form>
            @endif
          </li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Image attachments --}}
  <div id="group-attachments" class="form-group">
    <x-input-label value="Image Attachments" class="form-label" />
    <input type="file" name="attachment_images[]" accept="image/*" class="mt-1 block w-100 form-control" multiple>
    <small class="text-muted">Upload one or more images. PNG/JPG/WebP supported.</small>
    <x-input-error :messages="$errors->get('attachment_images')" class="mt-2" />
  </div>

  @if(!empty($lesson->attachment_path))
    <div class="form-group">
      <div class="text-sm text-gray-400">Existing images:</div>
      <div class="d-flex flex-column gap-2 mt-2">
        @foreach(($lesson->attachment_path ?? []) as $img)
          <div class="d-flex align-items-center justify-content-between bg-primary-light p-2 rounded">
            <a href="{{ $img }}" target="_blank" rel="noopener" class="d-inline-flex align-items-center gap-2">
              <img src="{{ $img }}" alt="Attachment" style="height:70px;border-radius:6px;">
              <span class="text-muted d-none d-sm-inline">Open</span>
            </a>
            @if(isset($topic, $lesson) && $lesson->exists && isset($topic->course))
              <form method="POST"
                    action="{{ route('admin.topics.lessons.attachments.destroy', [$topic->course, $topic, $lesson, $loop->index]) }}"
                    onsubmit="return confirm('Remove this image?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger">Remove</button>
              </form>
            @endif
          </div>
        @endforeach
      </div>
    </div>
  @endif

  {{-- Submit --}}
  <div class="d-flex align-items-center gap-2 mt-3">
    <x-primary-button>{{ ($lesson && $lesson->exists) ? 'Update Lesson' : 'Create Lesson' }}</x-primary-button>
    @php
      $cancelHref = url()->previous();
      if (isset($topic) && isset($topic->course)) {
        $cancelHref = route('admin.topics.lessons.index', ['course' => $topic->course, 'topic' => $topic]);
      }
    @endphp
    <a href="{{ $cancelHref }}" class="btn btn-outline">Cancel</a>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const typeSelect = document.getElementById('type');
    const grpContent = document.getElementById('group-content');
    const grpVideo = document.getElementById('group-video');
    const grpResource = document.getElementById('group-resource');
    const grpAttachments = document.getElementById('group-attachments');
    const grpCode = document.getElementById('group-code');

    function updateVisibility() {
      const t = typeSelect.value;
      const showTextual = (t === 'note' || t === 'assignment');
      grpContent.classList.toggle('d-none', !showTextual);
      grpCode.classList.toggle('d-none', !showTextual);
      grpVideo.classList.toggle('d-none', t !== 'video');
      // Resources and attachments always visible
      grpResource.classList.remove('d-none');
      grpAttachments.classList.remove('d-none');
    }

    typeSelect && typeSelect.addEventListener('change', updateVisibility);
    updateVisibility();

    // Add new code snippet textarea
    const addBtn = document.getElementById('add-code-snippet');
    const container = document.getElementById('code-snippets-container');
    addBtn && addBtn.addEventListener('click', function(){
      const ta = document.createElement('textarea');
      ta.name = 'code_snippet[]';
      ta.rows = 6;
      ta.className = 'block w-100 form-control font-mono';
      ta.placeholder = 'Paste code here...';
      container.appendChild(ta);
    });
  });
</script>