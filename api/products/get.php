<?php
header("Content-Type: application/json");
require '../db.php';

$barcode = $_GET['barcode'] ?? null;

if (!$barcode) {
    http_response_code(400);
    echo json_encode(["error" => "Barcode required"]);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT * FROM products WHERE barcode = ?");
    $stmt->execute([$barcode]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    echo json_encode($product ?: []);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
// This code retrieves a product by its barcode from the database.