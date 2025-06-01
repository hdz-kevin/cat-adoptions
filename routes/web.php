<?php

use App\Http\Controllers\AdoptionRequestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', fn () => redirect()->route('home'));
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'registrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::get('/profile/{user:username}', [ProfileController::class, 'show'])->name('profile');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/cats/photo-upload', [CatController::class, 'photoUpload'])->name('cats.photo.upload');
    Route::resource('cats', CatController::class)->only([
        'create', 'store', 'edit', 'update', 'destroy'
    ]);
    // Adoption Requests
    Route::delete('/adoption-requests/{adoptionRequest}/reject', [AdoptionRequestController::class, 'reject'])
            ->name('adoption-requests.reject');
    Route::post('/adoption-requests/{adoptionRequest}/approve', [AdoptionRequestController::class, 'approve'])
            ->name('adoption-requests.approve');
});

Route::middleware(['auth', 'not_admin'])->group(function () {
    Route::post('/adoption-requests/{cat}', [AdoptionRequestController::class, 'store'])->name('adoption-requests.store');
    Route::post('/adoption-requests/{cat}/cancel', [AdoptionRequestController::class, 'cancel'])->name('adoption-requests.cancel');
});

Route::resource('cats', CatController::class)->only(['index', 'show']);
