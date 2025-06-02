<?php
header("Content-Type: application/json");
require '../db.php';

try {
    $stmt = $pdo->query("
        SELECT
            s.user_id AS id,                      -- Sale ID
            p.name AS product,               -- Product name
            si.quantity AS qty,              -- Quantity
            si.price * si.quantity AS total, -- Total per item line
            s.created_at AS date             -- Sale date
        FROM sales s
        JOIN sales_items si ON s.id = si.sale_id
        JOIN products p ON si.product_id = p.id
        ORDER BY s.created_at DESC
    ");

    $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($sales);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
