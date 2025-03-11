<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include '../company/db.php'; // Ensure correct path to db.php

$data = json_decode(file_get_contents("php://input"), true);

// Validate required fields
if (!isset($data['userid'], $data['username'], $data['password'], $data['usertypeid']) || 
    empty($data['userid']) || empty(trim($data['username'])) || empty(trim($data['password'])) || empty($data['usertypeid'])) {
    echo json_encode(["status" => "error", "message" => "All fields are required"]);
    exit;
}

// Extract data
$userid = intval($data['userid']); // Get userid from request
$username = trim($data['username']);
$password = password_hash(trim($data['password']), PASSWORD_BCRYPT); // Hash password
$usertypeid = intval($data['usertypeid']);

// 🔹 Check if userid exists in company table
$checkCompany = $conn->prepare("SELECT userid FROM company WHERE userid = ?");
$checkCompany->bind_param("i", $userid);
$checkCompany->execute();
$checkCompany->store_result();

if ($checkCompany->num_rows == 0) {
    echo json_encode(["status" => "error", "message" => "Invalid userid. It must exist in the company table."]);
    exit;
}
$checkCompany->close();

// 🔹 Check if usertypeid exists in usertype_master table
$checkUserType = $conn->prepare("SELECT id FROM usertype_master WHERE id = ?");
$checkUserType->bind_param("i", $usertypeid);
$checkUserType->execute();
$checkUserType->store_result();

if ($checkUserType->num_rows == 0) {
    echo json_encode(["status" => "error", "message" => "Invalid usertypeid. It must exist in usertype_master table."]);
    exit;
}
$checkUserType->close();

// 🔹 Insert into user_master table
$stmt = $conn->prepare("INSERT INTO user_master (userid, username, password, usertypeid) VALUES (?, ?, ?, ?)");
$stmt->bind_param("isss", $userid, $username, $password, $usertypeid);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "User added successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Failed to add user", "debug" => $stmt->error]);
}

$stmt->close();
$conn->close();
?>
