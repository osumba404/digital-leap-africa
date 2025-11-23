

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
    <h1 class="page-title">Point Transactions</h1>
    <div class="page-actions">
        <a href="<?php echo e(route('admin.point-transactions.create')); ?>" class="btn btn-primary">
            <i class="fas fa-plus me-2"></i>Add Points
        </a>
    </div>
</div>

<div class="card bg-primary-light border-0 shadow-sm rounded mb-4">
    <form method="GET" class="p-3">
        <div class="row">
            <div class="col-md-4">
                <select name="user_id" class="form-control">
                    <option value="">All Users</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($user->id); ?>" <?php echo e(request('user_id') == $user->id ? 'selected' : ''); ?>>
                            <?php echo e($user->name); ?> (<?php echo e($user->email); ?>)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-3">
                <select name="type" class="form-control">
                    <option value="">All Types</option>
                    <option value="earned" <?php echo e(request('type') == 'earned' ? 'selected' : ''); ?>>Earned</option>
                    <option value="spent" <?php echo e(request('type') == 'spent' ? 'selected' : ''); ?>>Spent</option>
                    <option value="bonus" <?php echo e(request('type') == 'bonus' ? 'selected' : ''); ?>>Bonus</option>
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
                    <th>User</th>
                    <th>Points</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $transactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td>
                        <div><?php echo e($transaction->user->name); ?></div>
                        <small class="text-muted"><?php echo e($transaction->user->email); ?></small>
                    </td>
                    <td>
                        <span class="badge <?php echo e($transaction->points > 0 ? 'bg-success' : 'bg-danger'); ?>">
                            <?php echo e($transaction->points > 0 ? '+' : ''); ?><?php echo e($transaction->points); ?>

                        </span>
                    </td>
                    <td>
                        <span class="badge bg-secondary"><?php echo e(ucfirst($transaction->type)); ?></span>
                    </td>
                    <td>
                        <?php if($transaction->active): ?>
                            <span class="badge bg-success">Active</span>
                        <?php else: ?>
                            <span class="badge bg-warning">Inactive</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($transaction->description); ?></td>
                    <td><?php echo e($transaction->created_at->format('M d, Y H:i')); ?></td>
                    <td>
                        <a href="<?php echo e(route('admin.point-transactions.show', $transaction)); ?>" class="btn btn-sm btn-outline-info">
                            <i class="fas fa-eye"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="7" class="text-center py-4 text-muted">
                        No point transactions found.
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <?php if($transactions->hasPages()): ?>
        <div class="mt-4">
            <?php echo e($transactions->appends(request()->query())->links()); ?>

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
.bg-secondary { background-color: #6c757d !important; }
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
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\point-transactions\index.blade.php ENDPATH**/ ?>