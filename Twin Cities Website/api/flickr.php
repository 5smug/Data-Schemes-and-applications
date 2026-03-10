<?php
include_once '../config.php';

// If JavaScript is requested
if (isset($_GET['js']) && $_GET['js'] == '1') {
    header('Content-Type: application/javascript');
    // The function is now in main.js, so we just output a comment
    echo '// Flickr widget loaded';
    exit;
}

// Return JSON data
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