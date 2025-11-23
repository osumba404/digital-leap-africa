

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1>Point Transaction Details</h1>
        <p class="text-muted">Transaction information</p>
    </div>
    <a href="<?php echo e(route('admin.point-transactions.index')); ?>" class="btn btn-outline">Back to Transactions</a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Transaction Details</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>User:</strong> <?php echo e($pointTransaction->user->name); ?>

                        </div>
                        <div class="mb-3">
                            <strong>Email:</strong> <?php echo e($pointTransaction->user->email); ?>

                        </div>
                        <div class="mb-3">
                            <strong>Points:</strong>
                            <span class="badge <?php echo e($pointTransaction->points > 0 ? 'bg-success' : 'bg-danger'); ?> fs-6">
                                <?php echo e($pointTransaction->points > 0 ? '+' : ''); ?><?php echo e($pointTransaction->points); ?>

                            </span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <strong>Type:</strong>
                            <span class="badge bg-secondary"><?php echo e(ucfirst($pointTransaction->type)); ?></span>
                        </div>
                        <div class="mb-3">
                            <strong>Date:</strong> <?php echo e($pointTransaction->created_at->format('M d, Y H:i:s')); ?>

                        </div>
                        <?php if($pointTransaction->reference_type): ?>
                        <div class="mb-3">
                            <strong>Reference:</strong> <?php echo e($pointTransaction->reference_type); ?> #<?php echo e($pointTransaction->reference_id); ?>

                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="mb-3">
                    <strong>Description:</strong>
                    <div class="mt-2 p-3" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px;">
                        <?php echo e($pointTransaction->description); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>User Points Summary</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Current Points:</strong>
                    <div class="fs-4 text-primary"><?php echo e($pointTransaction->user->points ?? 0); ?></div>
                </div>
                <div class="mb-3">
                    <strong>User Level:</strong>
                    <div class="badge bg-info"><?php echo e($pointTransaction->user->level ?? 'Beginner'); ?></div>
                </div>
                <div class="mb-3">
                    <strong>Member Since:</strong>
                    <div class="small text-muted"><?php echo e($pointTransaction->user->created_at->format('M d, Y')); ?></div>
                </div>
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
.fs-6 { font-size: 1rem !important; }
.bg-success { background-color: #198754 !important; }
.bg-danger { background-color: #dc3545 !important; }
.bg-secondary { background-color: #6c757d !important; }
.bg-info { background-color: #0dcaf0 !important; color: #000; }
.text-primary { color: var(--cyan-accent) !important; }
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\point-transactions\show.blade.php ENDPATH**/ ?>