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
    
    {{-- Media Insert Toolbar --}}
    <div class="media-toolbar mb-2" style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
      <button type="button" id="insert-video-btn" class="btn btn-sm btn-outline">
        <i class="fas fa-video"></i> Insert Video
      </button>
      <button type="button" id="insert-youtube-btn" class="btn btn-sm btn-outline">
        <i class="fab fa-youtube"></i> Insert YouTube
      </button>
      <button type="button" id="insert-image-btn" class="btn btn-sm btn-outline">
        <i class="fas fa-image"></i> Insert Image
      </button>
    </div>
    
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
    <small class="text-muted d-block mb-2">Paste one or more code blocks. We'll keep formatting.</small>

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

  {{-- Video Options --}}
  <div id="group-video" class="form-group d-none">
    <x-input-label value="Video Content" class="form-label" />
    
    {{-- Video Upload --}}
    <div class="mb-3">
      <label class="form-label">Upload Video File</label>
      <input type="file" name="video_file" accept="video/*" class="mt-1 block w-100 form-control">
      <small class="text-muted">Upload MP4, WebM, or other video formats (max 100MB)</small>
    </div>
    
    {{-- YouTube URL --}}
    <div class="mb-3">
      <label class="form-label">Or YouTube URL</label>
      <x-text-input id="video_url" name="video_url" type="url" class="mt-1 block w-100 form-control" placeholder="https://www.youtube.com/watch?v=..." value="{{ old('video_url', $lesson->video_url ?? '') }}" />
      <small class="text-muted">Paste YouTube URL for embedded player</small>
    </div>
    
    {{-- Video Preview --}}
    <div id="video-preview" class="mt-3" style="display: none;">
      <label class="form-label">Preview:</label>
      <div id="video-preview-container"></div>
    </div>
    
    <x-input-error :messages="$errors->get('video_url')" class="mt-2" />
    <x-input-error :messages="$errors->get('video_file')" class="mt-2" />
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
  
  {{-- Existing Video --}}
  @if(!empty($lesson->video_file_path))
    <div class="form-group">
      <div class="text-sm text-gray-400">Current video:</div>
      <div class="mt-2">
        <video controls style="max-width: 100%; height: 200px; border-radius: 8px;">
          <source src="{{ $lesson->video_file_path }}" type="video/mp4">
          Your browser does not support the video tag.
        </video>
      </div>
    </div>
  @endif

  {{-- Submit --}}
  <div class="d-flex align-items-center gap-2 mt-3">
    <x-primary-button>{{ ($lesson && $lesson->exists) ? 'Update Lesson' : 'Create Lesson' }}</x-primary-button>
    <a href="{{ isset($topic) ? route('admin.topics.lessons.index', [$topic->course, $topic]) : '#' }}" class="btn-outline">Cancel</a>
  </div>
</div>

@push('styles')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
.media-toolbar {
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid rgba(255, 255, 255, 0.1);
  border-radius: 8px 8px 0 0;
  padding: 0.5rem;
}

.media-toolbar .btn {
  font-size: 0.85rem;
  padding: 0.4rem 0.8rem;
}

#quill-lesson-editor {
  border-radius: 0 0 8px 8px !important;
  border-top: none !important;
}

.ql-toolbar {
  border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
  border-left: 1px solid rgba(255, 255, 255, 0.1) !important;
  border-right: 1px solid rgba(255, 255, 255, 0.1) !important;
  background: rgba(255, 255, 255, 0.02);
}

.ql-container {
  border-bottom: 1px solid rgba(255, 255, 255, 0.1) !important;
  border-left: 1px solid rgba(255, 255, 255, 0.1) !important;
  border-right: 1px solid rgba(255, 255, 255, 0.1) !important;
  color: var(--diamond-white);
}

.ql-editor {
  color: var(--diamond-white);
}

[data-theme="light"] .ql-toolbar {
  background: #f8fafc;
  border-color: rgba(46, 120, 197, 0.2) !important;
}

[data-theme="light"] .ql-container {
  border-color: rgba(46, 120, 197, 0.2) !important;
}

[data-theme="light"] .ql-editor {
  color: #1a202c;
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Initialize Quill editor
  const quill = new Quill('#quill-lesson-editor', {
    theme: 'snow',
    modules: {
      toolbar: [
        [{ 'header': [1, 2, 3, false] }],
        ['bold', 'italic', 'underline', 'strike'],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'indent': '-1'}, { 'indent': '+1' }],
        ['link', 'blockquote', 'code-block'],
        [{ 'align': [] }],
        ['clean']
      ]
    },
    placeholder: 'Enter lesson content...'
  });

  // Set initial content
  const contentTextarea = document.getElementById('content');
  if (contentTextarea.value) {
    quill.root.innerHTML = contentTextarea.value;
  }

  // Update hidden textarea when content changes
  quill.on('text-change', function() {
    contentTextarea.value = quill.root.innerHTML;
  });

  // Media toolbar button handlers
  document.getElementById('insert-video-btn').addEventListener('click', function() {
    const filename = prompt('Enter video filename (e.g., video.mp4):');
    if (filename) {
      const range = quill.getSelection();
      if (range) {
        quill.insertText(range.index, `[VIDEO:${filename}]`, 'user');
      } else {
        quill.insertText(quill.getLength(), `[VIDEO:${filename}]`, 'user');
      }
    }
  });

  document.getElementById('insert-youtube-btn').addEventListener('click', function() {
    const url = prompt('Enter YouTube URL:');
    if (url) {
      let videoId = url;
      // Extract video ID from full YouTube URL
      const youtubeMatch = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
      if (youtubeMatch) {
        videoId = youtubeMatch[1];
      }
      
      const range = quill.getSelection();
      if (range) {
        quill.insertText(range.index, `[YOUTUBE:${videoId}]`, 'user');
      } else {
        quill.insertText(quill.getLength(), `[YOUTUBE:${videoId}]`, 'user');
      }
    }
  });

  document.getElementById('insert-image-btn').addEventListener('click', function() {
    const filename = prompt('Enter image filename (e.g., image.jpg):');
    if (filename) {
      const range = quill.getSelection();
      if (range) {
        quill.insertText(range.index, `[IMAGE:${filename}]`, 'user');
      } else {
        quill.insertText(quill.getLength(), `[IMAGE:${filename}]`, 'user');
      }
    }
  });

  // Lesson type change handler
  const typeSelect = document.getElementById('type');
  const videoGroup = document.getElementById('group-video');
  
  function toggleFieldsByType() {
    const selectedType = typeSelect.value;
    
    // Show/hide video fields
    if (selectedType === 'video') {
      videoGroup.classList.remove('d-none');
    } else {
      videoGroup.classList.add('d-none');
    }
  }
  
  typeSelect.addEventListener('change', toggleFieldsByType);
  toggleFieldsByType(); // Initial call

  // YouTube URL preview
  const videoUrlInput = document.getElementById('video_url');
  const videoPreview = document.getElementById('video-preview');
  const videoPreviewContainer = document.getElementById('video-preview-container');
  
  if (videoUrlInput) {
    videoUrlInput.addEventListener('input', function() {
      const url = this.value;
      if (url) {
        const youtubeMatch = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
        if (youtubeMatch) {
          const videoId = youtubeMatch[1];
          videoPreviewContainer.innerHTML = `
            <div style="position: relative; width: 100%; height: 0; padding-bottom: 56.25%; border-radius: 8px; overflow: hidden;">
              <iframe src="https://www.youtube.com/embed/${videoId}" 
                      style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; border: none;" 
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                      allowfullscreen>
              </iframe>
            </div>
          `;
          videoPreview.style.display = 'block';
        } else {
          videoPreview.style.display = 'none';
        }
      } else {
        videoPreview.style.display = 'none';
      }
    });
    
    // Trigger on page load if there's already a value
    if (videoUrlInput.value) {
      videoUrlInput.dispatchEvent(new Event('input'));
    }
  }

  // Add code snippet functionality
  document.getElementById('add-code-snippet').addEventListener('click', function() {
    const container = document.getElementById('code-snippets-container');
    const textarea = document.createElement('textarea');
    textarea.name = 'code_snippet[]';
    textarea.rows = 6;
    textarea.className = 'block w-100 form-control font-mono';
    textarea.placeholder = 'Paste code here...';
    container.appendChild(textarea);
  });
});
</script>
@endpush