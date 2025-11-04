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
    <select id="type" name="type" class="mt-1 block w-100 form-control" text-color="blue">
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
    <div id="quill-editor" style="min-height: 200px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px;"></div>
    <textarea id="content" name="content" class="d-none">{{ old('content', $lesson->content ?? '') }}</textarea>
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
              <button type="button"
                      class="btn btn-sm btn-danger js-del-resource"
                      data-url="{{ route('admin.topics.lessons.resources.destroy', [$topic->course, $topic, $lesson, $loop->index]) }}">
                Remove
              </button>
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
              <button type="button"
                      class="btn btn-sm btn-danger js-del-attachment"
                      data-url="{{ route('admin.topics.lessons.attachments.destroy', [$topic->course, $topic, $lesson, $loop->index]) }}">
                Remove
              </button>
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

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
.ql-toolbar {
    background: rgba(255,255,255,0.08) !important;
    border: 1px solid rgba(255,255,255,0.1) !important;
    border-bottom: none !important;
    border-radius: 8px 8px 0 0 !important;
}
.ql-container {
    background: rgba(255,255,255,0.05) !important;
    border: 1px solid rgba(255,255,255,0.1) !important;
    border-top: none !important;
    border-radius: 0 0 8px 8px !important;
    color: #fff !important;
}
.ql-editor {
    color: #fff !important;
    min-height: 200px;
}
.ql-editor.ql-blank::before {
    color: rgba(255,255,255,0.5) !important;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const quill = new Quill('#quill-editor', {
        theme: 'snow',
        placeholder: 'Enter lesson content...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['blockquote', 'code-block'],
                ['link', 'image'],
                ['clean']
            ]
        }
    });
    

    
    // Set initial content
    const initialContent = document.getElementById('content').value;
    if (initialContent) {
        quill.root.innerHTML = initialContent;
    }
    
    // Update hidden textarea on content change
    quill.on('text-change', function() {
        document.getElementById('content').value = quill.root.innerHTML;
    });
    
    // Update on form submit
    const form = document.getElementById('content').closest('form');
    if (form) {
        form.addEventListener('submit', function() {
            document.getElementById('content').value = quill.root.innerHTML;
        });
    }
});
</script>
@endpush

<script>
  (function initLessonForm(){
    function run(){
      // Inject minimal editor styles once
      (function(){
        if (document.getElementById('cms-style-injected')) return;
        var css = `
        .cms-editor{background:rgba(255,255,255,0.02);border:1px solid rgba(255,255,255,0.12);border-radius:10px;}
        .cms-toolbar{display:flex;flex-wrap:wrap;gap:.25rem;padding:.5rem;border-bottom:1px solid rgba(255,255,255,0.08);background:rgba(0,0,0,.15);border-top-left-radius:10px;border-top-right-radius:10px}
        .cms-btn,.cms-select{appearance:none;background:rgba(255,255,255,0.08);border:1px solid rgba(255,255,255,0.18);color:#fff;border-radius:6px;padding:.4rem .55rem;cursor:pointer;display:inline-flex;align-items:center;gap:.35rem}
        .cms-btn:hover,.cms-select:hover{background:rgba(255,255,255,0.15)}
        .cms-select{padding:.35rem .5rem}
        .cms-divider{width:1px;align-self:stretch;background:rgba(255,255,255,0.12);margin:0 .25rem}
        .cms-flex{margin-left:auto}
        .cms-surface{min-height:260px;padding:1rem;border-bottom-left-radius:10px;border-bottom-right-radius:10px;outline:none}
        .cms-surface pre{background:rgba(0,0,0,.35);border:1px solid rgba(255,255,255,.1);padding:.75rem;border-radius:8px;white-space:pre;overflow:auto}
        .cms-surface code{background:rgba(0,0,0,.35);padding:.05rem .35rem;border-radius:.35rem;font-family:ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace}
        .cms-surface img{max-width:100%;height:auto;border-radius:8px;border:1px solid rgba(255,255,255,0.1)}
        `;
        var style=document.createElement('style');style.id='cms-style-injected';style.textContent=css;document.head.appendChild(style);
      })();

      // Visibility
      const typeSelect = document.getElementById('type');
      const grpContent = document.getElementById('group-content');
      const grpVideo = document.getElementById('group-video');
      const grpResource = document.getElementById('group-resource');
      const grpAttachments = document.getElementById('group-attachments');
      const grpCode = document.getElementById('group-code');

      function updateVisibility() {
        if(!typeSelect) return;
        const t = typeSelect.value;
        const showTextual = (t === 'note' || t === 'assignment');
        grpContent && grpContent.classList.toggle('d-none', !showTextual);
        grpCode && grpCode.classList.toggle('d-none', !showTextual);
        grpVideo && grpVideo.classList.toggle('d-none', t !== 'video');
        grpResource && grpResource.classList.remove('d-none');
        grpAttachments && grpAttachments.classList.remove('d-none');
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
        container && container.appendChild(ta);
      });

      // CMS Editor Init
      const editor = document.getElementById('content-editor');
      const hidden = document.getElementById('content');
      const toolbar = (editor && editor.parentElement) ? editor.parentElement.querySelector('.cms-toolbar') : null;
      const form = hidden ? hidden.closest('form') : null;

      function sync(){ if(hidden && editor){ hidden.value = editor.innerHTML.trim(); } }
      function exec(cmd, val=null){ document.execCommand(cmd, false, val); editor && editor.focus(); sync(); }

      if (toolbar && editor && hidden) {
        toolbar.addEventListener('change', function(e){
          const sel = e.target.closest('[data-cmd="formatBlock"]');
          if (sel) { exec('formatBlock', sel.value); sel.blur(); }
        });
        toolbar.addEventListener('click', function(e){
          const btn = e.target.closest('[data-cmd],[data-action]');
          if (!btn) return;
          const cmd = btn.getAttribute('data-cmd');
          const action = btn.getAttribute('data-action');
          if (cmd) { exec(cmd); return; }
          if (action === 'link') {
            const url = prompt('Enter URL'); if (url) exec('createLink', url);
          } else if (action === 'image') {
            const url = prompt('Enter image URL'); if (url) { exec('insertImage', url); }
          } else if (action === 'inline-code') {
            document.execCommand('insertHTML', false, '<code>'+ (document.getSelection()+'' || 'code') +'</code>'); sync();
          } else if (action === 'clear') {
            exec('removeFormat');
          }
        });

        editor.addEventListener('input', sync);
        editor.addEventListener('paste', function(e){
          e.preventDefault();
          const text = (e.clipboardData || window.clipboardData).getData('text/plain');
          document.execCommand('insertText', false, text);
          sync();
        });
        editor.addEventListener('drop', function(e){
          if(!e.dataTransfer || !e.dataTransfer.files || !e.dataTransfer.files.length) return;
          const file = e.dataTransfer.files[0];
          if(!file.type.startsWith('image/')) return;
          e.preventDefault();
          const reader = new FileReader();
          reader.onload = function(ev){ document.execCommand('insertImage', false, ev.target.result); sync(); };
          reader.readAsDataURL(file);
        });
        // Ensure latest content is submitted even if no interaction
        form && form.addEventListener('submit', sync);
        // Initial sync
        sync();
      }
    }

    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', run, { once: true });
    } else {
      run();
    }
  })();

  // Deletion handlers for resources/attachments to avoid nested forms
  (function(){
    const csrf = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    function del(url, confirmMsg){
      if(!url) return;
      if(!confirm(confirmMsg)) return;
      fetch(url, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json', 'Content-Type': 'application/x-www-form-urlencoded' },
        body: new URLSearchParams({ _method: 'DELETE' })
      }).then(function(){ location.reload(); });
    }
    document.querySelectorAll('.js-del-resource').forEach(function(btn){
      btn.addEventListener('click', function(){ del(btn.dataset.url, 'Remove this resource?'); });
    });
    document.querySelectorAll('.js-del-attachment').forEach(function(btn){
      btn.addEventListener('click', function(){ del(btn.dataset.url, 'Remove this image?'); });
    });
  })();
</script>