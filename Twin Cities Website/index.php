<?php 

include_once 'db_connect.php'; 

?>

<!DOCTYPE html>
<html>
<head>
    <title>London & New York - Twin Cities</title>
    <!-- CSS add-ons -->
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Javascript add-ons -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="assets/main.js"></script>
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
        <h1>London & New York</h1>
        
        <section class="maps-section">
            <h2>City Maps</h2>
            <div id="london-map" class="map-container"></div>
            <div id="nyc-map" class="map-container"></div>
        </section>

        <section class="weather-section">
            <h2>Current Weather</h2>
            <div class="weather-container" id="weather-london"></div>
            <div class="weather-container" id="weather-nyc"></div>
        </section>
    </main>
</body>
</html>