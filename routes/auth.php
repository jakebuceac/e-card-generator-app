<?php

use App\Http\Controllers\Auth\AuthenticationController;
use App\Http\Controllers\Auth\Password\NewPasswordController;
use App\Http\Controllers\Auth\Password\PasswordController;
use App\Http\Controllers\Auth\Password\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegistrationController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegistrationController::class, 'create'])
                ->name('register');

    Route::post('register', [RegistrationController::class, 'store']);

    Route::get('login', [AuthenticationController::class, 'create'])
                ->name('login');

    Route::post('login', [AuthenticationController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
                ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [AuthenticationController::class, 'destroy'])
                ->name('logout');
});
