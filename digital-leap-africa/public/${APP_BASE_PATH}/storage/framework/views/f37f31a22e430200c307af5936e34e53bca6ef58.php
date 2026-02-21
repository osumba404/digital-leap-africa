

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
    <h1 class="page-title">System Email Templates</h1>
    <div class="page-actions">
        <a href="<?php echo e(route('admin.email-templates.index')); ?>" class="btn btn-outline">
            <i class="fas fa-arrow-left me-2"></i>Back to Templates
        </a>
    </div>
</div>

<p class="text-muted mb-4">Preview how transactional emails (course, article, event, etc.) look. All use the same dark blue layout.</p>

<div class="row g-4">
    <div class="col-md-4 col-lg-3">
        <div class="card bg-primary-light border-0 rounded" style="border: 1px solid rgba(255,255,255,0.08) !important;">
            <div class="card-body p-3">
                <h6 class="text-cyan mb-3">Templates</h6>
                <div class="d-flex flex-column gap-2 system-template-list">
                    <?php $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slug => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('admin.email-templates.system-preview')); ?>?template=<?php echo e($slug); ?>"
                       class="template-link text-decoration-none py-2 px-3 rounded <?php echo e(request()->get('template') === $slug ? 'active' : ''); ?>"
                       data-template="<?php echo e($slug); ?>">
                        <?php echo e($label); ?>

                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8 col-lg-9">
        <div class="card bg-primary-light border-0 rounded" style="border: 1px solid rgba(255,255,255,0.08) !important;">
            <div class="card-body p-0">
                <?php if($selected = request()->get('template')): ?>
                <iframe src="<?php echo e(route('admin.email-templates.system-preview.show', $selected)); ?>"
                        title="Email preview"
                        style="width:100%; height: 720px; border: none; display: block;"></iframe>
                <?php else: ?>
                <div class="p-5 text-center text-muted">
                    <i class="fas fa-envelope-open-text fa-3x mb-3 opacity-50"></i>
                    <p class="mb-0">Select a template from the list to preview.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<style>
.system-template-list .template-link {
    color: var(--cool-gray);
    font-size: 0.9rem;
    transition: background 0.2s, color 0.2s;
}
.system-template-list .template-link:hover {
    background: rgba(0, 201, 255, 0.1);
    color: var(--cyan-accent);
}
.system-template-list .template-link.active {
    background: rgba(46, 120, 197, 0.25);
    color: var(--cyan-accent);
    font-weight: 600;
}
.btn-outline {
    border: 1px solid rgba(255,255,255,0.2);
    color: var(--diamond-white);
}
.btn-outline:hover {
    background: rgba(255,255,255,0.05);
    color: var(--diamond-white);
}
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/admin/email-templates/system-preview.blade.php ENDPATH**/ ?>