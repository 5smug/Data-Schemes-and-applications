<?php
session_start();

required_once 'config/config.php';
required_once 'includes/db_connect.php';
required_once 'includes/functions.php';


try {
    $stmt = $pdo->query("SELECT * FROM city ORDER BY Name")
    $cities = $stmt->fetchall(PDO::FETCH_ASSOC)
} catch (PDOException $e) {
    error_log("Database error: " . $e.->getMessage());
    $cities - [];
}

// Below is going to be title of the page and just usual HTML
$pagetitle = "London & New York: Twin Cities";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Fonts and others -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title is shown above -->
    <title><?php echo $pageTitle; ?></title>
    <!-- Css -->
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <!-- Js -->
    <script src="assets/main.js"></script>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="index.php">🏢 Twin Cities</a>
            <ul class="nav-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="cities.php">Cities</a></li>
                <li><a href="rss/feed.php">RSS Feed</a></li>
            </ul>
        </div>
    </nav>

    <div class="city-selector">
        <?php foreach ($cities as $city): ?>
            <button class="city-btn" data-city-id="<?php echo $city['City_ID']; ?>">
                <?php eho htmlspecialchars($city['Name']); ?>
            </button>
        <php endforeach; ?>
    </div>

    <section class="maps-section">
        <h2>City maps</h2>
        <div class="map-container" id="london-map"></div>
        <div class="map-container" id="nyc-map"></div>
    </section>

    <section class="weather-section">
        <h2>Weather</h2>
        <div class="map-container" id="london-weather"></div>
        <div class="map-container" id="nyc-weather"></div>
    </section>

    <section class="places-preview">
        <h2>Featured Places of Interest</h2>
        <div class="places-grid" id="featured-places"></div>
    </section>

    <footer class="footer">
        <div class="footer">
            <p>&copy <?php echo date('Y'); ?> Twin Cities Project</p>
        </div>
    </footer>

    <script>
        const citiesData = <?php echo json_encode($cities); ?>;

        document.addEventListener('DOMContentLoaded', function() {
            initializeMaps();
            loadWeather();
            loadFeaturedPlaces();
        })
    </script>
</body>
</html>