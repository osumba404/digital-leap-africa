<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Certificate - <?php echo e($certificate->user->name); ?></title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,600;1,700&family=Libre+Baskerville:wght@400;700&family=Dancing+Script:wght@500;600&display=swap">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Libre Baskerville', Georgia, serif;
            background: #0C121C;
            --cert-navy: #0C121C;
            --cert-deep-blue: #1E4C7C;
            --cert-primary-blue: #2E78C5;
            --cert-cyan: #00C9FF;
            --cert-diamond-white: #F5F7FA;
            --cert-charcoal: #252A32;
            --cert-cool-gray: #AEB8C2;
        }

        .certificate-container {
            width: 900px;
            max-width: 100%;
            margin: 24px auto;
            background: var(--cert-navy);
            border-radius: 12px;
            padding: 14px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
            border: 1px solid rgba(0, 201, 255, 0.2);
        }

        .certificate-inner {
            background: var(--cert-charcoal);
            border-radius: 8px;
            padding: 48px 56px;
            position: relative;
            border: 2px solid var(--cert-deep-blue);
        }

        .certificate-inner::before {
            content: '';
            position: absolute;
            top: 12px;
            left: 12px;
            right: 12px;
            bottom: 12px;
            border: 1px solid var(--cert-primary-blue);
            border-radius: 4px;
            pointer-events: none;
            opacity: 0.5;
        }

        .certificate-header { text-align: center; margin-bottom: 36px; }

        .certificate-logo-wrap { margin-bottom: 20px; }
        .certificate-logo-wrap img {
            height: 72px;
            width: auto;
            max-width: 180px;
            object-fit: contain;
            display: block;
            margin: 0 auto;
        }

        .certificate-title {
            font-size: 2.25rem;
            font-weight: 700;
            color: var(--cert-diamond-white);
            margin-bottom: 6px;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .certificate-subtitle {
            font-size: 1.15rem;
            color: var(--cert-cyan);
            font-weight: 600;
            letter-spacing: 1px;
        }

        .certificate-body { text-align: center; margin: 32px 0 40px; }

        .certificate-text {
            font-size: 1.1rem;
            color: var(--cert-cool-gray);
            line-height: 1.85;
            margin-bottom: 12px;
        }

        .recipient-name {
            font-size: 2.25rem;
            font-weight: 700;
            font-style: italic;
            color: var(--cert-diamond-white);
            margin: 24px 0;
            font-family: 'Cormorant Garamond', Georgia, serif;
            border-bottom: 2px solid var(--cert-cyan);
            display: inline-block;
            padding-bottom: 4px;
        }

        .course-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--cert-cyan);
            margin: 20px 0;
            font-style: italic;
        }

        .certificate-footer {
            display: flex;
            justify-content: space-between;
            gap: 48px;
            margin-top: 40px;
            padding-top: 32px;
            border-top: 2px solid var(--cert-deep-blue);
        }

        .signature-section { text-align: center; flex: 1; }

        .signature-line {
            border-bottom: 2px solid var(--cert-primary-blue);
            width: 200px;
            margin: 0 auto 10px;
            height: 38px;
        }

        .signature-text {
            font-family: 'Dancing Script', cursive;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--cert-cyan);
            margin-bottom: 4px;
        }

        .signature-label {
            font-size: 0.8rem;
            color: var(--cert-cool-gray);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.5px;
        }

        .signature-role-name {
            font-size: 0.9rem;
            color: var(--cert-diamond-white);
            font-weight: 600;
            margin-top: 4px;
        }

        .certificate-meta {
            margin-top: 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .certificate-date,
        .certificate-number {
            font-size: 0.85rem;
            color: var(--cert-cool-gray);
            font-weight: 600;
        }

        .certificate-number { font-family: 'Courier New', monospace; letter-spacing: 0.5px; }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="certificate-inner">
            <div class="certificate-header">
                <div class="certificate-logo-wrap">
                    <img src="<?php echo e($logoUrl); ?>" alt="Digital Leap Africa">
                </div>
                <h1 class="certificate-title"><?php echo e(\App\Models\SiteSetting::getValue('certificate_title', 'Certificate of Completion')); ?></h1>
                <p class="certificate-subtitle"><?php echo e(\App\Models\SiteSetting::getValue('certificate_subtitle', 'Digital Leap Africa')); ?></p>
            </div>

            <div class="certificate-body">
                <p class="certificate-text"><?php echo e(\App\Models\SiteSetting::getValue('certificate_text', 'This is to certify that')); ?></p>
                <div class="recipient-name"><?php echo e($certificate->user->name); ?></div>
                <p class="certificate-text"><?php echo e(\App\Models\SiteSetting::getValue('certificate_completion_text', 'has successfully completed the course')); ?></p>
                <div class="course-title"><?php echo e($certificate->certificate_title); ?></div>
                <p class="certificate-text"><?php echo e(\App\Models\SiteSetting::getValue('certificate_achievement_text', 'and has demonstrated proficiency through dedicated study and commitment to excellence in digital learning.')); ?></p>
            </div>

            <div class="certificate-footer">
                <div class="signature-section">
                    <div class="signature-line">
                        <span class="signature-text"><?php echo e($instructorSignature); ?></span>
                    </div>
                    <p class="signature-label"><?php echo e(\App\Models\SiteSetting::getValue('certificate_instructor_title', 'Course Instructor')); ?></p>
                    <p class="signature-role-name"><?php echo e($certificate->course->instructor); ?></p>
                </div>
                <div class="signature-section">
                    <div class="signature-line">
                        <span class="signature-text"><?php echo e($directorSignature); ?></span>
                    </div>
                    <p class="signature-label"><?php echo e(\App\Models\SiteSetting::getValue('certificate_director_title', 'Program Director')); ?></p>
                    <p class="signature-role-name"><?php echo e(\App\Models\SiteSetting::getValue('certificate_director_name', 'Digital Leap Africa')); ?></p>
                </div>
            </div>

            <div class="certificate-meta">
                <div class="certificate-date"><?php echo e($certificate->issued_at->format('F j, Y')); ?></div>
                <div class="certificate-number"><?php echo e($certificate->certificate_number); ?></div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/certificates/download.blade.php ENDPATH**/ ?>