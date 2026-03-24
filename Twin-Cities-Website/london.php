<?php 

// This was added so that the file can connect itself to the localhost database to input or output information
include_once 'db_connect.php'; 

?>

<!DOCTYPE html>
<html>
<head>
    <title>London's Page</title>
    <!-- Connects the style.css from asset/style.css -->
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Connects the javascript from asset/main.js and flickr.php for API functionality -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="assets/main.js"></script>
    <!-- This is new compared to the index.php layout. On this page you can view the places of interest of chosen area -->
    <script src="api/flickr.php?js=1"></script>
</head>
<body>
    <!-- Creates the view of the buttons and logo in the top-right and top-left of the screen -->
    <nav class="navbar">
        <div class="container">
            <!-- The text "Twin Cities" is made alone in the top-left side of the screen -->
            <a href="index.php" class="logo">Twin Cities</a>
            <!-- Creates a place for buttons to be put -->
            <ul class="nav-menu">
                <!-- The buttons. Instead of using the button function from html, decided to use this so they can be changed better for css -->
                <li><a href="index.php">Home</a></li>
                <li><a href="london.php">London</a></li>
                <li><a href="nyc.php">New York</a></li>
                <li><a href="rss.php">RSS</a></li>
            </ul>
        </div>
    </nav>

    <!-- Main title container -->
    <main class="container">
        <h1>London, United Kingdom</h1>
        
        <!-- This shows the section for the map (you can use markers), and the heading -->
        <section class="maps-section">
            <h2>City Map</h2>
            <!-- Display of map with data attributes for London coordinates and city identifier -->
            <div id="city-map" class="map-container" data-lat="51.5074" data-lon="-0.1278" data-city="london"></div>
        </section>

        <!-- The entire weather section, information from main.js and weather.php -->
        <section class="weather-section">
            <!-- Basic white heading -->
            <h2>Weather Forecast</h2>
            <!-- Shows the weather for London, the script for it is shown in weather.php and below -->
            <div class="weather-container" id="weather-display"></div>
        </section>

        <!-- This section shown and gatheres information from the database using flickr -->
        <section class="places-section">
            <h2>Places of Interest</h2>
            <!-- Grid layout for displaying place cards, more on style.css about how this works -->
            <div class="places-grid">
                <?php 
                if ($pdo): 
                ?>
                    <?php
                    // Query to fetch all places of interest for London, shown in tuesday_assigment.sql and database
                    $places = $pdo->prepare("SELECT * FROM place_of_interest WHERE City_ID = 1");
                    $places->execute();
                    foreach ($places as $place): 
                    ?>
                    <!-- This function and style make it so that the information show/hides itself once it has been clicked -->
                    <div class="place-card" onclick="toggleDetails(this)">
                        <h3><?= $place['NameofLocation'] ?></h3>
                        <p><strong>Location:</strong> <?= $place['StreetName'] ?></p>
                        <p><strong>Postcode:</strong> <?= $place['Postcode'] ?></p>
                        
                        <!-- This place only appears once you've clicked on the name of the place of interest -->
                        <div class="place-details" style="display: none;">
                            <p><strong>Description:</strong> <?= $place['Place_Description'] ?></p>
                            <p><strong>Coordinates:</strong> <?= $place['Lat'] ?>, <?= $place['Lon'] ?></p>
                            
                            <!-- This fetches and uses the function from the flickr.php file, adding photos right below the actual description of the places -->
                            <div id="flickr-<?= $place['Place_of_InterestID'] ?>" class="flickr-photos" data-place="<?= $place['NameofLocation'] ?>"></div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </section>
    </main>

    <!-- The last lines of the code show the weather.php API reading data, and fetching the usefull information for showing the weather -->
    <script>
        // This function makes it so that it finds and displays the weather from assets/main.js, same as index.php but less advanced and quicker
        window.addEventListener('load', function() {
            // Below is the information fetched for London weather
            fetch('api/weather.php?city=london')
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    if (data.temp) {
                        var container = document.getElementById('weather-display');
                        // This is the layout that's also shown in main.js, has the same functions as it
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
        });
    </script>
</body>
</html>