# Email Notification System Documentation

## Overview
The Digital Leap Africa platform now includes a comprehensive email notification system that automatically sends emails to users for various platform activities. All emails are sent to the user's email address stored in the database.

## Features
- **Automatic Email Sending**: All in-app notifications now trigger corresponding email notifications
- **Professional Email Templates**: Modern, responsive email design with platform branding
- **User Email Fetching**: Emails are automatically sent to the user's registered email address
- **Error Handling**: Graceful fallback if email sending fails (in-app notifications still work)
- **Centralized Service**: Single service handles all email notification types

## Email Notification Types

### 1. Course-Related Notifications
- **Course Enrollment** (`course_enrollment`)
  - Sent when user successfully enrolls in a free course
  - Includes course details and "Start Learning" button

- **Course Approval** (`course_enrollment_approved`)
  - Sent when admin approves premium course enrollment
  - Includes "Access Course" button

- **Course Rejection** (`course_enrollment_rejected`)
  - Sent when admin rejects premium course enrollment
  - Includes support contact information

- **New Course Available** (`new_course`)
  - Sent to all users when admin publishes a new course
  - Includes "Explore Course" button

- **Course Completion** (`course_completed`)
  - Sent when user completes all lessons in a course
  - Includes celebration message and "View Certificate" button

### 2. Learning Progress Notifications
- **Lesson Completion** (`lesson_completed`)
  - Sent when user completes a lesson
  - Includes "Continue Learning" button

### 3. Account Management Notifications
- **Account Verified** (`account_verified`)
  - Sent when admin verifies user account
  - Includes gold badge information and "Go to Dashboard" button

- **Account Unverified** (`account_unverified`)
  - Sent when admin removes account verification
  - Includes information about limited features

### 4. Payment Notifications
- **Payment Success** (`payment_success`)
  - Sent when M-Pesa payment is successful
  - Includes course access and points earned information

### 5. Community Notifications
- **Forum Reply** (`forum_reply`)
  - Sent when someone replies to user's forum thread
  - Includes "Join Conversation" button

- **Testimonial Approved** (`testimonial_approved`)
  - Sent when admin approves user's testimonial
  - Includes "View Testimonials" button

## Technical Implementation

### Email Service Architecture
```php
// Centralized email service
App\Services\EmailNotificationService::sendNotification($type, $user, $data);
```

### Email Classes Structure
```
app/Mail/
├── BaseNotification.php          # Base email template class
├── CourseEnrollmentNotification.php
├── CourseApprovalNotification.php
├── AccountVerificationNotification.php
├── LessonCompletionNotification.php
├── CourseCompletionNotification.php
├── NewCourseNotification.php
└── PaymentSuccessNotification.php
```

### Email Templates
```
resources/views/emails/
├── base-notification.blade.php   # Professional responsive template
└── payment-success.blade.php     # Specific payment template
```

## Usage Examples

### Sending Email Notifications in Controllers
```php
use App\Services\EmailNotificationService;

// Course enrollment
EmailNotificationService::sendNotification('course_enrollment', $user, ['course' => $course]);

// Account verification
EmailNotificationService::sendNotification('account_verified', $user);

// Generic notification
EmailNotificationService::sendNotification('generic', $user, [
    'title' => 'Custom Title',
    'message' => 'Custom message content',
    'url' => route('some.route')
]);
```

### Email Template Features
- **Responsive Design**: Works on all devices and email clients
- **Professional Branding**: Digital Leap Africa colors and logo
- **Action Buttons**: Call-to-action buttons for user engagement
- **Consistent Styling**: Matches platform design system
- **Mobile Optimized**: Proper scaling for mobile devices

## Configuration

### Environment Variables Required
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@digitaleapafrica.com"
MAIL_FROM_NAME="Digital Leap Africa"
```

### Gmail Setup (Production)
1. Enable 2-Factor Authentication on Gmail
2. Generate App Password for Laravel
3. Update `.env` with credentials
4. Run `php artisan config:cache`

## Testing

### Test Email Route
Visit `/test-email` while logged in to send a test email notification.

### Manual Testing
```php
// In tinker or controller
use App\Services\EmailNotificationService;
use App\Models\User;

$user = User::find(1);
EmailNotificationService::sendNotification('generic', $user, [
    'title' => 'Test Email',
    'message' => 'This is a test email notification.',
    'url' => route('dashboard')
]);
```

## Error Handling

### Graceful Fallbacks
- If email sending fails, in-app notifications still work
- Errors are logged to Laravel log files
- Users are not affected by email delivery issues

### Logging
All email sending errors are logged with details:
```
Failed to send email notification (course_enrollment) to user@example.com: Error message
```

## Integration Points

### Controllers with Email Notifications
- `CourseController` - Enrollment notifications
- `LessonController` - Completion notifications
- `PaymentController` - Payment success notifications
- `Admin\UserController` - Account verification notifications
- `Admin\CourseController` - Course approval and new course notifications
- `Admin\TestimonialController` - Testimonial approval notifications
- `ForumController` - Forum reply notifications

### Automatic Triggers
All email notifications are automatically triggered when:
1. In-app notification is created
2. User email is fetched from database
3. Appropriate email template is selected
4. Email is sent asynchronously (non-blocking)

## Best Practices

### Email Content
- Clear, concise subject lines
- Personalized greetings using user's name
- Action-oriented call-to-action buttons
- Professional tone and branding
- Mobile-responsive design

### Performance
- Emails are sent asynchronously to avoid blocking user actions
- Error handling prevents application crashes
- Logging helps with debugging and monitoring

### Security
- No sensitive information in email content
- Secure SMTP configuration
- Proper authentication for email service

## Maintenance

### Adding New Email Types
1. Create new Mailable class in `app/Mail/`
2. Add case to `EmailNotificationService::sendNotification()`
3. Update controllers to call the service
4. Test email delivery

### Monitoring
- Check Laravel logs for email errors
- Monitor email delivery rates
- Test email templates across different clients

## Future Enhancements

### Planned Features
- Email preferences for users (opt-in/opt-out)
- Email templates customization in admin panel
- Bulk email notifications for announcements
- Email analytics and delivery tracking
- Rich HTML email templates with images

### Queue Integration
Consider implementing Laravel queues for high-volume email sending:
```php
// Future implementation
EmailNotificationService::sendNotification($type, $user, $data, $queue = true);
```

## Support

### Troubleshooting
1. Check `.env` email configuration
2. Verify Gmail app password
3. Check Laravel logs for errors
4. Test with `/test-email` route
5. Verify user email addresses in database

### Common Issues
- **SMTP Authentication Failed**: Check Gmail app password
- **Connection Timeout**: Verify SMTP host and port
- **Email Not Received**: Check spam folder, verify email address
- **Template Errors**: Check Blade syntax in email templates

---

**Note**: This email notification system enhances user engagement by keeping users informed about their learning progress and platform activities through professional email communications.