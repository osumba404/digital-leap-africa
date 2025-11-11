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
      
      var quill = new Quill('#quill-article-editor', {
        theme: 'snow',
        placeholder: 'Write your article content...',
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
              popup.style.cssText = 'position: absolute; background: #fff; border: 1px solid #ccc; padding: 10px; z-index: 1000; box-shadow: 0 2px 10px rgba(0,0,0,0.2);';
              
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
              popup.style.position = 'fixed';
              
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
      
      // Add custom button styling
      var toolbar = quill.getModule('toolbar');
      toolbar.addHandler('code-inline', function() {
        var range = quill.getSelection();
        if (range) {
          var text = quill.getText(range.index, range.length);
          quill.deleteText(range.index, range.length);
          quill.insertText(range.index, '`' + text + '`');
        }
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
