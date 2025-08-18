@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold mb-8">Help Center</h1>

    <!-- Accordion sections -->
    <div class="space-y-4">
        <!-- Getting Started Section -->
        <div class="border rounded-lg">
            <button class="accordion-btn w-full p-4 text-left font-semibold bg-gray-50 hover:bg-gray-100">
                Getting Started
                <span class="float-right">+</span>
            </button>
            <div class="accordion-content hidden p-4">
                <p class="mb-4">Welcome to Loop! Here's how to get started:</p>
                <ul class="list-disc ml-6">
                    <li class="mb-2">Create your account to start making playlists</li>
                    <li class="mb-2">Add your favorite YouTube videos to playlists</li>
                    <li class="mb-2">Make playlists public or private</li>
                    <li class="mb-2">Follow other users to see their public playlists</li>
                </ul>
            </div>
        </div>

        <!-- Features Section -->
        <div class="border rounded-lg">
            <button class="accordion-btn w-full p-4 text-left font-semibold bg-gray-50 hover:bg-gray-100">
                Main Features
                <span class="float-right">+</span>
            </button>
            <div class="accordion-content hidden p-4">
                <ul class="list-disc ml-6">
                    <li class="mb-2">Create and manage playlists</li>
                    <li class="mb-2">Search YouTube videos directly</li>
                    <li class="mb-2">Follow other users</li>
                    <li class="mb-2">Control playlist privacy</li>
                </ul>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="border rounded-lg">
            <button class="accordion-btn w-full p-4 text-left font-semibold bg-gray-50 hover:bg-gray-100">
                Frequently Asked Questions
                <span class="float-right">+</span>
            </button>
            <div class="accordion-content hidden p-4">
                <div class="mb-4">
                    <h3 class="font-bold mb-2">How do I create a playlist?</h3>
                    <p>Click the "New Playlist" button on your profile, give it a name, and start adding videos!</p>
                </div>
                <div class="mb-4">
                    <h3 class="font-bold mb-2">Can I make my playlists private?</h3>
                    <p>Yes! When creating or editing a playlist, you can set it as private or public.</p>
                </div>
                <div class="mb-4">
                    <h3 class="font-bold mb-2">How do I follow other users?</h3>
                    <p>Visit their profile and click the "Follow" button to see their public playlists.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .accordion-content {
        transition: all 0.3s ease-out;
    }
    
    .accordion-btn.active span {
        transform: rotate(45deg);
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const accordionBtns = document.querySelectorAll('.accordion-btn');
        
        accordionBtns.forEach(button => {
            button.addEventListener('click', () => {
                const content = button.nextElementSibling;
                button.classList.toggle('active');
                
                if (content.style.maxHeight) {
                    content.style.maxHeight = null;
                    content.classList.add('hidden');
                } else {
                    content.classList.remove('hidden');
                    content.style.maxHeight = content.scrollHeight + "px";
                }
            });
        });
    });
</script>
@endsection