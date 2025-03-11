<?php
require 'db.php'; // Database connection

header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Check if 'companyid' and 'employee_id' are provided
    if (!isset($_POST['companyid'], $_POST['employee_id'])) {
        echo json_encode(["error" => "Company ID and Employee ID are required"]);
        exit;
    }

    // Sanitize and validate inputs
    $companyid = trim($_POST['companyid']);
    $employee_id = trim($_POST['employee_id']);

    if (empty($companyid) || empty($employee_id)) {
        echo json_encode(["error" => "Invalid Company ID or Employee ID"]);
        exit;
    }

    // Prepare delete query
    $sql = "DELETE FROM employee WHERE companyid = ? AND employee_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $companyid, $employee_id); // Assuming companyid is integer, employee_id is string

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => "Employee deleted successfully"]);
        } else {
            echo json_encode(["error" => "No record found with this Company ID and Employee ID"]);
        }
    } else {
        echo json_encode(["error" => "Failed to delete employee"]);
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["error" => "Invalid request method"]);
}
?>
