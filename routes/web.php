<?php

use Illuminate\Support\Facades\Route;

// Triggering SonarQube analysis
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Guest Routes (Not Logged In)
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [AuthController::class, 'login']);

    Route::get('/register', [AuthController::class, 'showRegisterForm'])
        ->name('register');

    Route::post('/register', [AuthController::class, 'register']);
});

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    // User Dashboard
    Route::get('/', [TaskController::class, 'dashboard'])
        ->name('dashboard');

    // Profile
    Route::get('/profile', [TaskController::class, 'profile'])
        ->name('profile');

    Route::post('/profile', [TaskController::class, 'updateProfile'])
        ->name('profile.update');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    /*
    |--------------------------------------------------------------------------
    | User Task API (AJAX)
    |--------------------------------------------------------------------------
    */
    Route::get('/tasks', [TaskController::class, 'index'])
        ->name('tasks.index');

    Route::post('/tasks', [TaskController::class, 'store'])
        ->name('tasks.store');

    Route::put('/tasks/{id}', [TaskController::class, 'update'])
        ->name('tasks.update');

    Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])
        ->name('tasks.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (SECURED)
|--------------------------------------------------------------------------
| Only accessible by users with role = admin
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // Admin Dashboard
        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');

        // User Management
        Route::get('/users', [AdminController::class, 'users'])
            ->name('users');

        Route::put('/users/{id}/toggle-role', [AdminController::class, 'toggleRole'])
            ->name('users.toggle');

        // Task Monitoring
        Route::get('/tasks', [AdminController::class, 'tasks'])
            ->name('tasks');
    });
