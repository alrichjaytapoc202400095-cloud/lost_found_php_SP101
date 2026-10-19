<?php
// Update these settings if your XAMPP MySQL credentials differ.
$host = '127.0.0.1';
$db   = 'lost_and_found';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    exit('Database connection failed. Start Apache and MySQL in XAMPP, import database.sql in phpMyAdmin, and check config.php.');
}
if (session_status() !== PHP_SESSION_ACTIVE) session_start();
