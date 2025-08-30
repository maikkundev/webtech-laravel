<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('home');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', static function () {
        return view('dashboard');
    })->name('dashboard');

    // Playlist Routes (Protected)
    Route::resource('playlists', PlaylistController::class);
    Route::get('/playlists/{playlist}/add-video', [PlaylistController::class, 'addVideo'])->name('playlists.add-video');
    Route::post('/playlists/{playlist}/videos', [PlaylistController::class, 'storeVideo'])->name('playlists.store-video');
    Route::get('/playlists/{playlist}/play', [PlaylistController::class, 'play'])->name('playlists.play');
    Route::get('/search/videos', [PlaylistController::class, 'searchVideos'])->name('search.videos');

    // Video Routes (Protected)
    Route::resource('videos', VideoController::class);
    // Profile Routes (Protected)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
