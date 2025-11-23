

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

.btn-edit {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    border: 1px solid rgba(59, 130, 246, 0.3);
}

.btn-edit:hover {
    background: rgba(59, 130, 246, 0.2);
}

.btn-view {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.btn-view:hover {
    background: rgba(16, 185, 129, 0.2);
}

.btn-delete {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
}

.btn-delete:hover {
    background: rgba(239, 68, 68, 0.2);
}

[data-theme="light"] .btn-edit {
    background: rgba(59, 130, 246, 0.1);
    color: #2563eb;
}

[data-theme="light"] .btn-view {
    background: rgba(16, 185, 129, 0.1);
    color: #059669;
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

[data-theme="light"] .data-table td a {
    color: #2563eb !important;
}

[data-theme="light"] td[style*="color: var(--cool-gray)"] {
    color: #6b7280 !important;
}

[data-theme="light"] td i.fas {
    color: #6b7280 !important;
}

.course-info {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.course-image {
    width: 50px;
    height: 50px;
    object-fit: cover;
    border-radius: 6px;
    flex-shrink: 0;
}

.course-placeholder {
    width: 50px;
    height: 50px;
    background: rgba(0, 201, 255, 0.1);
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

[data-theme="light"] .course-placeholder {
    background: rgba(46, 120, 197, 0.1);
}

.course-title {
    font-weight: 600;
    color: var(--diamond-white);
    margin-bottom: 0.25rem;
}

.course-description {
    font-size: 0.85rem;
    color: var(--cool-gray);
    line-height: 1.4;
}

[data-theme="light"] .course-title {
    color: #1a202c !important;
}

[data-theme="light"] .course-description {
    color: #6b7280 !important;
}

.status-cohort {
    background: rgba(147, 51, 234, 0.1);
    color: #9333ea;
    border: 1px solid rgba(147, 51, 234, 0.3);
}

.status-self {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    border: 1px solid rgba(16, 185, 129, 0.3);
}

.status-inactive {
    background: rgba(107, 114, 128, 0.1);
    color: #6b7280;
    border: 1px solid rgba(107, 114, 128, 0.3);
}

[data-theme="light"] .status-cohort {
    color: #7c3aed;
}

[data-theme="light"] .status-self {
    color: #059669;
}

[data-theme="light"] .status-inactive {
    color: #4b5563;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
    <h1 class="page-title">Manage Courses</h1>
    <div class="page-actions">
        <a href="<?php echo e(route('admin.courses.create')); ?>" class="btn-primary" style="padding: 0.5rem 1rem; font-size: 0.9rem;">
            <i class="fas fa-plus me-2"></i>Add New Course
        </a>
    </div>
</div>

<?php if($courses->count() > 0): ?>
<div class="table-responsive">
    <table class="data-table">
        <thead>
            <tr>
                <th>Course</th>
                <th>Instructor</th>
                <th>Type</th>
                <th>Duration</th>
                <th>Status</th>
                <th>Created</th>
                <th style="width: 300px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td>
                    <div class="course-info">
                        <?php if($course->image_url_full): ?>
                            <img src="<?php echo e($course->image_url_full); ?>" alt="<?php echo e($course->title); ?>" class="course-image">
                        <?php else: ?>
                            <div class="course-placeholder">
                                <i class="fas fa-graduation-cap" style="color: var(--cyan-accent);"></i>
                            </div>
                        <?php endif; ?>
                        <div>
                            <div class="course-title"><?php echo e($course->title); ?></div>
                            <div class="course-description"><?php echo e(Str::limit($course->description, 50)); ?></div>
                        </div>
                    </div>
                </td>
                <td><?php echo e($course->instructor ?? 'Not assigned'); ?></td>
                <td>
                    <span class="status-badge status-<?php echo e($course->course_type === 'cohort_based' ? 'cohort' : 'self'); ?>">
                        <?php echo e($course->course_type === 'cohort_based' ? 'Cohort-Based' : 'Self-Paced'); ?>

                    </span>
                </td>
                <td>
                    <?php if($course->course_type === 'cohort_based'): ?>
                        <?php if($course->duration_weeks): ?>
                            <?php echo e($course->duration_weeks); ?> weeks
                        <?php endif; ?>
                        <?php if($course->start_date && $course->end_date): ?>
                            <br><small style="color: var(--cool-gray); font-size: 0.75rem;">
                                <?php echo e($course->start_date->format('M j')); ?> - <?php echo e($course->end_date->format('M j, Y')); ?>

                            </small>
                        <?php endif; ?>
                    <?php else: ?>
                        <span style="color: var(--cool-gray); font-size: 0.85rem;">Flexible</span>
                    <?php endif; ?>
                </td>
                <td>
                    <span class="status-badge status-<?php echo e($course->active ? 'active' : 'inactive'); ?>">
                        <?php echo e($course->active ? 'Active' : 'Inactive'); ?>

                    </span>
                </td>
                <td><?php echo e($course->created_at->format('M j, Y')); ?></td>
                <td>
                    <div class="action-buttons">
                        <a href="<?php echo e(route('admin.courses.manage', $course)); ?>" class="btn-sm btn-view">
                            <i class="fas fa-eye"></i>View
                        </a>
                        <a href="<?php echo e(route('admin.courses.enrollments', $course)); ?>" class="btn-sm btn-edit">
                            <i class="fas fa-users"></i>Enrollments
                        </a>
                        <a href="<?php echo e(route('admin.courses.edit', $course)); ?>" class="btn-sm btn-edit">
                            <i class="fas fa-edit"></i>Edit
                        </a>
                        <form method="POST" action="<?php echo e(route('admin.courses.destroy', $course)); ?>" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn-sm btn-delete" 
                                    onclick="return confirm('Are you sure you want to delete this course?')">
                                <i class="fas fa-trash"></i>Delete
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>

<?php else: ?>
<div style="text-align: center; padding: 3rem 0;">
    <i class="fas fa-graduation-cap" style="font-size: 3rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem; display: block;"></i>
    <h3 style="color: var(--cool-gray); margin-bottom: 0.75rem; font-size: 1.15rem;">No Courses Yet</h3>
    <p style="color: var(--cool-gray); margin-bottom: 1.5rem; font-size: 0.9rem;">Start building your course catalog by adding your first course.</p>
    <a href="<?php echo e(route('admin.courses.create')); ?>" class="btn-primary" style="padding: 0.6rem 1.5rem; font-size: 0.95rem;">
        <i class="fas fa-plus me-2"></i>Create First Course
    </a>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\courses\index.blade.php ENDPATH**/ ?>