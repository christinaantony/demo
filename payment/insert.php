<?php
header("Content-Type: application/json");
include 'db.php'; // Database connection

$data = json_decode(file_get_contents("php://input"), true);

// Validate required fields
if (!isset($data['installment_id'], $data['memberid'], $data['companyid'], $data['mds_id'], $data['userid'], $data['created_at'], $data['paid_date'], $data['paid_amount'])) {
    echo json_encode(["error" => "All fields are required"]);
    exit;
}

// Generate new ID
$result = $conn->query("SELECT MAX(id) AS max_id FROM payment");
$row = $result->fetch_assoc();
$new_id = $row['max_id'] + 1;

// Extract data
$installment_id = $data['installment_id'];
$memberid = $data['memberid'];
$companyid = $data['companyid'];
$mds_id = $data['mds_id'];
$userid = $data['userid'];
$created_at = $data['created_at'];
$paid_date = $data['paid_date'];
$paid_amount = $data['paid_amount'];

// Insert record
$stmt = $conn->prepare("INSERT INTO payment (id, installment_id, memberid, companyid, mds_id, userid, created_at, paid_date, paid_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iiiiisssd", $new_id, $installment_id, $memberid, $companyid, $mds_id, $userid, $created_at, $paid_date, $paid_amount);

if ($stmt->execute()) {
    echo json_encode(["message" => "Payment record added successfully", "id" => $new_id]);
} else {
    echo json_encode(["error" => "Failed to insert payment record"]);
}

$stmt->close();
$conn->close();
?>
