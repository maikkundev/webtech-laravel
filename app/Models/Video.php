<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    /** @use HasFactory<\Database\Factories\VideoFactory> */
    use HasFactory;

    protected $fillable = [
        'playlist_id',
        'user_id',
        'youtube_id',
        'title',
    ];

    /**
     * Get the playlist that owns the video.
     */
    public function playlist(): BelongsTo
    {
        return $this->belongsTo(Playlist::class);
    }

    /**
     * Get the user that owns the video.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the high quality thumbnail URL.
     *
     * @return string
     */
    public function getHighQualityThumbnailUrl(): string
    {
        return $this->getThumbnailUrl('maxresdefault');
    }

    /**
     * Get the thumbnail URL for the YouTube video.
     *
     * @param string $quality The quality of the thumbnail (default, mqdefault, hqdefault, sddefault, maxresdefault)
     * @return string
     */
    public function getThumbnailUrl(string $quality = 'hqdefault'): string
    {
        return "https://img.youtube.com/vi/{$this->youtube_id}/{$quality}.jpg";
    }

    /**
     * Get the medium quality thumbnail URL.
     *
     * @return string
     */
    public function getMediumQualityThumbnailUrl(): string
    {
        return $this->getThumbnailUrl('mqdefault');
    }

    /**
     * Accessor for thumbnail_url attribute.
     * This allows you to access $video->thumbnail_url even though it's not stored in the database.
     *
     * @return string
     */
    public function getThumbnailUrlAttribute(): string
    {
        return $this->getThumbnailUrl();
    }
}
