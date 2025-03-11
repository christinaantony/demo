<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include 'db.php'; // Database connection

// Ensure the request method is POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["error" => "Invalid request method. Use POST instead of DELETE."]);
    exit;
}

// Get form data from $_POST (works with form-data)
$account_id = $_POST['account_id'] ?? null;
$companyid = $_POST['companyid'] ?? null;

// Validate required fields
if (!$account_id || !$companyid) {
    echo json_encode(["error" => "Account ID and Company ID are required"]);
    exit;
}

// Fetch existing member and get the thumbnail image
$stmt = $conn->prepare("SELECT thumbnail_image FROM members WHERE account_id = ? AND companyid = ?");
$stmt->bind_param("ii", $account_id, $companyid);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    echo json_encode(["error" => "Member not found"]);
    exit;
}

$stmt->bind_result($thumbnail_image);
$stmt->fetch();
$stmt->close();

// Delete the member
$stmt = $conn->prepare("DELETE FROM members WHERE account_id = ? AND companyid = ?");
$stmt->bind_param("ii", $account_id, $companyid);

if ($stmt->execute()) {
    // Delete the associated image if it exists
    if (!empty($thumbnail_image)) {
        $image_path = __DIR__ . "/uploads/" . $thumbnail_image;
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }
    echo json_encode(["message" => "Member deleted successfully"]);
} else {
    echo json_encode(["error" => "Failed to delete member"]);
}

$stmt->close();
$conn->close();
?>
