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

// Public playlist routes (accessible to everyone)
Route::get('/playlists', [PlaylistController::class, 'index'])->name('playlists.index'); // Browse all public playlists

// Protected Routes - Authentication Required
Route::middleware(['auth'])->group(function () {
    // Playlist Management Routes - SPECIFIC ROUTES FIRST (before parameterized routes)
    Route::get('/playlists/create', [PlaylistController::class, 'create'])->name('playlists.create'); // Show create form
    Route::post('/playlists', [PlaylistController::class, 'store'])->name('playlists.store'); // Store new playlist

    // Video Management within Playlists (Protected)
    Route::get('/search/videos', [PlaylistController::class, 'searchVideos'])->name('search.videos'); // Search YouTube videos

    // Follow Routes (Protected)
    Route::post('/users/{user}/follow', [FollowController::class, 'follow'])->name('users.follow');
    Route::post('/users/{user}/unfollow', [FollowController::class, 'unfollow'])->name('users.unfollow');
    Route::get('/followed-lists/edit', [FollowController::class, 'editFollowedLists'])->name('followed-lists.edit');

    // Content Playback Routes (Protected)
    Route::get('/playback', [PlaylistController::class, 'playbackIndex'])->name('playback.index');

    // Video Routes (Protected)
    Route::resource('videos', VideoController::class);

    // Profile Routes (Protected)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Open Data Export Routes (Protected)
    Route::get('/export', [OpenDataController::class, 'index'])->name('export.index');
    Route::get('/export/yaml', [OpenDataController::class, 'exportYaml'])->name('export.yaml');

    // Playlist Routes with Parameters - THESE COME LAST to avoid conflicts
    Route::get('/playlists/{playlist}/edit', [PlaylistController::class, 'edit'])->name('playlists.edit'); // Show edit form
    Route::put('/playlists/{playlist}', [PlaylistController::class, 'update'])->name('playlists.update'); // Update playlist
    Route::delete('/playlists/{playlist}', [PlaylistController::class, 'destroy'])->name('playlists.destroy'); // Delete playlist
    Route::get('/playlists/{playlist}/add-video', [PlaylistController::class, 'addVideo'])->name('playlists.add-video'); // Show add video form
    Route::post('/playlists/{playlist}/videos', [PlaylistController::class, 'storeVideo'])->name('playlists.store-video'); // Add video to playlist
});

// Public playlist routes with parameters - AFTER protected specific routes
Route::get('/playlists/{playlist}', [PlaylistController::class, 'show'])->name('playlists.show'); // View specific playlist
Route::get('/playlists/{playlist}/play', [PlaylistController::class, 'play'])->name('playlists.play'); // Play playlist

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
