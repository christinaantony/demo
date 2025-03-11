<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
include '../company/db.php'; // Database connection

// Get input data
$data = json_decode(file_get_contents("php://input"), true);

// Validate required fields
if (empty($data['caption'])) {
    echo json_encode(["error" => "Caption is required"]);
    exit;
}

// Assign variables
$caption = $data['caption'];

// ✅ Insert status record
$stmt = $conn->prepare("INSERT INTO status_master (caption) VALUES (?)");
if (!$stmt) {
    echo json_encode(["error" => "SQL Prepare Failed: " . $conn->error]);
    exit;
}
$stmt->bind_param("s", $caption);

if ($stmt->execute()) {
    echo json_encode(["message" => "Status added successfully", "id" => $stmt->insert_id]);
} else {
    echo json_encode(["error" => "Failed to insert status: " . $stmt->error]);
}

// Close connections
$stmt->close();
$conn->close();
?>
