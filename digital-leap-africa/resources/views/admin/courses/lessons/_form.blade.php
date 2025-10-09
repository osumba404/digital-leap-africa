<div class="space-y-4">
    <div>
        <x-input-label for="title" value="Lesson Title" />
        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" value="{{ old('title', $lesson->title ?? '') }}" required />
        <x-input-error :messages="$errors->get('title')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="type" value="Lesson Type" />
        <select id="type" name="type" class="mt-1 block w-full">
            @php $selectedType = old('type', $lesson->type ?? 'note'); @endphp
            <option value="note" {{ $selectedType === 'note' ? 'selected' : '' }}>Note</option>
            <option value="video" {{ $selectedType === 'video' ? 'selected' : '' }}>Video</option>
            <option value="assignment" {{ $selectedType === 'assignment' ? 'selected' : '' }}>Assignment</option>
            <option value="quiz" {{ $selectedType === 'quiz' ? 'selected' : '' }}>Quiz</option>
        </select>
        <x-input-error :messages="$errors->get('type')" class="mt-2" />
    </div>

    <div id="group-content">
        <x-input-label for="content" value="Content / Description" />
        <textarea id="content" name="content" rows="5" class="mt-1 block w-full">{{ old('content', $lesson->content ?? '') }}</textarea>
        <x-input-error :messages="$errors->get('content')" class="mt-2" />
    </div>

    <div id="group-code">
        <div class="flex items-center justify-between">
            <x-input-label value="Code Snippets" />
            <button type="button" id="add-code-snippet" class="btn btn-sm btn-outline">+ Add snippet</button>
        </div>
        <div id="code-snippets-container" class="mt-2 space-y-2">
            @foreach (($lesson->code_snippet ?? []) as $code_snippet)
                <textarea name="code_snippet[]" rows="6" class="block w-full font-mono" placeholder="Paste code here...">{{ $code_snippet }}</textarea>
            @endforeach
            {{-- Initial snippet field --}}
            <textarea name="code_snippet[]" rows="6" class="block w-full font-mono" placeholder="Paste code here...">{{ old('code_snippet.0') }}</textarea>
        </div>
        <small class="text-muted">You can paste multiple code snippets. No limit.</small>
        <x-input-error :messages="$errors->get('code_snippet')" class="mt-2" />
    </div>

    <div id="group-video" class="d-none">
        <x-input-label for="video_url" value="Video URL (optional)" />
        <x-text-input id="video_url" name="video_url" type="url" class="mt-1 block w-full" value="{{ old('video_url', $lesson->video_url ?? '') }}" />
        <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
    </div>

    <div id="group-resource" class="mt-2">
        <x-input-label value="Resource Files (any type)" />
        <input type="file" name="resource_files[]" class="mt-1 block w-full" multiple>
        <small class="text-muted">Upload one or more resource files. No limit.</small>
        <x-input-error :messages="$errors->get('resource_files')" class="mt-2" />
    </div>

    @if(!empty($lesson->resource_url))
    <div class="mt-2">
        <div class="text-sm text-gray-400">Existing resources:</div>
        <ul class="list-disc pl-5">
            @foreach (($lesson->resource_url ?? []) as $path)
                <li><a class="text-accent" href="{{ $path }}" target="_blank" rel="noopener">{{ basename($path) }}</a></li>
            @endforeach
        </ul>
    </div>
    @endif

    <div id="group-attachments" class="mt-2">
        <x-input-label value="Image Attachments" />
        <input type="file" name="attachment_images[]" accept="image/*" class="mt-1 block w-full" multiple>
        <small class="text-muted">Upload one or more images. No limit.</small>
        <x-input-error :messages="$errors->get('attachment_images')" class="mt-2" />
    </div>

    @if(!empty($lesson->attachment_path))
    <div class="mt-2">
        <div class="text-sm text-gray-400">Existing images:</div>
        <div class="flex flex-wrap gap-2 mt-1">
            @foreach (($lesson->attachment_path ?? []) as $img)
                <a href="{{ $img }}" target="_blank" rel="noopener">
                <img src="{{ $img }}" alt="Attachment" style="height:70px;border-radius:6px;">
                </a>
            @endforeach
        </div>
    </div>
    @endif

    <div class="mt-4">
        <x-primary-button>{{ ($lesson && $lesson->exists) ? 'Update Lesson' : 'Create Lesson' }}</x-primary-button>
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
      grpResource.classList.remove('d-none');
      grpAttachments.classList.remove('d-none');
    }

    typeSelect && typeSelect.addEventListener('change', updateVisibility);
    updateVisibility();

    const addBtn = document.getElementById('add-code-snippet');
    const container = document.getElementById('code-snippets-container');
    addBtn && addBtn.addEventListener('click', function(){
      const ta = document.createElement('textarea');
      ta.name = 'code_snippet[]';
      ta.rows = 6;
      ta.className = 'block w-full font-mono';
      ta.placeholder = 'Paste code here...';
      container.appendChild(ta);
    });
  });
</script>