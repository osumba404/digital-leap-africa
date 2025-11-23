

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1><?php echo e($certificateTemplate->name); ?></h1>
        <p class="text-muted">Certificate template preview</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('admin.certificate-templates.edit', $certificateTemplate)); ?>" class="btn btn-edit">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="<?php echo e(route('admin.certificate-templates.index')); ?>" class="btn btn-outline">Back</a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Certificate Preview</h5>
            </div>
            <div class="card-body">
                <div class="certificate-preview" style="
                    background-color: <?php echo e($certificateTemplate->background_color); ?>;
                    color: <?php echo e($certificateTemplate->text_color); ?>;
                    padding: 2rem;
                    border-radius: 8px;
                    min-height: 400px;
                    border: 1px solid rgba(255,255,255,0.2);
                    position: relative;
                ">
                    <?php if($certificateTemplate->logo_image): ?>
                        <div class="text-center mb-3">
                            <img src="<?php echo e(Storage::url($certificateTemplate->logo_image)); ?>" alt="Logo" style="max-height: 80px;">
                        </div>
                    <?php endif; ?>
                    
                    <div class="certificate-content">
                        <?php echo str_replace([
                            '<?php echo e(student_name); ?>',
                            '<?php echo e(course_title); ?>',
                            '<?php echo e(completion_date); ?>',
                            '<?php echo e(certificate_number); ?>',
                            '<?php echo e(instructor_name); ?>'
                        ], [
                            'John Doe',
                            'Advanced Laravel Development',
                            now()->format('F d, Y'),
                            'CERT-2024-001',
                            'Digital Leap Africa'
                        ], $certificateTemplate->content); ?>

                    </div>
                    
                    <?php if($certificateTemplate->signature_image): ?>
                        <div class="text-end mt-4">
                            <img src="<?php echo e(Storage::url($certificateTemplate->signature_image)); ?>" alt="Signature" style="max-height: 60px;">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Template Info</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Status:</strong>
                    <?php if($certificateTemplate->active): ?>
                        <span class="badge bg-success">Active</span>
                    <?php else: ?>
                        <span class="badge bg-warning">Inactive</span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <strong>Background Color:</strong>
                    <div class="d-flex align-items-center gap-2">
                        <div class="color-preview" style="background-color: <?php echo e($certificateTemplate->background_color); ?>"></div>
                        <code><?php echo e($certificateTemplate->background_color); ?></code>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Text Color:</strong>
                    <div class="d-flex align-items-center gap-2">
                        <div class="color-preview" style="background-color: <?php echo e($certificateTemplate->text_color); ?>"></div>
                        <code><?php echo e($certificateTemplate->text_color); ?></code>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Created:</strong> <?php echo e($certificateTemplate->created_at->format('M d, Y H:i')); ?>

                </div>
                <div class="mb-3">
                    <strong>Updated:</strong> <?php echo e($certificateTemplate->updated_at->format('M d, Y H:i')); ?>

                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h5>Available Placeholders</h5>
            </div>
            <div class="card-body">
                <div class="small text-muted">
                    <div><code><?php echo e(student_name); ?></code> - Student's name</div>
                    <div><code><?php echo e(course_title); ?></code> - Course title</div>
                    <div><code><?php echo e(completion_date); ?></code> - Completion date</div>
                    <div><code><?php echo e(certificate_number); ?></code> - Certificate ID</div>
                    <div><code><?php echo e(instructor_name); ?></code> - Instructor name</div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.color-preview {
    width: 20px;
    height: 20px;
    border-radius: 4px;
    border: 1px solid rgba(255, 255, 255, 0.3);
}
.badge {
    padding: 0.35em 0.65em;
    font-size: 0.75em;
    border-radius: 0.375rem;
}
.bg-success { background-color: #198754 !important; }
.bg-warning { background-color: #ffc107 !important; color: #000; }
.card {
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid rgba(255, 255, 255, 0.1);
}
.card-header {
    background: rgba(255, 255, 255, 0.05);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--diamond-white);
}
code {
    background: rgba(255, 255, 255, 0.1);
    padding: 0.2rem 0.4rem;
    border-radius: 0.25rem;
    font-size: 0.875em;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\certificate-templates\show.blade.php ENDPATH**/ ?>