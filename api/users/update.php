<?php
header("Content-Type: application/json");
require '../db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['id'], $data['username'])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing ID or username"]);
    exit;
}

$updatePassword = isset($data['password']) && !empty($data['password']);
$hash = $updatePassword ? password_hash($data['password'], PASSWORD_BCRYPT) : null;

try {
    if ($updatePassword) {
        $stmt = $pdo->prepare("UPDATE users SET username = ?, password = ? WHERE id = ?");
        $stmt->execute([$data['username'], $hash, $data['id']]);
    } else {
        $stmt = $pdo->prepare("UPDATE users SET username = ? WHERE id = ?");
        $stmt->execute([$data['username'], $data['id']]);
    }

    echo json_encode(["success" => true]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
// This code handles user updates, allowing for username and optional password changes.
// It checks for the presence of an ID and username, and hashes the password if provided.