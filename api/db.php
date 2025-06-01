<?php
// Database connection config
$host = 'localhost';
$db = 'aquagrower'; // Change to your database name
$user = 'root';
$pass = ''; // set your MySQL password if needed

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("DB C failed: " . $e->getMessage());
}
?>
