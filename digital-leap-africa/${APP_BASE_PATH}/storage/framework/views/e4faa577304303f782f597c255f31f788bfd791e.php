

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
    <h1 class="page-title">Email Logs</h1>
</div>

<div class="card bg-primary-light border-0 shadow-sm rounded mb-4">
    <form method="GET" class="p-3">
        <div class="row">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by email or subject..." value="<?php echo e(request('search')); ?>">
            </div>
            <div class="col-md-3">
                <select name="status" class="form-control">
                    <option value="">All Status</option>
                    <option value="sent" <?php echo e(request('status') == 'sent' ? 'selected' : ''); ?>>Sent</option>
                    <option value="failed" <?php echo e(request('status') == 'failed' ? 'selected' : ''); ?>>Failed</option>
                    <option value="pending" <?php echo e(request('status') == 'pending' ? 'selected' : ''); ?>>Pending</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>
</div>

<div class="card bg-primary-light border-0 shadow-sm rounded">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>To Email</th>
                    <th>Subject</th>
                    <th>Status</th>
                    <th>Sent At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $logs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($log->to_email); ?></td>
                    <td><?php echo e(Str::limit($log->subject, 50)); ?></td>
                    <td>
                        <?php if($log->status == 'sent'): ?>
                            <span class="badge bg-success">Sent</span>
                        <?php elseif($log->status == 'failed'): ?>
                            <span class="badge bg-danger">Failed</span>
                        <?php else: ?>
                            <span class="badge bg-warning">Pending</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if($log->sent_at): ?>
                            <?php echo e($log->sent_at->format('M d, Y H:i')); ?>

                        <?php else: ?>
                            -
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?php echo e(route('admin.email-logs.show', $log)); ?>" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-eye"></i> View
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="text-center py-4 text-muted">
                        No email logs found.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <?php if($logs->hasPages()): ?>
        <div class="mt-4">
            <?php echo e($logs->appends(request()->query())->links()); ?>

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
.form-control {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: var(--diamond-white);
    border-radius: 8px;
}
.form-control:focus {
    background: rgba(255, 255, 255, 0.08);
    border-color: var(--cyan-accent);
    box-shadow: 0 0 0 0.2rem rgba(0, 201, 255, 0.25);
    color: var(--diamond-white);
}
.btn-primary {
    background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
    border: none;
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\email-logs\index.blade.php ENDPATH**/ ?>