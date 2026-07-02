<?php

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

// Services Routes
Route::get('/services', [\App\Http\Controllers\Frontend\ServiceController::class, 'index'])->name('services.index');
Route::get('/services/operative', [\App\Http\Controllers\Frontend\ServiceController::class, 'operative'])->name('services.operative');
Route::get('/services/endodontics', [\App\Http\Controllers\Frontend\ServiceController::class, 'endodontics'])->name('services.endodontics');
Route::get('/services/oral-surgery', [\App\Http\Controllers\Frontend\ServiceController::class, 'oralSurgery'])->name('services.oral-surgery');
Route::get('/services/prosthodontics', [\App\Http\Controllers\Frontend\ServiceController::class, 'prosthodontics'])->name('services.prosthodontics');
Route::get('/services/periodontics', [\App\Http\Controllers\Frontend\ServiceController::class, 'periodontics'])->name('services.periodontics');
Route::get('/services/orthodontics', [\App\Http\Controllers\Frontend\ServiceController::class, 'orthodontics'])->name('services.orthodontics');
Route::get('/services/pedodontics', [\App\Http\Controllers\Frontend\ServiceController::class, 'pedodontics'])->name('services.pedodontics');
Route::get('/services/oral-medicine', [\App\Http\Controllers\Frontend\ServiceController::class, 'oralMedicine'])->name('services.oral-medicine');

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

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('appointments', \App\Http\Controllers\Admin\AppointmentController::class);
        Route::post('appointments/{appointment}/status', [\App\Http\Controllers\Admin\AppointmentController::class, 'updateStatus'])->name('appointments.status');
        Route::resource('services', \App\Http\Controllers\Admin\ServiceController::class);
        Route::resource('doctors', \App\Http\Controllers\Admin\DoctorController::class);
    });
});

require __DIR__ . '/auth.php';
