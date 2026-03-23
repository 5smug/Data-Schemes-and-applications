<?php
include_once '../config.php';

// If JavaScript is requested, output JavaScript
if (isset($_GET['js']) && $_GET['js'] == '1') {
    header('Content-Type: application/javascript');
    ?>
    function loadFlickrPhotos(placeName, containerId) {
        var container = document.getElementById(containerId);
        if (!container) return;
        
        // Show loading message
        container.innerHTML = '<div class="flickr-loading">📸 Loading photos...</div>';
        
        // Call the API to get photos
        fetch('api/flickr.php?place=' + encodeURIComponent(placeName))
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                if (data.error) {
                    container.innerHTML = '<div class="flickr-error">No photos available</div>';
                    return;
                }
                
                if (data.photos && data.photos.length > 0) {
                    var html = '<div class="flickr-grid">';
                    
                    for (var i = 0; i < data.photos.length; i++) {
                        var photo = data.photos[i];
                        html += '<div class="flickr-thumb">';
                        html += '<img src="' + photo.url_sq + '" alt="' + photo.title + '">';
                        html += '</div>';
                    }
                    
                    html += '</div>';
                    container.innerHTML = html;
                } else {
                    container.innerHTML = '<div class="flickr-error">No photos available</div>';
                }
            })
            .catch(function() {
                container.innerHTML = '<div class="flickr-error">Failed to load photos</div>';
            });
    }

    // Auto-load when page is ready
    document.addEventListener('DOMContentLoaded', function() {
        var containers = document.querySelectorAll('.flickr-photos');
        for (var i = 0; i < containers.length; i++) {
            var container = containers[i];
            var placeName = container.getAttribute('data-place');
            var containerId = container.getAttribute('id');
            if (placeName && containerId) {
                loadFlickrPhotos(placeName, containerId);
            }
        }
    });
    ?>
    <?php
    exit;
}

// Return JSON data for a specific place
header('Content-Type: application/json');

$place = isset($_GET['place']) ? $_GET['place'] : '';
if (empty($place)) {
    echo json_encode(['error' => 'Place name required']);
    exit;
}

// Convert place name to filename (lowercase, spaces to dashes)
$filename = strtolower(str_replace(' ', '-', $place)) . '.png';
$imagePath = 'images/' . $filename;

// Check if the image exists
if (file_exists($imagePath)) {
    // Image exists, return it
    $photos = [
        [
            'id' => '1',
            'title' => $place,
            'url_sq' => $imagePath,
            'owner' => 'local'
        ]
    ];
    echo json_encode([
        'source' => 'local',
        'photos' => $photos
    ]);
} else {
    // No image found, return empty array
    echo json_encode([
        'source' => 'empty',
        'photos' => []
    ]);
}
?>