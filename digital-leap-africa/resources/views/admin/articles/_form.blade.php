@csrf
<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" value="{{ old('title', $article->title) }}" class="form-control @error('title') is-invalid @enderror" required>
    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Excerpt</label>
    <textarea name="excerpt" rows="2" class="form-control @error('excerpt') is-invalid @enderror" placeholder="Short summary (optional)">{{ old('excerpt', $article->excerpt) }}</textarea>
    @error('excerpt')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Tags</label>
    @php $existingTags = is_array(old('tags', $article->tags ?? [])) ? old('tags', $article->tags ?? []) : []; @endphp
    <input type="text" id="tags_input" value="{{ implode(', ', $existingTags) }}" class="form-control @error('tags') is-invalid @enderror" placeholder="e.g. Web Development, JavaScript, Trends, Frontend">
    @error('tags')<div class="invalid-feedback">{{ $message }}</div>@enderror
    <small class="text-muted">Separate tags with commas.</small>
</div>

<div class="mb-3">
    <label class="form-label">Content</label>
    <div id="quill-article-editor" style="min-height: 320px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px;"></div>
    <textarea id="content" name="content" class="d-none">{{ old('content', $article->content) }}</textarea>
    @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>

<div class="mb-3">
    <label class="form-label">Featured Image</label>
    <input id="featured_image_input" type="file" name="featured_image" accept="image/*" class="form-control @error('featured_image') is-invalid @enderror">
    @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror

    <div class="mt-2">
        @if(!empty($article->featured_image))
            <img id="featured_image_preview" src="{{ $article->featured_image_url }}" alt="{{ $article->title }}" style="max-height: 140px; border-radius: 8px; background: #fff;">
        @else
            <img id="featured_image_preview" src="#" alt="Preview" style="display:none; max-height: 140px; border-radius: 8px; background: #fff;">
        @endif
    </div>
</div>

<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" {{ old('published', $article->published_at ? 1 : 0) ? 'checked' : '' }}>
    <label class="form-check-label" for="published">
        Publish immediately
    </label>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>

<script>
(function(){
  var form = document.currentScript.closest('form');
  if(!form) return;
  form.addEventListener('submit', function(){
    var input = document.getElementById('tags_input');
    if(!input) return;
    Array.from(form.querySelectorAll('input[name="tags[]"]')).forEach(function(n){ n.parentNode.removeChild(n); });
    var parts = (input.value || '').split(',');
    parts.map(function(t){ return t.trim(); }).filter(function(t){ return t.length; }).forEach(function(tag){
      var hidden = document.createElement('input');
      hidden.type = 'hidden';
      hidden.name = 'tags[]';
      hidden.value = tag;
      form.appendChild(hidden);
    });
  });
})();
</script>