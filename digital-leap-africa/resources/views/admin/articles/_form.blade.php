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
    <label class="form-label">Content</label>
    <!-- add an id to hook the editor -->
    <textarea id="article-editor" name="content" rows="10" class="form-control @error('content') is-invalid @enderror" required>{{ old('content', $article->content) }}</textarea>
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

<!-- <div class="d-flex gap-2">
    <x-primary-button type="submit">Save</x-primary-button>
    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div> -->

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="{{ route('admin.articles.index') }}" class="btn btn-outline-secondary">Cancel</a>
</div>