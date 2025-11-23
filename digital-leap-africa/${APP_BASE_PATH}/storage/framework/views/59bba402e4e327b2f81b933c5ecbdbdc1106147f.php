

<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/mobile-responsive.css')); ?>">
<style>
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.02);
    }
}

@keyframes shimmer {
    0% {
        background-position: -200px 0;
    }
    100% {
        background-position: calc(200px + 100%) 0;
    }
}

.points-container {
    max-width: 1000px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

.points-header {
    text-align: center;
    margin-bottom: 3rem;
    animation: fadeInUp 0.8s ease-out;
}

.points-title {
    font-size: 2.5rem;
    font-weight: 700;
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
}

.points-subtitle {
    color: var(--cool-gray);
    font-size: 1.1rem;
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1.5rem;
    margin-bottom: 3rem;
    animation: fadeInUp 0.8s ease-out 0.2s both;
}

.stat-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 2rem;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -200px;
    width: 200px;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
    animation: shimmer 2s infinite;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3);
    border-color: rgba(0, 201, 255, 0.3);
}

.stat-card.points {
    background: linear-gradient(135deg, rgba(0, 201, 255, 0.1) 0%, rgba(122, 95, 255, 0.1) 100%);
    border-color: rgba(0, 201, 255, 0.2);
}

.stat-card.level {
    background: linear-gradient(135deg, rgba(122, 95, 255, 0.1) 0%, rgba(255, 107, 107, 0.1) 100%);
    border-color: rgba(122, 95, 255, 0.2);
}

.stat-icon {
    font-size: 2.5rem;
    margin-bottom: 1rem;
    display: block;
}

.stat-card.points .stat-icon {
    color: var(--cyan-accent);
}

.stat-card.level .stat-icon {
    color: var(--purple-accent);
}

.stat-value {
    font-size: 3rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    animation: pulse 2s infinite;
}

.stat-card.points .stat-value {
    color: var(--cyan-accent);
}

.stat-card.level .stat-value {
    color: var(--purple-accent);
}

.stat-label {
    color: var(--cool-gray);
    font-size: 1.1rem;
    font-weight: 500;
}

.rewards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
    margin-bottom: 3rem;
}

.reward-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 16px;
    padding: 1.5rem;
    transition: all 0.3s ease;
    animation: fadeInUp 0.8s ease-out both;
    position: relative;
    overflow: hidden;
}

.reward-card:nth-child(1) { animation-delay: 0.1s; }
.reward-card:nth-child(2) { animation-delay: 0.2s; }
.reward-card:nth-child(3) { animation-delay: 0.3s; }
.reward-card:nth-child(4) { animation-delay: 0.4s; }
.reward-card:nth-child(5) { animation-delay: 0.5s; }
.reward-card:nth-child(6) { animation-delay: 0.6s; }

.reward-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.3);
    border-color: rgba(0, 201, 255, 0.3);
}

.reward-card.affordable {
    border-color: rgba(34, 197, 94, 0.3);
    background: linear-gradient(135deg, rgba(34, 197, 94, 0.05) 0%, rgba(0, 201, 255, 0.05) 100%);
}

.reward-card.expensive {
    border-color: rgba(239, 68, 68, 0.3);
    background: linear-gradient(135deg, rgba(239, 68, 68, 0.05) 0%, rgba(255, 107, 107, 0.05) 100%);
}

.reward-icon {
    font-size: 2rem;
    color: var(--cyan-accent);
    margin-bottom: 1rem;
    display: block;
}

.reward-title {
    font-size: 1.25rem;
    font-weight: 600;
    color: var(--diamond-white);
    margin-bottom: 0.75rem;
}

.reward-description {
    color: var(--cool-gray);
    margin-bottom: 1.5rem;
    line-height: 1.6;
}

.reward-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
}

.reward-cost {
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent));
    color: var(--navy-bg);
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.9rem;
}

.reward-btn {
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    border: none;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 100px;
}

.reward-btn.available {
    background: linear-gradient(90deg, #22c55e, #16a34a);
    color: white;
}

.reward-btn.available:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 24px rgba(34, 197, 94, 0.4);
}

.reward-btn.unavailable {
    background: rgba(239, 68, 68, 0.1);
    color: #ef4444;
    border: 1px solid rgba(239, 68, 68, 0.3);
    cursor: not-allowed;
}

.earning-guide {
    background: linear-gradient(135deg, rgba(122, 95, 255, 0.1) 0%, rgba(0, 201, 255, 0.1) 100%);
    border: 1px solid rgba(122, 95, 255, 0.2);
    border-radius: 16px;
    padding: 2rem;
    animation: fadeInUp 0.8s ease-out 0.8s both;
}

.earning-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--diamond-white);
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.earning-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1rem;
    list-style: none;
    padding: 0;
    margin: 0;
}

.earning-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem;
    background: rgba(255, 255, 255, 0.05);
    border-radius: 8px;
    transition: all 0.3s ease;
}

.earning-item:hover {
    background: rgba(255, 255, 255, 0.1);
    transform: translateX(4px);
}

.earning-icon {
    color: var(--cyan-accent);
    font-size: 1.1rem;
    width: 20px;
    text-align: center;
}

.earning-text {
    color: var(--diamond-white);
    font-weight: 500;
}

.earning-points {
    color: var(--purple-accent);
    font-weight: 600;
    margin-left: auto;
}

/* Mobile Responsive Styles */
@media (max-width: 768px) {
    .points-container {
        padding: 1rem 0.5rem;
    }
    
    .points-title {
        font-size: 2rem;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .stat-card {
        padding: 1.5rem;
    }
    
    .stat-value {
        font-size: 2.5rem;
    }
    
    .rewards-grid {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .reward-card {
        padding: 1.25rem;
    }
    
    .reward-footer {
        flex-direction: column;
        align-items: stretch;
        gap: 0.75rem;
    }
    
    .reward-btn {
        width: 100%;
    }
    
    .earning-guide {
        padding: 1.5rem;
    }
    
    .earning-list {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 480px) {
    .points-container {
        padding: 0.75rem 0.25rem;
    }
    
    .points-title {
        font-size: 1.75rem;
    }
    
    .stat-card {
        padding: 1.25rem;
    }
    
    .stat-value {
        font-size: 2rem;
    }
    
    .reward-card {
        padding: 1rem;
    }
    
    .earning-guide {
        padding: 1.25rem;
    }
}

/* Light Mode Styles */
[data-theme="light"] .points-title {
    background: linear-gradient(90deg, #2E78C5, #7c4dff);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

[data-theme="light"] .points-subtitle {
    color: #4A5568;
}

[data-theme="light"] .stat-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .stat-card:hover {
    border-color: #2E78C5;
    box-shadow: 0 8px 24px rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .stat-label {
    color: #4A5568;
}

[data-theme="light"] .reward-card {
    background: #FFFFFF;
    border: 1px solid rgba(46, 120, 197, 0.2);
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
}

[data-theme="light"] .reward-card:hover {
    border-color: #2E78C5;
    box-shadow: 0 8px 24px rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .reward-title {
    color: #1A202C;
}

[data-theme="light"] .reward-description {
    color: #4A5568;
}

[data-theme="light"] .earning-guide {
    background: linear-gradient(135deg, rgba(46, 120, 197, 0.05), rgba(124, 77, 255, 0.05));
    border: 1px solid rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .earning-title {
    color: #1A202C;
}

[data-theme="light"] .earning-item {
    background: rgba(46, 120, 197, 0.05);
}

[data-theme="light"] .earning-item:hover {
    background: rgba(46, 120, 197, 0.1);
}

[data-theme="light"] .earning-text {
    color: #1A202C;
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
<div class="points-container">
    <div class="points-header">
        <h1 class="points-title">Point Redemption Store</h1>
        <p class="points-subtitle">Use your points to unlock exclusive features and rewards</p>
    </div>

    <div class="stats-grid">
        <div class="stat-card points">
            <i class="fas fa-coins stat-icon"></i>
            <div class="stat-value"><?php echo e(number_format($userPoints)); ?></div>
            <div class="stat-label">Your Points</div>
        </div>
        <div class="stat-card level">
            <i class="fas fa-trophy stat-icon"></i>
            <div class="stat-value"><?php echo e($userLevel); ?></div>
            <div class="stat-label">Your Level</div>
        </div>
    </div>

    <div class="rewards-grid">
        <?php $__currentLoopData = $rewards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $reward): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="reward-card <?php echo e($userPoints >= $reward['cost'] ? 'affordable' : 'expensive'); ?>">
                <i class="<?php echo e($reward['icon'] ?? 'fas fa-gift'); ?> reward-icon"></i>
                <h3 class="reward-title"><?php echo e($reward['name']); ?></h3>
                <p class="reward-description"><?php echo e($reward['description']); ?></p>
                <div class="reward-footer">
                    <span class="reward-cost">
                        <i class="fas fa-coins" style="margin-right: 0.25rem;"></i>
                        <?php echo e(number_format($reward['cost'])); ?> Points
                    </span>
                    <?php if($userPoints >= $reward['cost']): ?>
                        <form method="POST" action="<?php echo e(route('points.redeem')); ?>" style="margin: 0;">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="reward_type" value="<?php echo e($key); ?>">
                            <button type="submit" class="reward-btn available" 
                                    onclick="return confirm('Redeem this reward for <?php echo e($reward['cost']); ?> points?')">
                                <i class="fas fa-check" style="margin-right: 0.5rem;"></i>
                                Redeem
                            </button>
                        </form>
                    <?php else: ?>
                        <button class="reward-btn unavailable" disabled>
                            <i class="fas fa-lock" style="margin-right: 0.5rem;"></i>
                            Need <?php echo e(number_format($reward['cost'] - $userPoints)); ?> more
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="earning-guide">
        <h3 class="earning-title">
            <i class="fas fa-lightbulb"></i>
            How to Earn More Points
        </h3>
        <ul class="earning-list">

            <li class="earning-item">
                <i class="fas fa-graduation-cap earning-icon"></i>
                <span class="earning-text">Complete Courses</span>
                <span class="earning-points">200 points</span>
            </li>
            <li class="earning-item">
                <i class="fas fa-user-plus earning-icon"></i>
                <span class="earning-text">Enroll in Courses</span>
                <span class="earning-points">20 points</span>
            </li>
            <li class="earning-item">
                <i class="fas fa-comment earning-icon"></i>
                <span class="earning-text">Forum Posts</span>
                <span class="earning-points">10 points</span>
            </li>
            <li class="earning-item">
                <i class="fas fa-reply earning-icon"></i>
                <span class="earning-text">Forum Replies</span>
                <span class="earning-points">5 points</span>
            </li>
            <li class="earning-item">
                <i class="fas fa-quote-left earning-icon"></i>
                <span class="earning-text">Share Testimonials</span>
                <span class="earning-points">25 points</span>
            </li>
            <li class="earning-item">
                <i class="fas fa-calendar-check earning-icon"></i>
                <span class="earning-text">Daily Login</span>
                <span class="earning-points">5 points</span>
            </li>
        </ul>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\points\index.blade.php ENDPATH**/ ?>