<?php

// Finds and connects to localhost via db_connect
include_once 'db_connect.php';

header("Content-Type: application/rss+xml; charset=UTF-8");

// Get both of the cities from the database
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
    <!-- Before it gives the actual information about the cities and its places of interest, it gives this little points of information -->
    <title>London & New York RSS Feed</title>
    <!-- The link is used to get back to index.php. You can use it directly -->
    <link>http://localhost/Tuesday/Twin-Cities-Website/index.php</link>
    <description>Information about our twin cities and places of interest</description>
    <language>en-gb</language>

    <!-- Below of this information will come the actual relevant rss-feedback -->
<?php

// The following code makes it so that both cities get put in a loop when it gathers information.
foreach ($cities as $city) {
    // Uses this type of regular day-to-day format. There are no \n, so all this code goes into one straight line.
    echo "<item>";
    echo "<title>" . htmlspecialchars($city['Name']) . ", " . htmlspecialchars($city['Country']) . "</title>";
    echo "<description>" . htmlspecialchars($city['Weather']) . " | Population: " . number_format($city['Population']) . " | Currency: " . htmlspecialchars($city['Currency']) . "</description>";
    echo "<link>http://localhost/Tuesday/Twin-Cities-Website" . strtolower($city['Name']) . ".php</link>";
    echo "<guid>city-" . $city['City_ID'] . "</guid>";
    echo "<pubDate>" . date(DATE_RSS) . "</pubDate>";
    echo "</item>";
    
    // If this city has places of interest, create RSS items for each place in that city.
    if (isset($placesByCity[$city['City_ID']])) {
        foreach ($placesByCity[$city['City_ID']] as $place) {
            // Uses this type of regular day-to-day format. There are no \n, so all this code goes into one straight line.
            echo "<item>";
            echo "<title>" . htmlspecialchars($place['NameofLocation']) . " - " . htmlspecialchars($city['Name']) . "</title>";
            echo "<description>" . htmlspecialchars($place['Place_Description']) . " | Location: " . htmlspecialchars($place['StreetName']) . ", " . htmlspecialchars($place['Postcode']) . " | Coordinates: " . $place['Lat'] . ", " . $place['Lon'] . "</description>";
            echo "<link>http://localhost/Tuesday/Twin-Cities-Website/index.php" . strtolower($city['Name']) . ".php</link>";
            echo "<guid>place-" . $place['Place_of_InterestID'] . "</guid>";
            echo "<pubDate>" . date(DATE_RSS) . "</pubDate>";
            echo "</item>";
        }
    }
}

?>

</channel>

</rss>