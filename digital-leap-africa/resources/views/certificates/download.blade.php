<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Certificate - {{ $certificate->user->name }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { 
            font-family: 'Inter', 'Arial', sans-serif; 
            background: #F5F7FA;
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
            width: 1000px;
            margin: 20px auto;
            background: linear-gradient(135deg, var(--navy-bg) 0%, var(--deep-blue) 50%, var(--primary-blue) 100%);
            border-radius: 24px;
            padding: 30px;
            position: relative;
            box-shadow: 0 25px 50px rgba(12, 18, 28, 0.4);
        }
        
        .certificate-inner {
            background: var(--diamond-white);
            border-radius: 20px;
            padding: 50px;
            border: 4px solid var(--cyan-accent);
            box-shadow: inset 0 0 0 2px var(--primary-blue);
            position: relative;
        }
        
        .decorative-elements {
            position: absolute;
            top: 30px;
            left: 30px;
            right: 30px;
            height: 4px;
            background: linear-gradient(90deg, var(--cyan-accent), var(--purple-accent), var(--primary-blue));
            border-radius: 2px;
        }
        
        .certificate-header { text-align: center; margin-bottom: 40px; }
        
        .certificate-logo {
            width: 100px;
            height: 100px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--diamond-white);
            font-size: 40px;
            box-shadow: 0 8px 25px rgba(46, 120, 197, 0.3);
            border: 3px solid var(--diamond-white);
        }
        
        .certificate-title {
            font-size: 48px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-blue), var(--purple-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 3px;
        }
        
        .certificate-subtitle {
            font-size: 22px;
            color: var(--deep-blue);
            font-weight: 600;
            margin-bottom: 30px;
        }
        
        .certificate-body { text-align: center; margin: 40px 0; }
        
        .certificate-text {
            font-size: 19px;
            color: var(--charcoal);
            line-height: 1.8;
            margin-bottom: 25px;
            font-weight: 500;
        }
        
        .recipient-name {
            font-size: 42px;
            font-weight: 800;
            background: linear-gradient(135deg, var(--primary-blue), var(--cyan-accent));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin: 30px 0;
            text-decoration: underline;
            text-decoration-color: var(--cyan-accent);
            text-decoration-thickness: 3px;
            text-underline-offset: 8px;
        }
        
        .course-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--deep-blue);
            margin: 30px 0;
            font-style: italic;
            position: relative;
        }
        
        .course-title::before,
        .course-title::after {
            content: '"';
            font-size: 32px;
            color: var(--cyan-accent);
            font-weight: 900;
        }
        
        .certificate-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 60px;
            padding-top: 40px;
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
        
        .signature-section { text-align: center; flex: 1; }
        
        .signature-line {
            border-bottom: 3px solid var(--primary-blue);
            width: 220px;
            margin: 0 auto 15px;
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
            font-size: 15px;
            color: var(--cool-gray);
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .signature-name {
            font-weight: 700;
            color: var(--charcoal);
            margin-top: 8px;
            font-size: 17px;
        }
        
        .certificate-number {
            position: absolute;
            bottom: 20px;
            right: 25px;
            font-size: 14px;
            color: var(--cool-gray);
            font-family: 'Courier New', monospace;
            font-weight: 600;
            background: rgba(174, 184, 194, 0.1);
            padding: 8px 15px;
            border-radius: 8px;
            border: 1px solid rgba(174, 184, 194, 0.3);
        }
        
        .certificate-date {
            position: absolute;
            bottom: 20px;
            left: 25px;
            font-size: 14px;
            color: var(--cool-gray);
            font-weight: 600;
            background: rgba(174, 184, 194, 0.1);
            padding: 8px 15px;
            border-radius: 8px;
            border: 1px solid rgba(174, 184, 194, 0.3);
        }
    </style>
</head>
<body>
    <div class="certificate-container">
        <div class="certificate-inner">
            <div class="decorative-elements"></div>
            
            <div class="certificate-header">
                <div class="certificate-logo">🎓</div>
                <h1 class="certificate-title">{{ \App\Models\SiteSetting::getValue('certificate_title', 'Certificate of Completion') }}</h1>
                <p class="certificate-subtitle">{{ \App\Models\SiteSetting::getValue('certificate_subtitle', 'Digital Leap Africa') }}</p>
            </div>

            <div class="certificate-body">
                <p class="certificate-text">{{ \App\Models\SiteSetting::getValue('certificate_text', 'This is to certify that') }}</p>
                <div class="recipient-name">{{ $certificate->user->name }}</div>
                <p class="certificate-text">{{ \App\Models\SiteSetting::getValue('certificate_completion_text', 'has successfully completed the course') }}</p>
                <div class="course-title">{{ $certificate->certificate_title }}</div>
                <p class="certificate-text">{{ \App\Models\SiteSetting::getValue('certificate_achievement_text', 'and has demonstrated exceptional proficiency in the subject matter through dedicated study, practical application, and commitment to excellence in digital learning.') }}</p>
            </div>

            <div class="certificate-footer">
                <div class="signature-section">
                    <div class="signature-line"></div>
                    <p class="signature-label">{{ \App\Models\SiteSetting::getValue('certificate_instructor_title', 'Course Instructor') }}</p>
                    <p class="signature-name">{{ $certificate->course->instructor }}</p>
                </div>
                <div class="signature-section">
                    <div class="signature-line"></div>
                    <p class="signature-label">{{ \App\Models\SiteSetting::getValue('certificate_director_title', 'Program Director') }}</p>
                    <p class="signature-name">{{ \App\Models\SiteSetting::getValue('certificate_director_name', 'Digital Leap Africa') }}</p>
                </div>
            </div>

            <div class="certificate-date">
                📅 {{ $certificate->issued_at->format('F j, Y') }}
            </div>
            <div class="certificate-number">
                🛡️ {{ $certificate->certificate_number }}
            </div>
        </div>
    </div>
</body>
</html>