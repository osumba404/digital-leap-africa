@extends('admin.layout')

@section('title', 'New Article')

@section('admin-content')
<div class="admin-card">
    <div class="admin-card-header d-flex justify-content-between align-items-center">
        <h2>Create Article</h2>
        <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Back</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mx-3 mt-3">
            <strong>There were some problems with your submission:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="article-form" method="POST" action="{{ route('admin.articles.store') }}" enctype="multipart/form-data" class="p-3">
        @csrf
        @include('admin.articles._form')
    </form>

    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function(){
      var hidden = document.getElementById('content');
      var editorEl = document.getElementById('quill-article-editor');
      if(!hidden || !editorEl) return;
      var quill = new Quill('#quill-article-editor', {
        theme: 'snow',
        placeholder: 'Write your article content...',
        modules: { toolbar: [
          [{ 'header': [1, 2, 3, false] }],
          ['bold','italic','underline','strike'],
          [{ 'list': 'ordered' }, { 'list': 'bullet' }],
          ['blockquote','code-block'],
          ['link','image'],
          ['clean']
        ]}
      });
      if (hidden.value) {
        quill.root.innerHTML = hidden.value;
      }
      quill.on('text-change', function(){ hidden.value = quill.root.innerHTML; });
      var form = hidden.closest('form');
      if(form){ form.addEventListener('submit', function(){ hidden.value = quill.root.innerHTML; }); }

      // Live image preview remains
      var fileInput = document.getElementById('featured_image_input');
      var previewImg = document.getElementById('featured_image_preview');
      if (fileInput && previewImg) {
        fileInput.addEventListener('change', function (e) {
          var file = e.target.files && e.target.files[0];
          if (!file) return;
          var reader = new FileReader();
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
            // Quill sync handled above
        });
    }
});
</script>

</div>
@endsection
