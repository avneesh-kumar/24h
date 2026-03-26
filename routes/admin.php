<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AreaController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\IndustryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController;

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
], function () {
    // Authentication Routes
    Route::get('/', [LoginController::class, 'showLoginForm']);
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Password Reset Routes
    Route::get('/forgot-password', [LoginController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/forgot-password', [LoginController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset-password/{token}', [LoginController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset-password', [LoginController::class, 'reset'])->name('password.update');

    // Protected Routes
    Route::middleware(['auth'])->group(function () {
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Login History
        Route::get('/login-history', function () {
            $logins = \App\Models\UserLoginLog::with('user')->orderByDesc('created_at')->paginate(50);
            $data = collect();
            foreach($logins as $login) {
                $data->push([
                    'date' => $login->created_at,
                    'user' => $login->user->name,
                    'ip' => $login->ip_address,
                ]);
            }
            $logins = $data;
            return view('admin.login-history', compact('logins'));
        })->name('login-history');

        // Account Management
        Route::get('/account', function () {
            return view('admin.account');
        })->name('account');
        Route::post('/account/password', [AccountController::class, 'updatePassword'])->name('account.password.update');

        // Resource Routes
        Route::resource('areas', AreaController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('industries', IndustryController::class);
        Route::resource('testimonials', TestimonialController::class);
        Route::resource('menus', MenuController::class);
        Route::resource('posts', PostController::class);
    });
});

