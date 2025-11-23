

<?php $__env->startSection('admin-content'); ?>
<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="card-header bg-primary-dark text-white">
        <h5 class="m-0">Edit Partner</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.about.partners.update', $partner)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <div class="mb-3">
                <label for="name" class="form-label text-gray-200">Partner Name *</label>
                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="name" 
                       name="name" value="<?php echo e(old('name', $partner->name)); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="logo" class="form-label text-gray-200">Logo</label>
                <?php if($partner->logo_path): ?>
                    <div class="mb-2">
                        <img src="<?php echo e(Storage::url($partner->logo_path)); ?>" alt="<?php echo e($partner->name); ?>" 
                             class="img-thumbnail" style="max-width: 150px; background: white; padding: 10px;">
                    </div>
                <?php endif; ?>
                <input class="form-control bg-primary-light border-0 text-gray-200" type="file" 
                       id="logo" name="logo" accept="image/*">
                <small class="text-gray-400">Leave empty to keep current logo. Max size: 2MB.</small>
            </div>
            
            <div class="mb-3">
                <label for="website_url" class="form-label text-gray-200">Website URL</label>
                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="website_url" 
                       name="website_url" value="<?php echo e(old('website_url', $partner->website_url)); ?>" placeholder="https://example.com">
            </div>
            
            <div class="mb-3">
                <label for="order" class="form-label text-gray-200">Order</label>
                <input type="number" class="form-control bg-primary-light border-0 text-gray-200" id="order" 
                       name="order" value="<?php echo e(old('order', $partner->order)); ?>">
            </div>
            
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="is_active" 
                       name="is_active" value="1" <?php echo e(old('is_active', $partner->is_active) ? 'checked' : ''); ?>>
                <label class="form-check-label text-gray-200" for="is_active">
                    Active
                </label>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Partner</button>
                <a href="<?php echo e(route('admin.about.partners.index')); ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\about\partners\edit.blade.php ENDPATH**/ ?>