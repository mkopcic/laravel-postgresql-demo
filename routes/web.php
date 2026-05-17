<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

// Root — welcome za goste, redirect za prijavljene
Route::get('/', function () {
    if (auth()->check()) {
        return auth()->user()->hasRole('admin')
            ? redirect()->route('admin.dashboard')
            : redirect()->route('user.dashboard');
    }
    return view('welcome');
})->name('home');

// Showcase (slobodan pristup)
Route::get('/showcase', function () {
    return view('showcase');
});

// Auth rute (samo gosti)
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// User dashboard
Route::middleware(['auth', 'role:user|admin'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::put('/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
});

// Admin rute
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
        Route::put('/users/{user}/role', [AdminController::class, 'assignRole'])->name('users.assign-role');
    });
