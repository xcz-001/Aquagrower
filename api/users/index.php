<?php
header("Content-Type: application/json");
require '../db.php';

try {
    $stmt = $pdo->query("SELECT * FROM users");
    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
// This code retrieves all users from the database and returns them as a JSON array.
// It uses a prepared statement to prevent SQL injection and handles any potential database errors.