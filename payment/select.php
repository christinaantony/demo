<?php
header("Content-Type: application/json");
include 'db.php';

// Get raw JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validate ID
if (!isset($data['id'])) {
    echo json_encode(["error" => "ID is required"]);
    exit;
}

$id = $data['id'];

// Fetch payment record
$stmt = $conn->prepare("SELECT id, installment_id, memberid, companyid, mds_id, userid, created_at, paid_date, paid_amount FROM payment WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($id, $installment_id, $memberid, $companyid, $mds_id, $userid, $created_at, $paid_date, $paid_amount);

if ($stmt->fetch()) {
    echo json_encode([
        "id" => $id,
        "installment_id" => $installment_id,
        "memberid" => $memberid,
        "companyid" => $companyid,
        "mds_id" => $mds_id,
        "userid" => $userid,
        "created_at" => $created_at,
        "paid_date" => $paid_date,
        "paid_amount" => $paid_amount
    ]);
} else {
    echo json_encode(["error" => "Record not found"]);
}

$stmt->close();
$conn->close();
?>
