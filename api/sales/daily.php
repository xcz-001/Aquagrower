<?php
header("Content-Type: application/json");
require '../db.php';

try {
    $stmt = $pdo->prepare("SELECT * FROM sales WHERE DATE(created_at) = CURDATE()");
    $stmt->execute();
    $sales = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($sales);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
