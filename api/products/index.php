<?php
header("Content-Type: application/json");
require '../db.php';

try {
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    http_response_code(200);
    // Set the response code to 200 OK
    echo json_encode($products);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
// This code retrieves all products from the database and returns them as a JSON array.
// It uses a prepared statement to prevent SQL injection and handles any potential database errors.