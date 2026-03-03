<?php

$db_host = 'localhost';
$db_name = 'twin_cities';
$db_user = 'root';
$db_pass = '';

try {
    $dsn = "mysql:host=$db_host;dbname=$db_name;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => pdo::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    $pdo = new PDO($dsn, $db_user, $db_pass, $options);

} catch (PDOException $e) {
    error_log("Database Connection failed: " . $e->getMessage());
    die("Try again later")
}

?>