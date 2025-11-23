

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
    <h1 class="page-title">Certificate Management</h1>
    <p style="color: var(--cool-gray); margin-top: 0.5rem;">Customize certificate design, content, and signatures</p>
</div>

<?php if(session('success')): ?>
    <div style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.3); color: #10b981; padding: 1rem; border-radius: var(--radius); margin-bottom: 1.5rem;">
        <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

    </div>
<?php endif; ?>

<div class="admin-form">
    <form method="POST" action="<?php echo e(route('admin.certificates.update')); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div class="form-section">
            <h3 class="form-section-title">Certificate Header</h3>
            
            <div class="form-group">
                <label for="certificate_title" class="form-label">Certificate Title</label>
                <input type="text" id="certificate_title" name="certificate_title" class="form-control" 
                       value="<?php echo e(old('certificate_title', $settings['certificate_title'])); ?>" required>
                <small style="color: var(--cool-gray); font-size: 0.85rem;">Main title displayed on the certificate</small>
            </div>

            <div class="form-group">
                <label for="certificate_subtitle" class="form-label">Organization Name</label>
                <input type="text" id="certificate_subtitle" name="certificate_subtitle" class="form-control" 
                       value="<?php echo e(old('certificate_subtitle', $settings['certificate_subtitle'])); ?>" required>
                <small style="color: var(--cool-gray); font-size: 0.85rem;">Organization name below the title</small>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title">Certificate Content</h3>
            
            <div class="form-group">
                <label for="certificate_text" class="form-label">Opening Text</label>
                <input type="text" id="certificate_text" name="certificate_text" class="form-control" 
                       value="<?php echo e(old('certificate_text', $settings['certificate_text'])); ?>" required>
                <small style="color: var(--cool-gray); font-size: 0.85rem;">Text before the recipient name</small>
            </div>

            <div class="form-group">
                <label for="certificate_completion_text" class="form-label">Completion Text</label>
                <input type="text" id="certificate_completion_text" name="certificate_completion_text" class="form-control" 
                       value="<?php echo e(old('certificate_completion_text', $settings['certificate_completion_text'])); ?>" required>
                <small style="color: var(--cool-gray); font-size: 0.85rem;">Text before the course title</small>
            </div>

            <div class="form-group">
                <label for="certificate_achievement_text" class="form-label">Achievement Text</label>
                <textarea id="certificate_achievement_text" name="certificate_achievement_text" class="form-control" rows="3" required><?php echo e(old('certificate_achievement_text', $settings['certificate_achievement_text'])); ?></textarea>
                <small style="color: var(--cool-gray); font-size: 0.85rem;">Final achievement description text</small>
            </div>
        </div>

        <div class="form-section">
            <h3 class="form-section-title">Signature Section</h3>
            
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                <div class="form-group">
                    <label for="certificate_instructor_title" class="form-label">Instructor Title</label>
                    <input type="text" id="certificate_instructor_title" name="certificate_instructor_title" class="form-control" 
                           value="<?php echo e(old('certificate_instructor_title', $settings['certificate_instructor_title'])); ?>" required>
                </div>

                <div class="form-group">
                    <label for="certificate_director_title" class="form-label">Director Title</label>
                    <input type="text" id="certificate_director_title" name="certificate_director_title" class="form-control" 
                           value="<?php echo e(old('certificate_director_title', $settings['certificate_director_title'])); ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="certificate_director_name" class="form-label">Director Name</label>
                <input type="text" id="certificate_director_name" name="certificate_director_name" class="form-control" 
                       value="<?php echo e(old('certificate_director_name', $settings['certificate_director_name'])); ?>" required>
                <small style="color: var(--cool-gray); font-size: 0.85rem;">Name that appears under director signature</small>
            </div>
        </div>

        <div style="display: flex; gap: 1rem; justify-content: flex-end; margin-top: 2rem;">
            <button type="submit" class="btn-primary">
                <i class="fas fa-save me-2"></i>Save Certificate Settings
            </button>
        </div>
    </form>
</div>

<div style="margin-top: 3rem; padding: 1.5rem; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: var(--radius);">
    <h3 style="color: var(--diamond-white); margin-bottom: 1rem;">
        <i class="fas fa-info-circle me-2"></i>Certificate Preview
    </h3>
    <p style="color: var(--cool-gray); margin-bottom: 1rem;">
        Changes will be applied to all new certificates issued. Existing certificates will retain their original content.
    </p>
    <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
        <a href="<?php echo e(route('certificates.show', 1)); ?>" class="btn-outline" target="_blank">
            <i class="fas fa-eye me-2"></i>Preview Certificate
        </a>
        <a href="<?php echo e(route('admin.courses.index')); ?>" class="btn-outline">
            <i class="fas fa-graduation-cap me-2"></i>Manage Courses
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\certificates\index.blade.php ENDPATH**/ ?>