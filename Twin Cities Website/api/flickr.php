<?php

include_once '../config.php';

if (isset($_GET['js']) && $_GET['js'] == '1') {
    header('Content-Type: application/javascript');
    
    function loadFlickrPhotos(placeName, containerId) {
        var container = document.getElementById(containerId);
        if (!container) return;
        
        container.innerHTML = '<div class="flickr-loading">📸 Loading photos...</div>';
        
        fetch('api/flickr.php?place=' + encodeURIComponent(placeName))
            .then(response => response.json())
            .then(data => {
                if (data.error) {
                    container.innerHTML = '<div class="flickr-error">No photos found</div>';
                    return;
                }
                
                if (data.photos && data.photos.length > 0) {
                    var html = '<div class="flickr-grid">';
                    
                    for (var i = 0; i < 4; i++) {
                        if (data.photos[i]) {
                            var photo = data.photos[i];
                            var imgUrl = photo.url_sq;
                            if (!imgUrl) imgUrl = photo.url_t;
                            
                            html += '<div class="flickr-thumb">';
                            html += '<img src="' + imgUrl + '" alt="' + photo.title + '">';
                            html += '</div>';
                        }
                    }
                    
                    html += '</div>';
                    container.innerHTML = html;
                }
            });
    }
    exit;
}

header('Content-Type: application/json');

$place = isset($_GET['place']) ? $_GET['place'] : '';
if (empty($place)) {
    echo json_encode(['error' => 'Place name required']);
    exit;
}

// Sample photos
$photos = [
    [
        'id' => '1',
        'title' => $place,
        'url_sq' => 'https://via.placeholder.com/150/1E3A6F/FFFFFF?text=' . urlencode($place),
        'url_t' => 'https://via.placeholder.com/150/1E3A6F/FFFFFF?text=' . urlencode($place),
        'owner' => 'sample'
    ],
    [
        'id' => '2',
        'title' => $place . ' View',
        'url_sq' => 'https://via.placeholder.com/150/D52B1E/FFFFFF?text=View',
        'url_t' => 'https://via.placeholder.com/150/D52B1E/FFFFFF?text=View',
        'owner' => 'sample'
    ],
    [
        'id' => '3',
        'title' => $place . ' Details',
        'url_sq' => 'https://via.placeholder.com/150/FFD700/000000?text=Details',
        'url_t' => 'https://via.placeholder.com/150/FFD700/000000?text=Details',
        'owner' => 'sample'
    ],
    [
        'id' => '4',
        'title' => $place . ' Landmark',
        'url_sq' => 'https://via.placeholder.com/150/1E3A6F/FFFFFF?text=Landmark',
        'url_t' => 'https://via.placeholder.com/150/1E3A6F/FFFFFF?text=Landmark',
        'owner' => 'sample'
    ]
];

echo json_encode([
    'source' => 'sample',
    'photos' => $photos
]);

?>