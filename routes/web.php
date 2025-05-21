<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/', fn () => redirect()->route('home'));
Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'registrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    Route::get('/login', [LoginController::class, 'loginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::post('/logout', [LogoutController::class, 'logout'])->withoutMiddleware('admin')->name('logout');

    Route::post('/cats/photo-upload', [CatController::class, 'photoUpload'])->name('cats.photo.upload');
    Route::get('/cats/create', [CatController::class, 'create'])->name('cats.create');
    Route::post('/cats', [CatController::class, 'store'])->name('cats.store');
    Route::get('/cats/{cat}', [CatController::class, 'show'])->withoutMiddleware('admin')->name('cats.show');
    Route::get('/cats/{cat}/edit', [CatController::class, 'edit'])->name('cats.edit');
    Route::put('/cats/{cat}', [CatController::class, 'update'])->name('cats.update');
    Route::delete('/cats/{cat}', [CatController::class, 'destroy'])->name('cats.destroy');
});
