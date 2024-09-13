<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::prefix('dashboard')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'list'])->name('dashboard.list');
    Route::get('/{id}', [DashboardController::class, 'detail'])->name('dashboard.detail');
});

require __DIR__ . '/auth.php';
