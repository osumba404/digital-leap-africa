<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($subject ?? 'Digital Leap Africa'); ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #F5F7FA;
            background-color: #0C121C;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #252A32;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #1E4C7C;
        }
        .header {
            background-color: #0C121C;
            padding: 28px 40px;
            text-align: center;
            border-bottom: 2px solid #1E4C7C;
        }
        .logo {
            width: 56px;
            height: 56px;
            margin: 0 auto 12px;
            background-color: #252A32;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            font-weight: 700;
            color: #00C9FF;
            border: 1px solid #2E78C5;
        }
        .company-name {
            color: #F5F7FA;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 6px;
        }
        .tagline {
            color: #AEB8C2;
            font-size: 13px;
            font-weight: 400;
        }
        .content {
            padding: 32px 40px;
        }
        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #F5F7FA;
            margin-bottom: 18px;
        }
        .message {
            font-size: 15px;
            color: #AEB8C2;
            margin-bottom: 20px;
            line-height: 1.7;
        }
        .message strong { color: #F5F7FA; }
        .message a { color: #00C9FF; text-decoration: none; }
        .message a:hover { text-decoration: underline; }
        .cta-button {
            display: inline-block;
            background-color: #2E78C5;
            color: #F5F7FA;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 15px;
            margin: 20px 0;
            border: 1px solid #1E4C7C;
        }
        .cta-button:hover {
            background-color: #1E4C7C;
        }
        .info-box {
            background-color: #0C121C;
            border-left: 4px solid #2E78C5;
            padding: 18px 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
            color: #AEB8C2;
            font-size: 14px;
        }
        .info-box h3 { color: #F5F7FA; margin-bottom: 8px; font-size: 16px; }
        .info-box strong { color: #F5F7FA; }
        .icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 8px;
            vertical-align: middle;
        }
        .icon-success { background-color: #10b981; border-radius: 50%; }
        .icon-warning { background-color: #f59e0b; border-radius: 3px; }
        .icon-danger { background-color: #ef4444; border-radius: 3px; }
        .regards {
            margin-top: 28px;
            font-size: 15px;
            color: #AEB8C2;
        }
        .regards strong { color: #F5F7FA; }
        .footer {
            background-color: #0C121C;
            color: #AEB8C2;
            padding: 24px 40px;
            text-align: center;
            border-top: 1px solid #1E4C7C;
        }
        .footer-logo {
            color: #F5F7FA;
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        .footer-text {
            font-size: 13px;
            margin-bottom: 16px;
        }
        .footer a {
            color: #00C9FF;
            text-decoration: none;
        }
        .social-links a {
            color: #00C9FF;
            text-decoration: none;
            margin: 0 10px;
            font-size: 13px;
        }
        .unsubscribe {
            font-size: 12px;
            color: #64748b;
            margin-top: 16px;
        }
        .unsubscribe a { color: #00C9FF; text-decoration: none; }
        @media only screen and (max-width: 600px) {
            .email-container { margin: 0; border-radius: 0; }
            .header, .content, .footer { padding: 20px; }
            .company-name { font-size: 22px; }
            .greeting { font-size: 16px; }
            .message { font-size: 14px; }
            .cta-button { display: block; text-align: center; }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">DLA</div>
            <div class="company-name">Digital Leap Africa</div>
            <div class="tagline">Empowering African Youth Through Technology</div>
        </div>
        <div class="content">
            <?php echo $__env->yieldContent('content'); ?>
            <div class="regards">
                <p>Regards,<br><strong>Digital Leap Africa</strong></p>
            </div>
        </div>
        <div class="footer">
            <div class="footer-logo">Digital Leap Africa</div>
            <div class="footer-text">Building the future of African technology education</div>
            <div class="social-links">
                <a href="<?php echo e(config('app.url')); ?>">Website</a> |
                <a href="<?php echo e(config('app.url')); ?>/contact">Contact</a>
            </div>
            <div class="unsubscribe">
                &copy; <?php echo e(date('Y')); ?> Digital Leap Africa. All rights reserved.
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/emails/base.blade.php ENDPATH**/ ?>