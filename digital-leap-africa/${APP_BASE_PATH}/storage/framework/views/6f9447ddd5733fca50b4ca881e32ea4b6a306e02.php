

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1>Email Log Details</h1>
        <p class="text-muted">Email delivery information</p>
    </div>
    <a href="<?php echo e(route('admin.email-logs.index')); ?>" class="btn btn-outline">Back to Logs</a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Email Content</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Subject:</strong> <?php echo e($emailLog->subject); ?>

                </div>
                <div class="mb-3">
                    <strong>Body:</strong>
                    <div class="mt-2 p-3" style="background: rgba(255,255,255,0.02); border: 1px solid rgba(255,255,255,0.1); border-radius: 8px; max-height: 400px; overflow-y: auto;">
                        <?php echo $emailLog->body; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>Delivery Info</h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>To Email:</strong> <?php echo e($emailLog->to_email); ?>

                </div>
                <div class="mb-3">
                    <strong>Status:</strong>
                    <?php if($emailLog->status == 'sent'): ?>
                        <span class="badge bg-success">Sent</span>
                    <?php elseif($emailLog->status == 'failed'): ?>
                        <span class="badge bg-danger">Failed</span>
                    <?php else: ?>
                        <span class="badge bg-warning">Pending</span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <strong>Created:</strong> <?php echo e($emailLog->created_at->format('M d, Y H:i:s')); ?>

                </div>
                <?php if($emailLog->sent_at): ?>
                <div class="mb-3">
                    <strong>Sent At:</strong> <?php echo e($emailLog->sent_at->format('M d, Y H:i:s')); ?>

                </div>
                <?php endif; ?>
                
                <?php if($emailLog->error_message): ?>
                <div class="mb-3">
                    <strong>Error Message:</strong>
                    <div class="small text-danger mt-1 p-2" style="background: rgba(220, 53, 69, 0.1); border: 1px solid rgba(220, 53, 69, 0.3); border-radius: 4px;">
                        <?php echo e($emailLog->error_message); ?>

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
.bg-danger { background-color: #dc3545 !important; }
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
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\email-logs\show.blade.php ENDPATH**/ ?>