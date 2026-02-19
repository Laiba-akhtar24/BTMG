<?php

use Illuminate\Support\Facades\Route;

// ================= CONTROLLERS =================
use App\Http\Controllers\CourseController; // Backend
use App\Http\Controllers\Frontend\CourseController as FrontendCourseController; // Frontend
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\LaunchDateController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\SubscribeController;
use App\Http\Controllers\Admin\ContactLeadController;
use App\Http\Controllers\Admin\CourseInquiryController;
use App\Http\Controllers\Frontend\CourseInquiryController as FrontendCourseInquiryController;
use App\Http\Controllers\Admin\CourseEnrollmentController;




// ================= FRONTEND PAGES =================
Route::get('/', function () { return view('home'); })->name('home');
Route::get('/about', function () { return view('about'); })->name('about');
Route::get('/why-us', function () { return view('why-us'); })->name('why-us');
Route::get('/testimonials', function () { return view('testimonials'); })->name('testimonials');

// Contact page
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact/send', [ContactController::class, 'send'])->name('contact.send');
// ================= FRONTEND COURSES =================
// Courses list
Route::get('/courses', [FrontendCourseController::class, 'index'])
    ->name('frontend.courses');

// Single course details
Route::get('/courses/{id}', [FrontendCourseController::class, 'show'])
    ->name('frontend.course.details');

// ================= ADMIN AUTH =================
Route::get('/admin/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');

// ================= PROTECTED ADMIN ROUTES =================
Route::prefix('admin')->name('admin.')->middleware(['admin.auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', function () { return view('admin.dashboard'); })->name('dashboard');

    // Logout
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // ================= COURSES CRUD =================
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
    Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::put('/courses/{id}', [CourseController::class, 'update'])->name('courses.update');
    Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');

    // Admin - Course Topics
    Route::get('/courses/{courseId}/topics', [TopicController::class, 'showTopics'])->name('courses.topics');
    Route::post('/topics/store', [TopicController::class, 'store'])->name('topics.store');
    Route::get('/topics/{id}/edit', [TopicController::class, 'edit'])->name('topics.edit');
    Route::put('/topics/{id}', [TopicController::class, 'update'])->name('topics.update');
    Route::delete('/topics/{id}', [TopicController::class, 'destroy'])->name('topics.destroy');

    // Launch Dates
Route::get('/launch-dates', [LaunchDateController::class, 'index'])->name('launch-dates.index');
Route::get('/launch-dates/create', [LaunchDateController::class, 'create'])->name('launch-dates.create'); // <-- added
Route::post('/launch-dates', [LaunchDateController::class, 'store'])->name('launch-dates.store');
Route::get('/launch-dates/{id}/edit', [LaunchDateController::class, 'edit'])->name('launch-dates.edit');
Route::put('/launch-dates/{id}', [LaunchDateController::class, 'update'])->name('launch-dates.update');
Route::delete('/launch-dates/{id}', [LaunchDateController::class, 'destroy'])->name('launch-dates.destroy');
// Categories page
Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])
    ->name('categories.index');
Route::get('/categories/create', [\App\Http\Controllers\CategoryController::class, 'create'])
    ->name('categories.create');
Route::post('/categories', [\App\Http\Controllers\CategoryController::class, 'store'])
    ->name('categories.store');
Route::get('/categories/{id}/edit', [\App\Http\Controllers\CategoryController::class, 'edit'])
    ->name('categories.edit');
Route::put('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'update'])
    ->name('categories.update');
Route::delete('/categories/{id}', [\App\Http\Controllers\CategoryController::class, 'destroy'])
    ->name('categories.destroy');
Route::get('/categories/sync-from-courses', [\App\Http\Controllers\CategoryController::class, 'syncFromCourses'])
    ->name('categories.sync');


// Categories CRUD
 Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
    Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    Route::get('/subscribers', function () {
    return view('admin.subscribers.index');
})->name('subscribers.index');
    Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribers.store');
    Route::get('/subscribers', [SubscriberController::class, 'index'])->name('subscribers.index');
     Route::get('/admin/subscribers', [SubscriberController::class, 'index'])->name('admin.subscribers.index');
     Route::post('/subscribers/message', [SubscriberController::class, 'sendMessage'])->name('subscribers.message');
   Route::post('/admin/subscribers/message', [SubscriberController::class, 'sendMessage'])->name('admin.subscribers.message');
    Route::post('/subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe.store');
//    contact lead Routes//


Route::get('/contact-us', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact-submit', [ContactController::class, 'store'])->name('contact.store');

 Route::get('/contact-leads', [ContactLeadController::class, 'index'])
        ->name('contact-leads.index');

    });

// ================= OPTIONAL TEST/ALIAS ROUTES =================
// This is just for testing or direct view, no duplicate admin/frontend conflicts
Route::get('/course-details/{id}', function ($id) {
    return view('course-details', compact('id'));
})->name('course.details');

Route::post('/subscribe', [SubscriberController::class, 'subscribe'])->name('subscribe.store');
// Show contact form
Route::get('/contact', [ContactController::class, 'index'])->name('contact.show');

// Handle form submission
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::post('/contact/reply', [ContactController::class, 'sendReply'])->name('contact.reply');
// web.php
Route::post('/admin/contact/reply/{id}', [ContactController::class, 'reply'])->name('admin.contact.reply');
Route::post('/admin/contact/viewed/{id}', [\App\Http\Controllers\ContactController::class, 'markViewed'])
    ->name('admin.contact.viewed');
Route::get('/admin/courses', [CourseController::class, 'index'])->name('admin.courses.index');





Route::get('/courses/{id}', [CourseController::class, 'show'])->name('frontend.course.details');;




Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('course-inquiries', [App\Http\Controllers\Admin\CourseInquiryController::class, 'index'])->name('course-inquiries.index');
    Route::get('course-inquiries/view/{id}', [App\Http\Controllers\Admin\CourseInquiryController::class, 'markViewed'])->name('course-inquiries.view');
   
    
Route::post('/course-inquiry/store', [CourseInquiryController::class, 'store'])
    ->name('course-inquiry.store');
});
Route::get('/admin/course-inquiries/view/{id}', [CourseInquiryController::class, 'view'])
    ->name('admin.course-inquiries.view');


Route::post('admin/course-inquiry/store', [CourseInquiryController::class, 'store'])
    ->name('admin.course-inquiry.store');
 

    Route::get('/admin/course-inquiries/view/{id}', 
    [CourseInquiryController::class, 'view']
)->name('admin.course-inquiries.view');

Route::post('/admin/course-inquiries/mark-viewed/{id}', 
    [CourseInquiryController::class, 'markViewed']
)->name('admin.course-inquiries.markViewed');
Route::post('/admin/course-inquiries/reply/{id}', [App\Http\Controllers\CourseInquiryController::class, 'sendReply'])
    ->name('admin.course-inquiries.reply');


// Admin Course Enrollments
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('course-enrollments', [App\Http\Controllers\Admin\CourseEnrollmentController::class, 'index'])
        ->name('course-enrollments.index');

    Route::post('course-enrollments', [App\Http\Controllers\Admin\CourseEnrollmentController::class, 'store'])
        ->name('course-enrollments.store');


    Route::delete('course-enrollments/{id}', [App\Http\Controllers\Admin\CourseEnrollmentController::class, 'destroy'])
        ->name('course-enrollments.destroy');
    
});
Route::post('course-enrollments', [CourseEnrollmentController::class, 'store'])
    ->name('frontend.course.register'); // <- ye same route name tumhare form 
    
Route::post('/admin/course-inquiries/reply/{id}',
    [CourseInquiryController::class, 'sendReply']
)->name('admin.course-inquiries.reply');
Route::delete('/admin/course-inquiries/{id}', [CourseInquiryController::class, 'destroy'])
    ->name('admin.course-inquiries.delete');
Route::post('/admin/course-enrollments/mark-viewed/{id}', [CourseEnrollmentController::class, 'markViewed'])->name('admin.course-enrollments.mark-viewed');
Route::post('/admin/course-enrollments/approve/{id}', [CourseEnrollmentController::class, 'approve'])->name('admin.course-enrollments.approve');
Route::post('/admin/course-enrollments/reject/{id}', [CourseEnrollmentController::class, 'reject'])->name('admin.course-enrollments.reject');
Route::post('/admin/course-enrollments/reply/{id}', [CourseEnrollmentController::class, 'reply'])->name('admin.course-enrollments.reply');
Route::post('/admin/course-enrollments/{id}/status',
    [App\Http\Controllers\Admin\CourseEnrollmentController::class, 'updateStatus']
)->name('admin.course-enrollments.updateStatus');
Route::post('/admin/course-enrollments/{id}/reply',
    [App\Http\Controllers\Admin\CourseEnrollmentController::class, 'sendReply']
)->name('admin.course-enrollments.sendReply');
