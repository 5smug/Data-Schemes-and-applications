<?php

// Includes config to bring over the details for the localhost name, user, etc.
include_once 'config.php'; 
$db_host = DB_HOST;
$db_name = DB_NAME;
$db_user = DB_USER;
$db_pass = DB_PASS;

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    $pdo = null;
}

// In this part of the code, it makes it so that if XAMPP isn't opened, the page fails to load completly.

// http://localhost/Tuesday/Twin%20Cities%20Website/index.php

?>