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
            return $this->getMockSearchResults($query, $maxResults);
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

        // Fallback to mock data
        return $this->getMockSearchResults($query, $maxResults);
    }

    /**
     * Get video details by YouTube ID using HTTP client
     */
    public function getVideoDetails($videoId)
    {
        if (!$this->apiKey) {
            return $this->getMockVideoDetails($videoId);
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

        return $this->getMockVideoDetails($videoId);
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

    /**
     * Mock search results for development
     */
    private function getMockSearchResults($query, $maxResults)
    {
        $mockVideos = [
            [
                'id' => 'dQw4w9WgXcQ',
                'title' => 'Rick Astley - Never Gonna Give You Up (Official Video)',
                'description' => 'The official video for "Never Gonna Give You Up" by Rick Astley',
                'thumbnail' => 'https://img.youtube.com/vi/dQw4w9WgXcQ/hqdefault.jpg',
                'channel' => 'Rick Astley',
                'publishedAt' => '2009-10-25T06:57:33Z'
            ],
            [
                'id' => 'ZbZSe6N_BXs',
                'title' => 'PHP Tutorial for Beginners - ' . $query,
                'description' => 'Learn PHP programming from scratch',
                'thumbnail' => 'https://img.youtube.com/vi/ZbZSe6N_BXs/hqdefault.jpg',
                'channel' => 'Programming Channel',
                'publishedAt' => '2020-01-15T10:30:00Z'
            ],
            [
                'id' => 'J7DFmxVe0Ps',
                'title' => 'Laravel Tutorial - Build a Web Application with ' . $query,
                'description' => 'Complete Laravel tutorial for building web applications',
                'thumbnail' => 'https://img.youtube.com/vi/J7DFmxVe0Ps/hqdefault.jpg',
                'channel' => 'Laravel Channel',
                'publishedAt' => '2021-03-20T14:45:00Z'
            ],
            [
                'id' => 'kbBgx0BEuuI',
                'title' => 'JavaScript Fundamentals - ' . $query,
                'description' => 'Learn JavaScript programming fundamentals',
                'thumbnail' => 'https://img.youtube.com/vi/kbBgx0BEuuI/hqdefault.jpg',
                'channel' => 'JS Academy',
                'publishedAt' => '2022-05-10T09:15:00Z'
            ],
            [
                'id' => 'SccSCuHhOw0',
                'title' => 'Web Development Tutorial - ' . $query,
                'description' => 'Complete web development course',
                'thumbnail' => 'https://img.youtube.com/vi/SccSCuHhOw0/hqdefault.jpg',
                'channel' => 'WebDev Pro',
                'publishedAt' => '2023-02-28T16:20:00Z'
            ]
        ];

        // Filter mock results based on query (simple contains check)
        $filtered = array_filter($mockVideos, function($video) use ($query) {
            return stripos($video['title'], $query) !== false || 
                   stripos($video['description'], $query) !== false;
        });

        // If no matches, return all mock videos
        if (empty($filtered)) {
            $filtered = $mockVideos;
        }

        return array_slice(array_values($filtered), 0, $maxResults);
    }

    /**
     * Mock video details for development
     */
    private function getMockVideoDetails($videoId)
    {
        return [
            'id' => $videoId,
            'title' => 'Sample Video Title',
            'description' => 'Sample video description',
            'thumbnail' => "https://img.youtube.com/vi/{$videoId}/hqdefault.jpg",
            'channel' => 'Sample Channel',
            'duration' => 'PT3M45S',
            'publishedAt' => '2023-01-01T12:00:00Z'
        ];
    }
}
