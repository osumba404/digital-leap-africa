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
    <div id="quill-lesson-editor" style="min-height: 320px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px;"></div>
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

  {{-- Test/Assignment Questions --}}
  <div id="group-questions" class="form-group d-none">
    <x-input-label for="questions" value="Test/Assignment Questions" class="form-label" />
    <textarea id="questions" name="questions" rows="8" class="mt-1 block w-100 form-control" placeholder="Enter test questions or assignment instructions...">{{ old('questions', $lesson->questions ?? '') }}</textarea>
    <small class="text-muted">Add questions for quiz/test or instructions for assignment.</small>
    <x-input-error :messages="$errors->get('questions')" class="mt-2" />
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
<style>
/* CKEditor Dark Theme */
.ck-editor {
    border: 1px solid rgba(255,255,255,0.1) !important;
    border-radius: 8px !important;
    background: rgba(255,255,255,0.05) !important;
}

.ck-toolbar {
    background: rgba(255,255,255,0.08) !important;
    border: 1px solid rgba(255,255,255,0.1) !important;
    border-bottom: none !important;
    border-radius: 8px 8px 0 0 !important;
}

.ck-toolbar .ck-button {
    color: #fff !important;
}

.ck-toolbar .ck-button:hover {
    background: rgba(0, 201, 255, 0.2) !important;
}

.ck-toolbar .ck-button.ck-on {
    background: rgba(0, 201, 255, 0.3) !important;
}

.ck-content {
    background: rgba(255,255,255,0.05) !important;
    color: #fff !important;
    min-height: 300px !important;
    border-top: none !important;
    border-radius: 0 0 8px 8px !important;
}

.ck-content h1, .ck-content h2, .ck-content h3, .ck-content h4 {
    color: #00C9FF !important;
}

.ck-content blockquote {
    border-left: 4px solid #00C9FF !important;
    background: rgba(0, 201, 255, 0.1) !important;
    margin: 1rem 0 !important;
    padding: 0.5rem 1rem !important;
}

.ck-content pre {
    background: rgba(0, 0, 0, 0.4) !important;
    border: 1px solid rgba(255, 255, 255, 0.1) !important;
    color: #fff !important;
}

.ck-content code {
    background: rgba(0, 0, 0, 0.4) !important;
    color: #00C9FF !important;
}

.ck-content a {
    color: #00C9FF !important;
}

.ck-content table {
    border-collapse: collapse !important;
}

.ck-content table td, .ck-content table th {
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    background: rgba(255, 255, 255, 0.05) !important;
}

.ck-content table th {
    background: rgba(255, 255, 255, 0.1) !important;
    font-weight: bold !important;
}

.ck-content table {
    border-collapse: collapse !important;
    width: calc(100% - 0rem) !important;
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    table-layout: fixed !important;
    margin: 2.5rem 0 !important;
}

.ck-content p + table,
.ck-content ol + table,
.ck-content ul + table,
.ck-content h1 + table,
.ck-content h2 + table,
.ck-content h3 + table {
    margin-top: 3rem !important;
}

.ck-content table td,
.ck-content table th {
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    padding: 12px 16px !important;
    text-align: left !important;
    vertical-align: top !important;
    word-wrap: break-word !important;
    word-break: break-word !important;
    white-space: normal !important;
    overflow-wrap: break-word !important;
    line-height: 1.5 !important;
}

.ck-content table td,
.ck-content table th {
    border: 1px solid rgba(255, 255, 255, 0.3) !important;
    padding: 8px 12px !important;
    vertical-align: top !important;
}

.ck-content table th {
    background: rgba(255, 255, 255, 0.1) !important;
    font-weight: bold !important;
}

@media (max-width: 768px) {
    .ck-content table {
        font-size: 0.9rem !important;
    }
}

/* CKEditor Dropdowns and Panels */
.ck-dropdown__panel {
    background: #252A32 !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5) !important;
}

.ck-list__item {
    color: #fff !important;
    background: transparent !important;
}

.ck-list__item:hover {
    background: rgba(0, 201, 255, 0.2) !important;
    color: #fff !important;
}

.ck-list__item.ck-on {
    background: rgba(0, 201, 255, 0.3) !important;
    color: #fff !important;
}

/* Table Properties Panel */
.ck-form {
    background: #252A32 !important;
    color: #fff !important;
}

.ck-form__header {
    background: #1a1f2e !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.12) !important;
    color: #fff !important;
}

.ck-form__row {
    background: transparent !important;
}

.ck-labeled-field-view__label {
    color: #fff !important;
}

.ck-input {
    background: rgba(255, 255, 255, 0.05) !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    color: #fff !important;
}

.ck-input:focus {
    border-color: #00C9FF !important;
    box-shadow: 0 0 0 2px rgba(0, 201, 255, 0.2) !important;
}

/* Color Picker */
.ck-color-picker {
    background: #252A32 !important;
}

.ck-color-picker__row {
    background: transparent !important;
}

.ck-color-picker__tile {
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
}

.ck-color-picker__tile:hover {
    border-color: #00C9FF !important;
}

/* Balloon Panel */
.ck-balloon-panel {
    background: #252A32 !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5) !important;
}

.ck-balloon-panel .ck-toolbar {
    background: transparent !important;
    border: none !important;
}

/* Context Menu */
.ck-context-menu {
    background: #252A32 !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5) !important;
}

.ck-context-menu__item {
    color: #fff !important;
    background: transparent !important;
}

.ck-context-menu__item:hover {
    background: rgba(0, 201, 255, 0.2) !important;
}

/* Heading Dropdown */
.ck-heading-dropdown .ck-list__item {
    color: #fff !important;
}

.ck-heading-dropdown .ck-list__item:hover {
    background: rgba(0, 201, 255, 0.2) !important;
}

/* Font Size Dropdown */
.ck-font-size-dropdown .ck-list__item {
    color: #fff !important;
}

.ck-font-size-dropdown .ck-list__item:hover {
    background: rgba(0, 201, 255, 0.2) !important;
}

/* Button Dropdown */
.ck-button__dropdown {
    color: #fff !important;
}

/* Split Button */
.ck-splitbutton__arrow {
    color: #fff !important;
}

.ck-splitbutton__arrow:hover {
    background: rgba(0, 201, 255, 0.2) !important;
}

/* Tooltip */
.ck-tooltip {
    background: #1a1f2e !important;
    color: #fff !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
}

.ck-tooltip__text {
    color: #fff !important;
}

/* Table Toolbar */
.ck-table-form {
    background: #252A32 !important;
    color: #fff !important;
}

.ck-table-form__border-style {
    background: transparent !important;
}

.ck-table-form__border-width {
    background: rgba(255, 255, 255, 0.05) !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    color: #fff !important;
}

/* Special Characters Panel */
.ck-special-characters-navigation {
    background: #1a1f2e !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.12) !important;
}

.ck-special-characters-navigation__group {
    color: #fff !important;
    background: transparent !important;
}

.ck-special-characters-navigation__group:hover {
    background: rgba(0, 201, 255, 0.2) !important;
}

.ck-special-characters-navigation__group.ck-on {
    background: rgba(0, 201, 255, 0.3) !important;
}

.ck-special-characters-grid {
    background: #252A32 !important;
}

.ck-special-characters-grid__tile {
    color: #fff !important;
    background: transparent !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
}

.ck-special-characters-grid__tile:hover {
    background: rgba(0, 201, 255, 0.2) !important;
    border-color: #00C9FF !important;
}

/* Force all CKEditor dropdowns and panels to dark theme */
.ck.ck-dropdown__panel,
.ck-dropdown__panel,
.ck.ck-list,
.ck-list,
.ck.ck-balloon-panel,
.ck-balloon-panel {
    background: #252A32 !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    color: #fff !important;
}

/* All list items in dropdowns */
.ck.ck-list__item,
.ck-list__item,
.ck.ck-button,
.ck-button,
.ck.ck-list__item .ck-button,
.ck-list__item .ck-button {
    color: #fff !important;
    background: transparent !important;
}

.ck.ck-list__item:hover,
.ck-list__item:hover,
.ck.ck-button:hover,
.ck-button:hover,
.ck.ck-list__item .ck-button:hover,
.ck-list__item .ck-button:hover {
    background: rgba(0, 201, 255, 0.2) !important;
    color: #fff !important;
}

/* Heading dropdown specific */
.ck.ck-heading-dropdown .ck-list__item,
.ck-heading-dropdown .ck-list__item,
.ck.ck-heading-dropdown .ck-button,
.ck-heading-dropdown .ck-button {
    color: #fff !important;
    background: transparent !important;
}

/* Font size dropdown */
.ck.ck-font-size-dropdown .ck-list__item,
.ck-font-size-dropdown .ck-list__item {
    color: #fff !important;
    background: transparent !important;
}

/* All dropdown buttons and labels */
.ck.ck-dropdown .ck-button .ck-button__label,
.ck-dropdown .ck-button .ck-button__label,
.ck.ck-list__item .ck-button__label,
.ck-list__item .ck-button__label {
    color: #fff !important;
}

/* Table dropdown panels */
.ck.ck-table-properties-form,
.ck-table-properties-form,
.ck.ck-table-cell-properties-form,
.ck-table-cell-properties-form {
    background: #252A32 !important;
    color: #fff !important;
}

/* All form elements in dropdowns */
.ck.ck-form,
.ck-form,
.ck.ck-form__row,
.ck-form__row {
    background: #252A32 !important;
    color: #fff !important;
}

/* Input fields in forms */
.ck.ck-input,
.ck-input,
.ck.ck-input-text,
.ck-input-text {
    background: rgba(255, 255, 255, 0.05) !important;
    border: 1px solid rgba(255, 255, 255, 0.12) !important;
    color: #fff !important;
}

/* Labels in forms */
.ck.ck-label,
.ck-label,
.ck.ck-labeled-field-view__label,
.ck-labeled-field-view__label {
    color: #fff !important;
}

/* Color grids */
.ck.ck-color-grid,
.ck-color-grid,
.ck.ck-color-grid__tile,
.ck-color-grid__tile {
    background: #252A32 !important;
}

/* Override any white backgrounds */
.ck[class*="dropdown"],
.ck[class*="panel"],
.ck[class*="balloon"],
.ck[class*="list"] {
    background: #252A32 !important;
    color: #fff !important;
}

/* Text in all CK elements */
.ck * {
    color: inherit !important;
}

/* Specific overrides for stubborn elements */
.ck.ck-dropdown__panel .ck-list__item,
.ck.ck-dropdown__panel .ck-button,
.ck.ck-balloon-panel .ck-list__item,
.ck.ck-balloon-panel .ck-button {
    color: #fff !important;
    background: transparent !important;
}

.ck.ck-dropdown__panel .ck-list__item:hover,
.ck.ck-dropdown__panel .ck-button:hover,
.ck.ck-balloon-panel .ck-list__item:hover,
.ck.ck-balloon-panel .ck-button:hover {
    background: rgba(0, 201, 255, 0.2) !important;
    color: #fff !important;
}
</style>
@endpush

@push('scripts')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function(){
  var hidden = document.getElementById('content');
  var editorEl = document.getElementById('quill-lesson-editor');
  if(!hidden || !editorEl) return;
  
  // Register inline code format
  var Inline = Quill.import('blots/inline');
  class CodeInline extends Inline {
    static create() {
      let node = super.create();
      node.setAttribute('style', 'background: rgba(255,255,255,0.1); padding: 2px 4px; border-radius: 3px; font-family: monospace;');
      return node;
    }
  }
  CodeInline.blotName = 'code';
  CodeInline.tagName = 'code';
  Quill.register(CodeInline);
  
  var quill = new Quill('#quill-lesson-editor', {
    theme: 'snow',
    placeholder: 'Write your lesson content...',
    modules: { toolbar: {
      container: [
        [{ 'header': [1, 2, 3, false] }],
        ['bold','italic','underline','strike'],
        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
        ['blockquote','code-block'],
        ['link','image','table-insert'],
        [{ 'color': [] }, { 'background': [] }],
        ['code-inline'],
        ['clean']
      ],
      handlers: {
        'table-insert': function() {
          var btn = document.querySelector('.ql-table-insert');
          var existing = document.querySelector('.table-grid-popup');
          if (existing) existing.remove();
          
          var popup = document.createElement('div');
          popup.className = 'table-grid-popup';
          popup.style.cssText = 'position: fixed; background: #fff; border: 1px solid #ccc; padding: 10px; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.2);';
          
          var grid = document.createElement('div');
          grid.style.cssText = 'display: grid; grid-template-columns: repeat(8, 20px); grid-template-rows: repeat(8, 20px); gap: 1px;';
          
          for (var i = 0; i < 64; i++) {
            var cell = document.createElement('div');
            cell.style.cssText = 'width: 20px; height: 20px; border: 1px solid #ddd; cursor: pointer;';
            cell.dataset.row = Math.floor(i / 8) + 1;
            cell.dataset.col = (i % 8) + 1;
            
            cell.onmouseover = function() {
              var r = parseInt(this.dataset.row);
              var c = parseInt(this.dataset.col);
              grid.querySelectorAll('div').forEach(function(d, idx) {
                var dr = Math.floor(idx / 8) + 1;
                var dc = (idx % 8) + 1;
                d.style.background = (dr <= r && dc <= c) ? '#007acc' : '#fff';
              });
            };
            
            cell.onclick = function() {
              var rows = parseInt(this.dataset.row);
              var cols = parseInt(this.dataset.col);
              var range = quill.getSelection();
              if (range) {
                var tableText = '\n';
                for (var r = 0; r < rows; r++) {
                  var rowText = '| ';
                  for (var c = 0; c < cols; c++) {
                    rowText += 'Cell | ';
                  }
                  tableText += rowText + '\n';
                  if (r === 0) {
                    var separator = '| ';
                    for (var c = 0; c < cols; c++) {
                      separator += '--- | ';
                    }
                    tableText += separator + '\n';
                  }
                }
                tableText += '\n';
                quill.insertText(range.index, tableText);
              }
              popup.remove();
            };
            
            grid.appendChild(cell);
          }
          
          popup.appendChild(grid);
          document.body.appendChild(popup);
          
          var rect = btn.getBoundingClientRect();
          popup.style.left = rect.left + 'px';
          popup.style.top = (rect.bottom + 5) + 'px';
          
          setTimeout(function() {
            document.addEventListener('click', function(e) {
              if (!popup.contains(e.target) && e.target !== btn) {
                popup.remove();
              }
            }, { once: true });
          }, 100);
        },
        'code-inline': function() {
          var range = this.quill.getSelection();
          if (range) {
            var text = this.quill.getText(range.index, range.length);
            this.quill.deleteText(range.index, range.length);
            this.quill.insertText(range.index, '`' + text + '`', 'code', true);
          }
        }
      }
    }}
  });
  
  // Style the custom buttons
  setTimeout(() => {
    var codeBtn = document.querySelector('.ql-code-inline');
    if (codeBtn) {
      codeBtn.innerHTML = '<>';
      codeBtn.title = 'Inline Code';
    }
    
    var tableBtn = document.querySelector('.ql-table-insert');
    if (tableBtn) {
      tableBtn.innerHTML = '⊞';
      tableBtn.title = 'Insert Table';
    }
  }, 100);
  
  if (hidden.value) {
    quill.root.innerHTML = hidden.value;
  }
  quill.on('text-change', function(){ hidden.value = quill.root.innerHTML; });
  var form = hidden.closest('form');
  if(form){ form.addEventListener('submit', function(){ hidden.value = quill.root.innerHTML; }); }
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
      const grpQuestions = document.getElementById('group-questions');
      const grpResource = document.getElementById('group-resource');
      const grpAttachments = document.getElementById('group-attachments');
      const grpCode = document.getElementById('group-code');

      function updateVisibility() {
        if(!typeSelect) return;
        const t = typeSelect.value;
        const showTextual = (t === 'note' || t === 'assignment');
        const showQuestions = (t === 'quiz' || t === 'assignment');
        grpContent && grpContent.classList.toggle('d-none', !showTextual);
        grpCode && grpCode.classList.toggle('d-none', !showTextual);
        grpVideo && grpVideo.classList.toggle('d-none', t !== 'video');
        grpQuestions && grpQuestions.classList.toggle('d-none', !showQuestions);
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

      // Remove old CMS editor code - now using CKEditor
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