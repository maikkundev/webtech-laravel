<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class YouTubeService
{
    protected $apiKey;

    public function __construct()
    {
        $this->apiKey = config('services.youtube.api_key');
    }

    /**
     * Search for YouTube videos using HTTP client
     */
    public function searchVideos($query, $maxResults = 10)
    {
        if (!$this->apiKey) {
            return Log::error("Youtube API key not found");
        }

        try {
            $response = Http::get('https://www.googleapis.com/youtube/v3/search', [
                'part' => 'snippet',
                'q' => $query,
                'type' => 'video',
                'maxResults' => $maxResults,
                'order' => 'relevance',
                'key' => $this->apiKey
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $videos = [];

                foreach ($data['items'] as $item) {
                    $videos[] = [
                        'id' => $item['id']['videoId'],
                        'title' => $item['snippet']['title'],
                        'description' => $item['snippet']['description'] ?? '',
                        'thumbnail' => $item['snippet']['thumbnails']['high']['url'] ?? $item['snippet']['thumbnails']['default']['url'],
                        'channel' => $item['snippet']['channelTitle'],
                        'publishedAt' => $item['snippet']['publishedAt']
                    ];
                }

                return $videos;
            }
        } catch (\Exception $e) {
            // Log error if needed
            Log::warning('YouTube API search failed: ' . $e->getMessage());
        }
    }

    /**
     * Get video details by YouTube ID using HTTP client
     */
    public function getVideoDetails($videoId)
    {
        if (!$this->apiKey) {
            return Log::error("Youtube API key not found");
        }

        try {
            $response = Http::get('https://www.googleapis.com/youtube/v3/videos', [
                'part' => 'snippet,contentDetails',
                'id' => $videoId,
                'key' => $this->apiKey
            ]);

            if ($response->successful()) {
                $data = $response->json();

                if (empty($data['items'])) {
                    return null;
                }

                $video = $data['items'][0];
                return [
                    'id' => $video['id'],
                    'title' => $video['snippet']['title'],
                    'description' => $video['snippet']['description'] ?? '',
                    'thumbnail' => $video['snippet']['thumbnails']['high']['url'] ?? $video['snippet']['thumbnails']['default']['url'],
                    'channel' => $video['snippet']['channelTitle'],
                    'duration' => $video['contentDetails']['duration'],
                    'publishedAt' => $video['snippet']['publishedAt']
                ];
            }
        } catch (\Exception $e) {
            Log::warning('YouTube API video details failed: ' . $e->getMessage());
        }
    }

    /**
     * Extract YouTube video ID from URL
     */
    public function extractVideoId($url)
    {
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/';
        preg_match($pattern, $url, $matches);
        return isset($matches[1]) ? $matches[1] : null;
    }
}
