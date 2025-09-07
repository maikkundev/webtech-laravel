<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VideoController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\OpenDataController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', static function () {
    return view('home');
})->name('home');



// Public Routes
Route::get('/users/discover', [FollowController::class, 'discover'])->name('users.discover');
Route::get('/help', static function () {
    return view('help');
})->name('help');

// Search Routes (Public - accessible without authentication)
Route::get('/search', [SearchController::class, 'index'])->name('search.index');
Route::get('/search/results', [SearchController::class, 'search'])->name('search.results');

// Public playlist routes (for viewing and playing public playlists)
Route::get('/playlists/{playlist}', [PlaylistController::class, 'show'])->name('playlists.show');
Route::get('/playlists/{playlist}/play', [PlaylistController::class, 'play'])->name('playlists.play');

Route::middleware(['auth'])->group(function () {

    // Playlist Routes (Protected) - excluding show and play which are public
    Route::resource('playlists', PlaylistController::class)->except(['show']);
    Route::get('/playlists/{playlist}/add-video', [PlaylistController::class, 'addVideo'])->name('playlists.add-video');
    Route::post('/playlists/{playlist}/videos', [PlaylistController::class, 'storeVideo'])->name('playlists.store-video');
    Route::get('/search/videos', [PlaylistController::class, 'searchVideos'])->name('search.videos');

    // Follow Routes (Protected)
    Route::post('/users/{user}/follow', [FollowController::class, 'follow'])->name('users.follow');
    Route::post('/users/{user}/unfollow', [FollowController::class, 'unfollow'])->name('users.unfollow');

    // Video Routes (Protected)
    Route::resource('videos', VideoController::class);
    // Profile Routes (Protected)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Open Data Export Routes (Protected)
    Route::get('/export', [OpenDataController::class, 'index'])->name('export.index');
    Route::get('/export/yaml', [OpenDataController::class, 'exportYaml'])->name('export.yaml');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
