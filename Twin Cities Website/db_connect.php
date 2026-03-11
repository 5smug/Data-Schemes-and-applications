<?php

// Uses config.php to find the information for the database
include_once 'config.php'; 

// No need for the name, host, or other information as they are already specified in config.php
$db_host = DB_HOST;
$db_name = DB_NAME;
$db_user = DB_USER;
$db_pass = DB_PASS;

try {
    $pdo = new PDO(
        // After the information gets gathered from config.php, the program connects to the database.
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    // Silent fai, the page will start without the database.
    $pdo = null;
}

?>