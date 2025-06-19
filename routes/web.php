<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\PageBuilderController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Alias for default login route name for compatibility with Laravel auth
Route::get('/login', function() {
    return redirect()->route('admin.login');
})->name('login');

Route::get('/areas/{slug}', [App\Http\Controllers\AreaController::class, 'show'])->name('service-areas.show');
Route::get('/areas', [App\Http\Controllers\AreaController::class, 'index'])->name('areas.index');

// Service routes
Route::get('/services', [App\Http\Controllers\ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [App\Http\Controllers\ServiceController::class, 'show'])->name('services.show');

// Areas routes
Route::get('/areas', [App\Http\Controllers\AreaController::class, 'index'])->name('areas.index');
Route::get('/areas/{slug}', [App\Http\Controllers\AreaController::class, 'show'])->name('areas.show');

// Industries routes
Route::get('/industries', [App\Http\Controllers\IndustryController::class, 'index'])->name('industries.index');
Route::get('/industries/{slug}', [App\Http\Controllers\IndustryController::class, 'show'])->name('industries.show');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('industries', App\Http\Controllers\Admin\IndustryController::class);
    Route::resource('testimonials', App\Http\Controllers\Admin\TestimonialController::class);
    Route::resource('areas', App\Http\Controllers\Admin\AreaController::class);
    Route::resource('services', App\Http\Controllers\Admin\ServiceController::class);
    Route::resource('menus', App\Http\Controllers\Admin\MenuController::class);

    // Page Builder Routes
    Route::get('/page-builder', [PageBuilderController::class, 'index'])->name('page-builder.index');
    Route::get('/page-builder/load', [PageBuilderController::class, 'load'])->name('page-builder.load');
    Route::post('/page-builder/save', [PageBuilderController::class, 'save'])->name('page-builder.save');
    Route::get('/page-builder/preview', [PageBuilderController::class, 'preview'])->name('page-builder.preview');
});

require_once __DIR__.'/admin.php';
require __DIR__.'/settings.php';