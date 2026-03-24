<?php 

// This was added so that the file can connect itself to the localhost database to input or output information
include_once 'db_connect.php'; 

?>

<!DOCTYPE html>
<html>
<head>
    <title>Twin Cities Website</title>
    <!-- Connects the style.css from asset/style.css -->
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Connects the javascrip from asset/main.js -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="assets/main.js"></script>
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
        <h1>London & New York</h1>
        
        <!-- This shows the section for the maps (you can use markers), and the heading  -->
        <section class="maps-section">
            <h2>City Maps</h2>
            <!-- Display of maps -->
            <div id="london-map" class="map-container"></div>
            <div id="nyc-map" class="map-container"></div>
        </section>

        <!-- The entire weather section, information from main.js and weather.php -->
        <section class="weather-section">
            <!-- Basic white heading -->
            <h2>Current Weather</h2>
            <!-- Shows the weather for both of the cities, the script for it is shown in weather.php and below -->
            <div class="weather-container" id="weather-london"></div>
            <div class="weather-container" id="weather-nyc"></div>
        </section>
    </main>

    <!-- The last lines of the code show the weather.php API reading data, and fetching the usefull information for showing the weather -->
    <script>
        // This function makes it so that it finds and displays the weather from assets/main.js
        document.addEventListener('DOMContentLoaded', function() {
            // Below is the information fetched for London weather. Appears on london.php as well
            fetch('api/weather.php?city=london')
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    if (data.temp) {
                        // This is the layout that's also shown in main.js, has the same functions as it
                        var html = '<div class="weather-card">';
                        html += '<div class="weather-temp">' + data.temp + '</div>';
                        html += '<div class="weather-condition">' + data.conditions + '</div>';
                        html += '<div class="weather-details">';
                        html += '<div>💧 Humidity: ' + data.humidity + '</div>';
                        html += '<div>🌬️ Wind: ' + data.wind + '</div>';
                        html += '</div>';
                        html += '</div>';
                        document.getElementById('weather-london').innerHTML = html;
                    }
                });

            // Below is the information fetched for NYC weather. Appears on nyc.php as well
            fetch('api/weather.php?city=nyc')
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    if (data.temp) {
                        // This is the layout that's also shown in main.js, has the same functions as it
                        var html = '<div class="weather-card">';
                        html += '<div class="weather-temp">' + data.temp + '</div>';
                        html += '<div class="weather-condition">' + data.conditions + '</div>';
                        html += '<div class="weather-details">';
                        html += '<div>💧 Humidity: ' + data.humidity + '</div>';
                        html += '<div>🌬️ Wind: ' + data.wind + '</div>';
                        html += '</div>';
                        html += '</div>';
                        document.getElementById('weather-nyc').innerHTML = html;
                    }
                });
        });
    </script>
</body>
</html>