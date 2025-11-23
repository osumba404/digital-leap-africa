

<?php $__env->startSection('content'); ?>
<style>
.forum-container {
    max-width: 1000px;
    margin: 0 auto;
}

.forum-hero {
    background: linear-gradient(135deg, rgba(10, 15, 28, 0.95) 0%, rgba(19, 26, 42, 0.9) 100%);
    padding: 3rem 0;
    margin: -2rem -5% 3rem;
    border-radius: 0 0 24px 24px;
    position: relative;
    overflow: hidden;
}

[data-theme="light"] .forum-hero {
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.98) 0%, rgba(230, 242, 255, 0.95) 100%);
    border-bottom: 2px solid rgba(46, 120, 197, 0.2);
}

.forum-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: radial-gradient(circle at 80% 50%, rgba(0, 201, 255, 0.1) 0%, transparent 50%);
    pointer-events: none;
}

.forum-hero-content {
    position: relative;
    z-index: 1;
}

.thread-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 1.75rem;
    margin-bottom: 1.25rem;
    transition: all 0.3s ease;
    position: relative;
}

.thread-card:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3);
    border-color: rgba(0, 201, 255, 0.3);
}

.thread-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 1rem;
    gap: 1rem;
}

.thread-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--diamond-white);
    text-decoration: none;
    margin-bottom: 0.5rem;
    display: block;
}

.thread-title:hover {
    color: var(--cyan-accent);
}

.thread-meta {
    color: var(--cool-gray);
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex-wrap: wrap;
}

.thread-author {
    color: var(--cyan-accent);
    font-weight: 500;
}

.thread-content {
    color: var(--cool-gray);
    line-height: 1.6;
    margin-bottom: 1rem;
}

.reply-count {
    background: rgba(0, 201, 255, 0.2);
    color: var(--cyan-accent);
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-size: 0.8rem;
    font-weight: 500;
    white-space: nowrap;
}

.forum-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1rem;
    margin-bottom: 2rem;
}

.stat-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius);
    padding: 1.5rem;
    text-align: center;
}

.stat-number {
    font-size: 2rem;
    font-weight: 700;
    color: var(--cyan-accent);
    display: block;
}

.stat-label {
    color: var(--cool-gray);
    font-size: 0.9rem;
    margin-top: 0.5rem;
}

@media (max-width: 768px) {
    .thread-header {
        flex-direction: column;
        align-items: flex-start;
    }
    
    .thread-meta {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.25rem;
    }
}

/* ========== Light Mode Styles ========== */
[data-theme="light"] .thread-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .thread-card:hover {
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
}

[data-theme="light"] .thread-title {
    color: var(--primary-blue);
}

[data-theme="light"] .thread-title:hover {
    color: var(--purple-accent);
}

[data-theme="light"] .thread-meta {
    color: var(--cool-gray);
}

[data-theme="light"] .thread-author {
    color: var(--primary-blue);
}

[data-theme="light"] .thread-content {
    color: var(--cool-gray);
}

[data-theme="light"] .reply-count {
    background: rgba(46, 120, 197, 0.15);
    color: var(--primary-blue);
}

[data-theme="light"] .stat-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .stat-number {
    color: var(--primary-blue);
}

[data-theme="light"] .stat-label {
    color: var(--cool-gray);
}
</style>

<div class="container">
    <div class="forum-container">
        <div style="display: flex; align-items: center; justify-content: space-between; gap: 1rem; margin-bottom: 3rem; flex-wrap: wrap;">
            <div style="text-align: left;">
                <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;">Community Forum</h1>
                <p style="color: var(--cool-gray); font-size: 1.1rem; margin: 0;">Connect, discuss, and learn with fellow community members</p>
            </div>
            <div>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('forum.create')); ?>" class="btn-primary" style="padding: 0.75rem 1.5rem; white-space: nowrap;">
                        <i class="fas fa-plus me-2"></i>Start Discussion
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn-primary" style="padding: 0.75rem 1.5rem; white-space: nowrap;">
                        <i class="fas fa-sign-in-alt me-2"></i>Login to Participate
                    </a>
                <?php endif; ?>
            </div>
        </div>



        
        <?php if($threads->count() > 0): ?>
            <div>
                <?php $__currentLoopData = $threads; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $thread): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="thread-card">
                        <div class="thread-header">
                            <div style="flex-grow: 1; display:flex; gap:.75rem; align-items:flex-start;">
                                <div style="flex:0 0 auto;">
                                    <?php if($thread->user && $thread->user->profile_photo): ?>
                                        <img src="<?php echo e(route('me.photo', ['user_id' => $thread->user->id])); ?>" alt="<?php echo e($thread->user->name); ?>" style="width:40px;height:40px;border-radius:50%;object-fit:cover;display:block;">
                                    <?php else: ?>
                                        <div style="width:40px;height:40px;border-radius:50%;background: var(--charcoal);color:#fff;display:flex;align-items:center;justify-content:center;font-weight:700;">
                                            <?php echo e(strtoupper(substr($thread->user->name, 0, 1))); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div style="min-width:0;">
                                    <a href="<?php echo e(route('forum.show', $thread->id)); ?>" class="thread-title">
                                        <?php echo e($thread->title); ?>

                                    </a>
                                    <div class="thread-meta">
                                        <i class="fas fa-user"></i>
                                        <span class="thread-author"><?php echo e($thread->user->name); ?></span>
                                        <span>•</span>
                                        <i class="fas fa-clock"></i>
                                        <span><?php echo e($thread->created_at->diffForHumans()); ?></span>
                                    </div>
                                </div>
                            </div>

                            <div class="reply-count">
                                <i class="fas fa-comments me-1"></i><?php echo e($thread->replies_count); ?>

                            </div>
                        </div>

                        <div class="thread-content">
                            <?php echo e(Str::limit($thread->content ?? $thread->body ?? '', 200)); ?>

                        </div>

                        <?php if($thread->latestReply): ?>
                            <div style="padding-top: 1rem; border-top: 1px solid rgba(255, 255, 255, 0.1); color: var(--cool-gray); font-size: 0.9rem; display:flex; align-items:center; gap:.5rem;">
                                <i class="fas fa-reply me-1"></i>
                                <?php $lrUser = $thread->latestReply->user; ?>
                                <?php if($lrUser && $lrUser->profile_photo): ?>
                                    <img src="<?php echo e(route('me.photo', ['user_id' => $lrUser->id])); ?>" alt="<?php echo e($lrUser->name); ?>" style="width:20px;height:20px;border-radius:50%;object-fit:cover;">
                                <?php else: ?>
                                    <span style="width:20px;height:20px;border-radius:50%;background: var(--charcoal);color:#fff;display:inline-flex;align-items:center;justify-content:center;font-size:.75rem;font-weight:700;"><?php echo e(strtoupper(substr($lrUser->name,0,1))); ?></span>
                                <?php endif; ?>
                                <span>Latest reply by <span style="color: var(--cyan-accent);"><?php echo e($lrUser->name); ?></span> <?php echo e($thread->latestReply->created_at->diffForHumans()); ?></span>
                            </div>
                        <?php endif; ?>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php if(method_exists($threads, 'links')): ?>
                    <div style="margin-top: 2rem; display: flex; justify-content: center;">
                        <?php echo e($threads->links()); ?>

                    </div>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div style="text-align: center; padding: 4rem 0;">
                <i class="fas fa-comments" style="font-size: 4rem; color: var(--cool-gray); opacity: 0.5; margin-bottom: 1rem;"></i>
                <h3 style="color: var(--cool-gray); margin-bottom: 1rem;">No Discussions Yet</h3>
                <p style="color: var(--cool-gray); margin-bottom: 2rem;">Be the first to start a conversation in our community forum!</p>
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('forum.create')); ?>" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                        <i class="fas fa-plus me-2"></i>Start Discussion
                    </a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="btn-primary" style="padding: 0.75rem 1.5rem;">
                        <i class="fas fa-sign-in-alt me-2"></i>Login to Participate
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views/pages/forum/index.blade.php ENDPATH**/ ?>