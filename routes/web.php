<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('home');
    }
    return Inertia::render('Welcome');
});

Route::get('/home', [HomeController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('home');

Route::get('/profile/{user_id}', [ProfileController::class, 'show'])->name('profile.show');

Route::middleware('auth')->group(function () {
    Route::get('/profile/{user}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update'); // Menambahkan POST untuk spoofing PATCH
});

Route::middleware('auth')->group(function () {
    Route::get('/p/create', [PostsController::class, 'create'])->name('post.create');
    Route::post('/p', [PostsController::class, 'store'])->name('post.store');
});
Route::get('/p/{post}', [PostsController::class, 'show'])->name('post.show');

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.destroy');
});

require __DIR__ . '/auth.php';
