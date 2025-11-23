

<?php $__env->startSection('title', 'Contact Messages'); ?>

<?php $__env->startSection('admin-content'); ?>
<div class="admin-header">
    <h1>Contact Messages</h1>
    <div class="admin-stats">
        <span class="stat-badge"><?php echo e($messages->total()); ?> Total</span>
        <span class="stat-badge unread"><?php echo e($messages->where('is_read', false)->count()); ?> Unread</span>
    </div>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<div class="admin-card">
    <div class="table-responsive">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="<?php echo e(!$message->is_read ? 'unread-row' : ''); ?>">
                        <td>
                            <div class="user-info">
                                <strong><?php echo e($message->name); ?></strong>
                                <?php if(!$message->is_read): ?>
                                    <span class="new-badge">NEW</span>
                                <?php endif; ?>
                            </div>
                        </td>
                        <td><?php echo e($message->email); ?></td>
                        <td><?php echo e(Str::limit($message->subject, 40)); ?></td>
                        <td><?php echo e($message->created_at->format('M j, Y')); ?></td>
                        <td>
                            <?php if($message->admin_reply): ?>
                                <span class="status-badge replied">Replied</span>
                            <?php elseif($message->is_read): ?>
                                <span class="status-badge read">Read</span>
                            <?php else: ?>
                                <span class="status-badge unread">Unread</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="<?php echo e(route('admin.contact-messages.show', $message)); ?>" class="btn-sm btn-primary">
                                    <i class="fas fa-eye"></i> View
                                </a>
                                <form action="<?php echo e(route('admin.contact-messages.destroy', $message)); ?>" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn-sm btn-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center">No messages found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php echo e($messages->links()); ?>

</div>

<style>
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.admin-stats {
    display: flex;
    gap: 1rem;
}

.stat-badge {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.stat-badge.unread {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.unread-row {
    background: rgba(59, 130, 246, 0.05);
}

.user-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.new-badge {
    background: #ef4444;
    color: white;
    padding: 0.125rem 0.5rem;
    border-radius: 10px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-badge {
    padding: 0.25rem 0.75rem;
    border-radius: 12px;
    font-size: 0.75rem;
    font-weight: 600;
}

.status-badge.unread {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.status-badge.read {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.status-badge.replied {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}

.action-buttons {
    display: flex;
    gap: 0.5rem;
}

.btn-sm {
    padding: 0.375rem 0.75rem;
    font-size: 0.875rem;
    border-radius: 6px;
    text-decoration: none;
    border: none;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.25rem;
}

.btn-primary {
    background: #3b82f6;
    color: white;
}

.btn-danger {
    background: #ef4444;
    color: white;
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\contact-messages\index.blade.php ENDPATH**/ ?>