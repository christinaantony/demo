<?php
require 'db.php'; // Ensure correct DB connection

header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if employee_id is set
    if (!isset($_POST['employee_id'])) {
        echo json_encode(["error" => "Employee ID is required"]);
        exit;
    }

    // Trim and sanitize input
    $employee_id = trim($_POST['employee_id']);
    unset($_POST['employee_id']); // Remove employee_id from update fields

    if (empty($employee_id)) {
        echo json_encode(["error" => "Invalid Employee ID"]);
        exit;
    }

    // Dynamically build the update query
    $updateFields = [];
    $params = [];
    $paramTypes = '';

    foreach ($_POST as $key => $value) {
        $updateFields[] = "$key = ?";
        $params[] = trim($value);
        $paramTypes .= 's'; // Assuming all fields are strings, modify if needed
    }

    if (empty($updateFields)) {
        echo json_encode(["error" => "No fields provided for update"]);
        exit;
    }

    // Create the SQL query
    $sql = "UPDATE employee SET " . implode(", ", $updateFields) . " WHERE employee_id = ?";
    $stmt = $conn->prepare($sql);

    // Bind parameters dynamically
    $params[] = $employee_id;
    $paramTypes .= 's';
    $stmt->bind_param($paramTypes, ...$params);

    if ($stmt->execute()) {
        echo json_encode(["success" => "Employee updated successfully"]);
    } else {
        echo json_encode(["error" => "Failed to update employee"]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request method"]);
}
?>
