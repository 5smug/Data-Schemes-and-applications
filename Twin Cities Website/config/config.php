<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'twin_cities');
define('DB_USER', 'root');
define('DB_PASS', '');

define('WEATHER_API_KEY', 'API, we need to create it, in lesson, to do later.');
define('WEATHER_API_URL', 'https://api.openweathermap.org/data/2.5/weather');
define('MAP_PROVIDER', 'openstreetmap');

define('APP_NAME', 'Twin Cities');
define('APP_VERSION', '1.0.0');
define('APP_URL', 'http://localhost/twin-cities-website');
define('DEFAULT_CITY_ID', 1);
define('DEFAULT_CITY_NAME', 'London');
define('DEFAULT_LAT', 51.5074);
define('DEFAULT_LON', -0.1278);
date_default_timezone_set('Europe/London');

define('BASE_PATH', dirname(__DIR__) . '/');
define('INCLUDES_PATH', BASE_PATH . 'includes/');
define('ASSETS_PATH', BASE_PATH . 'assets/');

?>