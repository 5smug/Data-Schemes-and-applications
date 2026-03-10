<?php
require_once 'includes/db_connect.php';

// Get London data (City_ID = 1)
$city = $pdo->prepare("SELECT * FROM city WHERE City_ID = 1");
$city->execute();
$city = $city->fetch();

// Get all London places
$places = $pdo->prepare("SELECT * FROM place_of_interest WHERE City_ID = 1");
$places->execute();
$places = $places->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>London Preview</title>
    <!-- JSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="assets/main.js"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">Twin Cities</a>
            <ul class="nav-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="london.php">London</a></li>
                <li><a href="nyc.php">New York</a></li>
            </ul>
        </div>
    </nav>

    <main class="container">
        <h1>London, United Kingdom</h1>
        
        <section class="maps-section">
            <h2>City Map</h2>
            <div id="city-map" class="map-container" 
                 data-lat="<?= $city['Lat'] ?>" 
                 data-lon="<?= $city['Lon'] ?>"
                 data-city="london"></div>
        </section>

        <section class="weather-section">
            <h2>Weather</h2>
            <div class="weather-container" id="weather-display"></div>
        </section>

        <!-- Places of Interest -->
        <section class="places-section">
            <h2>Places of Interest</h2>
            <div class="places-grid">
                <?php foreach ($places as $place): ?>
                <div class="place-card" onclick="toggleDetails(this)">
                    <h3><?= htmlspecialchars($place['NameofLocation']) ?></h3>
                    <p><strong>Location:</strong> <?= htmlspecialchars($place['StreetName']) ?></p>
                    
                    <!-- Hidden details that show on click -->
                    <div class="place-details" style="display: none;">
                        <p><strong>Details:</strong> <?= htmlspecialchars($place['Place_Description']) ?></p>
                        <p><strong>Coordinates:</strong> <?= $place['Lat'] ?>, <?= $place['Lon'] ?></p>
                        <?php if (isset($place['Photo'])): ?>
                        <!-- <img src="data:image/jpeg;base64,<?= base64_encode($place['Photo']) ?>" alt="<?= $place['NameofLocation'] ?>"> -->
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <script>
        function toggleDetails(card) {
            const details = card.querySelector('.place-details');
            if (details.style.display === 'none') {
                details.style.display = 'block';
            } else {
                details.style.display = 'none';
            }
        }
    </script>
</body>
</html>