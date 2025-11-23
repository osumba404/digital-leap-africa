

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
    <h1 class="page-title">Point Rules</h1>
    <div class="page-actions">
        <a href="<?php echo e(route('admin.point-rules.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Create Rule
        </a>
    </div>
</div>

<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                    <th>Points</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $rules; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rule): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($rule->name); ?></td>
                    <td><?php echo e($rule->action); ?></td>
                    <td>
                        <span class="badge <?php echo e($rule->points > 0 ? 'bg-success' : 'bg-danger'); ?>">
                            <?php echo e($rule->points > 0 ? '+' : ''); ?><?php echo e($rule->points); ?>

                        </span>
                    </td>
                    <td>
                        <?php if($rule->active): ?>
                            <span class="badge bg-success">Active</span>
                        <?php else: ?>
                            <span class="badge bg-warning">Inactive</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($rule->created_at->format('M d, Y')); ?></td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="<?php echo e(route('admin.point-rules.edit', $rule)); ?>" class="btn btn-sm btn-edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form method="POST" action="<?php echo e(route('admin.point-rules.destroy', $rule)); ?>" class="d-inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this rule?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="text-center py-4 text-muted">
                        No point rules found. <a href="<?php echo e(route('admin.point-rules.create')); ?>">Create one</a>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <?php if($rules->hasPages()): ?>
        <div class="mt-4">
            <?php echo e($rules->links()); ?>

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
.bg-danger { background-color: #dc3545 !important; }
.bg-warning { background-color: #ffc107 !important; color: #000; }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\point-rules\index.blade.php ENDPATH**/ ?>