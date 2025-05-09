<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', fn () => view('home'))->name('home');

Route::get('/register', fn () => view('auth.register'))->name('register');
Route::post('/register', fn () => response("POST ".route('register')));

Route::get('/login', fn () => view('auth.login'))->name('login');
Route::post('/login', fn () => response("POST ".route('login.store')));
