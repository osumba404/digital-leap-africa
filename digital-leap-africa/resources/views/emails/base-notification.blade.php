<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 0;
            background-color: #f8fafc;
        }
        .email-container {
            background: white;
            margin: 20px;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header {
            background: linear-gradient(135deg, #2E78C5, #00C9FF);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
        }
        .content {
            padding: 30px 20px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #2E78C5;
        }
        .message {
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.7;
        }
        .action-button {
            display: inline-block;
            background: linear-gradient(135deg, #2E78C5, #00C9FF);
            color: white;
            padding: 15px 30px;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            margin: 20px 0;
            transition: transform 0.2s;
        }
        .action-button:hover {
            transform: translateY(-2px);
        }
        .footer {
            background: #f8fafc;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
            font-size: 14px;
            color: #64748b;
        }
        .footer a {
            color: #2E78C5;
            text-decoration: none;
        }
        .logo {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 10px;
        }
        @media (max-width: 600px) {
            .email-container {
                margin: 10px;
            }
            .content {
                padding: 20px 15px;
            }
            .header {
                padding: 20px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <div class="logo">🚀 Digital Leap Africa</div>
            <h1>{{ $title }}</h1>
        </div>
        
        <div class="content">
            <div class="greeting">Hello {{ $user->name }}!</div>
            
            <div class="message">
                {{ $message }}
            </div>
            
            @if($actionUrl)
                <div style="text-align: center;">
                    <a href="{{ $actionUrl }}" class="action-button">{{ $actionText }}</a>
                </div>
            @endif
            
            <p style="margin-top: 30px; font-size: 14px; color: #64748b;">
                This email was sent to you because you're a valued member of Digital Leap Africa. 
                If you have any questions, feel free to contact our support team.
            </p>
        </div>
        
        <div class="footer">
            <p>
                <strong>Digital Leap Africa</strong><br>
                Empowering African Youth Through Technology<br>
                <a href="{{ config('app.url') }}">Visit our website</a> | 
                <a href="mailto:support@digitaleapafrica.com">Contact Support</a>
            </p>
            <p style="margin-top: 15px; font-size: 12px;">
                © {{ date('Y') }} Digital Leap Africa. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>