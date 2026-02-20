<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($subject ?? 'Digital Leap Africa'); ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f5f7fa;
        }
        
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        .header {
            background-color: #2E78C5;
            padding: 30px 40px;
            text-align: center;
        }
        
        .logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 15px;
            background-color: #ffffff;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            font-weight: 700;
            color: #2E78C5;
        }
        
        .company-name {
            color: #ffffff;
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 8px;
        }
        
        .tagline {
            color: #AEB8C2;
            font-size: 14px;
            font-weight: 400;
        }
        
        .content {
            padding: 40px;
        }
        
        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #252A32;
            margin-bottom: 20px;
        }
        
        .message {
            font-size: 16px;
            color: #555555;
            margin-bottom: 30px;
            line-height: 1.7;
        }
        
        .cta-button {
            display: inline-block;
            background-color: #2E78C5;
            color: #ffffff;
            text-decoration: none;
            padding: 14px 28px;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
            margin: 20px 0;
            transition: background-color 0.2s ease;
        }
        
        .cta-button:hover {
            background-color: #1E4C7C;
        }
        
        .info-box {
            background-color: #f8fafc;
            border-left: 4px solid #2E78C5;
            padding: 20px;
            margin: 20px 0;
            border-radius: 0 8px 8px 0;
        }
        
        .icon {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 8px;
            vertical-align: middle;
        }
        
        .icon-success {
            background-color: #10b981;
            border-radius: 50%;
        }
        
        .icon-warning {
            background-color: #f59e0b;
            border-radius: 3px;
        }
        
        .icon-danger {
            background-color: #ef4444;
            border-radius: 3px;
        }
        
        .regards {
            margin-top: 30px;
            font-size: 16px;
            color: #555555;
        }
        
        .footer {
            background-color: #0C121C;
            color: #AEB8C2;
            padding: 30px 40px;
            text-align: center;
        }
        
        .footer-logo {
            color: #ffffff;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        
        .footer-text {
            font-size: 14px;
            margin-bottom: 20px;
        }
        
        .social-links {
            margin: 20px 0;
        }
        
        .social-links a {
            color: #2E78C5;
            text-decoration: none;
            margin: 0 10px;
            font-size: 14px;
        }
        
        .unsubscribe {
            font-size: 12px;
            color: #888888;
            margin-top: 20px;
        }
        
        .unsubscribe a {
            color: #2E78C5;
            text-decoration: none;
        }
        
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 0;
                border-radius: 0;
            }
            
            .header, .content, .footer {
                padding: 20px;
            }
            
            .company-name {
                font-size: 24px;
            }
            
            .greeting {
                font-size: 16px;
            }
            
            .message {
                font-size: 14px;
            }
            
            .cta-button {
                display: block;
                text-align: center;
                margin: 20px 0;
            }
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
                <p>Regards,<br>
                <strong>Digital Leap Africa</strong></p>
            </div>
        </div>
        
        <div class="footer">
            <div class="footer-logo">Digital Leap Africa</div>
            <div class="footer-text">
                Building the future of African technology education
            </div>
            <div class="social-links">
                <a href="#">Website</a> |
                <a href="#">LinkedIn</a> |
                <a href="#">Twitter</a> |
                <a href="#">Facebook</a>
            </div>
            <div class="unsubscribe">
                <a href="#">Unsubscribe</a> | <a href="#">Privacy Policy</a>
            </div>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\digital-leap-africa\digital-leap-africa\resources\views/emails/base.blade.php ENDPATH**/ ?>