

<?php $__env->startSection('content'); ?>
<div class="greeting">Hello <?php echo e($user->name); ?>,</div>

<div class="message">
    <p>We've added a new event you might be interested in.</p>
</div>

<div class="info-box">
    <h3><?php echo e($event->title); ?></h3>
    <ul style="list-style: none; padding: 0; margin: 12px 0 0;">
        <li style="margin-bottom: 6px;"><strong>Date:</strong> <?php echo e(\Carbon\Carbon::parse($event->date)->format('l, F j, Y')); ?></li>
        <li style="margin-bottom: 6px;"><strong>Location:</strong> <?php echo e($event->location ?? 'TBA'); ?></li>
        <?php if(!empty($event->topic)): ?>
            <li style="margin-bottom: 6px;"><strong>Topic:</strong> <?php echo e($event->topic); ?></li>
        <?php endif; ?>
    </ul>
    <?php if(!empty($event->description)): ?>
        <p style="margin-top: 12px; margin-bottom: 0;"><?php echo e(Str::limit(strip_tags($event->description), 180)); ?></p>
    <?php endif; ?>
</div>

<div style="text-align: center; margin: 24px 0;">
    <a href="<?php echo e(route('events.show', $event->slug ?? $event->id)); ?>" class="cta-button">View Event Details</a>
</div>

<div class="message">
    <p>We hope to see you there!</p>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('emails.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/emails/new-event.blade.php ENDPATH**/ ?>