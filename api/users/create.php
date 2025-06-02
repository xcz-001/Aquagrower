<?php
header("Content-Type: application/json");
require '../db.php';

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['username'], $data['password'], $data['role'])) {
    http_response_code(400);
    echo json_encode(["error" => "Missing fields"]);
    exit;
}

$username = $data['username'];

// Check if username already exists
$stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
$stmt->execute([$username]);
if ($stmt->fetch()) {
    http_response_code(409); // Conflict
    echo json_encode(["error" => "Username already exists"]);
    exit;
}

$hash = password_hash($data['password'], PASSWORD_BCRYPT);

try {
    $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
    $stmt->execute([$data['username'], $hash, $data['role']]);
    http_response_code(201);
    echo json_encode(["success" => true]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["error" => $e->getMessage()]);
}
// This code handles user creation, expecting a JSON payload with username, password, and role.
// It hashes the password and inserts the new user into the database.
?>