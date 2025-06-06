<?php
header('Content-Type: application/json');
require '../db.php';

if (
    !isset($_POST['id']) ||
    !isset($_POST['barcode']) ||
    !isset($_POST['name']) ||
    !isset($_POST['description']) ||
    !isset($_POST['qty']) ||
    !isset($_POST['price'])
) {
    http_response_code(400);
    echo json_encode(["error" => "Missing fields"]);
    exit;
}

$id = $_POST['id'];
$barcode = $_POST['barcode'];
$name = $_POST['name'];
$description = $_POST['description'];
$qty = (int)$_POST['qty'];
$price = (float)$_POST['price'];
$image_path = null;

// Handle image upload if provided
if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
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
}

//  Build query depending on image presence
if ($image_path) {
    $stmt = $pdo->prepare("UPDATE products SET barcode=?, name=?, description=?, quantity=?, price=?, filepath=? WHERE id=?");
    $stmt->execute([$barcode, $name, $description, $qty, $price, $image_path, $id]);
} else {
    $stmt = $pdo->prepare("UPDATE products SET barcode=?, name=?, description=?, quantity=?, price=? WHERE id=?");
    $stmt->execute([$barcode, $name, $description, $qty, $price, $id]);
}

http_response_code(200);
echo json_encode(["success" => true]);
// This code updates a product's details in the database, including handling an optional image upload.
