<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmailTemplate;
use App\Models\CertificateTemplate;

class AdminSystemSeeder extends Seeder
{
    public function run(): void
    {
        // Create default email templates
        $emailTemplates = [
            [
                'name' => 'Course Enrollment Notification',
                'subject' => 'Welcome to {{course.title}}!',
                'content' => '<h2>Welcome {{user.name}}!</h2><p>You have successfully enrolled in <strong>{{course.title}}</strong>.</p><p>Start your learning journey today!</p><a href="{{url}}" style="background: #2E78C5; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">View Course</a>',
                'active' => true
            ],
            [
                'name' => 'Course Completion Congratulations',
                'subject' => 'Congratulations! You completed {{course.title}}',
                'content' => '<h2>🎉 Congratulations {{user.name}}!</h2><p>You have successfully completed <strong>{{course.title}}</strong>.</p><p>Your certificate is now available for download.</p><a href="{{url}}" style="background: #00C9FF; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Download Certificate</a>',
                'active' => true
            ],
            [
                'name' => 'Password Reset Request',
                'subject' => 'Reset Your Password - Digital Leap Africa',
                'content' => '<h2>Password Reset Request</h2><p>Hello {{user.name}},</p><p>You requested to reset your password. Click the button below to reset it:</p><a href="{{url}}" style="background: #dc3545; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Reset Password</a><p>If you did not request this, please ignore this email.</p>',
                'active' => true
            ],
            [
                'name' => 'Account Verification',
                'subject' => 'Your account has been verified!',
                'content' => '<h2>Account Verified! 🥇</h2><p>Hello {{user.name}},</p><p>Your account has been verified and you now have a gold verification badge!</p><p>Enjoy premium features and enhanced credibility on our platform.</p><a href="{{url}}" style="background: #ffc107; color: #000; padding: 10px 20px; text-decoration: none; border-radius: 5px;">View Profile</a>',
                'active' => true
            ]
        ];

        foreach ($emailTemplates as $template) {
            EmailTemplate::updateOrCreate(
                ['name' => $template['name']],
                $template
            );
        }

        // Create default certificate template
        $certificateContent = '
            <div style="text-align: center; padding: 2rem;">
                <h1 style="font-size: 2.5rem; margin-bottom: 1rem; color: #2E78C5;">Certificate of Completion</h1>
                <p style="font-size: 1.2rem; margin-bottom: 2rem;">This is to certify that</p>
                <h2 style="font-size: 2rem; margin-bottom: 2rem; color: #00C9FF;">{{student_name}}</h2>
                <p style="font-size: 1.2rem; margin-bottom: 1rem;">has successfully completed the course</p>
                <h3 style="font-size: 1.5rem; margin-bottom: 2rem; color: #2E78C5;">{{course_title}}</h3>
                <p style="margin-bottom: 2rem;">on {{completion_date}}</p>
                <div style="display: flex; justify-content: space-between; align-items: end; margin-top: 3rem;">
                    <div>
                        <p style="margin: 0; font-weight: bold;">{{instructor_name}}</p>
                        <p style="margin: 0; font-size: 0.9rem;">Digital Leap Africa</p>
                    </div>
                    <div>
                        <p style="margin: 0; font-size: 0.8rem;">Certificate No: {{certificate_number}}</p>
                    </div>
                </div>
            </div>
        ';

        CertificateTemplate::updateOrCreate(
            ['name' => 'Default Certificate Template'],
            [
                'name' => 'Default Certificate Template',
                'content' => $certificateContent,
                'background_color' => '#ffffff',
                'text_color' => '#000000',
                'active' => true
            ]
        );
    }
}