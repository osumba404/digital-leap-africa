

<?php $__env->startSection('title', 'Confirm Details - ' . $course->title . ' | Digital Leap Africa'); ?>

<?php $__env->startSection('content'); ?>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6">
      <div class="lesson-header" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 2rem; margin-bottom: 2rem;">
        <div class="breadcrumb mb-2">
          <a href="<?php echo e(route('courses.show', $course)); ?>"><?php echo e($course->title); ?></a>
          <span class="mx-2">›</span>
          <span>Confirm your details</span>
        </div>
        <h1 style="font-size: 1.5rem; font-weight: 700; color: var(--diamond-white); margin-bottom: 0.5rem;">
          Confirm your details
        </h1>
        <p style="color: var(--cool-gray); margin-bottom: 0;">
          Please confirm your name and email before enrolling in <strong><?php echo e($course->title); ?></strong>.
        </p>
      </div>

      <?php if($preCourseTest): ?>
        <div style="background: rgba(0, 201, 255, 0.08); border: 1px solid rgba(0, 201, 255, 0.25); border-radius: 12px; padding: 1.25rem; margin-bottom: 2rem;">
          <p style="color: var(--diamond-white); margin: 0; font-size: 0.95rem;">
            <i class="fas fa-clipboard-check me-2" style="color: var(--cyan-accent);"></i>
            After you confirm, you will take a short <strong>pre-course test</strong> before your enrollment is activated. It does not count toward your final grade.
          </p>
        </div>
      <?php endif; ?>

      <div class="lesson-content" style="background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 12px; padding: 2rem;">
        <form method="POST" action="<?php echo e(route('courses.confirm-enroll', $course)); ?>">
          <?php echo csrf_field(); ?>
          <div class="mb-4">
            <label for="name" class="form-label" style="color: var(--diamond-white); font-weight: 600;">Full name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>" required
                   style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: var(--diamond-white); padding: 0.75rem;">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <p class="text-danger small mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
          <div class="mb-4">
            <label for="email" class="form-label" style="color: var(--diamond-white); font-weight: 600;">Email address</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo e(old('email', $user->email)); ?>" required
                   style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1); color: var(--diamond-white); padding: 0.75rem;">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <p class="text-danger small mt-1"><?php echo e($message); ?></p>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>
          <div class="d-flex gap-2 flex-wrap">
            <button type="submit" class="btn-primary" style="padding: 0.75rem 2rem; font-size: 1.05rem;">
              <?php if($preCourseTest): ?>
                <i class="fas fa-arrow-right me-2"></i>Confirm &amp; take pre-course test
              <?php else: ?>
                <i class="fas fa-check me-2"></i>Confirm &amp; enroll
              <?php endif; ?>
            </button>
            <a href="<?php echo e(route('courses.show', $course)); ?>" class="btn-outline" style="padding: 0.75rem 1.5rem;">Cancel</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/pages/courses/enroll-form.blade.php ENDPATH**/ ?>