

<?php $__env->startSection('title', 'Share a Testimonial'); ?>

<?php $__env->startPush('styles'); ?>
<style>
.testimonial-form-card {
    background: #112240;
    border-radius: 12px;
    border: 1px solid rgba(136, 146, 176, 0.2);
    max-width: 760px;
    margin: 0 auto;
}

.info-box {
    padding: 1rem;
    background: rgba(0, 201, 255, 0.05);
    border-radius: 8px;
    border: 1px solid rgba(0, 201, 255, 0.2);
}

/* Light Mode Styles */
[data-theme="light"] .testimonial-form-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] h1 {
    color: #1A202C !important;
}

[data-theme="light"] .text-muted {
    color: #4A5568 !important;
}

[data-theme="light"] .form-label {
    color: #1A202C;
}

[data-theme="light"] .form-control {
    background: #F8FAFC;
    border: 1px solid rgba(46, 120, 197, 0.2);
    color: #1A202C;
}

[data-theme="light"] .form-control:focus {
    background: #FFFFFF;
    border-color: #2E78C5;
    box-shadow: 0 0 0 0.2rem rgba(46, 120, 197, 0.25);
}

[data-theme="light"] .form-control::placeholder {
    color: #94a3b8;
}

[data-theme="light"] .info-box {
    background: rgba(46, 120, 197, 0.05);
    border: 1px solid rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .info-box p {
    color: #4A5568 !important;
}

[data-theme="light"] .info-box i {
    color: #2E78C5 !important;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<section class="section" style="padding:2rem 0;">
  <div class="container">
    <div class="text-center mb-3" style="text-align:center !important; color: #64b5f6; font-size: 22px">
      <h1 class="m-0">Share a Testimonial</h1>
      <p class="text-muted" style="margin-top:.5rem;color:#94a3b8">Tell others about your learning experience. Your testimonial will be published immediately.</p>
    </div>

    <div class="card testimonial-form-card">
      <div class="card-body" style="padding:1.25rem 1.25rem;">
        <form method="POST" action="<?php echo e(route('testimonials.store')); ?>">
          <?php echo csrf_field(); ?>

          <div class="mb-3">
            <label class="form-label">Your Testimonial</label>
            <textarea name="quote" rows="5" class="form-control" placeholder="Share how Digital Leap Africa helped you..." required><?php echo e(old('quote')); ?></textarea>
            <?php $__errorArgs = ['quote'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <div class="text-danger" style="margin-top:.25rem;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          </div>

          <!-- <div class="mb-3 info-box">
            <p style="margin: 0; color: var(--cool-gray); font-size: 0.9rem;">
              <i class="fas fa-info-circle" style="color: var(--cyan-accent); margin-right: 0.5rem;"></i>
              Your profile photo will be used automatically for this testimonial.
            </p>
          </div> -->

          <div class="d-grid" style="display:grid; gap:.75rem; grid-template-columns: 1fr;">
            <button type="submit" class="btn btn-primary btn-wide">Submit Testimonial</button>
            <a href="<?php echo e(route('testimonials.index')); ?>" class="btn btn-outline-secondary btn-wide">View Testimonials</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\testimonials\create.blade.php ENDPATH**/ ?>