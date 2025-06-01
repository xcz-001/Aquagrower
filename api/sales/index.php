<?php
header("Content-Type: application/json");
require '../db.php';

try {
    $stmt = $pdo->query("SELECT * FROM sales ORDER BY created_at DESC");
    $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($sales);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
// This code retrieves all sales records from the database and returns them as a JSON array.