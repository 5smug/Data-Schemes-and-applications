<?php include_once 'db_connect.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Twin Cities: London & New York</title>
    <!-- CSS -->
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- JS -->
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
        
        <div class="city-cards">
            <?php if ($pdo): ?>
                <?php
                $cities = $pdo->query("SELECT * FROM city")->fetchAll();
                foreach ($cities as $city): 
                ?>
                <div class="city-card">
                    <h2><?= $city['Name'] ?>, <?= $city['Country'] ?></h2>
                    <p><strong>Population:</strong> <?= number_format($city['Population']) ?></p>
                    <p><strong>Currency:</strong> <?= $city['Currency'] ?></p>
                    <p><strong>Weather:</strong> <?= $city['Weather'] ?></p>
                    <a href="<?= strtolower($city['Name']) == 'london' ? 'london.php' : 'nyc.php' ?>" class="btn">Explore</a>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="city-card">
                    <h2>London, United Kingdom</h2>
                    <p><strong>Population:</strong> 8,982,000</p>
                    <p><strong>Currency:</strong> Pounds (£)</p>
                    <p><strong>Weather:</strong> Partly cloudy</p>
                    <a href="london.php" class="btn">Explore</a>
                </div>
                <div class="city-card">
                    <h2>New York City, United States</h2>
                    <p><strong>Population:</strong> 8,419,000</p>
                    <p><strong>Currency:</strong> Dollars ($)</p>
                    <p><strong>Weather:</strong> Sunny</p>
                    <a href="nyc.php" class="btn">Explore</a>
                </div>
            <?php endif; ?>
        </div>

        <section class="maps-section">
            <h2>City Maps</h2>
            <div id="london-map" class="map-container"></div>
            <div id="nyc-map" class="map-container"></div>
        </section>
    </main>
</body>
</html>