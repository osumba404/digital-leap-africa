<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Payment Successful</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; margin: 0; padding: 20px; background-color: #f4f4f4; }
        .container { max-width: 600px; margin: 0 auto; background: #fff; border-radius: 10px; overflow: hidden; box-shadow: 0 0 20px rgba(0,0,0,0.1); }
        .header { background: linear-gradient(135deg, #2E78C5, #00C9FF); color: white; padding: 30px; text-align: center; }
        .content { padding: 30px; }
        .success-icon { font-size: 48px; margin-bottom: 20px; }
        .course-info { background: #f8f9fa; padding: 20px; border-radius: 8px; margin: 20px 0; }
        .btn { display: inline-block; background: linear-gradient(135deg, #2E78C5, #00C9FF); color: white; padding: 12px 30px; text-decoration: none; border-radius: 25px; margin: 20px 0; }
        .footer { background: #f8f9fa; padding: 20px; text-align: center; color: #666; font-size: 14px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="success-icon">🎉</div>
            <h1>Payment Successful!</h1>
            <p>Welcome to your new learning journey</p>
        </div>
        
        <div class="content">
            <p>Hi {{ $userName }},</p>
            
            <p>Congratulations! Your payment has been successfully processed and you are now enrolled in:</p>
            
            <div class="course-info">
                <h3>{{ $courseName }}</h3>
                <p><strong>Amount Paid:</strong> KES {{ number_format($amount, 2) }}</p>
                <p><strong>Points Earned:</strong> 120 points</p>
            </div>
            
            <p>You can now access all course materials and start your learning journey immediately.</p>
            
            <div style="text-align: center;">
                <a href="{{ $courseUrl }}" class="btn">Start Learning Now</a>
            </div>
            
            <p>If you have any questions or need support, feel free to contact us.</p>
            
            <p>Happy learning!<br>
            The Digital Leap Africa Team</p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Digital Leap Africa. All rights reserved.</p>
            <p>Built by Africans ❤️ for Africa</p>
        </div>
    </div>
</body>
</html>