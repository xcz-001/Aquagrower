<?php
header("Content-Type: application/json");
require '../db.php';

$sale_id = $_GET['id'] ?? null;

if (!$sale_id) {
    http_response_code(400);
    echo json_encode(["error" => "Missing sale ID"]);
    exit;
}

try {
    // Get sale info
    $stmt = $pdo->prepare("SELECT * FROM sales WHERE id = ?");
    $stmt->execute([$sale_id]);
    $sale = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$sale) {
        http_response_code(404);
        echo json_encode(["error" => "Sale not found"]);
        exit;
    }

    // Get sale items
    $stmt = $pdo->prepare("
        SELECT si.*, p.description, p.barcode
        FROM sales_items si
        JOIN products p ON si.product_id = p.id
        WHERE sale_id = ?
    ");
    $stmt->execute([$sale_id]);
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["sale" => $sale, "items" => $items]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
// This code retrieves a specific sale by its ID, including the sale details and associated items.
// It expects a sale ID as a query parameter and returns the sale information along with the items in JSON format.