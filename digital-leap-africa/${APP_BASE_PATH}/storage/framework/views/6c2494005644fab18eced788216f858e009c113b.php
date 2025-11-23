

<?php $__env->startSection('title', 'Contact Message'); ?>

<?php $__env->startSection('admin-content'); ?>
<div class="admin-header">
    <h1>Contact Message</h1>
    <a href="<?php echo e(route('admin.contact-messages.index')); ?>" class="btn-outline">
        <i class="fas fa-arrow-left"></i> Back to Messages
    </a>
</div>

<?php if(session('success')): ?>
    <div class="alert alert-success"><?php echo e(session('success')); ?></div>
<?php endif; ?>

<div class="message-grid">
    <!-- Message Details -->
    <div class="admin-card">
        <div class="message-header">
            <div class="sender-info">
                <h2><?php echo e($contactMessage->name); ?></h2>
                <p><?php echo e($contactMessage->email); ?></p>
                <span class="message-date"><?php echo e($contactMessage->created_at->format('M j, Y \a\t g:i A')); ?></span>
            </div>
            <div class="message-status">
                <?php if($contactMessage->admin_reply): ?>
                    <span class="status-badge replied">Replied</span>
                <?php elseif($contactMessage->is_read): ?>
                    <span class="status-badge read">Read</span>
                <?php else: ?>
                    <span class="status-badge unread">Unread</span>
                <?php endif; ?>
            </div>
        </div>

        <div class="message-subject">
            <h3><?php echo e($contactMessage->subject); ?></h3>
        </div>

        <div class="message-content">
            <h4>Message:</h4>
            <div class="message-text">
                <?php echo nl2br(e($contactMessage->message)); ?>

            </div>
        </div>

        <?php if($contactMessage->admin_reply): ?>
            <div class="admin-reply-display">
                <h4>Your Reply:</h4>
                <div class="reply-text">
                    <?php echo nl2br(e($contactMessage->admin_reply)); ?>

                </div>
                <small class="reply-date">Replied on <?php echo e($contactMessage->replied_at->format('M j, Y \a\t g:i A')); ?></small>
            </div>
        <?php endif; ?>
    </div>

    <!-- Reply Form -->
    <div class="admin-card">
        <h3><?php echo e($contactMessage->admin_reply ? 'Update Reply' : 'Send Reply'); ?></h3>
        
        <form action="<?php echo e(route('admin.contact-messages.reply', $contactMessage)); ?>" method="POST" class="reply-form">
            <?php echo csrf_field(); ?>
            <div class="form-group">
                <label for="admin_reply">Reply Message</label>
                <textarea id="admin_reply" name="admin_reply" rows="8" placeholder="Type your reply here..." required><?php echo e(old('admin_reply', $contactMessage->admin_reply)); ?></textarea>
                <?php $__errorArgs = ['admin_reply'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="error"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">
                    <i class="fas fa-reply"></i>
                    <?php echo e($contactMessage->admin_reply ? 'Update Reply' : 'Send Reply'); ?>

                </button>
            </div>
        </form>
    </div>
</div>

<style>
.admin-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 2rem;
}

.message-grid {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
}

.message-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1.5rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.sender-info h2 {
    margin: 0 0 0.25rem 0;
    color: var(--diamond-white);
}

.sender-info p {
    margin: 0 0 0.5rem 0;
    color: var(--cyan-accent);
}

.message-date {
    color: var(--cool-gray);
    font-size: 0.875rem;
}

.status-badge {
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.875rem;
    font-weight: 600;
}

.status-badge.unread {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
}

.status-badge.read {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.status-badge.replied {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
}

.message-subject {
    margin-bottom: 1.5rem;
}

.message-subject h3 {
    color: var(--diamond-white);
    margin: 0;
    font-size: 1.25rem;
}

.message-content h4,
.admin-reply-display h4 {
    color: var(--diamond-white);
    margin: 0 0 0.75rem 0;
    font-size: 1rem;
}

.message-text,
.reply-text {
    background: rgba(255, 255, 255, 0.05);
    padding: 1rem;
    border-radius: 8px;
    color: var(--cool-gray);
    line-height: 1.6;
    margin-bottom: 0.5rem;
}

.admin-reply-display {
    margin-top: 2rem;
    padding-top: 1.5rem;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.reply-date {
    color: var(--cool-gray);
    font-size: 0.875rem;
}

.reply-form .form-group {
    margin-bottom: 1.5rem;
}

.reply-form label {
    display: block;
    margin-bottom: 0.5rem;
    color: var(--diamond-white);
    font-weight: 600;
}

.reply-form textarea {
    width: 100%;
    padding: 0.75rem;
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 8px;
    background: rgba(255, 255, 255, 0.05);
    color: var(--diamond-white);
    font-size: 1rem;
    resize: vertical;
}

.reply-form textarea:focus {
    outline: none;
    border-color: var(--cyan-accent);
    box-shadow: 0 0 0 2px rgba(0, 201, 255, 0.2);
}

.error {
    color: #ef4444;
    font-size: 0.875rem;
    margin-top: 0.25rem;
    display: block;
}

.btn-primary {
    background: linear-gradient(135deg, var(--cyan-accent), var(--primary-blue));
    color: white;
    border: none;
    padding: 0.875rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 201, 255, 0.3);
}

/* Light Mode */
[data-theme="light"] .message-header {
    border-bottom-color: rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .sender-info h2,
[data-theme="light"] .message-subject h3,
[data-theme="light"] .message-content h4,
[data-theme="light"] .admin-reply-display h4,
[data-theme="light"] .reply-form label {
    color: var(--charcoal);
}

[data-theme="light"] .sender-info p {
    color: var(--primary-blue);
}

[data-theme="light"] .message-text,
[data-theme="light"] .reply-text {
    background: rgba(46, 120, 197, 0.05);
    color: var(--cool-gray);
}

[data-theme="light"] .reply-form textarea {
    background: #FFFFFF;
    border-color: rgba(46, 120, 197, 0.2);
    color: var(--charcoal);
}

[data-theme="light"] .admin-reply-display {
    border-top-color: rgba(46, 120, 197, 0.2);
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .message-grid {
        grid-template-columns: 1fr;
        gap: 1.5rem;
    }
    
    .message-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
    
    .admin-header {
        flex-direction: column;
        align-items: flex-start;
        gap: 1rem;
    }
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\admin\contact-messages\show.blade.php ENDPATH**/ ?>