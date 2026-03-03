<?php
session_start();

require_once 'includes/db_connect.php';
require_once 'includes/functions.php';

$city_id = isset($_GET['id']) ? (int)$_GET['id'] : 1;

$stmt = $pdo->prepare("SELECT * FROM city WHERE City_ID = ?");
$stmt->execute([$city_id]);
$city = $stmt->fetch();

if (!$city) {
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM place_of_interest WHERE City_ID = ?");
$stmt->execute([$city_id]);
$places = $stmt->fetchAll();

$stmt = $pdo->prepare("SELECT * FROM news WHERE City_ID = ? ORDER BY Time DESC LIMIT 5");
$stmt->execute([$city_id]);
$news = $stmt->fetchAll();

$pageTitle = $city['Name'] . " - Twin Cities";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="index.php" class="logo">🌍 Twin Cities</a>
            <ul class="nav-menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="cities.php?id=1" class="<?php echo $city_id == 1 ? 'active' : ''; ?>">London</a></li>
                <li><a href="cities.php?id=2" class="<?php echo $city_id == 2 ? 'active' : ''; ?>">New York</a></li>
                <li><a href="rss/feed.php" target="_blank"><i class="fas fa-rss"></i> RSS</a></li>
            </ul>
        </div>
    </nav>

    <section class="city-hero" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('assets/images/<?php echo strtolower($city['Name']); ?>-hero.jpg');">
        <div class="container">
            <h1><?php echo htmlspecialchars($city['Name']); ?></h1>
            <p class="city-country"><?php echo htmlspecialchars($city['Country']); ?></p>
            <div class="city-stats">
                <div class="stat">
                    <i class="fas fa-users"></i>
                    <span><?php echo number_format($city['Population']); ?></span>
                    <small>Population</small>
                </div>
                <div class="stat">
                    <i class="fas fa-money-bill-wave"></i>
                    <span><?php echo htmlspecialchars($city['Currency']); ?></span>
                    <small>Currency</small>
                </div>
                <div class="stat">
                    <i class="fas fa-cloud-sun"></i>
                    <span><?php echo htmlspecialchars($city['Weather']); ?></span>
                    <small>Climate</small>
                </div>
            </div>
        </div>
    </section>

    <main class="container">
        <section class="map-section">
            <h2><i class="fas fa-map-marked-alt"></i> Map of <?php echo htmlspecialchars($city['Name']); ?></h2>
            <div id="city-map" class="city-map" data-lat="<?php echo $city['Lat']; ?>" data-lon="<?php echo $city['Lon']; ?>"data-name="<?php echo htmlspecialchars($city['Name']); ?>"></div>
        </section>
        <section class="places-section">
            <h2><i class="fas fa-landmark"></i> Places of Interest (<?php echo count($places); ?>)</h2>
            <div class="places-grid">
                <?php foreach ($places as $place): ?>
                <div class="place-card" data-place-id="<?php echo $place['Place_of_InterestID']; ?>">
                    <div class="place-image">
                        <img src="https://via.placeholder.com/300x200?text=<?php echo urlencode($place['NameofLocation']); ?>" alt="<?php echo htmlspecialchars($place['NameofLocation']); ?>">
                    </div>
                    <div class="place-details">
                        <h3><?php echo htmlspecialchars($place['NameofLocation']); ?></h3>
                        <p class="place-address">
                            <i class="fas fa-map-pin"></i> 
                            <?php echo htmlspecialchars($place['StreetName'] . ', ' . $place['Postcode']); ?>
                        </p>
                        <p class="place-description"><?php echo htmlspecialchars($place['Place_Description']); ?></p>
                        <a href="place.php?id=<?php echo $place['Place_of_InterestID']; ?>" class="btn btn-small">View Details</a>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>

        <?php if (!empty($news)): ?>
        <section class="news-section">
            <h2><i class="fas fa-newspaper"></i> Latest News</h2>
            <div class="news-list">
                <?php foreach ($news as $item): ?>
                <article class="news-item">
                    <h3><?php echo htmlspecialchars($item['Headline']); ?></h3>
                    <div class="news-meta">
                        <span><i class="fas fa-building"></i> <?php echo htmlspecialchars($item['Publisher']); ?></span>
                        <span><i class="fas fa-calendar"></i> <?php echo date('F j, Y', strtotime($item['Time'])); ?></span>
                    </div>
                    <p><?php echo htmlspecialchars(substr($item['Body'], 0, 150)) . '...'; ?></p>
                </article>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>
    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; <?php echo date('Y'); ?> Twin Cities Project</p>
        </div>
    </footer>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="assets/main.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initCityMap();
        });
    </script>
</body>
</html>