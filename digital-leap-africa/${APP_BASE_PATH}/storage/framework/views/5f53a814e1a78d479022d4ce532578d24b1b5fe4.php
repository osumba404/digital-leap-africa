

<?php $__env->startPush('styles'); ?>
<style>
.action-buttons {
    display: flex;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.btn-sm {
    padding: 0.4rem 0.75rem;
    font-size: 0.8rem;
    border-radius: 6px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    transition: all 0.2s;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
    white-space: nowrap;
}

.btn-approve {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.btn-approve:hover {
    background: rgba(16, 185, 129, 0.2);
}

.btn-edit {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.btn-edit:hover {
    background: rgba(59, 130, 246, 0.2);
}

.btn-delete {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.btn-delete:hover {
    background: rgba(239, 68, 68, 0.2);
}

[data-theme="light"] .btn-approve {
    background: rgba(16, 185, 129, 0.1);
    color: #059669;
}

[data-theme="light"] .btn-edit {
    background: rgba(59, 130, 246, 0.1);
    color: #2563eb;
}

[data-theme="light"] .btn-delete {
    background: rgba(239, 68, 68, 0.1);
    color: #dc2626;
}

/* CRITICAL: Light Mode Text Fixes */
[data-theme="light"] .data-table td,
[data-theme="light"] .data-table td * {
    color: #1a202c !important;
}

[data-theme="light"] .data-table td i {
    color: inherit !important;
}

.filter-buttons {
    display: flex;
    gap: 0.5rem;
}

.filter-buttons .btn-outline {
    padding: 0.4rem 0.75rem;
    font-size: 0.85rem;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
    <h1 class="page-title">Testimonials Moderation</h1>
    <div class="page-actions filter-buttons">
        <a href="<?php echo e(route('admin.testimonials.index', ['status' => 'pending'])); ?>" class="btn-outline">Pending</a>
        <a href="<?php echo e(route('admin.testimonials.index', ['status' => 'approved'])); ?>" class="btn-outline">Approved</a>
        <a href="<?php echo e(route('admin.testimonials.index', ['status' => 'all'])); ?>" class="btn-outline">All</a>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="success-message"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>User</th>
                <th>Quote</th>
                <th>Status</th>
                <th>Submitted</th>
                <th style="width:280px">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($t->name ?? ($t->user->name ?? 'User')); ?></td>
                <td><?php echo e(\Illuminate\Support\Str::limit($t->quote, 100)); ?></td>
                <td>
                    <?php if($t->is_active): ?>
                        <span class="status-badge status-active">Approved</span>
                    <?php else: ?>
                        <span class="status-badge status-draft">Pending</span>
                    <?php endif; ?>
                </td>
                <td><?php echo e($t->created_at?->format('M d, Y')); ?></td>
                <td>
                    <div class="action-buttons">
                        <?php if(!$t->is_active): ?>
                        <form method="POST" action="<?php echo e(route('admin.testimonials.approve', $t)); ?>" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button class="btn-sm btn-approve" type="submit">
                                <i class="fas fa-check"></i>Approve
                            </button>
                        </form>
                        <?php else: ?>
                        <form method="POST" action="<?php echo e(route('admin.testimonials.unpublish', $t)); ?>" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PATCH'); ?>
                            <button class="btn-sm btn-edit" type="submit">
                                <i class="fas fa-eye-slash"></i>Unpublish
                            </button>
                        </form>
                        <?php endif; ?>
                        <form method="POST" action="<?php echo e(route('admin.testimonials.destroy', $t)); ?>" style="display:inline;" onsubmit="return confirm('Delete this testimonial?')">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button class="btn-sm btn-delete" type="submit">
                                <i class="fas fa-trash"></i>Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="5" style="text-align: center; padding: 2rem; color: var(--cool-gray);">
                    <i class="fas fa-quote-left" style="font-size: 2rem; opacity: 0.5; display: block; margin-bottom: 0.5rem;"></i>
                    No testimonials found.
                </td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<div style="margin-top:1rem;">
    <?php echo e($testimonials->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\testimonials\index.blade.php ENDPATH**/ ?>