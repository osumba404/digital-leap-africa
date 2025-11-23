

<?php $__env->startSection('content'); ?>
<!-- Coming Soon Banner -->
<div class="coming-soon-container">
  <div class="container">
    <div class="coming-soon-banner">
      <div class="banner-icon">
        <i class="fas fa-trophy"></i>
      </div>
      <div class="banner-content">
        <h1>Coming Soon</h1>
        <p>We are working to bring you an amazing leaderboard experience. Stay tuned for exciting competitions, and rankings!</p>
        <a href="<?php echo e(route('dashboard')); ?>" class="back-btn">
          <i class="fas fa-arrow-left"></i> Back to Dashboard
        </a>
      </div>
    </div>
  </div>
</div>



<!-- Points Modal -->
<div id="pointsModal" class="points-modal">
  <div class="modal-overlay" onclick="closePointsModal()"></div>
  <div class="modal-content">
    <div class="modal-header">
      <h3>How do points work?</h3>
      <button onclick="closePointsModal()" class="modal-close">
        <i class="fas fa-times"></i>
      </button>
    </div>
    
    <div class="modal-body">
      <div class="points-section">
        <h4><i class="fas fa-graduation-cap" style="color: #64b5f6;"></i> Learning Activities</h4>
        <p><strong>Course completion:</strong> 200 points<br><strong>Course enrollment:</strong> 20 points<br>Complete courses and enroll in new ones to earn points and advance your learning journey.</p>
      </div>
      
      <div class="points-section">
        <h4><i class="fas fa-users" style="color: #00d4ff;"></i> Community Engagement</h4>
        <p><strong>Forum activity:</strong> 5-10 points<br><strong>Daily login:</strong> 5 points<br>Participate in discussions and stay active to earn community points.</p>
      </div>
      
      <div class="points-section">
        <h4><i class="fas fa-shopping-cart" style="color: #7a5fff;"></i> Point Redemption</h4>
        <p><strong>Premium courses:</strong> 500 points<br><strong>Mentorship access:</strong> 500 points<br><strong>Profile customization:</strong> 100 points</p>
      </div>
      
      <div class="points-section">
        <h4><i class="fas fa-gift" style="color: #22c55e;"></i> Admin Rewards</h4>
        <p>From time to time, points may be rewarded to you by a community admin for exceptional contributions. Your rewards are visible on your profile.</p>
      </div>
      
      <div class="points-section">
        <h4><i class="fas fa-chart-line" style="color: #f59e0b;"></i> Levels</h4>
        <p>As you collect points, you will progress through 10 levels. Your current level is displayed on your avatar, and the points needed for the next level are shown on your profile page.</p>
        
        <div class="levels-grid">
          <div class="level-card"><div class="level-number">Level 1</div><div class="level-points">0 points</div></div>
          <div class="level-card"><div class="level-number">Level 2</div><div class="level-points">100 points</div></div>
          <div class="level-card"><div class="level-number">Level 3</div><div class="level-points">250 points</div></div>
          <div class="level-card"><div class="level-number">Level 4</div><div class="level-points">500 points</div></div>
          <div class="level-card"><div class="level-number">Level 5</div><div class="level-points">1,000 points</div></div>
          <div class="level-card"><div class="level-number">Level 6</div><div class="level-points">2,000 points</div></div>
          <div class="level-card"><div class="level-number">Level 7</div><div class="level-points">3,500 points</div></div>
          <div class="level-card"><div class="level-number">Level 8</div><div class="level-points">5,000 points</div></div>
          <div class="level-card"><div class="level-number">Level 9</div><div class="level-points">7,500 points</div></div>
          <div class="level-card"><div class="level-number">Level 10</div><div class="level-points">10,000 points</div></div>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
/* Coming Soon Banner Styles */
.coming-soon-container {
  min-height: 80vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 2rem 0;
}

.coming-soon-banner {
  background: var(--charcoal);
  border-radius: 16px;
  padding: 3rem 2rem;
  text-align: center;
  border: 1px solid rgba(100, 181, 246, 0.2);
  box-shadow: 0 10px 30px rgba(2, 12, 27, 0.7);
  max-width: 600px;
  width: 100%;
}

.banner-icon {
  font-size: 4rem;
  color: #64b5f6;
  margin-bottom: 1.5rem;
}

.banner-content h1 {
  font-size: 2.5rem;
  font-weight: 700;
  color: var(--diamond-white);
  margin-bottom: 1rem;
  background: linear-gradient(135deg, #64b5f6, #00d4ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.banner-content p {
  color: var(--cool-gray);
  font-size: 1.1rem;
  line-height: 1.6;
  margin-bottom: 2rem;
}

.back-btn {
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  background: linear-gradient(135deg, #64b5f6, #00d4ff);
  color: var(--navy-bg);
  padding: 0.75rem 1.5rem;
  border-radius: 8px;
  text-decoration: none;
  font-weight: 600;
  transition: all 0.3s ease;
}

.back-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 25px rgba(100, 181, 246, 0.3);
  color: var(--navy-bg);
}

/* Light Mode Coming Soon */
[data-theme="light"] .coming-soon-banner {
  background: #FFFFFF;
  border-color: rgba(46, 120, 197, 0.2);
  box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
}

[data-theme="light"] .banner-icon {
  color: var(--primary-blue);
}

[data-theme="light"] .banner-content h1 {
  background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

[data-theme="light"] .back-btn {
  background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
  color: #FFFFFF;
}

[data-theme="light"] .back-btn:hover {
  color: #FFFFFF;
  box-shadow: 0 8px 25px rgba(46, 120, 197, 0.3);
}

/* Responsive Design */
@media (max-width: 768px) {
  .coming-soon-container {
    padding: 1.5rem 0;
  }
  
  .coming-soon-banner {
    padding: 2rem 1.5rem;
    margin: 0 1rem;
  }
  
  .banner-icon {
    font-size: 3rem;
    margin-bottom: 1rem;
  }
  
  .banner-content h1 {
    font-size: 2rem;
  }
  
  .banner-content p {
    font-size: 1rem;
    margin-bottom: 1.5rem;
  }
}

@media (max-width: 480px) {
  .coming-soon-banner {
    padding: 1.5rem 1rem;
  }
  
  .banner-icon {
    font-size: 2.5rem;
  }
  
  .banner-content h1 {
    font-size: 1.75rem;
  }
  
  .banner-content p {
    font-size: 0.9rem;
  }
  
  .back-btn {
    padding: 0.6rem 1.25rem;
    font-size: 0.9rem;
  }
}

/* Modern Leaderboard Design (COMMENTED OUT) */
.leaderboard-page {
  min-height: 80vh;
  padding: 1rem 0;
}

.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 0 1rem;
}

/* Header Section */
.leaderboard-header {
  text-align: center;
  margin-bottom: 2rem;
}

.header-content {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1.5rem;
  flex-wrap: wrap;
  gap: 1rem;
}

.title-section {
  flex: 1;
}

.page-title {
  font-size: 2rem;
  font-weight: 700;
  color: var(--diamond-white);
  margin: 0 0 0.5rem 0;
  background: linear-gradient(135deg, #64b5f6, #00d4ff);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}

.page-subtitle {
  color: var(--cool-gray);
  margin: 0;
  font-size: 0.95rem;
}

.info-btn {
  background: rgba(100, 181, 246, 0.1);
  border: 1px solid rgba(100, 181, 246, 0.3);
  color: #64b5f6;
  padding: 0.6rem 1rem;
  border-radius: 8px;
  font-size: 0.85rem;
  cursor: pointer;
  transition: all 0.3s ease;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.info-btn:hover {
  background: rgba(100, 181, 246, 0.2);
  transform: translateY(-1px);
}

/* Filter Tabs */
.filters-section {
  display: flex;
  justify-content: center;
}

.filter-tabs {
  display: flex;
  background: var(--charcoal);
  border-radius: 8px;
  padding: 0.25rem;
  border: 1px solid rgba(100, 181, 246, 0.2);
}

.filter-tab {
  padding: 0.6rem 1.2rem;
  border-radius: 6px;
  text-decoration: none;
  color: var(--cool-gray);
  transition: all 0.3s;
  font-size: 0.9rem;
  font-weight: 500;
}

.filter-tab.active {
  background: linear-gradient(135deg, #64b5f6, #00d4ff);
  color: var(--navy-bg);
}

.filter-tab:hover:not(.active) {
  background: rgba(100, 181, 246, 0.1);
  color: #64b5f6;
}

/* My Stats Card */
.my-stats {
  margin-bottom: 2rem;
}

.stats-card {
  background: var(--charcoal);
  border-radius: 12px;
  padding: 1.5rem;
  border: 1px solid rgba(100, 181, 246, 0.2);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.stats-left {
  display: flex;
  align-items: center;
  gap: 1rem;
}

.my-avatar {
  position: relative;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: linear-gradient(135deg, #64b5f6, #00d4ff);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--navy-bg);
  font-weight: 700;
  font-size: 1.2rem;
}

.level-badge {
  position: absolute;
  bottom: -2px;
  right: -2px;
  background: #f59e0b;
  color: white;
  width: 18px;
  height: 18px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.7rem;
  font-weight: 700;
  border: 2px solid var(--charcoal);
}

.my-info h3 {
  color: var(--diamond-white);
  margin: 0 0 0.25rem 0;
  font-size: 1.1rem;
  font-weight: 600;
}

.points-info {
  display: flex;
  align-items: baseline;
  gap: 0.25rem;
}

.points {
  color: #64b5f6;
  font-size: 1.2rem;
  font-weight: 700;
}

.points-label {
  color: var(--cool-gray);
  font-size: 0.85rem;
}

.stats-right {
  text-align: right;
}

.rank-display {
  margin-bottom: 0.25rem;
}

.rank-number {
  color: #64b5f6;
  font-size: 1.5rem;
  font-weight: 700;
  line-height: 1;
}

.rank-label {
  color: var(--cool-gray);
  font-size: 0.8rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

.progress-info {
  color: var(--cool-gray);
  font-size: 0.8rem;
}

/* Leaderboard List */
.leaderboard-list {
  background: var(--charcoal);
  border-radius: 12px;
  border: 1px solid rgba(100, 181, 246, 0.2);
  overflow: hidden;
}

.leader-item {
  display: flex;
  align-items: center;
  padding: 1rem 1.5rem;
  border-bottom: 1px solid rgba(100, 181, 246, 0.1);
  transition: all 0.3s ease;
}

.leader-item:last-child {
  border-bottom: none;
}

.leader-item.podium {
  background: rgba(100, 181, 246, 0.03);
}

.leader-item:hover {
  background: rgba(100, 181, 246, 0.05);
}

/* Position */
.position {
  width: 50px;
  display: flex;
  justify-content: center;
  align-items: center;
}

.medal {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 1rem;
}

.medal.gold {
  background: linear-gradient(135deg, #ffd700, #ffed4e);
  color: #b45309;
}

.medal.silver {
  background: linear-gradient(135deg, #c0c0c0, #e5e5e5);
  color: #6b7280;
}

.medal.bronze {
  background: linear-gradient(135deg, #cd7f32, #d4a574);
  color: #92400e;
}

.rank-num {
  color: #64b5f6;
  font-weight: 700;
  font-size: 1.1rem;
}

/* User Profile */
.user-profile {
  display: flex;
  align-items: center;
  gap: 1rem;
  flex: 1;
  min-width: 0;
}

.profile-avatar {
  position: relative;
  width: 45px;
  height: 45px;
  border-radius: 50%;
  background: linear-gradient(135deg, #64b5f6, #00d4ff);
  display: flex;
  align-items: center;
  justify-content: center;
  color: var(--navy-bg);
  font-weight: 700;
  font-size: 1rem;
}

.level-indicator {
  position: absolute;
  bottom: -2px;
  right: -2px;
  background: #f59e0b;
  color: white;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.65rem;
  font-weight: 700;
  border: 2px solid var(--charcoal);
}

.profile-info h4 {
  color: var(--diamond-white);
  margin: 0 0 0.25rem 0;
  font-size: 1rem;
  font-weight: 600;
}

.profile-info p {
  color: var(--cool-gray);
  margin: 0;
  font-size: 0.8rem;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

/* Score Section */
.score-section {
  text-align: right;
}

.points-score {
  color: #64b5f6;
  font-size: 1.2rem;
  font-weight: 700;
  line-height: 1;
}

.points-text {
  color: var(--cool-gray);
  font-size: 0.75rem;
  text-transform: uppercase;
  letter-spacing: 0.5px;
}

/* Empty State */
.empty-state {
  text-align: center;
  padding: 3rem 2rem;
  color: var(--cool-gray);
}

.empty-icon {
  font-size: 3rem;
  opacity: 0.3;
  margin-bottom: 1rem;
}

.empty-state h3 {
  color: var(--diamond-white);
  margin-bottom: 0.5rem;
  font-size: 1.2rem;
}

.empty-state p {
  margin: 0;
  font-size: 0.9rem;
}

/* Modal Styles */
.points-modal {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 9999;
}

.modal-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.8);
  backdrop-filter: blur(4px);
}

.modal-content {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: var(--charcoal);
  border-radius: 12px;
  width: 90%;
  max-width: 500px;
  max-height: 85vh;
  overflow-y: auto;
  border: 1px solid rgba(100, 181, 246, 0.2);
  box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  border-bottom: 1px solid rgba(100, 181, 246, 0.1);
}

.modal-header h3 {
  color: var(--diamond-white);
  margin: 0;
  font-size: 1.2rem;
}

.modal-close {
  background: none;
  border: none;
  color: var(--cool-gray);
  font-size: 1.5rem;
  cursor: pointer;
  padding: 0.5rem;
  border-radius: 50%;
  transition: all 0.3s ease;
}

.modal-close:hover {
  background: rgba(100, 181, 246, 0.1);
  color: #64b5f6;
}

.modal-body {
  padding: 1rem;
}

.points-section {
  margin-bottom: 2rem;
}

.points-section:last-child {
  margin-bottom: 0;
}

.points-section h4 {
  color: #64b5f6;
  font-size: 1rem;
  margin-bottom: 0.5rem;
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.points-section p {
  color: var(--cool-gray);
  font-size: 0.85rem;
  line-height: 1.5;
  margin: 0;
}

.levels-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
  gap: 0.5rem;
  margin-top: 0.75rem;
}

.level-card {
  text-align: center;
  padding: 0.5rem;
  background: rgba(100, 181, 246, 0.05);
  border-radius: 6px;
  border: 1px solid rgba(100, 181, 246, 0.1);
}

.level-number {
  color: #64b5f6;
  font-weight: 700;
  margin-bottom: 0.25rem;
  font-size: 0.8rem;
}

.level-points {
  color: var(--cool-gray);
  font-size: 0.7rem;
}

/* Light Mode */
[data-theme="light"] .stats-card,
[data-theme="light"] .leaderboard-list,
[data-theme="light"] .filter-tabs,
[data-theme="light"] .modal-content {
  background: #FFFFFF;
  border-color: rgba(46, 120, 197, 0.2);
}

[data-theme="light"] .info-btn {
  background: rgba(46, 120, 197, 0.1);
  border-color: rgba(46, 120, 197, 0.3);
  color: var(--primary-blue);
}

[data-theme="light"] .leader-item {
  border-bottom-color: rgba(46, 120, 197, 0.1);
}

[data-theme="light"] .leader-item.podium {
  background: rgba(46, 120, 197, 0.03);
}

[data-theme="light"] .leader-item:hover {
  background: rgba(46, 120, 197, 0.05);
}

[data-theme="light"] .level-badge,
[data-theme="light"] .level-indicator {
  border-color: #FFFFFF;
}

[data-theme="light"] .level-card {
  background: rgba(46, 120, 197, 0.05);
  border-color: rgba(46, 120, 197, 0.1);
}

/* Responsive Design */
@media (max-width: 768px) {
  .header-content {
    flex-direction: column;
    text-align: center;
    gap: 1rem;
  }
  
  .page-title {
    font-size: 1.75rem;
  }
  
  .page-subtitle {
    font-size: 0.9rem;
  }
  
  .filter-tabs {
    width: 100%;
  }
  
  .filter-tab {
    flex: 1;
    text-align: center;
    padding: 0.5rem 0.8rem;
    font-size: 0.85rem;
  }
  
  .stats-card {
    flex-direction: column;
    text-align: center;
    gap: 1rem;
    padding: 1.25rem;
  }
  
  .stats-left {
    justify-content: center;
  }
  
  .stats-right {
    text-align: center;
  }
  
  .leader-item {
    padding: 0.75rem 1rem;
  }
  
  .position {
    width: 40px;
  }
  
  .medal {
    width: 28px;
    height: 28px;
    font-size: 0.9rem;
  }
  
  .profile-avatar {
    width: 40px;
    height: 40px;
    font-size: 0.9rem;
  }
  
  .level-indicator {
    width: 14px;
    height: 14px;
    font-size: 0.6rem;
  }
  
  .profile-info h4 {
    font-size: 0.9rem;
  }
  
  .profile-info p {
    font-size: 0.75rem;
  }
  
  .points-score {
    font-size: 1.1rem;
  }
  
  .points-text {
    font-size: 0.7rem;
  }
  
  .modal-content {
    width: 95%;
    max-width: 400px;
  }
  
  .modal-header,
  .modal-body {
    padding: 0.75rem;
  }
  
  .levels-grid {
    grid-template-columns: repeat(3, 1fr);
    gap: 0.4rem;
  }
}

@media (max-width: 480px) {
  .container {
    padding: 0 0.75rem;
  }
  
  .page-title {
    font-size: 1.5rem;
  }
  
  .page-subtitle {
    font-size: 0.85rem;
  }
  
  .info-btn {
    padding: 0.5rem 0.75rem;
    font-size: 0.8rem;
  }
  
  .filter-tab {
    padding: 0.45rem 0.6rem;
    font-size: 0.8rem;
  }
  
  .stats-card {
    padding: 1rem;
  }
  
  .my-avatar {
    width: 45px;
    height: 45px;
    font-size: 1.1rem;
  }
  
  .level-badge {
    width: 16px;
    height: 16px;
    font-size: 0.65rem;
  }
  
  .my-info h3 {
    font-size: 1rem;
  }
  
  .points {
    font-size: 1.1rem;
  }
  
  .rank-number {
    font-size: 1.3rem;
  }
  
  .leader-item {
    padding: 0.6rem 0.75rem;
  }
  
  .position {
    width: 35px;
  }
  
  .medal {
    width: 24px;
    height: 24px;
    font-size: 0.8rem;
  }
  
  .rank-num {
    font-size: 1rem;
  }
  
  .profile-avatar {
    width: 35px;
    height: 35px;
    font-size: 0.85rem;
  }
  
  .level-indicator {
    width: 12px;
    height: 12px;
    font-size: 0.55rem;
  }
  
  .profile-info h4 {
    font-size: 0.85rem;
  }
  
  .profile-info p {
    font-size: 0.7rem;
  }
  
  .points-score {
    font-size: 1rem;
  }
  
  .points-text {
    font-size: 0.65rem;
  }
  
  .empty-state {
    padding: 2rem 1rem;
  }
  
  .empty-icon {
    font-size: 2.5rem;
  }
  
  .empty-state h3 {
    font-size: 1.1rem;
  }
  
  .empty-state p {
    font-size: 0.85rem;
  }
  
  .modal-content {
    width: 98%;
    max-width: 350px;
  }
  
  .modal-header,
  .modal-body {
    padding: 0.6rem;
  }
  
  .modal-header h3 {
    font-size: 1.1rem;
  }
  
  .points-section h4 {
    font-size: 0.9rem;
  }
  
  .points-section p {
    font-size: 0.8rem;
  }
}
</style>

<script>
function openPointsModal() {
  document.getElementById('pointsModal').style.display = 'block';
  document.body.style.overflow = 'hidden';
}

function closePointsModal() {
  document.getElementById('pointsModal').style.display = 'none';
  document.body.style.overflow = '';
}

// Close modal on escape key
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closePointsModal();
  }
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\leaderboard.blade.php ENDPATH**/ ?>