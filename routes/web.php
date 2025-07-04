<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TachesController;
use App\Http\Controllers\PresencesController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::prefix('taches')->group(function () {
//     Route::get('/', [TachesController::class, 'index'])->name('taches.index');
// });

// Route::prefix('presences')->group(function () {
//     Route::get('/', [PresencesController::class, 'index'])->name('presences.index');
// });

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
