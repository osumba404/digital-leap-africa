

<?php $__env->startSection('content'); ?>
<div class="admin-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><?php echo e($thread->title); ?></h1>
            <p>By <?php echo e($thread->user->name); ?> • <?php echo e($thread->created_at->format('M j, Y g:i A')); ?></p>
        </div>
        <a href="<?php echo e(route('admin.forum.index')); ?>" class="btn btn-outline">← Back to Forum</a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <div class="mb-3">
            <strong>Original Post:</strong>
        </div>
        <div class="content">
            <?php echo nl2br(e($thread->content)); ?>

        </div>
    </div>
</div>

<?php if($thread->replies->count() > 0): ?>
    <div class="card">
        <div class="card-header">
            <h3>Replies (<?php echo e($thread->replies->count()); ?>)</h3>
        </div>
        <div class="card-body">
            <?php $__currentLoopData = $thread->replies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="reply-item mb-4 pb-3 border-bottom">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <div>
                            <strong><?php echo e($reply->user->name); ?></strong>
                            <small class="text-muted"><?php echo e($reply->created_at->format('M j, Y g:i A')); ?></small>
                        </div>
                        <form method="POST" action="<?php echo e(route('admin.forum.replies.destroy', $reply)); ?>" class="d-inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger" 
                                    onclick="return confirm('Delete this reply?')">Delete</button>
                        </form>
                    </div>
                    <div class="content">
                        <?php echo nl2br(e($reply->content)); ?>

                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-body text-center text-muted">
            No replies yet.
        </div>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\forum\show.blade.php ENDPATH**/ ?>