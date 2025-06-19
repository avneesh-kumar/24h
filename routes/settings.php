<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\SettingController;

Route::middleware(['auth'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    });
