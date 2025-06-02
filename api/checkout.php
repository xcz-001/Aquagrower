<?php
session_start();
header("Content-Type: application/json");
require 'db.php';

$input = json_decode(file_get_contents("php://input"), true);
$user_id = $_SESSION['user_id'] ?? null;
$rawInput = file_get_contents("php://input");
$data = json_decode($rawInput, true);
$cart = $data['cart'] ?? [];

if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "Not logged in. Session user_id missing"]);
    http_response_code(401);
    exit;
}

if (!$user_id || empty($cart)) {
    http_response_code(400);
    echo json_encode(["error" => "Missing user_id or empty cart"]);
    exit;
}

try {
    $pdo->beginTransaction();

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['qty'] * $item['price'];
    }

    $stmt = $pdo->prepare("INSERT INTO sales (user_id, total) VALUES (?, ?)");
    $stmt->execute([$user_id, $total]);
    $sale_id = $pdo->lastInsertId();

    $stmtItem = $pdo->prepare("INSERT INTO sales_items (sale_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    $stmtStock = $pdo->prepare("UPDATE products SET quantity = quantity - ? WHERE id = ?");

    foreach ($cart as $item) {
        $stmtItem->execute([$sale_id, $item['id'], $item['qty'], $item['price']]);
        $stmtStock->execute([$item['qty'], $item['id']]);
    }

    $pdo->commit();
    echo json_encode(["success" => true, "sale_id" => $sale_id]);
} catch (PDOException $e) {
    $pdo->rollBack();
    http_response_code(500);
    echo json_encode(["error" => "Checkout failed: " . $e->getMessage()]);
}
