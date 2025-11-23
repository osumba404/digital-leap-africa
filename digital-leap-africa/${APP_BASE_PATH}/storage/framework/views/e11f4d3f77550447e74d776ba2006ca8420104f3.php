

<?php $__env->startSection('about-content'); ?>
<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="text-gray-200 m-0">About Page Sections</h5>
        </div>
        
        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mb-4 bg-primary-light border-0">
                <div class="card-header bg-primary-dark text-white d-flex justify-content-between align-items-center">
                    <span><?php echo e(ucfirst($section->section_type)); ?> Section</span>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="is_active_<?php echo e($section->id); ?>" 
                               <?php echo e($section->is_active ? 'checked' : ''); ?> disabled>
                        <label class="form-check-label" for="is_active_<?php echo e($section->id); ?>">
                            <?php echo e($section->is_active ? 'Active' : 'Inactive'); ?>

                        </label>
                    </div>
                </div>
                <div class="card-body">
                    <form action="<?php echo e(route('admin.about.sections.update', $section->id)); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <div class="mb-3">
                            <label for="mini_title_<?php echo e($section->id); ?>" class="form-label text-gray-200">Mini Title</label>
                            <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="mini_title_<?php echo e($section->id); ?>" 
                                   name="mini_title" value="<?php echo e(old('mini_title', $section->mini_title)); ?>">
                        </div>
                        
                        <div class="mb-3">
                            <label for="title_<?php echo e($section->id); ?>" class="form-label text-gray-200">Title</label>
                            <input type="text" class="form-control bg-primary-light border-0 text-gray-200" id="title_<?php echo e($section->id); ?>" 
                                   name="title" value="<?php echo e(old('title', $section->title)); ?>" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="content_<?php echo e($section->id); ?>" class="form-label text-gray-200">Content</label>
                            <textarea class="form-control bg-primary-light border-0 text-gray-200" id="content_<?php echo e($section->id); ?>" 
                                      name="content" rows="5" required><?php echo e(old('content', $section->content)); ?></textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="image_<?php echo e($section->id); ?>" class="form-label text-gray-200">
                                <?php echo e($section->image_path ? 'Change Image' : 'Upload Image'); ?>

                            </label>
                            <input class="form-control bg-primary-light border-0 text-gray-200" type="file" 
                                   id="image_<?php echo e($section->id); ?>" name="image">
                            <?php if($section->image_path): ?>
                                <div class="mt-2">
                                    <img src="<?php echo e($section->image_url); ?>" alt="<?php echo e($section->title); ?>" class="img-thumbnail" style="max-width: 200px;">
                                </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mb-3">
                            <label for="read_more_url_<?php echo e($section->id); ?>" class="form-label text-gray-200">Read More URL</label>
                            <input type="url" class="form-control bg-primary-light border-0 text-gray-200" 
                                   id="read_more_url_<?php echo e($section->id); ?>" name="read_more_url" 
                                   value="<?php echo e(old('read_more_url', $section->read_more_url)); ?>">
                        </div>
                        
                        <div class="form-check form-switch mb-3">
                            <input class="form-check-input" type="checkbox" id="is_active_switch_<?php echo e($section->id); ?>" 
                                   name="is_active" value="1" <?php echo e($section->is_active ? 'checked' : ''); ?>>
                            <label class="form-check-label text-gray-200" for="is_active_switch_<?php echo e($section->id); ?>">
                                Active
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary">Update <?php echo e(ucfirst($section->section_type)); ?> Section</button>
                    </form>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .form-control:focus {
        background-color: #2d3748;
        color: #e2e8f0;
    }
    .form-control {
        color: #e2e8f0;
    }
    .form-control::placeholder {
        color: #a0aec0;
    }
</style>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.about.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\about\sections.blade.php ENDPATH**/ ?>