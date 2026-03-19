<?php 

include_once 'db_connect.php'; 

?>
<!DOCTYPE html>
<html>
<head>
    <title>New York City's Page</title>
    <!-- CSS add-ons -->
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Javascript add-ons -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="assets/main.js"></script>
    <!-- Flickr -->
    <script src="api/flickr.php?js=1"></script>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <!-- Title in top-left corner -->
            <a href="index.php" class="logo">Twin Cities</a>
            <ul class="nav-menu">
                <!-- Buttons at the top-right corner, easily reachable -->
                <li><a href="index.php">Home</a></li>
                <li><a href="london.php">London</a></li>
                <li><a href="nyc.php">New York</a></li>
                <li><a href="rss.php">RSS</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <!-- Gives the name of the city and its country. -->
        <h1>New York City, United States of America</h1>
        
        <section class="maps-section">
            <!-- Generates the map. Uses the id format so that javascript can host it -->
            <h2>City Map</h2>
            <div id="city-map" class="map-container" data-lat="40.7128" data-lon="-74.0060" data-city="nyc"></div>
        </section>

        <section class="weather-section">
            <!-- Gives the weather forecast, the id does the same thing. It brings it over from javascript -->
            <h2>Weather Forecast</h2>
            <div class="weather-container" id="weather-display"></div>
        </section>

        <section class="places-section">
            <!-- This whole section dedicates a large part to the places of interest. -->
            <h2>Places of Interest</h2>
            <div class="places-grid">
                <?php if ($pdo): ?>
                    <?php
                    $places = $pdo->prepare("SELECT * FROM place_of_interest WHERE City_ID = 2");
                    $places->execute();
                    foreach ($places as $place): 
                    ?>
                    <!-- To see the description for the places of interest, you first need to press on the name of that said location for it to appear. -->
                    <div class="place-card" onclick="toggleDetails(this)">
                        <h3><?= $place['NameofLocation'] ?></h3>
                        <!-- Once pressed, this will be the given information -->
                        <p><strong>Location:</strong> <?= $place['StreetName'] ?></p>
                        <p><strong>Postcode:</strong> <?= $place['Postcode'] ?></p>
                        
                        <div class="place-details" style="display: none;">
                            <p><strong>Description:</strong> <?= $place['Place_Description'] ?></p>
                            <p><strong>Coordinates:</strong> <?= $place['Lat'] ?>, <?= $place['Lon'] ?></p>
                            
                            <!-- Flickr photos container, at the moment is comented out as it's not needed anymore -->
                            <!-- <div id="flickr-<?= $place['Place_of_InterestID'] ?>" class="flickr-photos"></div>
                            <script>
                                // Load photos when the page loads
                                if (typeof loadFlickrPhotos === 'function') {
                                    loadFlickrPhotos('<?= $place['NameofLocation'] ?>', 'flickr-<?= $place['Place_of_InterestID'] ?>');
                                }
                            </script> -->
                        </div>
                    </div>
                    <!-- Ends each loop that was happening while outside of the website's page -->
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>