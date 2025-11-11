<div class="mb-3">
    <label for="name" class="form-label text-gray-200">Template Name</label>
    <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="name" name="name" value="{{ old('name', $emailTemplate->name ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="subject" class="form-label text-gray-200">Email Subject</label>
    <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="subject" name="subject" value="{{ old('subject', $emailTemplate->subject ?? '') }}" required>
</div>

<div class="mb-3">
    <label for="content" class="form-label text-gray-200">Email Content</label>
    <div id="editor-container" style="height: 300px;"></div>
    <textarea name="content" id="content" style="display: none;">{{ old('content', $emailTemplate->content ?? '') }}</textarea>
    <small class="text-gray-400">Use @{{user.name}}, @{{course.title}}, @{{url}} as placeholders</small>
</div>

<div class="form-check form-switch mb-3">
    <input class="form-check-input" type="checkbox" id="active" name="active" value="1" {{ old('active', $emailTemplate->active ?? true) ? 'checked' : '' }}>
    <label class="form-check-label text-gray-200" for="active">
        Active Template
    </label>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-2"></i>Save Template
    </button>
    <a href="{{ route('admin.email-templates.index') }}" class="btn btn-secondary">Cancel</a>
</div>

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<script>
document.addEventListener('DOMContentLoaded', function() {
    var quill = new Quill('#editor-container', {
        theme: 'snow',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline'],
                ['link'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['clean']
            ]
        }
    });

    var hiddenInput = document.getElementById('content');
    if (hiddenInput.value) {
        quill.root.innerHTML = hiddenInput.value;
    }

    quill.on('text-change', function() {
        hiddenInput.value = quill.root.innerHTML;
    });

    document.querySelector('form').addEventListener('submit', function() {
        hiddenInput.value = quill.root.innerHTML;
    });
});
</script>
@endpush