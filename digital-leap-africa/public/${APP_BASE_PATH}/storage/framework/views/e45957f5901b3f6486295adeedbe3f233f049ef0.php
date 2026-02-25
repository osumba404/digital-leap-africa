

<?php $__env->startSection('title', 'Course Enrollments'); ?>

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

.progress {
    height: 6px;
    background-color: rgba(0, 0, 0, 0.1);
    border-radius: 3px;
    overflow: hidden;
    margin: 0.25rem 0;
}

.progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #10b981 0%, #3b82f6 100%);
    border-radius: 3px;
    transition: width 0.3s ease;
}

.progress-text {
    font-size: 0.75rem;
    color: #6b7280;
    margin-top: 0.25rem;
}

.badge {
    display: inline-block;
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
    font-weight: 500;
    border-radius: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.badge-success { background: #dcfce7; color: #166534; }
.badge-warning { background: #fef3c7; color: #92400e; }
.badge-danger { background: #fecaca; color: #991b1b; }
.badge-secondary { background: #f3f4f6; color: #374151; }
.badge-primary { background: #dbeafe; color: #1e40af; }
.badge-info { background: #e0f2fe; color: #0c4a6e; }

.btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.375rem 0.75rem;
    border-radius: 6px;
    font-weight: 500;
    font-size: 0.875rem;
    cursor: pointer;
    transition: all 0.2s;
    text-decoration: none;
    border: none;
}

.btn-sm {
    padding: 0.25rem 0.5rem;
    font-size: 0.75rem;
}

.btn-success { background: #10b981; color: white; }
.btn-success:hover { background: #059669; }

.btn-warning { background: #f59e0b; color: white; }
.btn-warning:hover { background: #d97706; }

.btn-secondary { background: #6b7280; color: white; }
.btn-secondary:hover { background: #4b5563; }

.btn-info { background: #0ea5e9; color: white; }
.btn-info:hover { background: #0284c7; }

.btn-primary { background: #3b82f6; color: white; }
.btn-primary:hover { background: #2563eb; }

.btn-danger { background: #ef4444; color: white; }
.btn-danger:hover { background: #dc2626; }

.course-header {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
}

.course-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.stat-card {
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 6px;
    padding: 1rem;
    text-align: center;
}

.stat-number {
    font-size: 1.25rem;
    font-weight: 700;
    color: #3b82f6;
}

.stat-label {
    font-size: 0.75rem;
    color: #6b7280;
    margin-top: 0.25rem;
}

.content-card {
    background: white;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
}

.content-card-header {
    padding: 1rem 1.5rem;
    border-bottom: 1px solid #e5e7eb;
    background: #f9fafb;
}

.content-card-body {
    padding: 1.5rem;
}

@media (max-width: 768px) {
    .btn-group {
        flex-direction: column;
    }
    .btn-group .btn {
        width: 100%;
        margin-right: 0;
    }
    .course-stats {
        grid-template-columns: 1fr;
    }
    .content-card-body {
        padding: 1rem;
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('admin-content'); ?>
<div class="page-header">
  <h1 class="page-title">Manage Enrollments: <?php echo e($course->title); ?></h1>
</div>

<div class="quick-actions" style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;margin-bottom:1.5rem;">
  <a class="btn btn-edit" href="<?php echo e(route('admin.courses.topics.index', $course)); ?>">
    <i class="fas fa-list me-2"></i>Topics
  </a>
  <a class="btn btn-edit" href="<?php echo e(route('admin.courses.topics.index', $course)); ?>">
    <i class="fas fa-book-open me-2"></i>Lessons & Materials
  </a>
  <a class="btn btn-primary" href="<?php echo e(route('admin.courses.enrollments', $course)); ?>">
    <i class="fas fa-users me-2"></i>Manage Enrollments
  </a>
  <a class="btn btn-edit" href="<?php echo e(route('admin.courses.edit', $course)); ?>">
    <i class="fas fa-edit me-2"></i>Edit Course
  </a>
</div>

<div class="card" style="margin-bottom:1.25rem;">
  <div class="card-header" style="display:flex;align-items:center;justify-content:space-between;">
    <h3 class="card-title">Course Statistics</h3>
  </div>
  <div class="card-body">
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:1rem;">
      <div style="text-align:center;">
        <div style="font-size:1.5rem;font-weight:600;color:var(--cyan-accent);"><?php echo e($enrollments->count()); ?></div>
        <div class="muted">Total Enrollments</div>
      </div>
      <div style="text-align:center;">
        <div style="font-size:1.5rem;font-weight:600;color:var(--cyan-accent);"><?php echo e($enrollments->where('status', 'active')->count()); ?></div>
        <div class="muted">Active Students</div>
      </div>
      <div style="text-align:center;">
        <div style="font-size:1.5rem;font-weight:600;color:var(--cyan-accent);"><?php echo e($enrollments->where('status', 'completed')->count()); ?></div>
        <div class="muted">Completed</div>
      </div>
      <div style="text-align:center;">
        <div style="font-size:1.5rem;font-weight:600;color:var(--cyan-accent);"><?php echo e($totalLessons); ?></div>
        <div class="muted">Total Lessons</div>
      </div>
    </div>
  </div>
</div>

<div class="card">
  <div class="card-header">
    <h3 class="card-title">Student Enrollments</h3>
  </div>
  <div class="card-body">
    <?php if($enrollments->count() > 0): ?>
      <table class="data-table">
        <thead>
          <tr>
            <th>Student</th>
            <th>Email</th>
            <th>Status</th>
            <th>Progress</th>
            <th>Enrolled Date</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php $__currentLoopData = $enrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $enrollment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
              <td>
                <div style="display:flex;align-items:center;gap:0.75rem;">
                  <?php if($enrollment->user->profile_photo_url): ?>
                    <img src="<?php echo e($enrollment->user->profile_photo_url); ?>" 
                         alt="<?php echo e($enrollment->user->name); ?>" 
                         style="width:32px;height:32px;border-radius:50%;object-fit:cover;">
                  <?php else: ?>
                    <div style="width:32px;height:32px;border-radius:50%;background:var(--cyan-accent);display:flex;align-items:center;justify-content:center;color:white;font-size:0.75rem;font-weight:600;">
                      <?php echo e(strtoupper(substr($enrollment->user->name, 0, 2))); ?>

                    </div>
                  <?php endif; ?>
                  <div>
                    <div style="font-weight:600;"><?php echo e($enrollment->user->name); ?></div>
                    <div class="muted" style="font-size:0.75rem;">Level <?php echo e($enrollment->user->level ?? 1); ?> • <?php echo e($enrollment->user->points ?? 0); ?> pts</div>
                  </div>
                </div>
              </td>
              <td class="muted"><?php echo e($enrollment->user->email); ?></td>
              <td>
                <?php switch($enrollment->status):
                  case ('pending'): ?>
                    <span class="status-badge" style="background:rgba(251,191,36,0.2);color:#fbbf24;border:1px solid rgba(251,191,36,0.3);">Pending</span>
                    <?php break; ?>
                  <?php case ('active'): ?>
                    <span class="status-badge status-active">Active</span>
                    <?php break; ?>
                  <?php case ('completed'): ?>
                    <span class="status-badge" style="background:rgba(59,130,246,0.2);color:#3b82f6;border:1px solid rgba(59,130,246,0.3);">Completed</span>
                    <?php break; ?>
                  <?php case ('rejected'): ?>
                    <span class="status-badge" style="background:rgba(239,68,68,0.2);color:#ef4444;border:1px solid rgba(239,68,68,0.3);">Rejected</span>
                    <?php break; ?>
                  <?php case ('dropped'): ?>
                    <span class="status-badge status-inactive">Dropped</span>
                    <?php break; ?>
                  <?php case ('suspended'): ?>
                    <span class="status-badge" style="background:rgba(251,191,36,0.2);color:#fbbf24;border:1px solid rgba(251,191,36,0.3);">Suspended</span>
                    <?php break; ?>
                <?php endswitch; ?>
              </td>
              <td>
                <div style="min-width:120px;">
                  <div style="display:flex;align-items:center;gap:0.5rem;">
                    <div style="flex:1;height:6px;background:rgba(255,255,255,0.1);border-radius:3px;overflow:hidden;">
                      <div style="width:<?php echo e($enrollment->progress_percentage); ?>%;height:100%;background:linear-gradient(90deg,#10b981,#3b82f6);"></div>
                    </div>
                    <div style="font-size:0.75rem;min-width:3rem;text-align:right;"><?php echo e($enrollment->progress_percentage); ?>%</div>
                  </div>
                  <div class="muted" style="font-size:0.75rem;margin-top:0.25rem;"><?php echo e($enrollment->completed_lessons); ?>/<?php echo e($totalLessons); ?> lessons</div>
                </div>
              </td>
              <td><?php echo e($enrollment->enrolled_at->format('M j, Y')); ?></td>
              <td>
                <div style="display:flex;gap:0.25rem;flex-wrap:wrap;">
                  <?php if($enrollment->status === 'pending'): ?>
                    <form method="POST" action="<?php echo e(route('admin.courses.enrollments.approve', $enrollment)); ?>" style="display:inline;">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('PATCH'); ?>
                      <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Approve this enrollment?')" title="Approve">
                        <i class="fas fa-check"></i>
                      </button>
                    </form>
                    <form method="POST" action="<?php echo e(route('admin.courses.enrollments.reject', $enrollment)); ?>" style="display:inline;">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('PATCH'); ?>
                      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Reject this enrollment?')" title="Reject">
                        <i class="fas fa-times"></i>
                      </button>
                    </form>
                  <?php elseif($enrollment->status === 'active'): ?>
                    <form method="POST" action="<?php echo e(route('admin.courses.enrollments.suspend', $enrollment)); ?>" style="display:inline;">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('PATCH'); ?>
                      <button type="submit" class="btn btn-sm btn-warning" onclick="return confirm('Suspend this student?')" title="Suspend">
                        <i class="fas fa-pause"></i>
                      </button>
                    </form>
                    <form method="POST" action="<?php echo e(route('admin.courses.enrollments.drop', $enrollment)); ?>" style="display:inline;">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('PATCH'); ?>
                      <button type="submit" class="btn btn-sm btn-secondary" onclick="return confirm('Drop this student?')" title="Drop">
                        <i class="fas fa-user-minus"></i>
                      </button>
                    </form>
                    <form method="POST" action="<?php echo e(route('admin.courses.enrollments.warn', $enrollment)); ?>" style="display:inline;">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('PATCH'); ?>
                      <button type="submit" class="btn btn-sm btn-info" onclick="return confirm('Send warning?')" title="Send Warning">
                        <i class="fas fa-exclamation-triangle"></i>
                      </button>
                    </form>
                  <?php elseif($enrollment->status === 'suspended'): ?>
                    <form method="POST" action="<?php echo e(route('admin.courses.enrollments.reenroll', $enrollment)); ?>" style="display:inline;">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('PATCH'); ?>
                      <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Reactivate enrollment?')" title="Reactivate">
                        <i class="fas fa-play"></i>
                      </button>
                    </form>
                  <?php elseif($enrollment->status === 'dropped'): ?>
                    <form method="POST" action="<?php echo e(route('admin.courses.enrollments.reenroll', $enrollment)); ?>" style="display:inline;">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('PATCH'); ?>
                      <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Reenroll student?')" title="Reenroll">
                        <i class="fas fa-user-plus"></i>
                      </button>
                    </form>
                  <?php elseif($enrollment->status === 'rejected'): ?>
                    <form method="POST" action="<?php echo e(route('admin.courses.enrollments.approve', $enrollment)); ?>" style="display:inline;">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('PATCH'); ?>
                      <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Approve enrollment?')" title="Approve">
                        <i class="fas fa-check"></i>
                      </button>
                    </form>
                  <?php endif; ?>
                  
                  <?php if(in_array($enrollment->status, ['active', 'suspended', 'completed'])): ?>
                    <form method="POST" action="<?php echo e(route('admin.courses.enrollments.unenroll', $enrollment)); ?>" style="display:inline;">
                      <?php echo csrf_field(); ?>
                      <?php echo method_field('DELETE'); ?>
                      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Permanently unenroll? This cannot be undone.')" title="Unenroll">
                        <i class="fas fa-trash"></i>
                      </button>
                    </form>
                  <?php endif; ?>
                </div>
              </td>
            </tr>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
      </table>
    <?php else: ?>
      <div style="text-align:center;padding:3rem 0;color:var(--cool-gray);">
        <i class="fas fa-users" style="font-size:3rem;margin-bottom:1rem;opacity:0.5;"></i>
        <h4 style="font-size:1.125rem;font-weight:600;margin-bottom:0.5rem;">No Enrollments Yet</h4>
        <p>Students will appear here once they enroll in this course.</p>
      </div>
    <?php endif; ?>
  </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/admin/courses/enrollments.blade.php ENDPATH**/ ?>