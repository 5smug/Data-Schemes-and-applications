<?php 

// Uses db_connect to find and connect to the database
include_once 'db_connect.php'; 

?>

<!DOCTYPE html>
<html>
<head>
    <title>Document</title>
    <!-- CSS add-ons -->
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Javascript add-ons -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="assets/main.js"></script>
</head>
<body>
    <!-- Top bar of the page -->
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">Twin Cities</a>
            <ul class="nav-menu">
                <!-- The buttons on the top-right of the page -->
                <li><a href="index.php">Home</a></li>
                <li><a href="london.php">London</a></li>
                <li><a href="nyc.php">New York</a></li>
                <li><a href="rss.php">RSS</a></li>
            </ul>
        </div>
    </nav>
    <!-- Shows that both London and New York City are shown below -->
    <main class="container">
        <h1>London & New York</h1>
        
        <!-- Section for the maps -->
        <section class="maps-section">
            <h2>City Maps</h2>
            <!-- Loads the map for both cities -->
            <div id="london-map" class="map-container"></div>
            <div id="nyc-map" class="map-container"></div>
        </section>

        <!-- Section for the weather -->
        <section class="weather-section">
            <h2>Current Weather</h2>
            <!-- Loads the weather for both cities -->
            <div class="weather-container" id="weather-london"></div>
            <div class="weather-container" id="weather-nyc"></div>
        </section>
    </main>
</body>
</html>