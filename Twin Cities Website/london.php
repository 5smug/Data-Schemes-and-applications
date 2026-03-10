<?php include_once 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>London Page</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="assets/main.js"></script>
    <!-- Flickr -->
    <script src="api/flickr.php?js=1"></script>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">Twin Cities</a>
            <ul class="nav-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="london.php">London</a></li>
                <li><a href="nyc.php">New York</a></li>
                <li><a href="rss.php">RSS</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <h1>London, United Kingdom</h1>
        
        <section class="maps-section">
            <h2>City Map</h2>
            <div id="city-map" class="map-container" data-lat="51.5074" data-lon="-0.1278" data-city="london"></div>
        </section>

        <section class="weather-section">
            <h2>Current Weather</h2>
            <div class="weather-container" id="weather-display"></div>
        </section>

        <section class="places-section">
            <h2>Places of Interest</h2>
            <div class="places-grid">
                <?php if ($pdo): ?>
                    <?php
                    $places = $pdo->prepare("SELECT * FROM place_of_interest WHERE City_ID = 1");
                    $places->execute();
                    foreach ($places as $place): 
                    ?>
                    <div class="place-card" onclick="toggleDetails(this)">
                        <h3><?= $place['NameofLocation'] ?></h3>
                        <p><strong>Location:</strong> <?= $place['StreetName'] ?></p>
                        <p><strong>Postcode:</strong> <?= $place['Postcode'] ?></p>
                        
                        <div class="place-details" style="display: none;">
                            <p><strong>Description:</strong> <?= $place['Place_Description'] ?></p>
                            <p><strong>Coordinates:</strong> <?= $place['Lat'] ?>, <?= $place['Lon'] ?></p>
                            
                            <!-- Flickr photos will load here -->
                            <div class="flickr-photos" data-place="<?= $place['NameofLocation'] ?>"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </main>
</body>
</html>