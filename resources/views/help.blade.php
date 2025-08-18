@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-5 fade-in">
    <h1 class="mb-4 text-bs-primary">Help Center</h1>

    <!-- Help sections accordion -->
    <div class="accordion" id="helpAccordion">
        <!-- Getting Started Section -->
        <div class="accordion-item mb-3 card">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#gettingStartedContent">
                    <i class="bi bi-play-circle me-2"></i>
                    Getting Started
                </button>
            </h2>
            <div id="gettingStartedContent" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <p class="mb-3">Welcome to Loop! Here's how to get started:</p>
                    <ul class="list-unstyled ms-3">
                        <li>Create your account to start making playlists</li>
                        <li>Add your favorite YouTube videos to playlists</li>
                        <li>Make playlists public or private</li>
                        <li>Follow other users to see their public playlists</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Features Section -->
        <div class="accordion-item mb-3 card">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#featuresContent">
                    <i class="bi bi-star me-2"></i>
                    Main Features
                </button>
            </h2>
            <div id="featuresContent" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <ul class="list-unstyled ms-3">
                        <li>Create and manage playlists</li>
                        <li>Search YouTube videos directly</li>
                        <li>Follow other users</li>
                        <li>Control playlist privacy</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="accordion-item mb-3 card">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#faqContent">
                    <i class="bi bi-question-circle me-2"></i>
                    Frequently Asked Questions
                </button>
            </h2>
            <div id="faqContent" class="accordion-collapse collapse">
                <div class="accordion-body">
                    <div class="mb-4">
                        <h5 class="fw-bold mb-2">How do I create a playlist?</h5>
                        <p>Click the "New Playlist" button on your profile, give it a name, and start adding videos!</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-2">Can I make my playlists private?</h5>
                        <p>Yes! When creating or editing a playlist, you can set it as private or public.</p>
                    </div>
                    <div class="mb-4">
                        <h5 class="fw-bold mb-2">How do I follow other users?</h5>
                        <p>Visit their profile and click the "Follow" button to see their public playlists.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    /* Match your app's theme */
    .accordion-button:not(.collapsed) {
        color: var(--bs-primary);
        background-color: var(--bs-light);
        border-color: var(--bs-primary);
    }

    .accordion-button:hover {
        color: var(--bs-primary) !important;
        transition: color 0.2s ease;
    }

    .accordion-button:focus {
        border-color: var(--bs-primary);
        box-shadow: 0 0 0 0.2rem rgba(245, 48, 3, 0.25);
    }

    .accordion-item {
        border: 1px solid var(--bs-border-color);
        transition: box-shadow 0.2s ease;
    }

    .accordion-item:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Dark theme support */
    [data-bs-theme="dark"] .accordion-button:not(.collapsed) {
        background-color: var(--bs-dark);
        color: var(--bs-primary);
    }

    [data-bs-theme="dark"] .accordion-item {
        background-color: var(--bs-body-bg);
        color: var(--bs-body-color);
    }

    /* Text styles */
    .text-bs-primary {
        color: var(--bs-primary);
    }

    /* Icon styles */
    .bi {
        color: var(--bs-primary);
    }

    /* List styles */
    .list-unstyled li {
        transition: all 0.2s ease;
    }

    .list-unstyled li:hover {
        transform: translateX(5px);
    }

    /* Animation */
    .accordion-body {
        animation: fadeIn 0.3s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>
@endpush
@endsection