<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include 'db.php'; // Database connection

// Get raw JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validate required fields
if (!isset($data['usertype']) || empty(trim($data['usertype']))) {
    echo json_encode(["error" => "Usertype is required"]);
    exit;
}

$usertype = trim($data['usertype']);

// Check if usertype already exists
$stmt = $conn->prepare("SELECT id FROM usertype_master WHERE usertype = ?");
$stmt->bind_param("s", $usertype);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows > 0) {
    echo json_encode(["error" => "Usertype already exists"]);
    exit;
}
$stmt->close();

// Generate new ID (MAX(id) + 1)
$result = $conn->query("SELECT MAX(id) AS max_id FROM usertype_master");
$row = $result->fetch_assoc();
$new_id = $row['max_id'] + 1;

// Insert into usertype_master table
$stmt = $conn->prepare("INSERT INTO usertype_master (id, usertype) VALUES (?, ?)");
$stmt->bind_param("is", $new_id, $usertype);

if ($stmt->execute()) {
    echo json_encode(["message" => "Usertype added successfully", "id" => $new_id]);
} else {
    echo json_encode(["error" => "Failed to add usertype", "debug" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
