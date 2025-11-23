

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1><?php echo e($emailTemplate->name); ?></h1>
        <p class="text-muted">Email template details</p>
    </div>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('admin.email-templates.edit', $emailTemplate)); ?>" class="btn btn-edit">
            <i class="fas fa-edit me-2"></i>Edit
        </a>
        <a href="<?php echo e(route('admin.email-templates.index')); ?>" class="btn btn-outline">Back</a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Template Content</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Subject:</strong> <?php echo e($emailTemplate->subject); ?>

                </div>
                <div class="mb-3">
                    <strong>Content:</strong>
                    <div class="mt-2 p-3" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px;">
                        <?php echo $emailTemplate->content; ?>

                    </div>
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
                    <?php if($emailTemplate->active): ?>
                        <span class="badge bg-success">Active</span>
                    <?php else: ?>
                        <span class="badge bg-warning">Inactive</span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <strong>Created:</strong> <?php echo e($emailTemplate->created_at->format('M d, Y H:i')); ?>

                </div>
                <div class="mb-3">
                    <strong>Updated:</strong> <?php echo e($emailTemplate->updated_at->format('M d, Y H:i')); ?>

                </div>
                
                <?php if($emailTemplate->variables): ?>
                <div class="mb-3">
                    <strong>Variables:</strong>
                    <div class="small text-muted mt-1">
                        <?php $__currentLoopData = $emailTemplate->variables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variable): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div><?php echo e($variable); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
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
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\email-templates\show.blade.php ENDPATH**/ ?>