<?php

// Everything below was used to create the localhost for our database.
define('DB_HOST', 'localhost');
define('DB_NAME', 'tuesday_assigment');
define('DB_USER', 'root');
// This was left empty as we do not use a password
define('DB_PASS', '');

// Everything to do with weather_api. Gets called over from here to the weather.php file.
define('WEATHER_API_KEY', 'f53a0c93df620d12354925b7bf0313c0');
define('WEATHER_API_URL', 'https://api.openweathermap.org/data/2.5/weather');
// We do not own a FLCIKR_API_KEY but at what point we were thinking about getting one.
define('FLICKR_API_KEY', '');
// As City_ID = 1 is London, we decided to use that default timezone
date_default_timezone_set('Europe/London'); 

try { // Sets the login using the details above.
    $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);

} catch (PDOException $e) {
    // If there is an error, it reports it in the console and says whatever the error message says.
    error_log("Database Connection failed: " . $e->getMessage());
    // If it does fail, this makes it so that the connectiong stops and gives a message back to the user.
    die("Try again later");
}

?>