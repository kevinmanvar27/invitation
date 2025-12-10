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
use App\Http\Controllers\ProfileController;
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

// User profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    // Admin Profile Routes
    Route::get('/profile', [AdminProfileController::class, 'index'])->name('profile');
    Route::get('/profile/edit', [AdminProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [AdminProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/password', [AdminProfileController::class, 'showPasswordForm'])->name('profile.password');
    Route::put('/profile/password', [AdminProfileController::class, 'updatePassword'])->name('profile.password.update');
    
    // Settings Route (placeholder - redirects to profile for now)
    Route::get('/settings', function () {
        return redirect()->route('admin.profile');
    })->name('settings');
    
    // User Management
    Route::resource('users', UserController::class);
    Route::get('/users-export', [UserController::class, 'export'])->name('users.export');
    
    // Template Management
    Route::resource('templates', AdminTemplateController::class);
    Route::resource('categories', TemplateCategoryController::class);
    Route::resource('tags', TemplateTagController::class);
    
    // Design Management
    Route::resource('designs', UserDesignController::class);
    Route::get('/designs-export', [UserDesignController::class, 'export'])->name('designs.export');
    Route::resource('customizations', UserCustomizationController::class);
    
    // Design Elements - support both 'elements' and 'design-elements' route names
    Route::resource('elements', DesignElementController::class);
    Route::resource('design-elements', DesignElementController::class);
    
    Route::resource('fonts', FontController::class);
    
    // User-specific views (read-only)
    Route::resource('user-customizations', UserCustomizationController::class)->only(['index', 'show']);
    Route::resource('user-designs', UserDesignController::class)->only(['index', 'show'])->names([
        'index' => 'user-designs.index',
        'show' => 'user-designs.show',
    ]);
    
    // Business Operations
    Route::resource('subscriptions', SubscriptionController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('downloads', DownloadController::class);
    Route::resource('shared-invitations', SharedInvitationController::class);
    Route::resource('rsvp-responses', RsvpResponseController::class);
    Route::resource('rsvp-settings', RsvpSettingController::class);
    Route::resource('print-orders', PrintOrderController::class);
    Route::resource('user-profiles', UserProfileController::class);
    
    // Marketing
    Route::resource('coupons', CouponController::class);
    Route::resource('shipping-addresses', ShippingAddressController::class);
    Route::resource('referrals', ReferralController::class);
});

Route::resource('templates', TemplateController::class)->except(['show']);
Route::get('/editor/{template}', [EditorController::class, 'show'])->name('editor.show');
Route::post('/editor/{template}/save', [EditorController::class, 'saveDesign'])->name('editor.save');
Route::post('/editor/upload-image', [EditorController::class, 'uploadImage'])->name('editor.upload-image');