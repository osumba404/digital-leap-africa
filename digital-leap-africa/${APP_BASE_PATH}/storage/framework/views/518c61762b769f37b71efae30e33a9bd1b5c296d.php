

<?php $__env->startSection('content'); ?>
<style>
:root {
    --primary-blue: #2E78C5;
    --deep-blue: #1E4C7C;
    --navy-bg: #0C121C;
    --diamond-white: #F5F7FA;
    --cool-gray: #AEB8C2;
    --charcoal: #252A32;
    --cyan-accent: #00C9FF;
    --purple-accent: #7A5FFF;
}

.certificate-container {
    max-width: 1000px;
    margin: 2rem auto;
    background: linear-gradient(135deg, var(--navy-bg) 0%, var(--deep-blue) 50%, var(--primary-blue) 100%);
    border-radius: 24px;
    padding: 2rem;
    box-shadow: 0 25px 50px rgba(12, 18, 28, 0.4);
    position: relative;
    overflow: hidden;
}

.certificate-container::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(0, 201, 255, 0.1) 0%, transparent 70%);
    animation: shimmer 4s ease-in-out infinite;
}

@keyframes shimmer {
    0%, 100% { transform: rotate(0deg) scale(1); }
    50% { transform: rotate(180deg) scale(1.1); }
}

.certificate-inner {
    background: var(--diamond-white);
    border-radius: 20px;
    padding: 3.5rem;
    position: relative;
    z-index: 2;
    border: 4px solid var(--cyan-accent);
    box-shadow: inset 0 0 0 2px var(--primary-blue);
}

.certificate-header {
    text-align: center;
    margin-bottom: 2.5rem;
    position: relative;
}

.certificate-logo {
    width: 100px;
    height: 100px;
    margin: 0 auto 1.5rem;
    background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--diamond-white);
    font-size: 2.5rem;
    box-shadow: 0 8px 25px rgba(46, 120, 197, 0.3);
    border: 3px solid var(--diamond-white);
}

.certificate-title {
    font-size: 3rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--primary-blue), var(--purple-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
    letter-spacing: 3px;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.certificate-subtitle {
    font-size: 1.4rem;
    color: var(--deep-blue);
    font-weight: 600;
    margin-bottom: 2rem;
}

.certificate-body {
    text-align: center;
    margin: 2.5rem 0;
    position: relative;
}

.certificate-text {
    font-size: 1.2rem;
    color: var(--charcoal);
    line-height: 1.8;
    margin-bottom: 1.5rem;
    font-weight: 500;
}

.recipient-name {
    font-size: 2.8rem;
    font-weight: 800;
    background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin: 2rem 0;
    text-decoration: underline;
    text-decoration-color: var(--cyan-accent);
    text-decoration-thickness: 3px;
    text-underline-offset: 8px;
}

.course-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--deep-blue);
    margin: 2rem 0;
    font-style: italic;
    position: relative;
}

.course-title::before,
.course-title::after {
    content: '"';
    font-size: 2.2rem;
    color: var(--cyan-accent);
    font-weight: 900;
}

.certificate-footer {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    margin-top: 4rem;
    padding-top: 2.5rem;
    border-top: 3px solid var(--cyan-accent);
    position: relative;
}

.certificate-footer::before {
    content: '';
    position: absolute;
    top: -1.5px;
    left: 50%;
    transform: translateX(-50%);
    width: 60px;
    height: 3px;
    background: var(--purple-accent);
}

.signature-section {
    text-align: center;
}

.signature-line {
    border-bottom: 3px solid var(--primary-blue);
    width: 220px;
    margin: 0 auto 0.8rem;
    height: 50px;
    position: relative;
}

.signature-line::after {
    content: '';
    position: absolute;
    bottom: -1.5px;
    left: 50%;
    transform: translateX(-50%);
    width: 40px;
    height: 3px;
    background: var(--cyan-accent);
}

.signature-label {
    font-size: 0.95rem;
    color: var(--cool-gray);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.signature-name {
    font-weight: 700;
    color: var(--charcoal);
    margin-top: 0.5rem;
    font-size: 1.1rem;
}

.certificate-number {
    position: absolute;
    bottom: 1.5rem;
    right: 2rem;
    font-size: 0.9rem;
    color: var(--cool-gray);
    font-family: 'Courier New', monospace;
    font-weight: 600;
    background: rgba(174, 184, 194, 0.1);
    padding: 0.5rem 1rem;
    border-radius: 8px;
    border: 1px solid rgba(174, 184, 194, 0.3);
}

.certificate-date {
    position: absolute;
    bottom: 1.5rem;
    left: 2rem;
    font-size: 0.9rem;
    color: var(--cool-gray);
    font-weight: 600;
    background: rgba(174, 184, 194, 0.1);
    padding: 0.5rem 1rem;
    border-radius: 8px;
    border: 1px solid rgba(174, 184, 194, 0.3);
}

.decorative-elements {
    position: absolute;
    top: 2rem;
    left: 2rem;
    right: 2rem;
    height: 4px;
    background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent), var(--primary-blue));
    border-radius: 2px;
}

.corner-decoration {
    position: absolute;
    width: 60px;
    height: 60px;
    border: 4px solid var(--cyan-accent);
    border-radius: 50%;
}

.corner-decoration.top-left {
    top: -30px;
    left: -30px;
    border-right: none;
    border-bottom: none;
}

.corner-decoration.top-right {
    top: -30px;
    right: -30px;
    border-left: none;
    border-bottom: none;
}

.corner-decoration.bottom-left {
    bottom: -30px;
    left: -30px;
    border-right: none;
    border-top: none;
}

.corner-decoration.bottom-right {
    bottom: -30px;
    right: -30px;
    border-left: none;
    border-top: none;
}

@media print {
    .download-section { display: none; }
    .certificate-container { box-shadow: none; margin: 0; }
    .certificate-container::before { display: none; }
}

@media (max-width: 768px) {
    .certificate-container { padding: 1rem; margin: 1rem; }
    .certificate-inner { padding: 2rem; }
    .certificate-title { font-size: 2.2rem; }
    .recipient-name { font-size: 2rem; }
    .course-title { font-size: 1.4rem; }
    .certificate-footer { grid-template-columns: 1fr; gap: 2rem; }
    .signature-line { width: 180px; }
}
</style>

<div class="container">
    <div class="download-section" style="text-align: center; margin: 2rem 0;">
        <h2 style="color: var(--diamond-white); margin-bottom: 1rem;">Your Professional Certificate</h2>
        <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
            <button onclick="window.print()" class="btn-primary">
                <i class="fas fa-download me-2"></i>Download PDF
            </button>
            <a href="<?php echo e(route('certificates.download', $certificate)); ?>" class="btn-outline">
                <i class="fas fa-external-link-alt me-2"></i>Full Screen View
            </a>
        </div>
    </div>

    <div class="certificate-container">
        <div class="certificate-inner">
            <div class="decorative-elements"></div>
            <div class="corner-decoration top-left"></div>
            <div class="corner-decoration top-right"></div>
            <div class="corner-decoration bottom-left"></div>
            <div class="corner-decoration bottom-right"></div>
            
            <div class="certificate-header">
                <div class="certificate-logo">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <h1 class="certificate-title"><?php echo e(\App\Models\SiteSetting::getValue('certificate_title', 'Certificate of Completion')); ?></h1>
                <p class="certificate-subtitle"><?php echo e(\App\Models\SiteSetting::getValue('certificate_subtitle', 'Digital Leap Africa')); ?></p>
            </div>

            <div class="certificate-body">
                <p class="certificate-text"><?php echo e(\App\Models\SiteSetting::getValue('certificate_text', 'This is to certify that')); ?></p>
                <div class="recipient-name"><?php echo e($certificate->user->name); ?></div>
                <p class="certificate-text"><?php echo e(\App\Models\SiteSetting::getValue('certificate_completion_text', 'has successfully completed the course')); ?></p>
                <div class="course-title"><?php echo e($certificate->certificate_title); ?></div>
                <p class="certificate-text"><?php echo e(\App\Models\SiteSetting::getValue('certificate_achievement_text', 'and has demonstrated exceptional proficiency in the subject matter through dedicated study, practical application, and commitment to excellence in digital learning.')); ?></p>
            </div>

            <div class="certificate-footer">
                <div class="signature-section">
                    <div class="signature-line"></div>
                    <p class="signature-label"><?php echo e(\App\Models\SiteSetting::getValue('certificate_instructor_title', 'Course Instructor')); ?></p>
                    <p class="signature-name"><?php echo e($certificate->course->instructor); ?></p>
                </div>
                <div class="signature-section">
                    <div class="signature-line"></div>
                    <p class="signature-label"><?php echo e(\App\Models\SiteSetting::getValue('certificate_director_title', 'Program Director')); ?></p>
                    <p class="signature-name"><?php echo e(\App\Models\SiteSetting::getValue('certificate_director_name', 'Digital Leap Africa')); ?></p>
                </div>
            </div>

            <div class="certificate-date">
                <i class="fas fa-calendar-alt me-2"></i><?php echo e($certificate->issued_at->format('F j, Y')); ?>

            </div>
            <div class="certificate-number">
                <i class="fas fa-shield-alt me-2"></i><?php echo e($certificate->certificate_number); ?>

            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\certificates\show.blade.php ENDPATH**/ ?>