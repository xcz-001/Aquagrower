<?php
require '../db.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

file_put_contents("debug.txt", print_r([
  "_POST" => $_POST,
  "_FILES" => $_FILES
], true));
if (
    !isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK ||
    empty($_POST['name']) ||
    empty($_POST['description']) ||
    !isset($_POST['qty']) ||
    !isset($_POST['price'])
) {
    http_response_code(400);
    echo json_encode(["error" => "Missing or invalid required fields"]);
    exit;
}

function generateBarcode($name, $description) {
    return substr(md5($name . $description), 0, 12); // 12-char barcode
}

$name = $_POST['name'];
$description = $_POST['description'];
$qty = (int)$_POST['qty'];
$price = (float)$_POST['price'];
$barcode = generateBarcode($name, $description);

// Save image
$target_dir = "../../uploads/";
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

$filename = uniqid() . "_" . basename($_FILES["image"]["name"]);
$target_file = $target_dir . $filename;

if (!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
    http_response_code(500);
    echo json_encode(["error" => "Failed to upload image"]);
    exit;
}

$image_path = "uploads/" . $filename;

$stmt = $pdo->prepare("INSERT INTO products (barcode, name, description, quantity, price, filepath) VALUES (?, ?, ?, ?, ?, ?)");
try {
    $stmt->execute([$barcode, $name, $description, $qty, $price, $image_path]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => "DB Error: " . $e->getMessage()]);
    exit;
}

http_response_code(201);
echo json_encode(["success" => true]);
?>
