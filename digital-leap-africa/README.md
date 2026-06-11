# Digital Leap Africa — E-Learning Platform

Digital Leap Africa is a full-stack e-learning and community platform built with Laravel 9. It provides a comprehensive suite of tools for managing and delivering educational content, tracking learner progress, facilitating community engagement, and administering the platform. Everything — from the public-facing website to the advanced admin panel — is fully dynamic and database-driven.

---

## Table of Contents

1. [Tech Stack](#tech-stack)
2. [Authentication & Registration](#authentication--registration)
3. [Role-Based Access Control](#role-based-access-control)
4. [User / Student Journey](#user--student-journey)
5. [Course Structure](#course-structure)
6. [Enrollment System](#enrollment-system)
7. [Lesson Access & Sequential Restrictions](#lesson-access--sequential-restrictions)
8. [Exam System](#exam-system)
9. [Gamification & Points](#gamification--points)
10. [Badges & Achievements](#badges--achievements)
11. [Certificates](#certificates)
12. [Payments (M-Pesa)](#payments-m-pesa)
13. [Community — Forum](#community--forum)
14. [Blog / Articles](#blog--articles)
15. [eLibrary](#elibrary)
16. [Events](#events)
17. [Job Board](#job-board)
18. [Projects Showcase](#projects-showcase)
19. [Leaderboard](#leaderboard)
20. [Notifications](#notifications)
21. [Profile & Transcript](#profile--transcript)
22. [Admin Panel Overview](#admin-panel-overview)
23. [Course Management (Admin)](#course-management-admin)
24. [Student Management (Admin)](#student-management-admin)
25. [Content Management (Admin)](#content-management-admin)
26. [Site Settings](#site-settings)
27. [Email Notification System](#email-notification-system)
28. [Getting Started](#getting-started)

---

## Tech Stack

| Layer       | Technology                                |
|-------------|-------------------------------------------|
| Backend     | PHP 8.2 / Laravel 9                       |
| Frontend    | Blade, Tailwind CSS, Alpine.js            |
| Database    | MySQL                                     |
| Auth        | Laravel Breeze + Laravel Socialite (Google OAuth) |
| Payments    | M-Pesa STK Push (Safaricom Daraja API)    |
| Email       | SMTP via custom mail server               |
| Images      | WebP conversion & optimisation            |
| Storage     | Local disk (public) / Laravel Storage     |

---

## Authentication & Registration

### Standard Registration
Users register with their **name, email, and password**. Registered users are assigned the `user` role by default.

### Google OAuth
Users can sign in or register via **Google OAuth** (Laravel Socialite). On first Google login:
- A new account is created automatically with a temporary default password (`@africa1`).
- The user is prompted immediately to update their password on the profile page.
- Subsequent Google logins are matched by email address, so no duplicate accounts are created.

### Login
Standard email/password login is supported. Sessions are managed via Laravel's cookie-based session system.

### Password Reset
Users can request a password reset link via email. The link expires after 60 minutes and is sent through the platform's SMTP email service.

### Email Verification
Email verification is enforced for access to certain authenticated routes (enrollments, forum posting, testimonials, etc.).

---

## Role-Based Access Control

The platform uses a two-tier role system stored in the `users.role` column:

| Role    | Access Level                                          |
|---------|-------------------------------------------------------|
| `user`  | Public pages, dashboard, courses, forum, profile, etc.|
| `admin` | Everything above + full Admin Panel                   |

Access is enforced by a custom `RoleMiddleware`. All admin routes are protected by `auth` + `role:admin`. Admins access the panel at `/admin/dashboard`.

To promote a user to admin, update their `role` column in the database from `user` to `admin`.

---

## User / Student Journey

1. **Discovery** — User browses the public course catalogue at `/courses`.
2. **Registration / Login** — User creates an account or logs in (including via Google).
3. **Course Page** — User views full course details: description, instructor, topics, lessons, pricing, and available slots.
4. **Enrollment** — User clicks "Enroll":
   - For **free courses**: User is taken to a confirmation form to verify their name and email, then enrolled immediately (or directed to the pre-course test first if one exists).
   - For **premium courses**: User initiates an M-Pesa STK Push payment. On successful payment, enrollment is automatically activated.
5. **Pre-Course Test** (if enabled) — Before accessing lessons, the user must complete the pre-course exam. Passing it activates the enrollment.
6. **Learning** — User accesses lessons sequentially. Lessons are locked until the previous one (and its post-lesson test, if any) is completed.
7. **Post-Lesson Tests** — After each lesson, if a post-lesson test is configured, the user must complete it before they can mark the lesson complete or proceed.
8. **Mark Complete** — User marks each lesson as complete after reading/watching it and passing any associated test.
9. **Final Exam** — Once all lessons and post-lesson tests are completed, the user can attempt the final exam.
10. **Course Completion** — Completing all lessons (and passing the final exam if enabled) marks the enrollment as `completed`, awards bonus points, and issues a certificate if the course has certification enabled.
11. **Certificate** — User can view and download their certificate. It is also verifiable publicly via a unique certificate number.

---

## Course Structure

Courses follow a three-level hierarchy:

```
Course
 └── Topics (Modules/Sections, ordered)
      └── Lessons (ordered within each topic)
           └── Post-Lesson Exam (optional, per lesson)
```

### Course Types
- **Self-Paced** — No fixed start/end dates. Students learn at their own pace.
- **Cohort-Based** — Has a defined `start_date`, `end_date`, and `duration_weeks`. Designed for group learning with limited `slots`.

### Course Fields
- Title, slug, description, instructor name, cover image (WebP optimised)
- Free/premium toggle with price (KES)
- Active/inactive toggle
- Certification enabled/disabled with custom certificate title
- Slot limit (maximum enrollments)

### Lessons
Each lesson supports multiple content types:
- **Notes** — Rich text content (Quill editor with image upload support)
- **Video** — YouTube/Vimeo embed URL or direct video file upload
- **Code Snippets** — Syntax-highlighted code blocks
- **Resources** — Downloadable resource files (multiple)
- **Attachments** — Downloadable attachment images (multiple)
- **Questions** — Built-in question field per lesson

---

## Enrollment System

### Free Course Enrollment Flow
1. User visits the course page and clicks "Enroll".
2. User is shown a confirmation form to verify their name and email.
3. If a **pre-course test** exists and is enabled, enrollment status is set to `pending_pre_test` and the user is redirected to take the test.
4. Once the pre-course test is submitted, enrollment is automatically set to `active` and the user is notified by email and in-app notification.
5. If no pre-course test exists, enrollment is immediately set to `active`.

### Premium Course Enrollment Flow
1. User clicks "Enroll" on a premium course.
2. User is prompted to enter their M-Pesa phone number.
3. An STK Push is sent to the user's phone.
4. Upon successful payment confirmation (via M-Pesa callback), the user is enrolled with `active` status and awarded points.

### Enrollment Statuses

| Status             | Description                                                    |
|--------------------|----------------------------------------------------------------|
| `pending_pre_test` | Enrollment created; user must complete the pre-course test     |
| `pending`          | Awaiting admin approval (legacy/manual flow)                   |
| `active`           | Full access to course content                                  |
| `suspended`        | Temporarily suspended by admin; access revoked                 |
| `dropped`          | Student dropped from the course by admin                       |
| `rejected`         | Enrollment rejected by admin                                   |
| `completed`        | Student has completed all course requirements                  |

---

## Lesson Access & Sequential Restrictions

The platform enforces **strict sequential lesson access**:

- A student **cannot skip** to a later lesson without completing all prior lessons in order.
- To fully complete a lesson, the student must:
  1. Open and read/watch the lesson content.
  2. **Complete the post-lesson test** (if the lesson has one enabled).
  3. Click "Mark as Complete".
- If a lesson has an enabled post-lesson test and the student has not completed it, the "Mark as Complete" button is blocked and the next lesson is locked.
- The restriction applies across topics: all lessons in earlier topics must be fully completed before the first lesson of the next topic becomes accessible.
- The **final exam** is locked until every single lesson in the course (and every post-lesson test) is completed.

---

## Exam System

The platform supports three exam types:

### 1. Pre-Course Exam
- Administered before the student gains full access to a course.
- Does **not** count toward the final grade.
- On submission, if the enrollment is `pending_pre_test`, it is automatically promoted to `active`.

### 2. Post-Lesson Exam
- Attached to a specific lesson.
- Must be completed before the student can mark the lesson as complete and proceed.
- **Counts toward the final grade.**

### 3. Final Exam
- Unlocked only after the student has completed all lessons and all post-lesson tests.
- Counts toward the final grade.
- On submission, the enrollment is marked as `completed` (if not already).

### Question Types
- **Single Choice** — One correct answer from multiple options.
- **Multiple Choice** — Multiple correct answers required.
- **Text** — Free-text answer (manually reviewed; auto-scored as 0).

### Grading
- Each question has a configurable points value.
- Auto-graded for choice-based questions; text answers are awarded 0 points automatically.
- The final grade percentage is calculated from all attempts that count toward the final grade (post-lesson tests + final exam).
- Grade breakdown is stored: `final_grade_points_earned`, `final_grade_points_possible`, `final_grade_percentage`.

### Attempt Management
- A student can retake exams (previous in-progress attempts are marked as `abandoned` on a new start).
- Time limits can be set per exam (in minutes). If time runs out, the attempt is auto-abandoned.

---

## Gamification & Points

Users earn points for completing activities on the platform:

| Action           | Points |
|------------------|--------|
| Course enroll    | 20     |
| Lesson complete  | 50 (via GamificationService) |
| Course complete  | 200    |
| Forum post       | 10     |
| Forum reply      | 5      |
| Testimonial      | 25     |
| Profile complete | 100    |
| Daily login      | 5      |

Points are recorded in the `gamification_points` table. A user's **level** is determined by their cumulative points:

| Level | Points Required |
|-------|----------------|
| 1     | 0              |
| 2     | 100            |
| 3     | 250            |
| 4     | 500            |
| 5     | 1,000          |
| 6     | 2,000          |
| 7     | 3,500          |
| 8     | 5,000          |
| 9     | 7,500          |
| 10    | 10,000         |

Users can also **spend points** through the Point Redemption system (`/points`).

---

## Badges & Achievements

Badges are automatically awarded when a user meets certain milestones:

| Badge              | Condition                        |
|--------------------|----------------------------------|
| First Steps        | Accumulate 100+ points           |
| Lesson Master      | Complete 10+ lessons             |
| Course Completer   | Complete 1+ courses              |
| Dedicated Learner  | Complete 5+ courses              |
| Point Collector    | Accumulate 500+ points           |
| Expert Learner     | Accumulate 1,000+ points         |

Admins can also manually create, assign, and manage badges from the admin panel.

---

## Certificates

- Courses can have certification enabled with a custom certificate title.
- A certificate is automatically issued when a student completes all course requirements.
- Certificates have a unique certificate number and are publicly verifiable at `/verify-certificate/{number}`.
- Students can view and download their certificates from their profile.
- Admins can manage certificate templates from the admin panel.

---

## Payments (M-Pesa)

Premium course payments are processed via **Safaricom M-Pesa STK Push** (Daraja API):

1. User enters their M-Pesa phone number (format: `2547XXXXXXXX`).
2. An STK Push notification is sent to their phone.
3. The user approves the payment on their phone.
4. M-Pesa sends a callback to `/mpesa/callback`.
5. On a `ResultCode: 0` (success), the payment is marked as complete and the user is automatically enrolled.
6. Enrollment points (20) and premium purchase points (100) are awarded.
7. An email notification is sent to the user.

Payments are tracked in the `payments` table with statuses: `pending`, `completed`, `failed`.

---

## Community — Forum

The community forum at `/forum` allows authenticated users to engage with peers:

- **Threads** — Users can create discussion threads on any topic.
- **Replies** — Users can reply to threads.
- **Points** — Posting a thread earns 10 points; replying earns 5 points.
- Admins can moderate (view, delete) all threads and replies from the admin panel.

---

## Blog / Articles

The platform features a full blog at `/blog`:

- Articles are organized with titles, slugs, featured images, tags, and categories.
- Rich text content (stored as longtext).
- **Likes**, **bookmarks**, and **shares** per article (authenticated users).
- **Comments** — Authenticated users can comment on articles.
- **Status** — Articles can be `draft` or `published`.
- Admins manage articles (create, edit, publish, delete) from the admin panel.

---

## eLibrary

The eLibrary at `/elibrary` is a curated collection of learning resources:

- Resources include titles, descriptions, file links/URLs, and categories.
- Accessible to all public visitors.
- Full CRUD management from the admin panel.

---

## Events

The events section at `/events` lists upcoming and past learning events:

- Event fields: title, slug, description, date/time, location, registration URL, cover image.
- Public-facing event listing and detail pages.
- Admin CRUD for creating, editing, and deleting events.

---

## Job Board

The job board at `/jobs` lists tech-related job opportunities:

- Job listings with title, company, description, type, location, and application details.
- Publicly accessible.
- Full CRUD management in the admin panel.

---

## Projects Showcase

The projects section at `/projects` showcases student and organisational projects:

- Project fields: title, slug, description, image, link.
- Publicly accessible.
- Admin CRUD for managing projects.

---

## Leaderboard

The public leaderboard at `/leaderboard` ranks users by their accumulated gamification points, encouraging healthy competition and motivation.

---

## Notifications

The platform has a built-in in-app notification system:

- Notifications are created for key events: course enrollment, lesson completion, course completion, badge earned, payment success, admin actions (approve, reject, suspend, drop, warn).
- Users access notifications from the top navigation bar with an unread count indicator.
- Notifications can be marked as read individually or all at once.
- All notifications link to a relevant page (course, profile, etc.).

---

## Profile & Transcript

### Profile Page (`/profile`)
- Update name, email, phone number, bio, and profile photo.
- View accumulated points, level, and earned badges.
- View all enrolled courses and their statuses.
- View earned certificates.
- Change password.

### Transcript (`/profile/transcript/{course}`)
- Detailed per-course academic transcript.
- Lists all lessons, completion status, and exam scores.
- Displays the final grade percentage.

### Public Profile (`/user/{user}`)
- Other users can view a public version of any user's profile.

---

## Admin Panel Overview

Accessible at `/admin/dashboard`, the admin panel provides centralised control over the entire platform. It uses a collapsible dark-themed sidebar with the following sections:

| Menu Item     | Description                                      |
|---------------|--------------------------------------------------|
| Dashboard     | Summary stats: courses, users, enrollments, jobs |
| About         | Manage about sections, team members, partners    |
| Articles      | Blog/article CRUD and publishing                 |
| Courses       | Full course and enrollment management            |
| Projects      | Projects showcase CRUD                           |
| Jobs          | Job board CRUD                                   |
| Events        | Events CRUD                                      |
| Forum         | Forum moderation                                 |
| eLibrary      | eLibrary resources CRUD                          |
| Testimonials  | Testimonial moderation and approval              |
| Badges        | Badge creation and manual assignment             |
| Users         | User management and verification                 |
| FAQs          | FAQ CRUD                                         |
| Messages      | Contact message inbox and reply                  |
| Certificates  | Certificate management                           |
| Settings      | Site-wide settings                               |

---

## Course Management (Admin)

### Creating a Course (`/admin/courses/create`)
Admins fill in:
- Title, description, instructor name, cover image (auto-converted to WebP)
- Course type: `self_paced` or `cohort_based`
- Free/premium toggle and price
- Active/inactive toggle
- Duration (weeks), start date, end date (cohort-based)
- Slot limit
- Certification toggle and certificate title

On creation, if the course is active, all users are notified via email and in-app notification.

### Managing Topics (`/admin/courses/{course}/topics`)
- Create, edit, reorder (via order field), and delete topics.
- Each topic acts as a module/section of the course.

### Managing Lessons (`/admin/courses/{course}/topics/{topic}/lessons`)
- Create lessons within a topic with rich content (Quill editor), video, code snippets, resources, and attachments.
- Set lesson order.
- Attach a post-lesson exam directly from the lesson management page.
- Delete individual resource files and attachment images without deleting the whole lesson.

### Managing Exams (`/admin/courses/{course}/exams`)
- Create pre-course, post-lesson, or final exams.
- Enable/disable individual exams.
- Set time limits.
- Toggle whether the exam counts toward the final grade.
- Add questions of type: single choice, multiple choice, or text.
- Set points per question.
- Manage (add, edit, delete) answer options for choice questions.

### Enrollment Management (`/admin/courses/{course}/enrollments`)
Admins have full control over every student enrolled in a course:

| Action       | Description                                              | Email Sent |
|--------------|----------------------------------------------------------|------------|
| Approve      | Activates a pending enrollment                           | Yes        |
| Reject       | Rejects a pending enrollment                             | Yes        |
| Suspend      | Temporarily revokes course access                        | Yes        |
| Drop         | Drops the student from the course                        | Yes        |
| Re-enroll    | Reactivates a suspended or dropped enrollment            | Yes        |
| Warn         | Sends a formal warning to the student                    | Yes        |
| Unenroll     | Permanently removes the student and all progress data    | Yes        |

The enrollments page also shows:
- Student name, email, level, and points
- Enrollment status badge
- Lesson progress bar (completed lessons / total lessons, percentage)
- Enrolled date

---

## Student Management (Admin)

### User List (`/admin/users`)
- View all registered users with their name, email, role, and verification status.
- **Verify** a user (sets `email_verified_at`).
- **Unverify** a user (removes email verification).

### Badges (`/admin/badges`)
- Create new badges with name, description, and icon.
- Manually assign badges to specific users.

### Point Transactions (`/admin/point-transactions`)
- View all point transactions across the platform.
- Manually award points to users.

### Point Rules (`/admin/point-rules`)
- Configure the points awarded for each gamification action.

---

## Content Management (Admin)

### Articles (`/admin/articles`)
- Create, edit, publish, and delete blog articles.
- Rich text editor with image support.
- Set status to `draft` or `published`.
- Manage tags and featured images.

### Jobs (`/admin/jobs`)
- Full CRUD for job listings.

### Projects (`/admin/projects`)
- Full CRUD for project showcases.

### eLibrary Resources (`/admin/elibrary-resources`)
- Full CRUD for eLibrary entries.

### Events (`/admin/events`)
- Full CRUD for events with image upload support.

### Testimonials (`/admin/testimonials`)
- View all user-submitted testimonials.
- **Approve** testimonials to display them publicly.
- **Unpublish** approved testimonials.
- **Delete** testimonials.

### FAQs (`/admin/faqs`)
- Full CRUD for Frequently Asked Questions displayed on the public site.

### Contact Messages (`/admin/contact-messages`)
- View all messages submitted through the contact form.
- Reply to messages directly from the admin panel.
- Delete messages.

### About Page (`/admin/about`)
- Manage about sections (content blocks for the About page).
- Manage team members (name, role, bio, photo, email, social links).
- Manage partners (logo, name, website link).

---

## Site Settings

Accessible at `/admin/settings`, admins can configure global platform settings:

- **Site Name** — Displayed throughout the site and in email templates.
- **Logo** — Upload a custom logo (displayed in the header and emails).
- **Footer Links** — Manage social media and footer navigation links.
- **Other branding** settings as needed.

Settings are stored in the `site_settings` table and injected globally into all views via a view composer.

---

## Email Notification System

The platform sends transactional emails via SMTP for all key events. Templates are built on a shared base layout (`emails.base`) with consistent branding.

### Triggers

| Event                        | Recipient  |
|------------------------------|------------|
| Course enrolled              | Student    |
| Course enrollment approved   | Student    |
| Course enrollment rejected   | Student    |
| Course enrollment suspended  | Student    |
| Student dropped from course  | Student    |
| Enrollment re-activated      | Student    |
| Warning issued               | Student    |
| Permanently unenrolled       | Student    |
| Lesson completed             | Student    |
| Course completed             | Student    |
| Payment successful           | Student    |
| New course published         | All users  |

### Configuration (`.env`)
```dotenv
MAIL_MAILER=smtp
MAIL_HOST=mail.digitalleap.africa
MAIL_PORT=465
MAIL_USERNAME=notification@digitalleap.africa
MAIL_PASSWORD=your-password
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=notification@digitalleap.africa
MAIL_FROM_NAME="Digital Leap Africa"
```

---

## Getting Started

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js & npm
- MySQL (via XAMPP, WAMP, or Laragon)

### Installation

**1. Clone the repository**
```bash
git clone https://github.com/osumba404/digital-leap-africa.git
cd digital-leap-africa
```

**2. Install dependencies**
```bash
composer install
npm install
```

**3. Configure environment**
```bash
cp .env.example .env
php artisan key:generate
```

Update `.env` with your database credentials, mail settings, Google OAuth keys, and M-Pesa API keys.

**4. Run migrations and seeders**
```bash
php artisan migrate:fresh --seed
```

**5. Create storage link**
```bash
php artisan storage:link
```

**6. Compile assets**
```bash
npm run dev
```

**7. Serve the application**
```bash
php artisan serve
```

The application runs at **http://127.0.0.1:8000**.

### Admin Access

1. Register a new user account on the site.
2. In your database tool, find the user in the `users` table.
3. Change the `role` column from `user` to `admin`.
4. Log in — you will now see the **Admin Panel** link in the navigation.

### Google OAuth Setup
```dotenv
GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URI=http://127.0.0.1:8000/auth/google/callback
```

### M-Pesa Setup
```dotenv
MPESA_ENV=sandbox
MPESA_CONSUMER_KEY=your-consumer-key
MPESA_CONSUMER_SECRET=your-consumer-secret
MPESA_SHORTCODE=your-shortcode
MPESA_PASSKEY=your-passkey
MPESA_CALLBACK_URL=https://yourdomain.com/mpesa/callback
```
