<?php
require_once '../config/config.php';
header('Content-Type: application/json');

// Check if database can register city_id function
if (!isset($_GET['city_id'])) {
    echo json_encode(['error' => 'City ID is required']);
    exit;
}

$city_id = intval($_GET['city_id']);

try {
    // Get all places for the specified city
    $stmt = $pdo->prepare("SELECT * FROM place_of_interest WHERE City_ID = ?");
    $stmt->execute([$city_id]);
    $places = $stmt->fetchAll();
    
    // This is only for the map, do not touch
    $formattedPlaces = [];
    foreach ($places as $place) {
        $formattedPlaces[] = [
            'id' => $place['Place_of_InterestID'],
            'name' => $place['NameofLocation'],
            'lat' => floatval($place['Lat']),
            'lon' => floatval($place['Lon']),
            'address' => $place['StreetName'],
            'postcode' => $place['Postcode'],
            'description' => $place['Place_Description']
        ];
    }
    
    echo json_encode($formattedPlaces, JSON_PRETTY_PRINT);
    
} catch (PDOException $e) {
    echo json_encode(['error' => 'Database error']);
}
?>