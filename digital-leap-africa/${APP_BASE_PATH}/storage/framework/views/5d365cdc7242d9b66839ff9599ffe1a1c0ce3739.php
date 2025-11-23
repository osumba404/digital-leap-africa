<?php echo csrf_field(); ?>
<div class="mb-3">
    <label class="form-label">Title</label>
    <input type="text" name="title" value="<?php echo e(old('title', $article->title)); ?>" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="mb-3">
    <label class="form-label">Excerpt</label>
    <textarea name="excerpt" rows="2" class="form-control <?php $__errorArgs = ['excerpt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="Short summary (optional)"><?php echo e(old('excerpt', $article->excerpt)); ?></textarea>
    <?php $__errorArgs = ['excerpt'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="mb-3">
    <label class="form-label">Tags</label>
    <?php $existingTags = is_array(old('tags', $article->tags ?? [])) ? old('tags', $article->tags ?? []) : []; ?>
    <input type="text" id="tags_input" value="<?php echo e(implode(', ', $existingTags)); ?>" class="form-control <?php $__errorArgs = ['tags'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="e.g. Web Development, JavaScript, Trends, Frontend">
    <?php $__errorArgs = ['tags'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <small class="text-muted">Separate tags with commas.</small>
</div>

<div class="mb-3">
    <label class="form-label">Content</label>
    <div id="quill-article-editor" style="min-height: 320px; background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px;"></div>
    <textarea id="content" name="content" class="d-none"><?php echo old('content', $article->content); ?></textarea>
    <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>

<div class="mb-3">
    <label class="form-label">Featured Image</label>
    <input id="featured_image_input" type="file" name="featured_image" accept="image/*" class="form-control <?php $__errorArgs = ['featured_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
    <?php $__errorArgs = ['featured_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <div class="mt-2">
        <?php if(!empty($article->featured_image)): ?>
            <img id="featured_image_preview" src="<?php echo e($article->featured_image_url); ?>" alt="<?php echo e($article->title); ?>" style="max-height: 140px; border-radius: 8px; background: #fff;">
        <?php else: ?>
            <img id="featured_image_preview" src="#" alt="Preview" style="display:none; max-height: 140px; border-radius: 8px; background: #fff;">
        <?php endif; ?>
    </div>
</div>

<div class="form-check mb-3">
    <input class="form-check-input" type="checkbox" name="published" id="published" value="1" <?php echo e(old('published', $article->published_at ? 1 : 0) ? 'checked' : ''); ?>>
    <label class="form-check-label" for="published">
        Publish immediately
    </label>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">Save</button>
    <a href="<?php echo e(route('admin.articles.index')); ?>" class="btn btn-outline-secondary">Cancel</a>
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
</script><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\articles\_form.blade.php ENDPATH**/ ?>