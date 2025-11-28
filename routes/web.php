<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\EditorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ShippingAddressController;
use App\Http\Controllers\Admin\ReferralController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\TemplateController as AdminTemplateController;
use App\Http\Controllers\Admin\TemplateCategoryController;
use App\Http\Controllers\Admin\TemplateTagController;
use App\Http\Controllers\Admin\UserDesignController;
use App\Http\Controllers\Admin\UserCustomizationController;
use App\Http\Controllers\Admin\DesignElementController;
use App\Http\Controllers\Admin\FontController;
use App\Http\Controllers\Admin\SubscriptionController;
use App\Http\Controllers\Admin\PaymentController;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Admin\SharedInvitationController;
use App\Http\Controllers\Admin\RsvpResponseController;
use App\Http\Controllers\Admin\RsvpSettingController;
use App\Http\Controllers\Admin\PrintOrderController;
use App\Http\Controllers\Admin\UserProfileController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Static pages routes
Route::get('/about', function () {
    return view('static.about');
})->name('about');

Route::get('/contact', function () {
    return view('static.contact');
})->name('contact');

Route::get('/privacy-policy', function () {
    return view('static.privacy-policy');
})->name('privacy-policy');

Route::get('/terms-of-service', function () {
    return view('static.terms-of-service');
})->name('terms-of-service');

Route::get('/return-refund-policy', function () {
    return view('static.return-refund-policy');
})->name('return-refund-policy');

// New routes for missing pages
Route::get('/services', function () {
    return view('static.services');
})->name('services');

Route::get('/pricing', function () {
    return view('static.pricing');
})->name('pricing');

Route::get('/wedding-invitations', function () {
    return view('static.wedding-invitations');
})->name('wedding-invitations');

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Admin Authentication routes
Route::get('/admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminLoginController::class, 'login']);

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    // Added admin profile route
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::resource('users', UserController::class);
        Route::get('/users/export', [UserController::class, 'export'])->name('users.export');
    Route::resource('templates', AdminTemplateController::class);
    Route::resource('categories', TemplateCategoryController::class);
    Route::resource('tags', TemplateTagController::class);
    Route::resource('designs', UserDesignController::class);
    Route::resource('customizations', UserCustomizationController::class);
    Route::resource('elements', DesignElementController::class);
    Route::resource('fonts', FontController::class);
    Route::resource('subscriptions', SubscriptionController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('downloads', DownloadController::class);
    Route::resource('shared-invitations', SharedInvitationController::class);
    Route::resource('rsvp-responses', RsvpResponseController::class);
    Route::resource('rsvp-settings', RsvpSettingController::class);
    Route::resource('print-orders', PrintOrderController::class);
    Route::resource('user-profiles', UserProfileController::class);
    Route::resource('coupons', CouponController::class);
    Route::resource('shipping-addresses', ShippingAddressController::class);
    Route::resource('referrals', ReferralController::class);
});

Route::resource('templates', TemplateController::class);
Route::get('/editor/{template}', [EditorController::class, 'show'])->name('editor.show');