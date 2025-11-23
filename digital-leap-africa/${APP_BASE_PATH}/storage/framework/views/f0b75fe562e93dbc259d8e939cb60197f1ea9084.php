

<?php $__env->startPush('styles'); ?>
<style>
.testimonials-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

.page-header {
    text-align: center;
    margin-bottom: 3rem;
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}

.page-subtitle {
    color: var(--cool-gray);
    font-size: 1.1rem;
}

.filters-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
    flex-wrap: wrap;
}

.filter-group {
    display: flex;
    gap: 0.5rem;
    align-items: center;
}

.filter-btn {
    padding: 0.5rem 1rem;
    border-radius: 8px;
    border: 1px solid rgba(255, 255, 255, 0.1);
    background: rgba(255, 255, 255, 0.03);
    color: var(--diamond-white);
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    font-size: 0.9rem;
}

.filter-btn:hover {
    background: rgba(255, 255, 255, 0.08);
    border-color: rgba(0, 201, 255, 0.3);
}

.filter-btn.active {
    background: rgba(0, 201, 255, 0.15);
    border-color: rgba(0, 201, 255, 0.4);
    color: var(--cyan-accent);
}

.testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 2rem;
}

.testimonial-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 12px;
    padding: 1.5rem;
    transition: all 0.3s ease;
    width: 100%;
    box-sizing: border-box;
    overflow: hidden;
}

.testimonial-card:hover {
    background: rgba(255, 255, 255, 0.05);
    border-color: rgba(0, 201, 255, 0.3);
    transform: translateY(-2px);
}

.testimonial-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
}

.testimonial-avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid rgba(0, 201, 255, 0.3);
}

.testimonial-avatar-placeholder {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--cyan-accent), var(--purple-accent));
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 1.2rem;
    color: white;
}

.testimonial-info {
    flex: 1;
}

.testimonial-name {
    font-weight: 600;
    color: var(--diamond-white);
    margin-bottom: 0.25rem;
    word-wrap: break-word;
    overflow-wrap: break-word;
}

.testimonial-date {
    font-size: 0.85rem;
    color: var(--cool-gray);
}

.testimonial-quote {
    color: var(--diamond-white);
    line-height: 1.6;
    font-style: italic;
    position: relative;
    padding-left: 1rem;
    border-left: 3px solid rgba(0, 201, 255, 0.3);
    word-wrap: break-word;
    word-break: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
}

.testimonial-status {
    display: inline-block;
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 500;
    margin-top: 0.75rem;
}

.status-approved {
    background: rgba(34, 197, 94, 0.2);
    color: #22c55e;
    border: 1px solid rgba(34, 197, 94, 0.3);
}

.status-pending {
    background: rgba(251, 191, 36, 0.2);
    color: #fbbf24;
    border: 1px solid rgba(251, 191, 36, 0.3);
}

.empty-state {
    text-align: center;
    padding: 3rem 1rem;
    color: var(--cool-gray);
}

.empty-state i {
    font-size: 3rem;
    color: var(--cyan-accent);
    margin-bottom: 1rem;
}

@media (max-width: 768px) {
    .testimonials-container {
        padding: 1.5rem 0.75rem;
    }

    .testimonials-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .page-header {
        margin-bottom: 2rem;
    }
    
    .page-title {
        font-size: 2rem;
    }
    
    .page-subtitle {
        font-size: 1rem;
    }
    
    .filters-bar {
        flex-direction: column;
        align-items: stretch;
        gap: 0.75rem;
    }
    
    .filter-group {
        justify-content: center;
        flex-wrap: wrap;
    }
    
    .filter-btn {
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
    }
    
    .testimonial-card {
        padding: 1.25rem;
    }
    
    .testimonial-header {
        gap: 0.75rem;
    }
    
    .testimonial-avatar,
    .testimonial-avatar-placeholder {
        width: 45px;
        height: 45px;
        font-size: 1rem;
    }
    
    .testimonial-name {
        font-size: 0.95rem;
    }
    
    .testimonial-date {
        font-size: 0.8rem;
    }
    
    .testimonial-quote {
        font-size: 0.95rem;
        padding-left: 0.75rem;
        word-wrap: break-word;
        word-break: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
    }
}

@media (max-width: 480px) {
    .testimonials-container {
        padding: 1rem 0.5rem;
    }
    
    .page-title {
        font-size: 1.75rem;
    }
    
    .page-subtitle {
        font-size: 0.9rem;
    }
    
    .filter-btn {
        font-size: 0.8rem;
        padding: 0.4rem 0.6rem;
    }
    
    .testimonial-card {
        padding: 1rem;
    }
    
    .testimonial-quote {
        font-size: 0.9rem;
        word-wrap: break-word;
        word-break: break-word;
        overflow-wrap: break-word;
        hyphens: auto;
    }
}

/* Light Mode Styles */
[data-theme="light"] .page-title {
    background: linear-gradient(90deg, #2E78C5, #7c4dff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

[data-theme="light"] .page-subtitle {
    color: #4A5568;
}

[data-theme="light"] .filter-btn {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    color: #1A202C;
}

[data-theme="light"] .filter-btn:hover {
    background: rgba(46, 120, 197, 0.05);
    border-color: rgba(46, 120, 197, 0.4);
}

[data-theme="light"] .filter-btn.active {
    background: rgba(46, 120, 197, 0.15);
    border-color: rgba(46, 120, 197, 0.5);
    color: #2E78C5;
}

[data-theme="light"] .testimonial-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .testimonial-card:hover {
    background: #FFFFFF;
    border-color: rgba(46, 120, 197, 0.4);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

[data-theme="light"] .testimonial-name {
    color: #1A202C;
}

[data-theme="light"] .testimonial-date {
    color: #4A5568;
}

[data-theme="light"] .testimonial-quote {
    color: #1A202C;
    border-left-color: rgba(46, 120, 197, 0.4);
}

[data-theme="light"] .testimonial-avatar {
    border-color: rgba(46, 120, 197, 0.4);
}

[data-theme="light"] .empty-state {
    color: #4A5568;
}

[data-theme="light"] .empty-state i {
    color: #2E78C5;
}

[data-theme="light"] .filters-bar span {
    color: #4A5568 !important;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="testimonials-container">
    <div class="page-header">
        <h1 class="page-title">Testimonials</h1>
        <p class="page-subtitle">Hear what our community members have to say</p>
        <?php if(auth()->guard()->check()): ?>
        <div style="margin-top: 1.5rem;">
            <a href="<?php echo e(route('testimonials.create')); ?>" class="btn-primary" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.75rem 1.5rem; text-decoration: none;">
                <i class="fas fa-plus"></i>
                <span>Share Your Testimonial</span>
            </a>
        </div>
        <?php endif; ?>
    </div>

    <div class="filters-bar">
        <div class="filter-group">
            <span style="color: var(--cool-gray); font-size: 0.9rem;">Filter:</span>
            <a href="<?php echo e(route('testimonials.index', ['sort' => $sort, 'filter' => 'all'])); ?>" 
               class="filter-btn <?php echo e($filter === 'all' ? 'active' : ''); ?>">
                <i class="fas fa-globe me-1"></i>All Testimonials
            </a>
            <?php if(auth()->guard()->check()): ?>
            <a href="<?php echo e(route('testimonials.index', ['sort' => $sort, 'filter' => 'mine'])); ?>" 
               class="filter-btn <?php echo e($filter === 'mine' ? 'active' : ''); ?>">
                <i class="fas fa-user me-1"></i>My Testimonials
            </a>
            <?php endif; ?>
        </div>

        <div class="filter-group">
            <span style="color: var(--cool-gray); font-size: 0.9rem;">Sort:</span>
            <a href="<?php echo e(route('testimonials.index', ['sort' => 'latest', 'filter' => $filter])); ?>" 
               class="filter-btn <?php echo e($sort === 'latest' ? 'active' : ''); ?>">
                <i class="fas fa-arrow-down me-1"></i>Latest
            </a>
            <a href="<?php echo e(route('testimonials.index', ['sort' => 'oldest', 'filter' => $filter])); ?>" 
               class="filter-btn <?php echo e($sort === 'oldest' ? 'active' : ''); ?>">
                <i class="fas fa-arrow-up me-1"></i>Oldest
            </a>
        </div>
    </div>

    <?php if($testimonials->count()): ?>
    <div class="testimonials-grid">
        <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="testimonial-card">
            <div class="testimonial-header">
                <?php if($testimonial->user && $testimonial->user->profile_photo): ?>
                    <img src="<?php echo e(route('me.photo')); ?>?user_id=<?php echo e($testimonial->user_id); ?>" 
                         alt="<?php echo e($testimonial->name); ?>" 
                         class="testimonial-avatar"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="testimonial-avatar-placeholder" style="display:none;">
                        <?php echo e(strtoupper(substr($testimonial->name ?? 'U', 0, 1))); ?>

                    </div>
                <?php elseif($testimonial->avatar_path): ?>
                    <img src="<?php echo e(Storage::url($testimonial->avatar_path)); ?>" 
                         alt="<?php echo e($testimonial->name); ?>" 
                         class="testimonial-avatar"
                         onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                    <div class="testimonial-avatar-placeholder" style="display:none;">
                        <?php echo e(strtoupper(substr($testimonial->name ?? 'U', 0, 1))); ?>

                    </div>
                <?php else: ?>
                    <div class="testimonial-avatar-placeholder">
                        <?php echo e(strtoupper(substr($testimonial->name ?? 'U', 0, 1))); ?>

                    </div>
                <?php endif; ?>
                <div class="testimonial-info">
                    <div class="testimonial-name"><?php echo e($testimonial->name ?? 'Anonymous'); ?></div>
                    <div class="testimonial-date">
                        <i class="far fa-calendar me-1"></i>
                        <?php echo e($testimonial->created_at?->format('M d, Y')); ?>

                    </div>
                </div>
            </div>
            <div class="testimonial-quote">
                <?php echo e($testimonial->quote); ?>

            </div>
            <?php if($filter === 'mine'): ?>
                <span class="testimonial-status <?php echo e($testimonial->is_active ? 'status-approved' : 'status-pending'); ?>">
                    <?php echo e($testimonial->is_active ? 'Approved' : 'Pending Review'); ?>

                </span>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div style="margin-top: 2rem;">
        <?php echo e($testimonials->links()); ?>

    </div>
    <?php else: ?>
    <div class="empty-state">
        <i class="fas fa-quote-left"></i>
        <h3>No testimonials found</h3>
        <p><?php echo e($filter === 'mine' ? 'You haven\'t submitted any testimonials yet.' : 'Be the first to share your experience!'); ?></p>
        <?php if(auth()->guard()->check()): ?>
        <a href="<?php echo e(route('testimonials.create')); ?>" class="btn-primary" style="margin-top: 1rem;">
            <i class="fas fa-plus me-1"></i>Share Your Testimonial
        </a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\testimonials\index.blade.php ENDPATH**/ ?>