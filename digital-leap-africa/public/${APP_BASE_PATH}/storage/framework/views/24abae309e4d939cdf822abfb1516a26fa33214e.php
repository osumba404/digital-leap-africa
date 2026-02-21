

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
    <h1 class="page-title">Email Templates</h1>
    <div class="page-actions">
        <a href="<?php echo e(route('admin.email-templates.system-preview')); ?>" class="btn btn-outline-info me-2">
            <i class="fas fa-eye me-2"></i>View system templates
        </a>
        <a href="<?php echo e(route('admin.email-templates.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Create Template
        </a>
    </div>
</div>

<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $templates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($template->name); ?></td>
                    <td><?php echo e($template->subject); ?></td>
                    <td>
                        <?php if($template->active): ?>
                            <span class="badge bg-success">Active</span>
                        <?php else: ?>
                            <span class="badge bg-warning">Inactive</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($template->created_at->format('M d, Y')); ?></td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="<?php echo e(route('admin.email-templates.show', $template)); ?>" class="btn btn-sm btn-outline-info">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="<?php echo e(route('admin.email-templates.edit', $template)); ?>" class="btn btn-sm btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="<?php echo e(route('admin.email-templates.destroy', $template)); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this template?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">
                        No email templates found. <a href="<?php echo e(route('admin.email-templates.create')); ?>">Create one</a>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <?php if($templates->hasPages()): ?>
        <div class="mt-4">
            <?php echo e($templates->links()); ?>

        </div>
    <?php endif; ?>
</div>

<style>
.badge {
    padding: 0.35em 0.65em;
    font-size: 0.75em;
    border-radius: 0.375rem;
}
.bg-success { background-color: #198754 !important; }
.bg-warning { background-color: #ffc107 !important; color: #000; }
.bg-secondary { background-color: #6c757d !important; }
.btn-primary {
    background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
    border: none;
    color: white;
}
.btn-primary:hover {
    background: linear-gradient(135deg, var(--deep-blue), var(--primary-blue));
    color: white;
}
.btn-outline-info {
    color: var(--cyan-accent);
    border-color: var(--cyan-accent);
}
.btn-outline-info:hover {
    background-color: var(--cyan-accent);
    color: white;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/admin/email-templates/index.blade.php ENDPATH**/ ?>