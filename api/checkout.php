<?php
session_start();
header("Content-Type: application/json");
require 'db.php';

$user_id = $_POST['user_id'] ?? null; // or from session if using auth
$cart = $_SESSION['cart'] ?? [];

if (!$user_id || empty($cart)) {
    http_response_code(400);
    echo json_encode(["error" => "Missing user_id or empty cart"]);
    exit;
}

try {
    $pdo->beginTransaction();

    // Calculate total
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['quantity'] * $item['price'];
    }

    // Insert sale
    $stmt = $pdo->prepare("INSERT INTO sales (user_id, total) VALUES (?, ?)");
    $stmt->execute([$user_id, $total]);
    $sale_id = $pdo->lastInsertId();

    // Insert sale items + update stock
    $stmtItem = $pdo->prepare("INSERT INTO sales_items (sale_id, product_id, quantity, price) VALUES (?, ?, ?, ?)");
    $stmtStock = $pdo->prepare("UPDATE products SET quantity = quantity - ? WHERE id = ?");

    foreach ($cart as $item) {
        $stmtItem->execute([$sale_id, $item['id'], $item['quantity'], $item['price']]);
        $stmtStock->execute([$item['quantity'], $item['id']]);
    }

    $pdo->commit();
    $_SESSION['cart'] = []; // Clear cart
    echo json_encode(["success" => true, "sale_id" => $sale_id]);
} catch (PDOException $e) {
    $pdo->rollBack();
    http_response_code(500);
    echo json_encode(["error" => "Checkout failed: " . $e->getMessage()]);
}
// This code handles the checkout process, inserting a sale and updating stock quantities.
// It expects a user ID and a cart stored in the session, calculates the total, and inserts the sale and sale items into the database.