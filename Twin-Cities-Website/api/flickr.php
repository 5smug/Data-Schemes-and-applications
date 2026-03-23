<?php

include_once '../config.php';

// This makes it so that if javascript is requested, the code below is outputed.
// This was created because when I tried to implemented it the main.js file, it was giving an error, and I kept trying to fix it but I ended up giving up for this.
// I used: https://www.w3resource.com/API/flickr/tutorial.php and https://www.youtube.com/watch?v=iGlaFjVxsvE to create an idea.
if (isset($_GET['js']) && $_GET['js'] == '1') {
    header('Content-Type: application/javascript');
    ?>
    function loadFlickrPhotos(placeName, containerId) {
        var container = document.getElementById(containerId);
        if (!container) return;
        
        container.innerHTML = '<div class="flickr-loading">📸 Loading photos...</div>';
        
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
    <?php
    exit;
}

header('Content-Type: application/json');

$place = isset($_GET['place']) ? $_GET['place'] : '';
if (empty($place)) {
    echo json_encode(['error' => 'Place name required']);
    exit;
}

// This code creates it so that it can read the png file. It reads if there is a blank space, a - or .png. 
// If it doesn't find it, it won't load, as is supposed to. It loads everything from line 75 to 86, if it can be found as the same name in images/
$filename = strtolower(str_replace(' ', '-', $place)) . '.png';
$specialCases = [
    'big ben' => 'Big ben.png',
    'buckingham palace' => 'Buckingham Palace.png',
    'central park' => 'Central Park.png',
    'empire state building' => 'Empire State Building.png',
    'london eye' => 'London Eye.png',
    'madison square garden' => 'Madison Square Garden.png',
    'natural history museum' => 'Natural History Museum.png',
    'statue of liberty' => 'Statue of Liberty.png',
    'the high line' => 'The High Line.png',
    'the metropolitan museum of art' => 'The Metropolitan Museum of Art.png',
    'tower bridge' => 'tower bridge.png',
    'tower of london' => 'Tower of London.png'
];

$placeLower = strtolower($place);
if (isset($specialCases[$placeLower])) {
    $filename = $specialCases[$placeLower];
}

// This is for the path, index.php and others couldn't find it normally so this had to be added.
$imagePath = 'images/' . $filename;

// This function below checks for the existence of the image. If this doesn't exist, it returns it.
$fullPath = __DIR__ . '/' . $imagePath;
if (file_exists($fullPath)) {
    // This part returns it
    $photos = [
        [
            'id' => '1',
            'title' => $place,
            'url_sq' => 'api/' . $imagePath,
            'owner' => 'local'
        ]
    ];
    echo json_encode([
        'source' => 'local',
        'photos' => $photos
    ]);
} else {
    // If no image was found, show empty tray
    echo json_encode([
        'source' => 'empty',
        'photos' => []
    ]);
}

?>