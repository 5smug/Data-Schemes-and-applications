<?php

include_once 'db_connect.php';

header("Content-Type: application/rss+xml; charset=UTF-8");

// Get all cities (london and New York City)
$cities = $pdo->query("SELECT * FROM city")->fetchAll();

// Get all places
$places = $pdo->query("SELECT * FROM place_of_interest")->fetchAll();

$placesByCity = [];
foreach ($places as $place) {
    $placesByCity[$place['City_ID']][] = $place;
}

echo '<?xml version="1.0" encoding="UTF-8"?>';

?>

<rss version="2.0">
    
<channel>

    <title>Twin Cities RSS Feed</title>
    <link>http://localhost:8000/Twin%20Cities%20Website/</link>
    <description>Information about our twin cities and places of interest</description>
    <language>en-gb</language>

<?php

// Create a loop that goes to both cities
foreach ($cities as $city) {
    echo "<item>";
    echo "<title>" . htmlspecialchars($city['Name']) . ", " . htmlspecialchars($city['Country']) . "</title>";
    echo "<description>" . htmlspecialchars($city['Weather']) . " | Population: " . number_format($city['Population']) . " | Currency: " . htmlspecialchars($city['Currency']) . "</description>";
    echo "<link>http://localhost:8000/Twin%20Cities%20Website/" . strtolower($city['Name']) . ".php</link>";
    echo "<guid>city-" . $city['City_ID'] . "</guid>";
    echo "<pubDate>" . date(DATE_RSS) . "</pubDate>";
    echo "</item>";
    
    // If this city has places of interest, create RSS items for each place in that city
    if (isset($placesByCity[$city['City_ID']])) {
        foreach ($placesByCity[$city['City_ID']] as $place) {
            echo "<item>";
            echo "<title>" . htmlspecialchars($place['NameofLocation']) . " - " . htmlspecialchars($city['Name']) . "</title>";
            echo "<description>" . htmlspecialchars($place['Place_Description']) . " | Location: " . htmlspecialchars($place['StreetName']) . ", " . htmlspecialchars($place['Postcode']) . " | Coordinates: " . $place['Lat'] . ", " . $place['Lon'] . "</description>";
            echo "<link>http://localhost:8000/Twin%20Cities%20Website/" . strtolower($city['Name']) . ".php</link>";
            echo "<guid>place-" . $place['Place_of_InterestID'] . "</guid>";
            echo "<pubDate>" . date(DATE_RSS) . "</pubDate>";
            echo "</item>";
        }
    }
}

?>

</channel>

</rss>