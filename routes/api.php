<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Favorite Movies Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/favorites', [MovieController::class, 'showFavorites'])->name('favorites');
    Route::post('/favorites', [MovieController::class, 'addFavorite'])->name('add.favorite');
    Route::delete('/favorites/{id}', [MovieController::class, 'removeFavorite'])->name('remove.favorite');
});

