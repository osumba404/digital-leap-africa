<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Template Preview - Digital Leap Africa</title>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f7fa;
            margin: 0;
            padding: 20px;
        }
        .preview-container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
        }
        .preview-header {
            text-align: center;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 2px solid #2E78C5;
        }
        .preview-title {
            color: #2E78C5;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .template-links {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }
        .template-link {
            display: block;
            padding: 15px 20px;
            background: linear-gradient(135deg, #2E78C5 0%, #1E4C7C 100%);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            text-align: center;
            font-weight: 600;
            transition: transform 0.2s ease;
        }
        .template-link:hover {
            transform: translateY(-2px);
        }
        .iframe-container {
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }
        iframe {
            width: 100%;
            height: 600px;
            border: none;
        }
    </style>
</head>
<body>
    <div class="preview-container">
        <div class="preview-header">
            <div class="preview-title">📧 Email Template Preview</div>
            <p>Digital Leap Africa - Professional Email Templates</p>
        </div>
        
        <div class="template-links">
            <a href="?template=course-enrollment" class="template-link">🎉 Course Enrollment</a>
            <a href="?template=course-approved" class="template-link">✅ Course Approved</a>
            <a href="?template=course-rejected" class="template-link">📋 Course Rejected</a>
            <a href="?template=account-verified" class="template-link">🥇 Account Verified</a>
            <a href="?template=lesson-completed" class="template-link">🎯 Lesson Completed</a>
            <a href="?template=course-completed" class="template-link">🏆 Course Completed</a>
            <a href="?template=payment-success" class="template-link">💳 Payment Success</a>
            <a href="?template=password-reset" class="template-link">🔐 Password Reset</a>
        </div>
        
        <?php if(request('template')): ?>
        <div class="iframe-container">
            <iframe src="/email-template/<?php echo e(request('template')); ?>"></iframe>
        </div>
        <?php else: ?>
        <div style="text-align: center; padding: 40px; color: #666;">
            <h3>Select a template above to preview</h3>
            <p>Click on any template link to see how the email will look to users.</p>
        </div>
        <?php endif; ?>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\DLA\digital-leap-africa\digital-leap-africa\resources\views\emails\preview.blade.php ENDPATH**/ ?>