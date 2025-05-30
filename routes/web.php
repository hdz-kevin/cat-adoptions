<?php

use App\Http\Controllers\AdoptionRequestController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


# TODO: Prevent a user from adopting more than one cat.


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
    // Profile
    Route::get('/profile', fn (Request $request) => response()->json($request->user()))->name('profile');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/cats/photo-upload', [CatController::class, 'photoUpload'])->name('cats.photo.upload');
    Route::get('/cats/create', [CatController::class, 'create'])->name('cats.create');
    Route::post('/cats', [CatController::class, 'store'])->name('cats.store');
    Route::get('/cats/{cat}/edit', [CatController::class, 'edit'])->name('cats.edit');
    Route::put('/cats/{cat}', [CatController::class, 'update'])->name('cats.update');
    Route::delete('/cats/{cat}', [CatController::class, 'destroy'])->name('cats.destroy');
    Route::delete('/adoption-requests/{adoptionRequest}/reject', [AdoptionRequestController::class, 'reject'])
            ->name('adoption-requests.reject');
    Route::post('/adoption-requests/{adoptionRequest}/approve', [AdoptionRequestController::class, 'approve'])
            ->name('adoption-requests.approve');
});

Route::middleware(['auth', 'not_admin'])->group(function () {
    Route::post('/adoption-requests/{cat}', [AdoptionRequestController::class, 'store'])->name('adoption-requests.store');
    Route::post('/adoption-requests/{cat}/cancel', [AdoptionRequestController::class, 'cancel'])->name('adoption-requests.cancel');
});

Route::get('/cats', [CatController::class, 'index'])->name('cats.index');
Route::get('/cats/{cat}', [CatController::class, 'show'])->withoutMiddleware(['auth', 'admin'])->name('cats.show');
