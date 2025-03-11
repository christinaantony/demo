<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
include 'db.php'; // Database connection

error_reporting(E_ALL);
ini_set('display_errors', 1);

$data = json_decode(file_get_contents("php://input"), true);

// Validate required fields
if (
    empty($data['mds_id']) || empty($data['companyid']) || empty($data['mds_name']) ||
    empty($data['total_salary']) || empty($data['starting_date']) ||
    empty($data['number_of_installments']) || empty($data['end_date']) ||
    empty($data['caption']) || empty($data['no_of_members']) ||
    empty($data['status']) || empty($data['statusid'])
) {
    echo json_encode(["error" => "All fields are required"]);
    exit;
}

// Assign variables
$mds_id = $data['mds_id'];
$companyid = $data['companyid'];
$mds_name = $data['mds_name'];
$total_salary = $data['total_salary'];
$starting_date = $data['starting_date'];
$number_of_installments = $data['number_of_installments'];
$end_date = $data['end_date'];
$caption = $data['caption'];
$no_of_members = $data['no_of_members'];
$status = $data['status'];
$statusid = $data['statusid'];

// ✅ Check if the company exists
$stmt = $conn->prepare("SELECT id FROM company WHERE id = ?");
if (!$stmt) {
    echo json_encode(["error" => "SQL Prepare Failed: " . $conn->error]);
    exit;
}
$stmt->bind_param("i", $companyid);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo json_encode(["error" => "Invalid company ID"]);
    $stmt->close();
    exit;
}
$stmt->close();

// ✅ Insert MDS record with new fields (status & statusid)
$stmt = $conn->prepare("
    INSERT INTO mds (mds_id, companyid, mds_name, total_salary, starting_date, number_of_installments, end_date, caption, no_of_members, status, statusid) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
");
if (!$stmt) {
    echo json_encode(["error" => "SQL Prepare Failed: " . $conn->error]);
    exit;
}
$stmt->bind_param("sisssissisi", $mds_id, $companyid, $mds_name, $total_salary, $starting_date, $number_of_installments, $end_date, $caption, $no_of_members, $status, $statusid);

if ($stmt->execute()) {
    echo json_encode(["message" => "MDS record added successfully"]);
} else {
    echo json_encode(["error" => "Failed to insert MDS record: " . $stmt->error]);
}

// Close connections
$stmt->close();
$conn->close();
?>
