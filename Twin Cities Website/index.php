<?php

require_once 'includes/db_connect.php'

$cities = $pdo->query("SELECT City_ID, Name, Country, Population, Currency FROM city") -> fetchall();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Twin Cities Assigment</title>
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
        <h1>Twin Cities: London & New York</h1>
        
        <div class="city-cards">
            <?php foreach ($cities as $city): ?>
            <div class="city-card">
                <h2><?= htmlspecialchars($city['Name']) ?></h2>
                <p><strong>Country:</strong> <?= htmlspecialchars($city['Country']) ?></p>
                <p><strong>Population:</strong> <?= number_format($city['Population']) ?></p>
                <p><strong>Currency:</strong> <?= htmlspecialchars($city['Currency']) ?></p>
                <a href="<?= strtolower($city['Name']) == 'london' ? 'london.php' : 'nyc.php' ?>" class="btn">Explore</a>
            </div>
            <?php endforeach; ?>
        </div>
    </main>
</body>
</html>