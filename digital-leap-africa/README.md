# Digital Leap Africa 🚀

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-10.x-red?style=for-the-badge&logo=laravel" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.1+-blue?style=for-the-badge&logo=php" alt="PHP">
  <img src="https://img.shields.io/badge/Status-Complete-green?style=for-the-badge" alt="Status">
</p>

**Empowering African youth through technology education, collaboration, and professional opportunities.**

A comprehensive Laravel-based learning management system designed to bridge the digital skills gap in Africa through expert-led courses, real-world projects, job opportunities, and community engagement.

## 🌟 Project Status: **COMPLETE** ✅

All major features have been implemented with modern design, full mobile responsiveness, and engaging animations.

## 🎯 Key Features

### 🎓 **Learning Management System**
- **ALX-Style Enrollment**: Free courses (immediate access) vs Premium courses (admin approval)
- **Expert-Led Courses**: Comprehensive course catalog with dual enrollment system
- **Progress Tracking**: User dashboard with learning analytics and completion rates
- **Interactive Content**: Lessons, topics, and structured learning paths
- **Gamification**: Points system to encourage engagement and completion

### 💼 **Career Development**
- **Job Board**: Curated tech job opportunities with application tracking
- **Project Showcase**: Portfolio building with real-world project examples
- **Skills Assessment**: Track learning progress and skill development

### 📚 **Digital Resources**
- **eLibrary**: Comprehensive digital resource collection
- **Blog/Articles**: Educational content and industry insights
- **Community Forum**: Discussion threads with reply functionality

### 👥 **Community Features**
- **User Profiles**: Personalized dashboards and progress tracking
- **Forum Discussions**: Thread creation and community interaction (with points)
- **Events System**: Community events and workshops
- **Gamification**: Complete point system with automatic rewards and badge earning
- **Point Redemption**: Spend points on premium features and privileges

### 🛠 **Advanced Admin Management**
- **Complete CMS**: Full content management for all resources
- **User Management**: Admin controls and role-based access
- **Analytics Dashboard**: Platform statistics and insights
- **Badge Management**: Create and assign badges with automatic awarding
- **Gamification Controls**: Monitor points, levels, and user progression
- **Comprehensive Site Configuration**: Advanced settings system with 8 organized sections

### ⚙️ **Comprehensive Site Settings**
- **Basic Information**: Site name, tagline, contact details, language settings
- **Appearance Customization**: Dynamic theme colors, font selection, background modes
- **Social Media Integration**: Complete social platform linking (Facebook, Instagram, LinkedIn, YouTube, Twitter/X, TikTok)
- **SEO & Metadata**: Meta tags, keywords, OpenGraph images, Google Analytics integration
- **Security & Access Control**: Maintenance mode, registration controls, admin notifications
- **Legal Compliance**: Privacy policy and terms of service management
- **API Integrations**: SMTP configuration, M-Pesa payment gateway, social login options
- **File Management**: Logo, favicon, hero banner, and OpenGraph image uploads

## 🎨 Design & User Experience

### **Modern Dark Theme**
- **Color Palette**: Navy, charcoal, cyan, and purple accents
- **Typography**: Inter font family for optimal readability
- **Consistent Branding**: Professional design system throughout

### **Responsive Design**
- **Mobile-First**: Optimized for all device sizes
- **Touch-Friendly**: Intuitive mobile navigation with hamburger menu
- **Adaptive Layouts**: Flexible grids and responsive components

### **Engaging Animations**
- **Page Transitions**: Smooth fade-in and slide animations
- **Interactive Elements**: Hover effects and micro-interactions
- **Loading States**: Professional loading and transition effects
- **Scroll Effects**: Dynamic header behavior and parallax elements

## 🏗 Technical Architecture

### **Backend (Laravel 10.x)**
```
├── Models & Relationships
│   ├── User (with roles & gamification)
│   ├── Course → Topics → Lessons
│   ├── Project, Job, Article, Event
│   └── Forum → Thread → Reply
├── Controllers
│   ├── Public Controllers (Courses, Jobs, etc.)
│   ├── Admin Controllers (Full CRUD)
│   └── Auth & Profile Management
├── Middleware & Security
│   ├── Role-based access control
│   ├── CSRF protection
│   └── Input validation
└── Database
    ├── Migrations for all entities
    ├── Seeders for sample data
    └── Relationships & constraints
```

### **Frontend Architecture**
```
├── Layouts
│   ├── Main App Layout (with navigation)
│   ├── Admin Layout (dashboard style)
│   └── Guest Layout (auth pages)
├── Components
│   ├── Responsive Navigation
│   ├── Mobile Sidebar
│   ├── Form Components
│   └── Data Tables
├── Styling
│   ├── CSS Variables (design system)
│   ├── Responsive Breakpoints
│   ├── Animation Keyframes
│   └── Component Styles
└── JavaScript
    ├── Mobile Menu Interactions
    ├── Scroll Effects
    └── Form Enhancements
```

## 📱 Pages & Functionality

### **Public Pages**
- ✅ **Homepage**: Hero section, features, statistics with animations
- ✅ **Courses**: Course catalog with search, enrollment and progress tracking
- ✅ **Projects**: Project showcase with filtering and details
- ✅ **Jobs**: Job board with application links and filtering
- ✅ **eLibrary**: Digital resources with categorization
- ✅ **Forum**: Discussion threads with reply functionality
- ✅ **Blog**: Articles with commenting system
- ✅ **Auth Pages**: Modern login/register with animations
- ✅ **Legal Pages**: Privacy Policy and Terms of Service with responsive design

### **User Dashboard**
- ✅ **Personal Dashboard**: Progress tracking, enrolled courses, quick actions
- ✅ **Profile Management**: Account settings, password update, gamification stats
- ✅ **Course Progress**: Detailed learning analytics and completion tracking

### **Advanced Admin Panel**
- ✅ **Admin Dashboard**: Statistics, quick actions, recent activity
- ✅ **Content Management**: Full CRUD for all content types
- ✅ **User Management**: Role assignment and user oversight
- ✅ **Forum Management**: Complete thread and reply administration
- ✅ **Rich Content Editor**: Quill.js integration with image uploads
- ✅ **Comprehensive Site Settings**: 8 organized sections with 50+ configuration options
  - Basic Information & Contact Details
  - Appearance & Theme Customization
  - Social Media Integration
  - SEO & Metadata Management
  - Security & Access Controls
  - Legal Page Management
  - API & Integration Settings
  - File Upload Management

## 🚀 Installation & Setup

### Prerequisites
- PHP 8.1+ (tested with PHP 8.2.12)
- Composer
- Node.js & NPM
- MySQL/PostgreSQL
- Laravel 9.52.20

### Installation Steps

1. **Clone Repository**
```bash
git clone https://github.com/your-username/digital-leap-africa.git
cd digital-leap-africa
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Environment Setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database Configuration**
```bash
# Configure database in .env file
php artisan migrate
php artisan db:seed
```

5. **Build Assets**
```bash
npm run build
```

6. **Start Development Server**
```bash
php artisan serve
```

## 🔧 Configuration

### **Environment Variables**
```env
APP_NAME="Digital Leap Africa"
APP_URL=http://localhost:8000
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=digital_leap_africa
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Email Configuration (for password reset)
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@digitaleapafrica.com"
MAIL_FROM_NAME="${APP_NAME}"
```

### **Course Search Configuration**
The search functionality is automatically enabled and searches through:
- Course titles
- Course descriptions
- Real-time results with pagination
- Mobile-responsive interface
- Clear search and empty state handling

### **Advanced Site Configuration**
All site settings are now managed through the comprehensive admin settings panel:

**Access**: Admin Panel → Site Settings

**Available Sections**:
1. **Basic Information** - Site identity and contact details
2. **General Information** - Logo and favicon management
3. **Appearance** - Theme colors, fonts, and visual settings
4. **Social Media Links** - Complete social platform integration
5. **SEO & Metadata** - Search engine optimization settings
6. **Security & Access** - Site security and access controls
7. **Legal Pages** - Privacy policy and terms management
8. **Integrations & APIs** - Third-party service configurations

**Dynamic Features**:
- Real-time theme color updates
- Font family customization
- Social media link management
- SEO metadata control
- Maintenance mode toggle
- File upload management

### **Admin Account**
Create an admin user:
```bash
php artisan tinker
User::create([
    'name' => 'Admin User',
    'email' => 'admin@digitaleapafrica.com',
    'password' => Hash::make('password'),
    'role' => 'admin',
    'email_verified_at' => now()
]);
```

### **Email Configuration**

#### **SMTP Setup (Required)**
1. **Gmail Setup**: Enable 2FA and generate App Password
2. **Update .env**: Replace `your-email@gmail.com` and `your-app-password`
3. **Cache Config**: Run `php artisan config:cache`
4. **Test Email**: Visit `/test-email` while logged in to test email delivery

#### **Password Reset System**
- **Secure Token-Based**: Only registered users receive reset emails
- **Professional Emails**: Branded reset emails with action buttons
- **Database Validation**: System validates email exists before sending
- **Privacy Protection**: Same response whether email exists or not
- **Single-Use Tokens**: Tokens expire after successful password reset

### **User Verification System**
- **Admin Panel**: `/admin/users` - Manage user verification status
- **Gold Badges**: Verified users get gold medal badges on avatars
- **Notifications**: Automatic notifications for verification changes

## 🆕 Latest Updates & Features

### **Version 8.0 - Comprehensive Email Notification System** 🆕 **LATEST**
- **Complete Email Infrastructure**: Professional email notifications for all platform activities
- **10 Email Notification Types**: Course enrollment, completion, verification, payments, forum replies, etc.
- **Secure Password Reset**: Token-based email reset system for registered users only
- **Professional Email Templates**: Responsive, branded email design with action buttons
- **Centralized Email Service**: Single service manages all email types with error handling
- **Database Integration**: Emails automatically sent to user's registered email address
- **Security Features**: Only registered users receive password reset emails, no email disclosure

### **Version 7.0 - Search & Legal Pages**
- **Course Search Functionality**: Real-time search with filters, pagination, and results counter
- **Legal Pages**: Complete Privacy Policy and Terms of Service pages with modern design
- **Enhanced Mobile Responsiveness**: Fixed text overflow issues across all testimonial pages
- **Footer Integration**: Legal pages properly linked in footer navigation
- **Search UX**: Clear search option, empty states, and mobile-optimized interface

### **Version 6.0 - User Verification & Password Reset System**
- **Admin User Verification**: Manual verify/unverify users with gold medal badges
- **Gold Medal Badges**: Premium verification badges on user avatars (Twitter/WhatsApp style)
- **Dual Password Reset**: Email-based and direct reset (no email required)
- **User Management Panel**: Complete admin interface for user verification
- **Automatic Notifications**: Users notified of verification status changes
- **Gmail SMTP Integration**: Ready-to-use email configuration for password resets

### **Version 5.0 - ALX-Style Enrollment System**
- **Dual Enrollment Flow**: Free courses (immediate access) vs Premium courses (admin approval required)
- **Smart Course Management**: Automatic enrollment handling based on course type (free/premium)
- **Admin Enrollment Control**: Complete approval/rejection system with notifications
- **Status-Based Access**: Course content access controlled by enrollment status
- **Enhanced User Experience**: Clear status indicators (pending, active, rejected) with appropriate messaging
- **Integrated Notifications**: Automatic notifications for enrollment status changes

### **Version 4.0 - Complete Gamification System**
- **Automatic Point Awarding**: Points earned for lessons (50), courses (200), enrollment (20), forum activity (5-10)
- **Auto Badge System**: Badges automatically awarded based on achievements and milestones
- **Point Redemption Store**: Spend points on premium courses (500), forum privileges (250), job priority (300), mentorship (500), certifications (1000)
- **User Level Progression**: 5-tier system from Beginner (0) to Master (5000+ points)
- **Daily Login Rewards**: 5 points per day for active engagement
- **Gamification Service**: Centralized service handling all point/badge logic

### **Version 3.0 - Production Ready & Fully Functional**
- **Complete Admin Forum Management**: Full CRUD operations for forum threads and replies
- **Rich Text Editor Integration**: Quill.js with dark theme and image upload support
- **Database Migration Fixes**: Resolved all table/column conflicts and errors
- **Error Handling Enhancement**: Graceful fallbacks for missing database tables
- **Google OAuth Integration**: Complete social login functionality
- **Comprehensive Email System**: Professional email notifications for all platform activities
- **Secure Password Reset**: Token-based email reset for registered users only
- **Mobile Navigation Fixes**: Professional responsive navigation with smooth animations
- **Production Deployment Ready**: All critical bugs fixed and tested

### **Version 2.0 - Comprehensive Settings System**
- **Advanced Admin Settings**: 8 organized sections with 50+ configuration options
- **Dynamic Theme Engine**: Real-time color and font customization
- **Social Media Integration**: Complete platform linking with dynamic footer
- **SEO Enhancement**: Meta tags, keywords, and Google Analytics integration
- **Security Controls**: Maintenance mode, registration controls, admin notifications
- **File Management**: Multi-file upload system for logos, favicons, banners
- **API Framework**: SMTP, M-Pesa, and social login integrations
- **Performance Optimization**: Advanced caching system for settings

### **Settings Architecture**
```php
// Easy settings access throughout the application
SettingsHelper::get('primary_color', '#2E78C5')
SettingsHelper::get('maintenance_mode', false)
SettingsHelper::all() // Get all settings
```

### **Dynamic Theme System**
- CSS variables automatically updated from admin settings
- Real-time color scheme changes
- Font family selection with Google Fonts integration
- Background mode controls (Light/Dark/Auto)

### **Social Media Integration**
- Dynamic footer links based on admin settings
- Support for Facebook, Instagram, LinkedIn, YouTube, Twitter/X, TikTok
- Automatic icon rendering and link validation

## 📊 Features Breakdown

### **Completed Features** ✅
- [x] User Authentication & Authorization (Google OAuth included)
- [x] **ALX-Style Enrollment System** (free vs premium course flows)
- [x] **Course Search System** (real-time search with pagination and filters)
- [x] Course Management System (with rich text editor)
- [x] Project Showcase Platform
- [x] Job Board with Applications
- [x] Digital Library (eLibrary)
- [x] Community Forum with Replies (admin management included)
- [x] Blog/Articles System
- [x] User Dashboard & Profiles
- [x] Advanced Admin Panel (Complete CMS with enrollment management)
- [x] **Complete Gamification System** (automatic points, badges, levels, redemption)
- [x] Mobile Responsive Design (professional navigation)
- [x] Modern Animations & Interactions
- [x] Comprehensive Site Configuration System
- [x] Dynamic Theme Customization
- [x] Social Media Integration
- [x] SEO & Analytics Integration
- [x] Maintenance Mode System
- [x] Advanced Security Controls
- [x] Multi-language Support
- [x] File Management System
- [x] API Integration Framework
- [x] Notification System Infrastructure
- [x] Rich Text Content Editor (Quill.js)
- [x] Database Migration System (conflict-free)
- [x] Error Handling & Graceful Fallbacks
- [x] **Automatic Point System** (lesson completion, course enrollment, forum participation)
- [x] **Badge Auto-Awarding** (achievement-based badge earning)
- [x] **Point Redemption Store** (spend points on premium features)
- [x] **User Level Progression** (Beginner → Learner → Contributor → Expert → Master)
- [x] **Daily Login Rewards** (5 points per day)
- [x] **ALX-Style Enrollment System** (free vs premium course flows)
- [x] **Admin Enrollment Management** (approve/reject premium course enrollments)
- [x] **Status-Based Course Access** (content access controlled by enrollment status)
- [x] **Dual Course Types** (free courses with immediate access, premium with approval)
- [x] **Admin User Verification System** (manual verify/unverify users with notifications)
- [x] **Gold Medal Verification Badges** (Twitter/WhatsApp-style badges on user avatars)
- [x] **Secure Password Reset System** (email-based token reset for registered users only)
- [x] **Comprehensive Email Notification System** (10 notification types with professional templates)
- [x] **Professional Email Templates** (responsive, branded email design with action buttons)
- [x] **Email Security Features** (database validation, token-based reset, privacy protection)
- [x] **User Management Interface** (admin panel for user verification and management)
- [x] **Legal Pages System** (Privacy Policy and Terms of Service with modern design)
- [x] **Enhanced Mobile Responsiveness** (fixed text overflow and card layout issues)

### **Technical Achievements** 🏆
- [x] Role-based Access Control
- [x] RESTful API Architecture
- [x] Database Relationships & Migrations (conflict-free)
- [x] Advanced Form Validation & Security
- [x] Comprehensive File Upload & Management
- [x] Responsive CSS Grid Layouts
- [x] JavaScript Interactions
- [x] SEO-Friendly URLs
- [x] Error Handling & Logging
- [x] Settings Caching System
- [x] Dynamic Theme Engine
- [x] Maintenance Mode Middleware
- [x] Social Media API Integration
- [x] Google Analytics Integration
- [x] Advanced Security Middleware
- [x] Multi-file Upload System
- [x] Settings Helper Architecture
- [x] Rich Text Editor Integration (Quill.js)
- [x] Google OAuth Authentication
- [x] Admin Forum Management System
- [x] Notification Infrastructure
- [x] Mobile-First Responsive Design
- [x] Production-Ready Deployment
- [x] Git Repository Management
- [x] Database Migration Conflict Resolution

## 🎨 Design System

### **Color Palette**
```css
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
```

### **Typography**
- **Font Family**: Inter (Google Fonts)
- **Headings**: 700 weight with gradient text effects
- **Body**: 400-500 weight for optimal readability
- **UI Elements**: 600 weight for emphasis

### **Components**
- **Cards**: Glass morphism with subtle borders
- **Buttons**: Gradient backgrounds with hover animations
- **Forms**: Dark theme with cyan accent focus states
- **Navigation**: Fixed header with scroll effects

## 📱 Mobile Experience

### **Responsive Breakpoints**
- **Desktop**: 1200px+ (Full layout)
- **Tablet**: 768px-1199px (Adapted layout)
- **Mobile**: <768px (Stacked layout with hamburger menu)
- **Small Mobile**: <480px (Optimized spacing)

### **Mobile Features**
- **Hamburger Menu**: Smooth slide-in navigation
- **Touch Gestures**: Swipe and tap interactions
- **Optimized Forms**: Mobile-friendly input sizes
- **Readable Text**: Appropriate font scaling

## 🏅 User Verification & Password Reset

### **🥇 Gold Medal Verification Badges**
- **Visual Design**: Gold gradient badges with medal icons on user avatars
- **Responsive Sizing**: 14px for navigation, 24px for profile pages
- **Theme Adaptive**: Border colors adapt to light/dark themes
- **Conditional Display**: Only shows for verified users (`email_verified_at` not null)

### **👨‍💼 Admin Verification Controls**
- **User Management**: `/admin/users` - view all users with verification status
- **One-Click Actions**: Verify/Unverify buttons with confirmation
- **Dual Notifications**: Users receive both in-app and email notifications
- **Status Indicators**: Green (verified) and yellow (unverified) badges in admin panel

### **📧 Comprehensive Email Notification System**

#### **🎯 Email Notification Types**
1. **Course Enrollment** - Welcome emails for successful enrollments
2. **Course Approval/Rejection** - Admin decision notifications
3. **Account Verification** - Gold badge verification emails
4. **Lesson Completion** - Progress celebration emails
5. **Course Completion** - Achievement milestone emails
6. **New Course Announcements** - Platform-wide course launches
7. **Payment Success** - Transaction confirmation emails
8. **Forum Replies** - Community engagement notifications
9. **Testimonial Approval** - Content moderation updates
10. **Password Reset** - Secure token-based reset emails

#### **🔐 Secure Password Reset System**
- **Database Validation**: Only sends emails to registered users in database
- **Token-Based Security**: Secure token generation and validation
- **Professional Emails**: Branded reset emails with action buttons
- **Privacy Protection**: Doesn't reveal if email exists in system
- **Single-Use Tokens**: Tokens expire after successful password reset

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

## 🛠 Recent Critical Fixes & Improvements

### **Database & Migration Fixes**
- ✅ **Migration Conflicts Resolved**: Fixed duplicate table/column creation errors
- ✅ **Notifications Table**: Created with proper error handling for missing tables
- ✅ **Articles Table**: Resolved conflicting migrations with existence checks
- ✅ **Profile Photo Column**: Fixed duplicate column addition errors
- ✅ **Testimonials Table**: Added proper table existence validation

### **Admin Panel Enhancements**
- ✅ **Forum Management**: Created complete Admin ForumController with CRUD operations
- ✅ **Admin Layout**: Built professional admin interface layout
- ✅ **Rich Text Editor**: Integrated Quill.js with dark theme and image upload
- ✅ **Navigation Fixes**: Professional responsive navigation with smooth animations

### **Authentication & Integration**
- ✅ **Google OAuth**: Complete social login functionality implemented
- ✅ **Laravel Socialite**: Installed and configured for social authentication
- ✅ **Error Handling**: Graceful fallbacks for missing database components

### **Production Readiness**
- ✅ **Git Repository**: Synchronized with GitHub, resolved merge conflicts
- ✅ **Code Quality**: All critical bugs fixed and tested
- ✅ **Mobile Optimization**: Professional mobile-first responsive design
- ✅ **Performance**: Optimized queries and caching systems

## 🔒 Advanced Security Features

- **CSRF Protection**: All forms protected
- **Input Validation**: Comprehensive server-side validation for all inputs
- **Role-based Access Control**: Advanced admin/user role separation
- **Password Hashing**: Secure password storage with bcrypt
- **SQL Injection Prevention**: Eloquent ORM protection
- **Maintenance Mode**: Site-wide maintenance control
- **Registration Controls**: Admin-controlled user registration
- **File Upload Security**: Secure file validation and storage
- **Settings Access Control**: Protected admin-only configuration
- **Session Management**: Secure session handling
- **API Security**: Protected API endpoints with validation
- **Error Handling**: Graceful fallbacks prevent application crashes

## 🚀 Performance Optimizations

- **Settings Caching**: Advanced caching system for site settings
- **Lazy Loading**: Efficient database queries
- **CSS Optimization**: Minimal and organized stylesheets
- **JavaScript**: Vanilla JS for lightweight interactions
- **Image Optimization**: Responsive image handling with multiple formats
- **Database Optimization**: Indexed queries and relationship optimization
- **File Management**: Efficient file storage and retrieval system
- **Cache Management**: Automatic cache invalidation for settings updates

## 📧 Email Notification Architecture

### **Email Service Structure**
```php
// Centralized email service
App\Services\EmailNotificationService::sendNotification($type, $user, $data);

// Email classes
app/Mail/
├── BaseNotification.php              # Base email template
├── CourseEnrollmentNotification.php   # Course enrollment emails
├── CourseApprovalNotification.php     # Course approval/rejection
├── AccountVerificationNotification.php # Account verification
├── LessonCompletionNotification.php   # Lesson completion
├── CourseCompletionNotification.php   # Course completion
├── NewCourseNotification.php          # New course announcements
└── PasswordResetNotification.php      # Password reset emails
```

### **Email Template Features**
- **Responsive Design**: Works on all devices and email clients
- **Professional Branding**: Digital Leap Africa colors and logo
- **Action Buttons**: Call-to-action buttons for user engagement
- **Consistent Styling**: Matches platform design system
- **Mobile Optimized**: Proper scaling for mobile devices

### **Integration Points**
Email notifications are automatically sent from:
- CourseController (enrollment notifications)
- LessonController (completion notifications)
- PaymentController (payment success)
- Admin\UserController (verification notifications)
- Admin\CourseController (approval & new course notifications)
- Admin\TestimonialController (approval notifications)
- ForumController (reply notifications)

### **Testing Features**
- `/test-email` - Test general email notifications (requires login)
- `/test-password-reset` - Test password reset emails (requires login)

## 🔍 Search Features

### **Course Search System**
- **Real-time Search**: Instant results as you type
- **Database Queries**: Searches course titles and descriptions
- **Pagination Support**: Maintains search parameters across pages
- **Mobile Optimized**: Touch-friendly interface with responsive design
- **Results Counter**: Shows number of courses found
- **Empty States**: Helpful messages when no results found
- **Clear Search**: Easy option to reset search and view all courses

### **Search Implementation**
```php
// Controller handles search parameter
public function index(Request $request): View
{
    $search = $request->get('search');
    $query = Course::query()->where('active', true);
    
    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('title', 'LIKE', "%{$search}%")
              ->orWhere('description', 'LIKE', "%{$search}%");
        });
    }
    
    $courses = $query->latest()->paginate(9)->appends(['search' => $search]);
    return view('pages.courses.index', compact('courses', 'search'));
}
```

## 📄 Legal Pages

### **Privacy Policy & Terms of Service**
- **Modern Design**: Consistent with site theme and responsive layout
- **Comprehensive Content**: Professional legal content covering all aspects
- **Easy Navigation**: Linked in footer and accessible via direct URLs
- **Mobile Responsive**: Optimized for all device sizes
- **Light/Dark Theme**: Supports both theme modes
- **Dynamic Dates**: Shows current date as "Last updated"

### **Legal Pages Routes**
```php
Route::view('/privacy-policy', 'legal.privacy')->name('privacy.policy');
Route::view('/terms-of-service', 'legal.terms')->name('terms.service');
```

## 🤝 Contributing

This project is complete but open for enhancements:

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/enhancement`)
3. Commit changes (`git commit -am 'Add enhancement'`)
4. Push to branch (`git push origin feature/enhancement`)
5. Create Pull Request

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 👨‍💻 Developer

**Collins Otieno**
- Email: otienocollins0549@gmail.com
- GitHub: [@osumba404](https://github.com/osumba404)

---

<p align="center">
  <strong>🌍 Empowering African Youth Through Technology 🚀</strong>
</p>

<p align="center">
  Built with ❤️ using Laravel, modern CSS, and JavaScript
</p>