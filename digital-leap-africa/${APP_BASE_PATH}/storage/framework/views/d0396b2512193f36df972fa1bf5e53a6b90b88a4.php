

<?php $__env->startSection('content'); ?>
<div class="admin-header">
    <h1>Forum Management</h1>
    <p>Manage forum threads and discussions</p>
</div>

<div class="card">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Replies</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td>
                            <a href="<?php echo e(route('admin.forum.show', $thread)); ?>" class="text-decoration-none">
                                <?php echo e($thread->title); ?>

                            </a>
                        </td>
                        <td><?php echo e($thread->user->name); ?></td>
                        <td><?php echo e($thread->replies_count); ?></td>
                        <td><?php echo e($thread->created_at->format('M j, Y')); ?></td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="<?php echo e(route('admin.forum.show', $thread)); ?>" class="btn btn-sm btn-edit">View</a>
                                <form method="POST" action="<?php echo e(route('admin.forum.destroy', $thread)); ?>" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-danger" 
                                            onclick="return confirm('Delete this thread?')">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">No threads found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <?php if($threads->hasPages()): ?>
        <div class="mt-4">
            <?php echo e($threads->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\forum\index.blade.php ENDPATH**/ ?>