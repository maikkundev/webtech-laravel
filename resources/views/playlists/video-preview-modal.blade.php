{{-- Video Preview Modal --}}
<div class="modal fade" id="videoPreviewModal" tabindex="-1" aria-labelledby="videoPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-color: #e3e3e0;">
            <div class="modal-header" style="border-color: #F53003;">
                <h5 class="modal-title fw-bold" id="videoPreviewModalLabel" style="color: #1b1b18;">
                    Video Preview
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <!-- Video Preview Container -->
                <div id="videoPreviewContent">
                    <!-- Content will be loaded dynamically -->
                </div>
            </div>

            <div class="modal-footer" style="border-color: #e3e3e0;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirmAddVideo" class="btn text-white fw-semibold"
                    style="background-color: #F53003; border-color: #F53003;"
                    onmouseover="this.style.backgroundColor='#d42a00'"
                    onmouseout="this.style.backgroundColor='#F53003'">
                    Add to Playlist
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    let currentVideoData = null;

    // Function to preview video (called from the main page)
    function previewVideo(videoId, title) {
        currentVideoData = {
            id: videoId,
            title: title
        };

        // Set modal title
        document.getElementById('videoPreviewModalLabel').textContent = 'Preview: ' + title;

        // Create video preview content
        const previewContent = document.getElementById('videoPreviewContent');
        previewContent.innerHTML = `
            <div class="text-center">
                <h6 class="fw-semibold mb-3" style="color: #1b1b18;">${title}</h6>
                <div class="ratio ratio-16x9 mb-3">
                    <iframe src="https://www.youtube.com/embed/${videoId}"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                    </iframe>
                </div>
                <p class="text-muted small">Video ID: ${videoId}</p>
            </div>
        `;

        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('videoPreviewModal'));
        modal.show();
    }

    // Handle the confirm add video button
    document.getElementById('confirmAddVideo').addEventListener('click', function() {
        if (currentVideoData && typeof addVideoToPlaylist === 'function') {
            // Close the modal first
            const modal = bootstrap.Modal.getInstance(document.getElementById('videoPreviewModal'));
            modal.hide();

            // Add the video to playlist using the existing function
            addVideoToPlaylist(currentVideoData.id, currentVideoData.title);
        } else {
            alert('No video selected or addVideoToPlaylist function not found');
        }
    });
</script>
