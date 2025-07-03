<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\DashboardController;

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🟢 হোমপেজে প্রোডাক্ট দেখানো
Route::get('/', [ProductController::class, 'index']);

// 🟢 প্রোডাক্ট আপলোড ফর্ম দেখানো (শুধু logged in user)
Route::get('/dashboard/upload', [ProductController::class, 'create'])->middleware(['auth']);

// 🟢 ফর্ম সাবমিট করলে ডাটাবেজে সেভ হবে
Route::post('/dashboard/upload', [ProductController::class, 'store'])->middleware(['auth']);

// 🟢 ড্যাশবোর্ড (লগইন ও ভেরিফাইড ইউজারদের জন্য)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🟢 প্রোফাইল ম্যানেজমেন্ট (Laravel Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🟢 Auth Routes
require __DIR__.'/auth.php';
