<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once(__DIR__ . '/../includes/activity-logger.php');

define('BASE_URL', 'http://localhost/it34b/');

define('DB_HOST', '127.0.0.1');
define('DB_PORT', '3307');
define('DB_NAME', 'it34b');
define('DB_USER', 'root');
define('DB_PASS', '');

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST .
        ";port=" . DB_PORT .
        ";dbname=" . DB_NAME,
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]
    );

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>