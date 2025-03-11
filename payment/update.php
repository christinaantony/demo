<?php
header("Content-Type: application/json");
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

// Validate required fields
if (!isset($data['id'], $data['installment_id'], $data['memberid'], $data['companyid'], $data['mds_id'], $data['userid'], $data['created_at'], $data['paid_date'], $data['paid_amount'])) {
    echo json_encode(["error" => "All fields are required"]);
    exit;
}

// Extract data
$id = $data['id'];
$installment_id = $data['installment_id'];
$memberid = $data['memberid'];
$companyid = $data['companyid'];
$mds_id = $data['mds_id'];
$userid = $data['userid'];
$created_at = $data['created_at'];
$paid_date = $data['paid_date'];
$paid_amount = $data['paid_amount'];

// Check if the record exists
$stmt = $conn->prepare("SELECT id FROM payment WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->store_result();
if ($stmt->num_rows == 0) {
    echo json_encode(["error" => "Record not found"]);
    exit;
}
$stmt->close();

// Update the record
$stmt = $conn->prepare("UPDATE payment SET installment_id = ?, memberid = ?, companyid = ?, mds_id = ?, userid = ?, created_at = ?, paid_date = ?, paid_amount = ? WHERE id = ?");
$stmt->bind_param("iiiiissdi", $installment_id, $memberid, $companyid, $mds_id, $userid, $created_at, $paid_date, $paid_amount, $id);

if ($stmt->execute()) {
    echo json_encode(["message" => "Payment record updated successfully"]);
} else {
    echo json_encode(["error" => "Failed to update payment record"]);
}

$stmt->close();
$conn->close();
?>
