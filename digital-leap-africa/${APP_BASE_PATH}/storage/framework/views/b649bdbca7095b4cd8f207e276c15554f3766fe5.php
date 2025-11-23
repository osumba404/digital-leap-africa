

<?php $__env->startSection('title', 'Notifications'); ?>

<?php $__env->startPush('styles'); ?>
<style>
.notifications-container {
    max-width: 900px;
    margin: 2rem auto;
    padding: 0 1rem;
}

.notifications-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.notifications-title {
    font-size: 2rem;
    font-weight: 700;
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.notification-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1rem;
    transition: all 0.3s;
    display: flex;
    gap: 1rem;
}

.notification-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    border-color: rgba(0, 201, 255, 0.2);
}

.notification-card.unread {
    background: rgba(0, 201, 255, 0.05);
    border-left: 4px solid var(--cyan-accent);
}

/* Light mode */
[data-theme="light"] .notifications-title {
    background: linear-gradient(90deg, #2E78C5, #7c4dff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

[data-theme="light"] .notification-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .notification-card.unread {
    background: rgba(46, 120, 197, 0.05);
    border-left: 4px solid #2E78C5;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="notifications-container">
    <div class="notifications-header">
        <h1 class="notifications-title">All Notifications</h1>
        <?php if($notifications->where('is_read', false)->count() > 0): ?>
            <a href="#" class="btn-outline" onclick="markAllAsRead(event)">Mark all as read</a>
        <?php endif; ?>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="notification-card <?php echo e(!$notification->is_read ? 'unread' : ''); ?>">
            <div class="notification-icon <?php echo e($notification->type); ?>">
                <?php if($notification->type === 'course_enrollment'): ?>
                    <i class="fas fa-graduation-cap"></i>
                <?php elseif($notification->type === 'badge_earned'): ?>
                    <i class="fas fa-medal"></i>
                <?php elseif($notification->type === 'testimonial_approved'): ?>
                    <i class="fas fa-check-circle"></i>
                <?php elseif($notification->type === 'forum_reply'): ?>
                    <i class="fas fa-comment"></i>
                <?php elseif($notification->type === 'new_course'): ?>
                    <i class="fas fa-book"></i>
                <?php elseif($notification->type === 'new_article'): ?>
                    <i class="fas fa-newspaper"></i>
                <?php elseif($notification->type === 'lesson_completed'): ?>
                    <i class="fas fa-check-circle"></i>
                <?php elseif($notification->type === 'course_completed'): ?>
                    <i class="fas fa-trophy"></i>
                <?php elseif($notification->type === 'new_event'): ?>
                    <i class="fas fa-calendar-alt"></i>
                <?php elseif($notification->type === 'payment_success'): ?>
                    <i class="fas fa-check-circle"></i>
                <?php endif; ?>
            </div>
            <div style="flex: 1;">
                <h3 style="margin-bottom: 0.5rem; color: var(--diamond-white);"><?php echo e($notification->title); ?></h3>
                <p style="color: var(--cool-gray); margin-bottom: 0.5rem;"><?php echo e($notification->message); ?></p>
                <small style="color: var(--cool-gray);"><?php echo e($notification->created_at->diffForHumans()); ?></small>
                <?php if($notification->url): ?>
                    <a href="<?php echo e($notification->url); ?>" class="btn-outline btn-sm" style="margin-top: 0.5rem; display: inline-block;">View</a>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="text-align: center; padding: 4rem 2rem; color: var(--cool-gray);">
            <i class="fas fa-bell-slash" style="font-size: 4rem; margin-bottom: 1rem; opacity: 0.3;"></i>
            <p>No notifications yet</p>
        </div>
    <?php endif; ?>

    <?php echo e($notifications->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\notifications\index.blade.php ENDPATH**/ ?>