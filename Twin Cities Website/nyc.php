<?php
include 'includes/db_connect.php';

// Get NYC data (City_ID = 2)
$stmt = $pdo->prepare("SELECT * FROM city WHERE City_ID = 2");
$stmt->execute();
$city = $stmt->fetch();

// Get all NYC places
$stmt = $pdo->prepare("SELECT * FROM place_of_interest WHERE City_ID = 2");
$stmt->execute();
$places = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>New York City Preview</title>
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
        <h1>New York City, United States</h1>
        
        <!-- Map Section -->
        <section class="maps-section">
            <h2>City Map</h2>
            <div id="city-map" class="map-container" 
                 data-lat="<?= htmlspecialchars($city['Lat']) ?>" 
                 data-lon="<?= htmlspecialchars($city['Lon']) ?>"
                 data-city="nyc"></div>
        </section>

        <!-- Weather Section -->
        <section class="weather-section">
            <h2>Current Weather</h2>
            <div class="weather-container" id="weather-display"></div>
        </section>

        <!-- Places of Interest -->
        <section class="places-section">
            <h2>Places of Interest in NYC</h2>
            <div class="places-grid">
                <?php foreach ($places as $place): ?>
                <div class="place-card" onclick="toggleDetails(this)">
                    <h3><?= htmlspecialchars($place['NameofLocation']) ?></h3>
                    <p><strong>Location:</strong> <?= htmlspecialchars($place['StreetName']) ?></p>
                    <p><strong>Postcode:</strong> <?= htmlspecialchars($place['Postcode']) ?></p>
                    
                    <!-- Hidden details that show on click -->
                    <div class="place-details" style="display: none; margin-top: 15px; padding-top: 15px; border-top: 1px solid #eee;">
                        <p><strong>Description:</strong> <?= htmlspecialchars($place['Place_Description']) ?></p>
                        <p><strong>Coordinates:</strong> <?= $place['Lat'] ?>, <?= $place['Lon'] ?></p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <script>
        function toggleDetails(card) {
            const details = card.querySelector('.place-details');
            if (details.style.display === 'none' || details.style.display === '') {
                details.style.display = 'block';
            } else {
                details.style.display = 'none';
            }
        }
    </script>
</body>
</html>