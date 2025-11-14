<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\{
    ProfileController,
    PageController,
    CourseController,
    ProjectController,
    ELibraryController,
    JobController,
    EventController,
    ForumController,
    LessonController,
    ArticlesController,
    PartnerPublicController,
    TestimonialPublicController,
    NotificationController,
    PaymentController,
    PointRedemptionController
};

use App\Http\Controllers\Admin\{
    JobController as AdminJobController,
    CourseController as AdminCourseController,
    ProjectController as AdminProjectController,
    ELibraryResourceController as AdminELibraryResourceController,
    SiteSettingController as AdminSiteSettingController,
    AdminTopicController,
    LessonController as AdminLessonController,
    EventController as AdminEventController,
    ForumController as AdminForumController,
    ArticleController as AdminArticleController,
    DashboardController as AdminDashboardController,
    AboutController as AdminAboutController,
    AssignmentController as AdminAssignmentController,
    TestimonialController as AdminTestimonialController,
    FaqController as AdminFaqController,
    EmailTemplateController,
    EmailLogController,
    PointTransactionController,
    CertificateTemplateController,
    PointRuleController
   
};

// Google OAuth Routes
Route::get('/auth/google', [\App\Http\Controllers\Auth\GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [\App\Http\Controllers\Auth\GoogleAuthController::class, 'handleGoogleCallback']);

// Authentication Routes
require __DIR__.'/auth.php';

// Custom Password Reset (remove these and use Laravel's built-in)
// Route::post('/forgot-password', [\App\Http\Controllers\Auth\PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
// Route::get('/reset-password/{token}', [\App\Http\Controllers\Auth\PasswordResetController::class, 'showResetPasswordForm'])->name('password.reset');
// Route::post('/reset-password', [\App\Http\Controllers\Auth\PasswordResetController::class, 'resetPassword'])->name('password.update');


// Payment routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/courses/{course}/pay', [PaymentController::class, 'initiate'])->name('courses.pay');
    Route::get('/payment/{payment}/status', [PaymentController::class, 'checkStatus'])->name('payment.status');
    Route::get('/payment/{payment}/poll', [PaymentController::class, 'pollStatus'])->name('payment.poll');
});

// M-Pesa callback (no auth required)
Route::post('/mpesa/callback', [PaymentController::class, 'callback'])->name('mpesa.callback');

// Test callback URL accessibility (remove in production)
Route::get('/mpesa/callback', function() {
    return response()->json([
        'status' => 'success',
        'message' => 'M-Pesa callback URL is accessible',
        'timestamp' => now()->toISOString(),
        'url' => request()->fullUrl()
    ]);
});

// Test M-Pesa callback route (remove in production)
Route::get('/test-mpesa-callback', function() {
    // Simulate a successful M-Pesa callback
    $testData = [
        'Body' => [
            'stkCallback' => [
                'MerchantRequestID' => 'test-merchant-123',
                'CheckoutRequestID' => 'test-checkout-456',
                'ResultCode' => 0,
                'ResultDesc' => 'The service request is processed successfully.',
                'CallbackMetadata' => [
                    'Item' => [
                        [
                            'Name' => 'Amount',
                            'Value' => 2500
                        ],
                        [
                            'Name' => 'MpesaReceiptNumber',
                            'Value' => 'TEST123456789'
                        ],
                        [
                            'Name' => 'TransactionDate',
                            'Value' => 20241102103000
                        ],
                        [
                            'Name' => 'PhoneNumber',
                            'Value' => 254712345678
                        ]
                    ]
                ]
            ]
        ]
    ];
    
    // Find a pending payment to test with
    $payment = \App\Models\Payment::where('status', 'pending')->first();
    if (!$payment) {
        return 'No pending payments found to test with';
    }
    
    // Update the test data with the actual payment's checkout request ID
    $testData['Body']['stkCallback']['CheckoutRequestID'] = $payment->checkout_request_id;
    
    // Create a request with the test data
    $request = new \Illuminate\Http\Request();
    $request->merge($testData);
    
    // Call the callback method
    $controller = new \App\Http\Controllers\PaymentController();
    $response = $controller->callback($request);
    
    return 'Test callback executed. Response: ' . $response->getContent();
})->name('test.mpesa.callback');

// Test payment success email route (remove in production)
Route::get('/test-payment-email', function() {
    if (!auth()->check()) {
        return 'Please login first';
    }
    
    $payment = \App\Models\Payment::with('course')->first();
    if (!$payment) {
        return 'No payments found to test with';
    }
    
    try {
        \App\Services\EmailNotificationService::sendNotification('payment_success', auth()->user(), [
            'payment' => $payment,
            'course' => $payment->course
        ]);
        return 'Payment success email sent successfully to ' . auth()->user()->email;
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
})->middleware('auth')->name('test.payment.email');

// Test email notification route (remove in production)
Route::get('/test-email', function() {
    if (!auth()->check()) {
        return 'Please login first';
    }
    
    try {
        \App\Services\EmailNotificationService::sendNotification('generic', auth()->user(), [
            'title' => 'Test Email Notification',
            'message' => 'This is a test email to verify that the email notification system is working correctly.',
            'url' => route('dashboard')
        ]);
        return 'Test email sent successfully to ' . auth()->user()->email;
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
})->middleware('auth')->name('test.email');

// Test password reset email route (remove in production)
Route::get('/test-password-reset', function() {
    if (!auth()->check()) {
        return 'Please login first';
    }
    
    try {
        $token = \Illuminate\Support\Str::random(64);
        \App\Services\EmailNotificationService::sendNotification('password_reset', auth()->user(), ['resetUrl' => url('/reset-password/' . $token)]);
        return 'Password reset email sent successfully to ' . auth()->user()->email;
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
})->middleware('auth')->name('test.password-reset');

// Email template preview routes (remove in production)
Route::get('/email-preview', function() {
    return view('emails.preview');
})->name('email.preview');

Route::get('/email-template/{template}', function($template) {
    $user = auth()->user() ?? new \App\Models\User([
        'name' => 'John Doe',
        'email' => 'john@example.com'
    ]);
    
    $course = new \App\Models\Course([
        'title' => 'Advanced Laravel Development',
        'description' => 'Master Laravel framework with advanced concepts',
        'price' => 2500,
        'level' => 'intermediate',
        'duration' => '8 weeks'
    ]);
    
    $lesson = new \App\Models\Lesson([
        'title' => 'Building RESTful APIs',
        'content' => 'Learn to build robust APIs'
    ]);
    
    $payment = new \App\Models\Payment([
        'transaction_id' => 'TXN123456789',
        'amount' => 2500,
        'created_at' => now()
    ]);
    
    $data = [
        'user' => $user,
        'course' => $course,
        'lesson' => $lesson,
        'payment' => $payment,
        'resetUrl' => url('/reset-password/sample-token'),
        'subject' => 'Sample Email Template'
    ];
    
    try {
        return view('emails.' . $template, $data);
    } catch (\Exception $e) {
        return 'Template not found: ' . $template;
    }
})->name('email.template');

// --- PUBLIC ROUTES ---

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

// Partners (public apply)
Route::get('/partners/apply', [PartnerPublicController::class, 'apply'])->name('partners.apply');
Route::post('/partners/apply', [PartnerPublicController::class, 'store'])->name('partners.store');

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
// Fallback route for old ID-based URLs - redirects to slug-based URL
Route::get('/courses/{id}', function($id) {
    $course = \App\Models\Course::findOrFail($id);
    return redirect()->route('courses.show', $course->slug, 301);
})->where('id', '[0-9]+');
Route::get('/courses/{course:slug}', [CourseController::class, 'show'])->name('courses.show');
Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');
Route::get('/projects/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/elibrary', [ELibraryController::class, 'index'])->name('elibrary.index');
Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
// Fallback route for old ID-based URLs - redirects to slug-based URL
Route::get('/events/{id}', function($id) {
    $event = \App\Models\Event::findOrFail($id);
    return redirect()->route('events.show', $event->slug, 301);
})->where('id', '[0-9]+');
Route::get('/events/{event:slug}', [EventController::class, 'show'])->name('events.show');
Route::get('/forum', [ForumController::class, 'index'])->name('forum.index');
Route::get('/forum/create', [ForumController::class, 'create'])->middleware(['auth', 'verified'])->name('forum.create');
Route::post('/forum', [ForumController::class, 'store'])->middleware(['auth', 'verified'])->name('forum.store');
Route::get('/forum/{id}', [ForumController::class, 'show'])->name('forum.show');
Route::post('/forum/{thread}/reply', [ForumController::class, 'storeReply'])->middleware(['auth', 'verified'])->name('forum.reply');
Route::get('/blog', [ArticlesController::class, 'index'])->name('blog.index');
Route::get('/blog/{article:slug}', [ArticlesController::class, 'show'])->name('blog.show');
Route::get('/leaderboard', [\App\Http\Controllers\LeaderboardController::class, 'index'])->name('leaderboard');
Route::post('/blog/{article:slug}/comments', [ArticlesController::class, 'storeComment'])->middleware(['auth', 'verified'])->name('blog.comments.store');
Route::post('/blog/{article}/like', [ArticlesController::class, 'like'])->middleware(['auth', 'verified'])->name('blog.like');
Route::post('/blog/{article}/bookmark', [ArticlesController::class, 'bookmark'])->middleware(['auth', 'verified'])->name('blog.bookmark');
Route::post('/blog/{article}/share', [ArticlesController::class, 'share'])->name('blog.share');
Route::get('/contact', [\App\Http\Controllers\ContactController::class, 'index'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
Route::view('/donate', 'donate')->name('donate');
Route::view('/privacy-policy', 'legal.privacy')->name('privacy.policy');
Route::view('/terms-of-service', 'legal.terms')->name('terms.service');
Route::post('/newsletter/subscribe', [\App\Http\Controllers\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');


// View a lesson
Route::get('/lessons/{lesson}', [LessonController::class, 'show'])
    ->middleware('auth') // optional but recommended, since show() accesses Auth::user()
    ->name('lessons.show');

// Mark a lesson as complete
Route::post('/lessons/{lesson}/complete', [LessonController::class, 'complete'])
    ->middleware('auth')
    ->name('lessons.complete');


// --- DASHBOARD ROUTE (AUTHENTICATED) ---
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



// Testimonials (public view)
Route::get('/testimonials', [TestimonialPublicController::class, 'index'])->name('testimonials.index');

// --- AUTHENTICATED USER ROUTES ---
Route::middleware(['auth', 'verified'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Course Enrollment
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');
    Route::post('/lessons/{lesson}/complete', [LessonController::class, 'complete'])->name('lessons.complete');

    // Certificates
    Route::get('/certificates/{certificate}', [\App\Http\Controllers\CertificateController::class, 'show'])->name('certificates.show');
    Route::get('/certificates/{certificate}/download', [\App\Http\Controllers\CertificateController::class, 'download'])->name('certificates.download');

    // Testimonials (user)
    Route::get('/testimonials/create', [TestimonialPublicController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials', [TestimonialPublicController::class, 'store'])->name('testimonials.store');
    Route::get('/profile/testimonials', [TestimonialPublicController::class, 'myTestimonials'])->name('profile.testimonials');
    
    // Point Redemption
    Route::get('/points', [PointRedemptionController::class, 'index'])->name('points.index');
    Route::post('/points/redeem', [PointRedemptionController::class, 'redeem'])->name('points.redeem');
});

// Certificate verification (public)
Route::get('/verify-certificate/{certificateNumber}', [\App\Http\Controllers\CertificateController::class, 'verify'])->name('certificates.verify');

Route::get('/me/photo', function () {
    // Check if a specific user_id is requested (for testimonials, etc.)
    $userId = request()->query('user_id');
    
    if ($userId) {
        // Fetch the specified user's photo
        $user = \App\Models\User::find($userId);
        if (!$user) {
            // Return transparent pixel if user not found
            $transparentPixel = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==');
            return response($transparentPixel, 200)->header('Content-Type', 'image/png');
        }
    } else {
        // Default to authenticated user
        $user = auth()->user();
        if (!$user) {
            abort(401);
        }
    }

    // Use the model accessor to get the correct URL
    if ($user->profile_photo_url) {
        // If it's already a full URL, redirect to it
        if (preg_match('/^https?:\/\//i', $user->profile_photo_url)) {
            return redirect($user->profile_photo_url);
        }
        
        // If it's a local path, serve the file directly
        $filePath = public_path(ltrim($user->profile_photo_url, '/'));
        if (file_exists($filePath)) {
            return response()->file($filePath);
        }
    }

    // Fallback to default avatar or transparent pixel
    $fallback = public_path('images/default-avatar.svg');
    if (is_file($fallback)) {
        return response()->file($fallback, 200, ['Content-Type' => 'image/svg+xml']);
    }
    
    // Return a transparent 1x1 pixel PNG to avoid 404 errors
    $transparentPixel = base64_decode('iVBORw0KGgoAAAANSUhEUgAAAAEAAAABCAYAAAAfFcSJAAAADUlEQVR42mNk+M9QDwADhgGAWjR9awAAAABJRU5ErkJggg==');
    return response($transparentPixel, 200)->header('Content-Type', 'image/png');
})->name('me.photo');



// Notification routes
Route::middleware('auth')->group(function () {
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])->name('notifications.mark-all-read');
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unread-count');
});


// --- ADMIN ROUTES ---
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'role:admin'])
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Content Management
        Route::prefix('content')->group(function () {
            Route::get('/', [AdminDashboardController::class, 'content'])->name('content.index');
        });

        // Articles
            Route::resource('articles', AdminArticleController::class)->names([
                'index' => 'articles.index',
                'create' => 'articles.create',
                'store' => 'articles.store',
                'show' => 'articles.show',
                'edit' => 'articles.edit',
                'update' => 'articles.update',
                'destroy' => 'articles.destroy'
            ]);

        // About Page Management
        Route::prefix('about')->name('about.')->group(function () {
            // Main about page
            Route::get('/', [AdminAboutController::class, 'index'])->name('index');
            
            // About Sections
            Route::prefix('sections')->name('sections.')->group(function () {
                Route::get('/', [AdminAboutController::class, 'index'])->name('index');
                Route::get('/create', [AdminAboutController::class, 'createSection'])->name('create');
                Route::post('/', [AdminAboutController::class, 'storeSection'])->name('store');
                Route::get('/{section}/edit', [AdminAboutController::class, 'editSection'])->name('edit');
                Route::put('/{section}', [AdminAboutController::class, 'updateSection'])->name('update');
                Route::delete('/{section}', [AdminAboutController::class, 'destroySection'])->name('destroy');
            });

            // Team Members
            Route::prefix('team')->name('team.')->group(function () {
                Route::get('/', [AdminAboutController::class, 'index'])->name('index');
                Route::get('/create', [AdminAboutController::class, 'createTeamMember'])->name('create');
                Route::post('/', [AdminAboutController::class, 'storeTeamMember'])->name('store');
                Route::get('/{teamMember}/edit', [AdminAboutController::class, 'editTeamMember'])->name('edit');
                Route::put('/{teamMember}', [AdminAboutController::class, 'updateTeamMember'])->name('update');
                Route::delete('/{teamMember}', [AdminAboutController::class, 'destroyTeamMember'])->name('destroy');
            });

            // Partners
            Route::prefix('partners')->name('partners.')->group(function () {
                Route::get('/', [AdminAboutController::class, 'index'])->name('index');
                Route::get('/create', [AdminAboutController::class, 'createPartner'])->name('create');
                Route::post('/', [AdminAboutController::class, 'storePartner'])->name('store');
                Route::get('/{partner}/edit', [AdminAboutController::class, 'editPartner'])->name('edit');
                Route::put('/{partner}', [AdminAboutController::class, 'updatePartner'])->name('update');
                Route::delete('/{partner}', [AdminAboutController::class, 'destroyPartner'])->name('destroy');
            });
        });

        // Resource Routes
        Route::resource('jobs', AdminJobController::class)->except(['show']);
        Route::resource('courses', AdminCourseController::class)->except(['show']);
        Route::get('/courses/{course}/enrollments', [AdminCourseController::class, 'enrollments'])->name('courses.enrollments');
        Route::patch('/enrollments/{enrollment}/approve', [AdminCourseController::class, 'approveEnrollment'])->name('courses.enrollments.approve');
        Route::patch('/enrollments/{enrollment}/reject', [AdminCourseController::class, 'rejectEnrollment'])->name('courses.enrollments.reject');

        Route::resource('projects', AdminProjectController::class)->except(['show']);
        Route::resource('elibrary-resources', AdminELibraryResourceController::class);
        Route::resource('events', AdminEventController::class)->except(['show']);
        Route::resource('forum', AdminForumController::class)->only(['index', 'show', 'destroy']);
        Route::delete('forum/replies/{reply}', [AdminForumController::class, 'destroyReply'])->name('forum.replies.destroy');
        //Route::resource('articles', AdminArticleController::class)->except(['show']);

         // Courses
        Route::resource('courses', AdminCourseController::class)->except(['show']);


        Route::get('/courses/{course}/manage', [AdminCourseController::class, 'manage'])->name('courses.manage');
        Route::get('courses/{course}/lessons', function(\App\Models\Course $course) {
            $topic = $course->topics()->orderBy('created_at')->first();
            if (!$topic) {
                return redirect()
                    ->route('admin.courses.topics.index', $course)
                    ->with('error', 'Create a topic first to manage lessons.');
            }
            // Render the existing view that expects $topic
            return view('admin.courses.lessons.index', compact('topic'));
        })->name('courses.lessons.index');

        Route::prefix('courses/{course}')->group(function () {
            Route::resource('assignments', AdminAssignmentController::class)
                ->names([
                    'index' => 'courses.assignments.index',
                    'create' => 'courses.assignments.create',
                    'store' => 'courses.assignments.store',
                    'edit' => 'courses.assignments.edit',
                    'update' => 'courses.assignments.update',
                    'destroy' => 'courses.assignments.destroy',
                ])->except(['show']);
        }); 



        Route::get('courses/{course}/topics/create', [AdminTopicController::class, 'create'])->name('courses.topics.create');

                // Nested Topics under Courses
        Route::prefix('courses/{course}')->group(function () {
            Route::resource('topics', AdminTopicController::class)
                ->names([
                    'index' => 'courses.topics.index',
                    'create' => 'courses.topics.create',
                    'store' => 'courses.topics.store',
                    'edit' => 'courses.topics.edit',
                    'update' => 'courses.topics.update',
                    'destroy' => 'courses.topics.destroy'
                ]);

                    Route::get('topics/{topic}/lessons', [AdminLessonController::class, 'index'])
                    ->name('topics.lessons.index');
                    // Delete a single resource file by index
                    Route::delete('topics/{topic}/lessons/{lesson}/resources/{index}', [AdminLessonController::class, 'destroyResource'])
                        ->name('topics.lessons.resources.destroy');
                    // Delete a single attachment image by index
                    Route::delete('topics/{topic}/lessons/{lesson}/attachments/{index}', [AdminLessonController::class, 'destroyAttachment'])
                        ->name('topics.lessons.attachments.destroy');
                
        });

            Route::resource('topics.lessons', AdminLessonController::class)->except(['index', 'show']);
            
            // Upload image from Quill editor (outside course prefix)
            Route::post('lessons/upload-image', [AdminLessonController::class, 'uploadImage'])
                ->name('lessons.upload-image');

        // Testimonials moderation
        Route::resource('testimonials', AdminTestimonialController::class)->only(['index','destroy','update'])->names([
            'index' => 'testimonials.index',
            'update' => 'testimonials.update',
            'destroy' => 'testimonials.destroy',
        ]);
        Route::patch('testimonials/{testimonial}/approve', [AdminTestimonialController::class, 'approve'])->name('testimonials.approve');
        Route::patch('testimonials/{testimonial}/unpublish', [AdminTestimonialController::class, 'unpublish'])->name('testimonials.unpublish');

        // FAQs CRUD
        Route::resource('faqs', AdminFaqController::class)->names([
            'index' => 'faqs.index',
            'create' => 'faqs.create',
            'store' => 'faqs.store',
            'edit' => 'faqs.edit',
            'update' => 'faqs.update',
            'destroy' => 'faqs.destroy',
        ]);

        // Badges Management
        Route::resource('badges', \App\Http\Controllers\Admin\BadgeController::class)->names([
            'index' => 'badges.index',
            'create' => 'badges.create',
            'store' => 'badges.store',
            'edit' => 'badges.edit',
            'update' => 'badges.update',
            'destroy' => 'badges.destroy',
        ]);
        Route::get('badges/{badge}/assign', [\App\Http\Controllers\Admin\BadgeController::class, 'assign'])->name('badges.assign');
        Route::post('badges/{badge}/assign', [\App\Http\Controllers\Admin\BadgeController::class, 'storeAssignment'])->name('badges.storeAssignment');

        // User Management
        Route::get('users', [\App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
        Route::patch('users/{user}/verify', [\App\Http\Controllers\Admin\UserController::class, 'verify'])->name('users.verify');
        Route::patch('users/{user}/unverify', [\App\Http\Controllers\Admin\UserController::class, 'unverify'])->name('users.unverify');

             // Certificates
        Route::prefix('certificates')->name('certificates.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\CertificateController::class, 'index'])->name('index');
            Route::put('/', [\App\Http\Controllers\Admin\CertificateController::class, 'update'])->name('update');
        });

        // Contact Messages
        Route::resource('contact-messages', \App\Http\Controllers\Admin\ContactMessageController::class)->only(['index', 'show', 'destroy'])->names([
            'index' => 'contact-messages.index',
            'show' => 'contact-messages.show',
            'destroy' => 'contact-messages.destroy',
        ]);
        Route::post('contact-messages/{contactMessage}/reply', [\App\Http\Controllers\Admin\ContactMessageController::class, 'reply'])->name('contact-messages.reply');

        // Email Management
        Route::resource('email-templates', EmailTemplateController::class)->names([
            'index' => 'email-templates.index',
            'create' => 'email-templates.create',
            'store' => 'email-templates.store',
            'show' => 'email-templates.show',
            'edit' => 'email-templates.edit',
            'update' => 'email-templates.update',
            'destroy' => 'email-templates.destroy'
        ]);
        
        Route::resource('email-logs', EmailLogController::class)->only(['index', 'show'])->names([
            'index' => 'email-logs.index',
            'show' => 'email-logs.show'
        ]);
        
        // Points Management
        Route::resource('point-transactions', PointTransactionController::class)->only(['index', 'create', 'store', 'show'])->names([
            'index' => 'point-transactions.index',
            'create' => 'point-transactions.create',
            'store' => 'point-transactions.store',
            'show' => 'point-transactions.show'
        ]);
        
        // Certificate Templates
        Route::resource('certificate-templates', CertificateTemplateController::class)->names([
            'index' => 'certificate-templates.index',
            'create' => 'certificate-templates.create',
            'store' => 'certificate-templates.store',
            'show' => 'certificate-templates.show',
            'edit' => 'certificate-templates.edit',
            'update' => 'certificate-templates.update',
            'destroy' => 'certificate-templates.destroy'
        ]);
        
        // Point Rules
        Route::resource('point-rules', PointRuleController::class)->names([
            'index' => 'point-rules.index',
            'create' => 'point-rules.create',
            'store' => 'point-rules.store',
            'edit' => 'point-rules.edit',
            'update' => 'point-rules.update',
            'destroy' => 'point-rules.destroy'
        ]);

        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [AdminSiteSettingController::class, 'index'])->name('index');
            Route::post('/', [AdminSiteSettingController::class, 'update'])->name('update');
        });
        });



        

// Fallback route - must be at the end
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});