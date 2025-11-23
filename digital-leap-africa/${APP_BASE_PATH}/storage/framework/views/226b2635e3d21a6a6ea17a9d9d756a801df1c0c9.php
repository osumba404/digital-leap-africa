

<?php $__env->startSection('admin-content'); ?>
<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="card-header bg-primary-dark text-white">
        <h5 class="m-0">Edit Team Member</h5>
    </div>
    <div class="card-body">
        <form action="<?php echo e(route('admin.about.team.update', $teamMember)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <div class="mb-3">
                <label for="name" class="form-label text-gray-200">Name *</label>
                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="name" 
                       name="name" value="<?php echo e(old('name', $teamMember->name)); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="role" class="form-label text-gray-200">Role *</label>
                <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="role" 
                       name="role" value="<?php echo e(old('role', $teamMember->role)); ?>" required>
            </div>
            
            <div class="mb-3">
                <label for="bio" class="form-label text-gray-200">Bio</label>
                <textarea class="form-control bg-primary-light border-0 text-gray-200" id="bio" 
                          name="bio" rows="4"><?php echo e(old('bio', $teamMember->bio)); ?></textarea>
            </div>
            
            <div class="mb-3">
                <label for="photo" class="form-label text-gray-200">Photo</label>
                <?php if($teamMember->image_path): ?>
                    <div class="mb-2">
                        <img src="<?php echo e($teamMember->image_url); ?>" alt="<?php echo e($teamMember->name); ?>" 
                             class="img-thumbnail" style="max-width: 150px;">
                    </div>
                <?php endif; ?>
                <input class="form-control bg-primary-light border-0 text-gray-200" type="file" 
                       id="photo" name="photo" accept="image/*">
                <small class="text-gray-400">Leave empty to keep current photo. Max size: 2MB.</small>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label text-gray-200">Email</label>
                <input type="email" class="form-control bg-primary-light border-0 text-gray-200" id="email" 
                       name="email" value="<?php echo e(old('email', $teamMember->email)); ?>">
            </div>

            <div class="mb-3">
                <label for="facebook_url" class="form-label text-gray-200">Facebook URL</label>
                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="facebook_url" 
                       name="facebook_url" value="<?php echo e(old('facebook_url', $teamMember->facebook_url)); ?>">
            </div>

            <div class="mb-3">
                <label for="instagram_url" class="form-label text-gray-200">Instagram URL</label>
                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="instagram_url" 
                       name="instagram_url" value="<?php echo e(old('instagram_url', $teamMember->instagram_url)); ?>">
            </div>

            <div class="mb-3">
                <label for="linkedin_url" class="form-label text-gray-200">LinkedIn URL</label>
                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="linkedin_url" 
                       name="linkedin_url" value="<?php echo e(old('linkedin_url', $teamMember->linkedin_url)); ?>">
            </div>

            <div class="mb-3">
                <label for="twitter_url" class="form-label text-gray-200">Twitter URL</label>
                <input type="url" class="form-control bg-primary-light border-0 text-gray-200" id="twitter_url" 
                       name="twitter_url" value="<?php echo e(old('twitter_url', $teamMember->twitter_url)); ?>">
            </div>
            
            <div class="mb-3">
                <label for="order" class="form-label text-gray-200">Order</label>
                <input type="number" class="form-control bg-primary-light border-0 text-gray-200" id="order" 
                       name="order" value="<?php echo e(old('order', $teamMember->order)); ?>">
            </div>
            
            <div class="form-check form-switch mb-3">
                <input class="form-check-input" type="checkbox" id="is_active" 
                       name="is_active" value="1" <?php echo e(old('is_active', $teamMember->is_active) ? 'checked' : ''); ?>>
                <label class="form-check-label text-gray-200" for="is_active">
                    Active
                </label>
            </div>
            
            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-primary">Update Team Member</button>
                <a href="<?php echo e(route('admin.about.team.index')); ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\about\team\edit.blade.php ENDPATH**/ ?>