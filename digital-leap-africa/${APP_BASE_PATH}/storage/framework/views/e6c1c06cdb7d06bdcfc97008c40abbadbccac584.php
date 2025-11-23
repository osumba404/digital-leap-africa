

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
    <h1 class="page-title">User Management</h1>
</div>

<?php if($users->count() > 0): ?>
<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>User</th>
                <th>Email</th>
                <th>Role</th>
                <th>Verification Status</th>
                <th>Joined</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div style="width: 40px; height: 40px; border-radius: 50%; background: rgba(0, 201, 255, 0.1); display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user" style="color: var(--cyan-accent);"></i>
                        </div>
                        <div>
                            <div style="font-weight: 600; color: var(--diamond-white);"><?php echo e($user->name); ?></div>
                        </div>
                    </div>
                </td>
                <td><?php echo e($user->email); ?></td>
                <td>
                    <span class="status-badge status-<?php echo e($user->role); ?>"><?php echo e(ucfirst($user->role)); ?></span>
                </td>
                <td>
                    <?php if($user->email_verified_at): ?>
                        <span class="status-badge status-active">
                            <i class="fas fa-check-circle me-1"></i>Verified
                        </span>
                    <?php else: ?>
                        <span class="status-badge status-pending">
                            <i class="fas fa-clock me-1"></i>Unverified
                        </span>
                    <?php endif; ?>
                </td>
                <td><?php echo e($user->created_at->format('M j, Y')); ?></td>
                <td>
                    <div style="display: flex; gap: 0.5rem;">
                        <?php if($user->email_verified_at): ?>
                            <form method="POST" action="<?php echo e(route('admin.users.unverify', $user)); ?>" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <button type="submit" class="btn-sm" style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.3);" onclick="return confirm('Remove verification for this user?')">
                                    <i class="fas fa-times"></i> Unverify
                                </button>
                            </form>
                        <?php else: ?>
                            <form method="POST" action="<?php echo e(route('admin.users.verify', $user)); ?>" style="display: inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <button type="submit" class="btn-sm" style="background: rgba(16, 185, 129, 0.1); color: #10b981; border: 1px solid rgba(16, 185, 129, 0.3);">
                                    <i class="fas fa-check"></i> Verify
                                </button>
                            </form>
                        <?php endif; ?>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<div style="margin-top: 2rem;">
    <?php echo e($users->links()); ?>

</div>

<?php else: ?>
<div style="text-align: center; padding: 3rem 0;">
    <i class="fas fa-users" style="font-size: 3rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem; display: block;"></i>
    <h3 style="color: var(--cool-gray); margin-bottom: 0.75rem;">No Users Found</h3>
    <p style="color: var(--cool-gray);">Users will appear here once they register.</p>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\users\index.blade.php ENDPATH**/ ?>