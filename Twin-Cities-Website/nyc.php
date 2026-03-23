<?php 
include_once 'db_connect.php'; 
?>
<!DOCTYPE html>
<html>
<head>
    <title>New York City's Page</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="assets/main.js"></script>
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
        <h1>New York City, United States of America</h1>
        
        <section class="maps-section">
            <h2>City Map</h2>
            <div id="city-map" class="map-container" data-lat="40.7128" data-lon="-74.0060" data-city="nyc"></div>
        </section>

        <section class="weather-section">
            <h2>Weather Forecast</h2>
            <div class="weather-container" id="weather-display"></div>
        </section>

        <section class="places-section">
            <h2>Places of Interest</h2>
            <div class="places-grid">
                <?php if ($pdo): ?>
                    <?php
                    $places = $pdo->prepare("SELECT * FROM place_of_interest WHERE City_ID = 2");
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
                            
                            <!-- Flickr photos container -->
                            <div id="flickr-<?= $place['Place_of_InterestID'] ?>" class="flickr-photos" data-place="<?= $place['NameofLocation'] ?>"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <script>
        // This function makes it so that it finds and displays the weather from assets/main.js, same as index.php but less advanced and quicker.
        window.addEventListener('load', function() {
            if (typeof loadWeatherForCity === 'function') {
                loadWeatherForCity('New York', 'weather-display');
            } else {
                fetch('api/weather.php?city=nyc')
                    .then(function(response) { return response.json(); })
                    .then(function(data) {
                        if (data.temp) {
                            var container = document.getElementById('weather-display');
                            var html = '<div class="weather-card">';
                            html += '<div class="weather-temp">' + data.temp + '</div>';
                            html += '<div class="weather-condition">' + data.conditions + '</div>';
                            html += '<div class="weather-details">';
                            html += '<div>💧 Humidity: ' + data.humidity + '</div>';
                            html += '<div>🌬️ Wind: ' + data.wind + '</div>';
                            html += '</div>';
                            html += '</div>';
                            container.innerHTML = html;
                        }
                    });
            }
        });
    </script>
</body>
</html>