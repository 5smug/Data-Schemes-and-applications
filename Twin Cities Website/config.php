<?php

// Define the database. Finds the xampp dabatase after the name and connects to it on local host
define('DB_HOST', 'localhost');
define('DB_NAME', 'tuesday_assigment');
define('DB_USER', 'root');
define('DB_PASS', '');

// This are used for the actual key. This key is needed for weather.php so that the code can view the weather.
define('WEATHER_API_KEY', 'f53a0c93df620d12354925b7bf0313c0');
define('WEATHER_API_URL', 'https://api.openweathermap.org/data/2.5/weather');

// The default timezone is made for city_id: 1, which happens to be London.
date_default_timezone_set('Europe/London'); 

try {
    // Tries the connection towards the database
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        // Executes
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    // Summons and executes the connection
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

} catch (PDOException $e) {
    // If database isn't found or can't be connected, get why that is
    error_log("Database Connection failed: " . $e->getMessage());
    die("Try again later");
}

?>