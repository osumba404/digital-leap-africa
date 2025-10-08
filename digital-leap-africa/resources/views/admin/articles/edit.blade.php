@extends('admin.layout')

@section('title', 'Edit Article')

@section('admin-content')
<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h2>Edit Article</h2>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>
    <form method="POST" action="{{ route('admin.articles.update', $article) }}" enctype="multipart/form-data" class="p-3">
        @method('PUT')
        @include('admin.articles._form')
    </form>

    {{-- CKEditor 5 CDN --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <style>
/* Fallback: style the raw textarea before CKEditor initializes */
#article-editor.form-control {
    background-color: #0b1e39;  /* dark navy */
    color: #e6eefc;             /* light text */
    border-color: #1e3a66;
}
#article-editor.form-control::placeholder {
    color: #9fb3d9;
}

/* CKEditor toolbar (the top bar) */
.ck.ck-toolbar {
    background: #12284a;
    border-color: #1e3a66;
    color: #e6eefc;
}
.ck.ck-toolbar .ck-button .ck-icon,
.ck.ck-toolbar .ck-button .ck-button__label {
    color: #e6eefc;
}
.ck.ck-toolbar .ck-button:not(.ck-disabled):hover {
    background: rgba(255,255,255,0.06);
}
.ck.ck-toolbar .ck-separator {
    background: #1e3a66;
}

/* CKEditor content area */
.ck-editor__editable,
.ck-content {
    background-color: #0b1e39 !important;  /* dark navy */
    color: #e6eefc;             /* light text */
    min-height: 320px;
    border-radius: 8px;
}
.ck.ck-editor__main > .ck-editor__editable {
    border-color: #1e3a66;
}

/* Improve readability of elements inside content */
.ck-content h1, .ck-content h2, .ck-content h3, .ck-content h4, .ck-content h5, .ck-content h6 {
    color: #ffffff;
}
.ck-content a {
    color: #8ac7ff;
}
.ck-content blockquote {
    border-left: 4px solid #3b6aa1;
    background: rgba(255,255,255,0.03);
    color: #dbeafe;
    padding-left: .75rem;
}
.ck-content ul, .ck-content ol {
    padding-left: 1.25rem;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let editorInstance = null;

    const textarea = document.getElementById('article-editor');
    if (textarea) {
        ClassicEditor.create(textarea, {
            toolbar: [
                'heading','|',
                'bold','italic','underline','strikethrough','|',
                'bulletedList','numberedList','blockQuote','|',
                'link','insertTable','|',
                'undo','redo'
            ],
            link: { addTargetToExternalLinks: true }
        }).then(editor => {
            editorInstance = editor;

            // Keep textarea in sync as user types (so required passes)
            editor.model.document.on('change:data', () => {
                textarea.value = editor.getData();
            });
        }).catch(console.error);
    }

    const form = document.getElementById('article-form');
    if (form) {
        // Ensure value set before native validation triggers
        const saveBtn = form.querySelector('button[type="submit"]');
        if (saveBtn) {
            saveBtn.addEventListener('click', function () {
                if (editorInstance) {
                    textarea.value = editorInstance.getData();
                }
            });
        }

        // Redundant safety on submit (if needed)
        form.addEventListener('submit', function () {
            if (editorInstance) {
                textarea.value = editorInstance.getData();
            }
        });
    }

    // Live image preview (already present)
    const fileInput = document.getElementById('featured_image_input');
    const previewImg = document.getElementById('featured_image_preview');
    if (fileInput && previewImg) {
        fileInput.addEventListener('change', function (e) {
            const file = e.target.files && e.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = function (ev) {
                previewImg.src = ev.target.result;
                previewImg.style.display = 'block';
            };
            reader.readAsDataURL(file);
        });
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const formEl = document.getElementById('article-form');
    if (formEl) {
        formEl.addEventListener('submit', function () {
            console.log('[ArticleForm] submit fired');
            // ensure CKEditor content synced (kept as you added)
        });
        // Also detect button click for visibility
        const saveBtn = formEl.querySelector('button[type="submit"]');
        if (saveBtn) {
            saveBtn.addEventListener('click', function () {
                console.log('[ArticleForm] save button clicked');
            });
        }
    }
});
</script>
</div>
@endsection
