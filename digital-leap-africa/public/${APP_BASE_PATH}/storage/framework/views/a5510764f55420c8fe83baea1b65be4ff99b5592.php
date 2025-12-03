

<?php $__env->startPush('styles'); ?>
<style>
.btn-group .btn {
    margin-right: 2px;
    margin-bottom: 2px;
}
.btn-group {
    display: flex;
    flex-wrap: wrap;
    gap: 2px;
}
@media (max-width: 768px) {
    .btn-group {
        flex-direction: column;
    }
    .btn-group .btn {
        width: 100%;
        margin-right: 0;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title"><?php echo e($course->title); ?> - Enrollments</h3>
                    <a href="<?php echo e(route('admin.courses.index')); ?>" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Courses
                    </a>
                </div>
                
                <div class="card-body">
                    <?php if($enrollments->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Student</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>Enrolled Date</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $enrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($enrollment->user->name); ?></td>
                                            <td><?php echo e($enrollment->user->email); ?></td>
                                            <td>
                                                <?php switch($enrollment->status):
                                                    case ('pending'): ?>
                                                        <span class="badge badge-warning">Pending</span>
                                                        <?php break; ?>
                                                    <?php case ('active'): ?>
                                                        <span class="badge badge-success">Active</span>
                                                        <?php break; ?>
                                                    <?php case ('completed'): ?>
                                                        <span class="badge badge-primary">Completed</span>
                                                        <?php break; ?>
                                                    <?php case ('rejected'): ?>
                                                        <span class="badge badge-danger">Rejected</span>
                                                        <?php break; ?>
                                                    <?php case ('dropped'): ?>
                                                        <span class="badge badge-secondary">Dropped</span>
                                                        <?php break; ?>
                                                    <?php case ('suspended'): ?>
                                                        <span class="badge badge-warning">Suspended</span>
                                                        <?php break; ?>
                                                <?php endswitch; ?>
                                            </td>
                                            <td><?php echo e($enrollment->enrolled_at->format('M d, Y H:i')); ?></td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <?php if($enrollment->status === 'pending'): ?>
                                                        <form method="POST" action="<?php echo e(route('admin.courses.enrollments.approve', $enrollment)); ?>" style="display: inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Approve this enrollment?')">
                                                                <i class="fas fa-check"></i> Approve
                                                            </button>
                                                        </form>
                                                        <form method="POST" action="<?php echo e(route('admin.courses.enrollments.reject', $enrollment)); ?>" style="display: inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Reject this enrollment?')">
                                                                <i class="fas fa-times"></i> Reject
                                                            </button>
                                                        </form>
                                                    <?php elseif($enrollment->status === 'active'): ?>
                                                        <form method="POST" action="<?php echo e(route('admin.courses.enrollments.suspend', $enrollment)); ?>" style="display: inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Suspend this student?')">
                                                                <i class="fas fa-pause"></i> Suspend
                                                            </button>
                                                        </form>
                                                        <form method="POST" action="<?php echo e(route('admin.courses.enrollments.drop', $enrollment)); ?>" style="display: inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-sm btn-secondary" onclick="return confirm('Drop this student from the course?')">
                                                                <i class="fas fa-user-minus"></i> Drop
                                                            </button>
                                                        </form>
                                                        <form method="POST" action="<?php echo e(route('admin.courses.enrollments.warn', $enrollment)); ?>" style="display: inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-sm btn-info" onclick="return confirm('Send warning to this student?')">
                                                                <i class="fas fa-exclamation-triangle"></i> Warn
                                                            </button>
                                                        </form>
                                                    <?php elseif($enrollment->status === 'suspended'): ?>
                                                        <form method="POST" action="<?php echo e(route('admin.courses.enrollments.reenroll', $enrollment)); ?>" style="display: inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Reactivate this enrollment?')">
                                                                <i class="fas fa-play"></i> Reenroll
                                                            </button>
                                                        </form>
                                                        <form method="POST" action="<?php echo e(route('admin.courses.enrollments.drop', $enrollment)); ?>" style="display: inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-sm btn-secondary" onclick="return confirm('Drop this student permanently?')">
                                                                <i class="fas fa-user-minus"></i> Drop
                                                            </button>
                                                        </form>
                                                    <?php elseif($enrollment->status === 'dropped'): ?>
                                                        <form method="POST" action="<?php echo e(route('admin.courses.enrollments.reenroll', $enrollment)); ?>" style="display: inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Reenroll this student?')">
                                                                <i class="fas fa-user-plus"></i> Reenroll
                                                            </button>
                                                        </form>
                                                    <?php elseif($enrollment->status === 'rejected'): ?>
                                                        <form method="POST" action="<?php echo e(route('admin.courses.enrollments.approve', $enrollment)); ?>" style="display: inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Approve this enrollment?')">
                                                                <i class="fas fa-check"></i> Approve
                                                            </button>
                                                        </form>
                                                    <?php elseif($enrollment->status === 'completed'): ?>
                                                        <form method="POST" action="<?php echo e(route('admin.courses.enrollments.reenroll', $enrollment)); ?>" style="display: inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PATCH'); ?>
                                                            <button type="submit" class="btn btn-sm btn-primary" onclick="return confirm('Reopen this enrollment?')">
                                                                <i class="fas fa-redo"></i> Reopen
                                                            </button>
                                                        </form>
                                                    <?php endif; ?>
                                                    
                                                    
                                                    <?php if(in_array($enrollment->status, ['active', 'suspended', 'completed'])): ?>
                                                        <form method="POST" action="<?php echo e(route('admin.courses.enrollments.unenroll', $enrollment)); ?>" style="display: inline;">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('DELETE'); ?>
                                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Permanently unenroll this student? This action cannot be undone.')">
                                                                <i class="fas fa-trash"></i> Unenroll
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
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h4 class="text-muted">No Enrollments Yet</h4>
                            <p class="text-muted">Students will appear here once they enroll in this course.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views/admin/courses/enrollments.blade.php ENDPATH**/ ?>