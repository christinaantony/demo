<?php
require 'db.php'; // Database connection

header("Content-Type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

// Handle form-data (multipart/form-data)
if ($_SERVER["REQUEST_METHOD"] === "POST" && empty($_POST)) {
    $_POST = $_REQUEST;
}

// Get 'companyid' from form-data ($_POST) or query parameters ($_GET)
$companyid = $_POST['companyid'] ?? $_GET['companyid'] ?? null;

if (!$companyid || empty(trim($companyid))) {
    echo json_encode(["error" => "Company ID is required"]);
    exit;
}

// Fetch employees based on companyid
$sql = "SELECT id, companyid, employee_id, employee_name, employee_address, place, mail_id, pincode, joined_date, designation, mobile_number, thumbnail_image 
        FROM employee 
        WHERE companyid = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $companyid);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $employees = [];

    while ($row = $result->fetch_assoc()) {
        $employees[] = $row;
    }

    if (!empty($employees)) {
        echo json_encode($employees);
    } else {
        echo json_encode(["error" => "No employees found for this company"]);
    }
} else {
    echo json_encode(["error" => "Failed to fetch employees"]);
}

// Close statement and connection
$stmt->close();
$conn->close();
?>
