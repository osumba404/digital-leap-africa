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
    <div id="shadcn-editor" style="min-height: 300px;"></div>
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
<style>
/* shadcn-editor Dark Theme */
.shadcn-editor {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 8px;
    color: #fff;
    min-height: 300px;
}

.shadcn-editor .ProseMirror {
    padding: 1rem;
    outline: none;
    color: #fff;
    min-height: 280px;
}

.shadcn-editor .ProseMirror h1, 
.shadcn-editor .ProseMirror h2, 
.shadcn-editor .ProseMirror h3, 
.shadcn-editor .ProseMirror h4 {
    color: #00C9FF;
    font-weight: bold;
    margin: 1rem 0 0.5rem 0;
}

.shadcn-editor .ProseMirror blockquote {
    border-left: 4px solid #00C9FF;
    background: rgba(0, 201, 255, 0.1);
    margin: 1rem 0;
    padding: 0.5rem 1rem;
}

.shadcn-editor .ProseMirror pre {
    background: rgba(0, 0, 0, 0.4);
    border: 1px solid rgba(255, 255, 255, 0.1);
    padding: 1rem;
    border-radius: 8px;
    overflow-x: auto;
    color: #fff;
}

.shadcn-editor .ProseMirror code {
    background: rgba(0, 0, 0, 0.4);
    color: #00C9FF;
    padding: 0.2rem 0.4rem;
    border-radius: 4px;
}

.shadcn-editor .ProseMirror a {
    color: #00C9FF;
    text-decoration: underline;
}

.shadcn-editor .ProseMirror a:hover {
    color: #7A5FFF;
}

.shadcn-editor .ProseMirror ul, 
.shadcn-editor .ProseMirror ol {
    padding-left: 1.5rem;
}

.shadcn-editor .ProseMirror table {
    border-collapse: collapse;
    width: 100%;
    margin: 1rem 0;
}

.shadcn-editor .ProseMirror table td, 
.shadcn-editor .ProseMirror table th {
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 8px;
    text-align: left;
}

.shadcn-editor .ProseMirror table th {
    background: rgba(255, 255, 255, 0.1);
    font-weight: bold;
}

.shadcn-editor-toolbar {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.1);
    border-bottom: none;
    border-radius: 8px 8px 0 0;
    padding: 0.5rem;
    display: flex;
    gap: 0.25rem;
    flex-wrap: wrap;
}

.shadcn-editor-btn {
    background: rgba(255,255,255,0.08);
    border: 1px solid rgba(255,255,255,0.18);
    color: #fff;
    border-radius: 6px;
    padding: 0.4rem 0.55rem;
    cursor: pointer;
    font-size: 14px;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
}

.shadcn-editor-btn:hover {
    background: rgba(0, 201, 255, 0.2);
}

.shadcn-editor-btn.active {
    background: rgba(0, 201, 255, 0.3);
}

.shadcn-editor-divider {
    width: 1px;
    background: rgba(255,255,255,0.12);
    margin: 0 0.25rem;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editorContainer = document.getElementById('shadcn-editor');
    const contentTextarea = document.getElementById('content');
    
    if (!editorContainer || !contentTextarea) return;
    
    // Create toolbar
    const toolbar = document.createElement('div');
    toolbar.className = 'shadcn-editor-toolbar';
    toolbar.innerHTML = `
        <button type="button" class="shadcn-editor-btn" data-command="bold">𝐁</button>
        <button type="button" class="shadcn-editor-btn" data-command="italic">𝐼</button>
        <button type="button" class="shadcn-editor-btn" data-command="underline">U̲</button>
        <div class="shadcn-editor-divider"></div>
        <button type="button" class="shadcn-editor-btn" data-command="heading1">H1</button>
        <button type="button" class="shadcn-editor-btn" data-command="heading2">H2</button>
        <button type="button" class="shadcn-editor-btn" data-command="heading3">H3</button>
        <div class="shadcn-editor-divider"></div>
        <button type="button" class="shadcn-editor-btn" data-command="bullet_list">• List</button>
        <button type="button" class="shadcn-editor-btn" data-command="ordered_list">1. List</button>
        <button type="button" class="shadcn-editor-btn" data-command="blockquote">❝ Quote</button>
        <div class="shadcn-editor-divider"></div>
        <button type="button" class="shadcn-editor-btn" data-command="link">🔗 Link</button>
        <button type="button" class="shadcn-editor-btn" data-command="code">Code</button>
        <button type="button" class="shadcn-editor-btn" data-command="table">⊞ Table</button>
        <button type="button" class="shadcn-editor-btn" data-command="shape">◊ Shape</button>
    `;
    
    // Create editor wrapper
    const editorWrapper = document.createElement('div');
    editorWrapper.className = 'shadcn-editor';
    
    // Create contenteditable div
    const editor = document.createElement('div');
    editor.className = 'ProseMirror';
    editor.contentEditable = true;
    editor.innerHTML = contentTextarea.value || '<p>Start typing...</p>';
    editor.style.cssText = 'padding: 1rem; outline: none; color: #fff; min-height: 280px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-top: none; border-radius: 0 0 8px 8px;';
    
    editorWrapper.appendChild(editor);
    editorContainer.appendChild(toolbar);
    editorContainer.appendChild(editorWrapper);
    
    // Sync content
    function syncContent() {
        contentTextarea.value = editor.innerHTML;
    }
    
    // Handle input
    editor.addEventListener('input', syncContent);
    editor.addEventListener('paste', function(e) {
        setTimeout(syncContent, 10);
    });
    
    // Toolbar commands
    toolbar.addEventListener('click', function(e) {
        const btn = e.target.closest('[data-command]');
        if (!btn) return;
        
        const command = btn.dataset.command;
        editor.focus();
        
        switch(command) {
            case 'bold':
                document.execCommand('bold');
                break;
            case 'italic':
                document.execCommand('italic');
                break;
            case 'underline':
                document.execCommand('underline');
                break;
            case 'heading1':
                document.execCommand('formatBlock', false, 'h1');
                break;
            case 'heading2':
                document.execCommand('formatBlock', false, 'h2');
                break;
            case 'heading3':
                document.execCommand('formatBlock', false, 'h3');
                break;
            case 'bullet_list':
                document.execCommand('insertUnorderedList');
                break;
            case 'ordered_list':
                document.execCommand('insertOrderedList');
                break;
            case 'blockquote':
                document.execCommand('formatBlock', false, 'blockquote');
                break;
            case 'link':
                const url = prompt('Enter URL:');
                if (url) document.execCommand('createLink', false, url);
                break;
            case 'code':
                document.execCommand('formatBlock', false, 'pre');
                break;
            case 'table':
                insertTable();
                break;
            case 'shape':
                insertShape();
                break;
        }
        
        function insertTable() {
            const rows = prompt('Number of rows:', '3') || '3';
            const cols = prompt('Number of columns:', '3') || '3';
            
            let tableHTML = `<div class="editable-element" style="position: relative; margin: 1rem 0;">
                <div class="edit-controls" style="position: absolute; top: -30px; right: 0; opacity: 0; transition: opacity 0.2s; background: rgba(0,0,0,0.9); border-radius: 4px; padding: 4px; display: flex; gap: 2px;">
                    <button type="button" onclick="editTable(this)" style="background: #00C9FF; border: none; color: white; padding: 4px 8px; font-size: 11px; cursor: pointer; border-radius: 3px;">Edit</button>
                    <button type="button" onclick="deleteElement(this)" style="background: #ff4444; border: none; color: white; padding: 4px 8px; font-size: 11px; cursor: pointer; border-radius: 3px;">Delete</button>
                </div>
                <table style="border-collapse: collapse; width: 100%; border: 1px solid rgba(255,255,255,0.2);">`;
            
            for (let i = 0; i < parseInt(rows); i++) {
                tableHTML += '<tr>';
                for (let j = 0; j < parseInt(cols); j++) {
                    const cellStyle = 'border: 1px solid rgba(255,255,255,0.2); padding: 8px; background: rgba(255,255,255,0.05);';
                    if (i === 0) {
                        tableHTML += `<th style="${cellStyle} font-weight: bold; background: rgba(255,255,255,0.1);">Header ${j + 1}</th>`;
                    } else {
                        tableHTML += `<td style="${cellStyle}">Cell ${i + 1},${j + 1}</td>`;
                    }
                }
                tableHTML += '</tr>';
            }
            tableHTML += '</table></div><p><br></p>';
            
            document.execCommand('insertHTML', false, tableHTML);
            addEditListeners();
        }
        
        function insertShape() {
            const shapes = {
                '1': `<div class="editable-element" style="position: relative; margin: 1rem 0;">
                    <div class="edit-controls" style="position: absolute; top: -30px; right: 0; opacity: 0; transition: opacity 0.2s; background: rgba(0,0,0,0.9); border-radius: 4px; padding: 4px; display: flex; gap: 2px;">
                        <button type="button" onclick="editShape(this)" style="background: #00C9FF; border: none; color: white; padding: 4px 8px; font-size: 11px; cursor: pointer; border-radius: 3px;">Edit</button>
                        <button type="button" onclick="deleteElement(this)" style="background: #ff4444; border: none; color: white; padding: 4px 8px; font-size: 11px; cursor: pointer; border-radius: 3px;">Delete</button>
                    </div>
                    <div class="shape-content" style="width: 200px; height: 100px; border: 2px solid #00C9FF; background: rgba(0,201,255,0.1); display: flex; align-items: center; justify-content: center; color: #00C9FF; font-weight: bold; border-radius: 8px;">Rectangle</div>
                </div>`,
                '2': `<div class="editable-element" style="position: relative; margin: 1rem 0;">
                    <div class="edit-controls" style="position: absolute; top: -30px; right: 0; opacity: 0; transition: opacity 0.2s; background: rgba(0,0,0,0.9); border-radius: 4px; padding: 4px; display: flex; gap: 2px;">
                        <button type="button" onclick="editShape(this)" style="background: #00C9FF; border: none; color: white; padding: 4px 8px; font-size: 11px; cursor: pointer; border-radius: 3px;">Edit</button>
                        <button type="button" onclick="deleteElement(this)" style="background: #ff4444; border: none; color: white; padding: 4px 8px; font-size: 11px; cursor: pointer; border-radius: 3px;">Delete</button>
                    </div>
                    <div class="shape-content" style="width: 150px; height: 150px; border: 2px solid #7A5FFF; background: rgba(122,95,255,0.1); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #7A5FFF; font-weight: bold;">Circle</div>
                </div>`,
                '3': `<div class="editable-element" style="position: relative; margin: 1rem 0;">
                    <div class="edit-controls" style="position: absolute; top: -30px; right: 0; opacity: 0; transition: opacity 0.2s; background: rgba(0,0,0,0.9); border-radius: 4px; padding: 4px; display: flex; gap: 2px;">
                        <button type="button" onclick="editShape(this)" style="background: #00C9FF; border: none; color: white; padding: 4px 8px; font-size: 11px; cursor: pointer; border-radius: 3px;">Edit</button>
                        <button type="button" onclick="deleteElement(this)" style="background: #ff4444; border: none; color: white; padding: 4px 8px; font-size: 11px; cursor: pointer; border-radius: 3px;">Delete</button>
                    </div>
                    <div class="shape-content" style="width: 0; height: 0; border-left: 30px solid #00C9FF; border-top: 15px solid transparent; border-bottom: 15px solid transparent;"></div>
                </div>`,
                '4': `<div class="editable-element" style="position: relative; margin: 1rem 0;">
                    <div class="edit-controls" style="position: absolute; top: -30px; right: 0; opacity: 0; transition: opacity 0.2s; background: rgba(0,0,0,0.9); border-radius: 4px; padding: 4px; display: flex; gap: 2px;">
                        <button type="button" onclick="editShape(this)" style="background: #00C9FF; border: none; color: white; padding: 4px 8px; font-size: 11px; cursor: pointer; border-radius: 3px;">Edit</button>
                        <button type="button" onclick="deleteElement(this)" style="background: #ff4444; border: none; color: white; padding: 4px 8px; font-size: 11px; cursor: pointer; border-radius: 3px;">Delete</button>
                    </div>
                    <div class="shape-content" style="background: rgba(16,185,129,0.1); border-left: 4px solid #10B981; padding: 1rem; border-radius: 0 8px 8px 0;"><strong style="color: #10B981;">💡 Tip:</strong> <span style="color: #fff;">Add your important note here</span></div>
                </div>`,
                '5': `<div class="editable-element" style="position: relative; margin: 1rem 0;">
                    <div class="edit-controls" style="position: absolute; top: -30px; right: 0; opacity: 0; transition: opacity 0.2s; background: rgba(0,0,0,0.9); border-radius: 4px; padding: 4px; display: flex; gap: 2px;">
                        <button type="button" onclick="editShape(this)" style="background: #00C9FF; border: none; color: white; padding: 4px 8px; font-size: 11px; cursor: pointer; border-radius: 3px;">Edit</button>
                        <button type="button" onclick="deleteElement(this)" style="background: #ff4444; border: none; color: white; padding: 4px 8px; font-size: 11px; cursor: pointer; border-radius: 3px;">Delete</button>
                    </div>
                    <div class="shape-content" style="background: rgba(245,158,11,0.1); border-left: 4px solid #F59E0B; padding: 1rem; border-radius: 0 8px 8px 0;"><strong style="color: #F59E0B;">⚠️ Warning:</strong> <span style="color: #fff;">Add your warning message here</span></div>
                </div>`
            };
            
            const choice = prompt('Choose a shape:\n1. Rectangle\n2. Circle\n3. Arrow\n4. Tip Box\n5. Warning Box\n\nEnter number (1-5):');
            
            if (shapes[choice]) {
                document.execCommand('insertHTML', false, shapes[choice] + '<p><br></p>');
                addEditListeners();
            }
        }
        
        syncContent();
    });
    
    // Add edit functionality
    function addEditListeners() {
        document.querySelectorAll('.editable-element').forEach(el => {
            el.addEventListener('mouseenter', () => {
                const controls = el.querySelector('.edit-controls');
                if (controls) controls.style.opacity = '1';
            });
            el.addEventListener('mouseleave', () => {
                const controls = el.querySelector('.edit-controls');
                if (controls) controls.style.opacity = '0';
            });
        });
    }
    
    // Global edit functions
    window.editTable = function(btn) {
        const table = btn.closest('.editable-element').querySelector('table');
        const rows = prompt('Number of rows:', table.rows.length) || table.rows.length;
        const cols = prompt('Number of columns:', table.rows[0].cells.length) || table.rows[0].cells.length;
        const width = prompt('Table width (e.g., 100%, 500px):', '100%') || '100%';
        
        let newHTML = `<table style="border-collapse: collapse; width: ${width}; border: 1px solid rgba(255,255,255,0.2);">`;
        for (let i = 0; i < parseInt(rows); i++) {
            newHTML += '<tr>';
            for (let j = 0; j < parseInt(cols); j++) {
                const cellStyle = 'border: 1px solid rgba(255,255,255,0.2); padding: 8px; background: rgba(255,255,255,0.05);';
                const existingCell = table.rows[i]?.cells[j];
                const cellContent = existingCell ? existingCell.innerHTML : (i === 0 ? `Header ${j + 1}` : `Cell ${i + 1},${j + 1}`);
                if (i === 0) {
                    newHTML += `<th style="${cellStyle} font-weight: bold; background: rgba(255,255,255,0.1);">${cellContent}</th>`;
                } else {
                    newHTML += `<td style="${cellStyle}">${cellContent}</td>`;
                }
            }
            newHTML += '</tr>';
        }
        newHTML += '</table>';
        table.outerHTML = newHTML;
        syncContent();
    };
    
    window.editShape = function(btn) {
        const shapeContent = btn.closest('.editable-element').querySelector('.shape-content');
        const text = prompt('Shape text:', shapeContent.textContent) || shapeContent.textContent;
        const width = prompt('Width (e.g., 200px):', shapeContent.style.width || '200px') || '200px';
        const height = prompt('Height (e.g., 100px):', shapeContent.style.height || '100px') || '100px';
        const position = prompt('Position (left/center/right):', 'left') || 'left';
        
        shapeContent.textContent = text;
        shapeContent.style.width = width;
        shapeContent.style.height = height;
        
        const parent = shapeContent.parentElement;
        if (position === 'center') {
            parent.style.textAlign = 'center';
        } else if (position === 'right') {
            parent.style.textAlign = 'right';
        } else {
            parent.style.textAlign = 'left';
        }
        
        syncContent();
    };
    
    window.deleteElement = function(btn) {
        if (confirm('Delete this element?')) {
            btn.closest('.editable-element').remove();
            syncContent();
        }
    };
    
    // Add listeners on content change
    editor.addEventListener('input', () => {
        setTimeout(addEditListeners, 100);
        syncContent();
    });
    
    // Form submission
    const form = editor.closest('form');
    if (form) {
        form.addEventListener('submit', syncContent);
    }
    
    // Initial setup
    addEditListeners();
    syncContent();
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

      // Remove old CMS editor code - now using shadcn-editor
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