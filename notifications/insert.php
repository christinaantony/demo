<?php
header("Content-Type: application/json");
include 'db.php'; // Database connection

$data = json_decode(file_get_contents("php://input"), true);

// Validate required fields
if (!isset($data['companyid'], $data['notification_description'], $data['date'], $data['userid'], $data['type'], $data['status'])) {
    echo json_encode(["error" => "All fields are required"]);
    exit;
}

$companyid = $data['companyid'];

// ✅ Check if the company ID exists in the company table
$companyCheck = $conn->prepare("SELECT id FROM company WHERE id = ?");
$companyCheck->bind_param("i", $companyid);
$companyCheck->execute();
$companyCheck->store_result();

if ($companyCheck->num_rows === 0) {
    echo json_encode(["error" => "Invalid company ID. No matching company found."]);
    exit;
}
$companyCheck->close();

// ✅ Generate new ID for the notification
$result = $conn->query("SELECT MAX(id) AS max_id FROM notification");
$row = $result->fetch_assoc();
$new_id = $row['max_id'] + 1;

// Extract other data
$notification_description = $data['notification_description'];
$date = $data['date'];
$userid = $data['userid'];
$type = $data['type'];
$status = $data['status']; // Status field

// ✅ Insert record only if company ID exists
$stmt = $conn->prepare("INSERT INTO notification (id, companyid, notification_description, date, userid, type, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("iissiis", $new_id, $companyid, $notification_description, $date, $userid, $type, $status);

if ($stmt->execute()) {
    echo json_encode(["message" => "Notification added successfully", "id" => $new_id]);
} else {
    echo json_encode(["error" => "Failed to insert notification"]);
}

$stmt->close();
$conn->close();
?>
