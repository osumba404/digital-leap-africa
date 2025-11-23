

<?php $__env->startSection('admin-content'); ?>
<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="card-header bg-primary-dark text-white">
        <h5 class="m-0">Edit Section</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.about.sections.update', $section)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <div class="mb-3">
                <label for="section_type" class="form-label text-gray-200">Section Type</label>
                <select class="form-control bg-primary-light border-0 text-gray-200" id="section_type" name="section_type" required>
                    <option value="">Select Type</option>
                    <option value="about" <?php echo e(old('section_type', $section->section_type) == 'about' ? 'selected' : ''); ?>>About</option>
                    <option value="mission" <?php echo e(old('section_type', $section->section_type) == 'mission' ? 'selected' : ''); ?>>Mission</option>
                    <option value="vision" <?php echo e(old('section_type', $section->section_type) == 'vision' ? 'selected' : ''); ?>>Vision</option>
                    <option value="values" <?php echo e(old('section_type', $section->section_type) == 'values' ? 'selected' : ''); ?>>Values</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label for="title" class="form-label text-gray-200">Title</label>
                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="title" 
                       name="title" value="<?php echo e(old('title', $section->title)); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="mini_title" class="form-label text-gray-200">Subtitle</label>
                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="mini_title" 
                       name="mini_title" value="<?php echo e(old('mini_title', $section->mini_title)); ?>">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label text-gray-200">Image</label>
                <?php if($section->image_path): ?>
                    <div class="mb-2">
                        <img src="<?php echo e($section->image_url); ?>" alt="<?php echo e($section->title); ?>"
                            class="img-thumbnail" style="max-width: 300px; background: white; padding: 8px;">
                    </div>
                <?php endif; ?>
                <input class="form-control bg-primary-light border-0 text-gray-200" type="file"
                    id="image" name="image" accept="image/*">
                <small class="text-gray-400">Leave empty to keep the current image. Max 4MB.</small>
            </div>
            
            <div class="mb-3">
                <label for="content" class="form-label text-gray-200">Content</label>
                <textarea class="form-control bg-primary-light border-0 text-gray-200" id="content" 
                          name="content" rows="5" required><?php echo e(old('content', $section->content)); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="bullet_points_text" class="form-label text-gray-200">Key Points (one per line)</label>
                <textarea class="form-control bg-primary-light border-0 text-gray-200" id="bullet_points_text" name="bullet_points_text" rows="4" placeholder="Point one&#10;Point two&#10;Point three"><?php echo e(old('bullet_points_text', isset($section->bullet_points) && is_array($section->bullet_points) ? implode("\n", $section->bullet_points) : '')); ?></textarea>
                <small class="text-gray-400">Leave blank if not needed. Each new line becomes a bullet.</small>
            </div>
            
            <div class="mb-3">
                <label for="order" class="form-label text-gray-200">Order</label>
                <input type="number" class="form-control bg-primary-light border-0 text-gray-200" id="order" 
                       name="order" value="<?php echo e(old('order', $section->order)); ?>">
            </div>
            
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="is_active" 
                       name="is_active" value="1" <?php echo e(old('is_active', $section->is_active) ? 'checked' : ''); ?>>
                <label class="form-check-label text-gray-200" for="is_active">
                    Active
                </label>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Section</button>
                <a href="<?php echo e(route('admin.about.sections.index')); ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\about\sections\edit.blade.php ENDPATH**/ ?>