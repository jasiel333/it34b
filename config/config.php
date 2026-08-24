<?php
session_start();

require_once(__DIR__ . '/functions.php');
define('base_url', 'http://localhost/it34_b/');

define('DB_HOST', 'localhost');
define('DB_NAME', 'it34_b');
define('DB_USER', 'root');
define('DB_PASS', '');

try{
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" .DB_NAME, DB_USER, DB_PASS,
   [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

 }catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
