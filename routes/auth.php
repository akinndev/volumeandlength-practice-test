<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\AuthenticatedOAuthController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    Route::post('register', [RegisteredUserController::class, 'store'])->name('register.post');

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store'])->name('login.post');

    Route::get('auth/google', [AuthenticatedOAuthController::class, 'googleAuth'])->name('google.login');
    Route::get('auth/google/callback', [AuthenticatedOAuthController::class, 'googleCallback']);
});

Route::middleware('auth')->group(function () {
    Route::get('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');
});
