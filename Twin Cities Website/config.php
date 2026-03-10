<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'tuesday_assigment');
define('DB_USER', 'root');
define('DB_PASS', '');

define('WEATHER_API_KEY', 'f53a0c93df620d12354925b7bf0313c0'); // Do not change
define('WEATHER_API_URL', 'https://api.openweathermap.org/data/2.5/weather'); 
define('MAP_PROVIDER', 'openstreetmap');

define('APP_NAME', 'Twin Cities');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'http://localhost/twin-cities-website');

define('FLICKR_API_KEY', 'your_api_key_here');
define('FLICKR_API_SECRET', 'your_api_secret_here');
define('FLICKR_CACHE_EXPIRY', 86400); // 24 hours in seconds

define('BASE_PATH', dirname(__DIR__) . '/');
define('INCLUDES_PATH', BASE_PATH . 'includes/');
define('ASSETS_PATH', BASE_PATH . 'assets/');

try {
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

} catch (PDOException $e) {
    error_log("Database Connection failed: " . $e->getMessage());
    die("Try again later");
}

?>