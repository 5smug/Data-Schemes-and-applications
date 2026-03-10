<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'tuesday_assigment');
define('DB_USER', 'root');
define('DB_PASS', '');
define('WEATHER_API_KEY', 'f53a0c93df620d12354925b7bf0313c0');
define('WEATHER_API_URL', 'https://api.openweathermap.org/data/2.5/weather');
define('FLICKR_API_KEY', 'your_key_here');
date_default_timezone_set('Europe/London'); 

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