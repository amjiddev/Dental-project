<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Frontend Routes (Public)
Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');

// About Routes
Route::get('/about', [\App\Http\Controllers\Frontend\PageController::class, 'about'])->name('about');
Route::get('/team', [\App\Http\Controllers\Frontend\PageController::class, 'team'])->name('team');
Route::get('/doctor/{doctor}', [\App\Http\Controllers\Frontend\DoctorController::class, 'show'])->name('doctor.show');

// Services Routes
Route::get('/services', [\App\Http\Controllers\Frontend\ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [\App\Http\Controllers\Frontend\ServiceController::class, 'show'])->name('services.show');

// Discounts Route
Route::get('/discounts', [\App\Http\Controllers\Frontend\PageController::class, 'discounts'])->name('discounts');

// Gallery Route
Route::get('/gallery', [\App\Http\Controllers\Frontend\PageController::class, 'gallery'])->name('gallery');

// Contact Route
Route::get('/contact', [\App\Http\Controllers\Frontend\PageController::class, 'contact'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\Frontend\PageController::class, 'contactSubmit'])->name('contact.submit');

// Terms and Privacy Routes
Route::get('/terms', [\App\Http\Controllers\Frontend\PageController::class, 'terms'])->name('terms');
Route::get('/privacy', [\App\Http\Controllers\Frontend\PageController::class, 'privacy'])->name('privacy');

// Appointment Routes
Route::get('/appointment', [\App\Http\Controllers\Frontend\AppointmentController::class, 'create'])->name('appointment.create');
Route::post('/appointment', [\App\Http\Controllers\Frontend\AppointmentController::class, 'store'])->name('appointment.store');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Management Routes
    Route::prefix('user-management')->name('user-management.')->group(function () {
        Route::resource('users', UserManagementController::class);
        Route::resource('roles', RoleManagementController::class);
        Route::resource('permissions', PermissionManagementController::class);
    });

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('appointments', \App\Http\Controllers\Admin\AppointmentController::class);
        Route::get('appointments/{appointment}/handle', [\App\Http\Controllers\Admin\AppointmentController::class, 'handle'])->name('appointments.handle');
        Route::put('appointments/{appointment}/handle', [\App\Http\Controllers\Admin\AppointmentController::class, 'updateHandle'])->name('appointments.handle-update');
        Route::post('appointments/{appointment}/status', [\App\Http\Controllers\Admin\AppointmentController::class, 'updateStatus'])->name('appointments.status');
        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
        Route::resource('services.treatment-options', \App\Http\Controllers\Admin\TreatmentOptionController::class)->scoped();
        Route::post('services/{service}/treatment-options/{treatmentOption}/toggle-status', [\App\Http\Controllers\Admin\TreatmentOptionController::class, 'toggleStatus'])->name('services.treatment-options.toggle-status');
        Route::post('services/{service}/toggle-status', [\App\Http\Controllers\Admin\ServiceController::class, 'toggleStatus'])->name('services.toggle-status');
        Route::resource('doctors', \App\Http\Controllers\Admin\DoctorController::class);
        Route::post('doctors/{doctor}/toggle-status', [\App\Http\Controllers\Admin\DoctorController::class, 'toggleStatus'])->name('doctors.toggle-status');
        Route::resource('gallery', \App\Http\Controllers\Admin\GalleryController::class);
        Route::post('gallery/{gallery}/toggle-status', [\App\Http\Controllers\Admin\GalleryController::class, 'toggleStatus'])->name('gallery.toggle-status');
        Route::resource('discounts', \App\Http\Controllers\Admin\DiscountController::class);
        Route::post('discounts/{discount}/toggle-status', [\App\Http\Controllers\Admin\DiscountController::class, 'toggleStatus'])->name('discounts.toggle-status');
        Route::resource('expert-tips', \App\Http\Controllers\Admin\ExpertTipController::class);
        Route::post('expert-tips/{expertTip}/toggle-status', [\App\Http\Controllers\Admin\ExpertTipController::class, 'toggleStatus'])->name('expert-tips.toggle-status');

        // Contact Messages Routes
        Route::resource('contact-messages', \App\Http\Controllers\Admin\ContactMessageController::class, ['only' => ['index', 'show', 'destroy']]);
        Route::get('contact-messages/unread/count', [\App\Http\Controllers\Admin\ContactMessageController::class, 'getUnread'])->name('contact-messages.unread-count');

        // Settings Routes
        Route::get('settings/about', [\App\Http\Controllers\Admin\SettingController::class, 'about'])->name('settings.about');
        Route::put('settings/about', [\App\Http\Controllers\Admin\SettingController::class, 'updateAbout'])->name('settings.about.update');
        Route::get('settings/home', [\App\Http\Controllers\Admin\SettingController::class, 'home'])->name('settings.home');
        Route::put('settings/home', [\App\Http\Controllers\Admin\SettingController::class, 'updateHome'])->name('settings.home.update');
        Route::get('settings/contact', [\App\Http\Controllers\Admin\SettingController::class, 'contact'])->name('settings.contact');
        Route::put('settings/contact', [\App\Http\Controllers\Admin\SettingController::class, 'updateContact'])->name('settings.contact.update');
        Route::post('settings/toggle-section', [\App\Http\Controllers\Admin\SettingController::class, 'toggleSection'])->name('settings.toggle-section');
    });
});

require __DIR__ . '/auth.php';
