<?php
require '../db.php';
header("Content-Type: application/json");

$view = $_GET['view'] ?? 'all';

$sql = "
  SELECT
    s.id AS sale_id,
    s.user_id,
    s.total,
    s.created_at,
    si.quantity,
    si.price,
    p.name AS product_name
  FROM sales s
  JOIN sales_items si ON s.id = si.sale_id
  JOIN products p ON si.product_id = p.id
";

$params = [];
if ($view === 'today') {
  $sql .= " WHERE DATE(s.created_at) = CURDATE()";
}

$sql .= " ORDER BY s.id DESC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);

$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// group by sale
$grouped = [];
foreach ($rows as $row) {
  $saleId = $row['sale_id'];
  if (!isset($grouped[$saleId])) {
    $grouped[$saleId] = [
      'user_id' => $row['user_id'],
      'total' => (float)$row['total'],
      'created_at' => $row['created_at'],
      'items' => []
    ];
  }
  $grouped[$saleId]['items'][] = [
    'product' => $row['product_name'],
    'qty' => (int)$row['quantity']
  ];
}

echo json_encode(array_values($grouped));