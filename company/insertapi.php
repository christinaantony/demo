<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include 'db.php';

// Check required fields
if (!isset($_POST['company_name'], $_POST['company_address'], $_POST['place'], $_POST['email_id'], $_POST['mobile_number'], $_POST['userid'], $_POST['joining_date'])) {
    echo json_encode(["error" => "Missing required fields"]);
    exit;
}

// Get system IP address
$ip_address = $_SERVER['REMOTE_ADDR'];

// Get MAX(id) + 1 for new company ID
$result = $conn->query("SELECT MAX(id) AS max_id FROM company");
$row = $result->fetch_assoc();
$new_id = ($row['max_id'] ?? 0) + 1;

// Handle file upload (if exists)
$thumbnail_image = "";
if (!empty($_FILES['thumbnail_image']['name'])) {
    $upload_dir = "uploads/";
    $filename = time() . "_" . basename($_FILES['thumbnail_image']['name']);
    $upload_path = $upload_dir . $filename;

    if (move_uploaded_file($_FILES['thumbnail_image']['tmp_name'], $upload_path)) {
        $thumbnail_image = $filename;
    } else {
        echo json_encode(["error" => "File upload failed"]);
        exit;
    }
}

// Generate IFSC Code (First 3 letters of Bank Name + Random 4 Digits)
$bank_name = strtoupper(preg_replace('/[^A-Za-z]/', '', $_POST['company_name']));
$ifsc_prefix = substr($bank_name, 0, 3);
do {
    $ifsc_code = $ifsc_prefix . rand(1000, 9999);
    $check_ifsc = $conn->query("SELECT COUNT(*) AS count FROM company WHERE ifsc_code = '$ifsc_code'");
    $row_ifsc = $check_ifsc->fetch_assoc();
} while ($row_ifsc['count'] > 0);

// Generate a Unique Starting Account Number
do {
    $starting_account_number = rand(100000, 999999);
    $check_existing = $conn->query("SELECT COUNT(*) AS count FROM company WHERE starting_account_number = '$starting_account_number'");
    $row_existing = $check_existing->fetch_assoc();
} while ($row_existing['count'] > 0);

// Insert Data into Company Table
$stmt = $conn->prepare("INSERT INTO company (id, company_name, company_address, place, email_id, mobile_number, ifsc_code, starting_account_number, userid, ip_address, thumbnail_image, joining_date) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

if (!$stmt) {
    echo json_encode(["error" => "SQL Prepare Failed: " . $conn->error]);
    exit;
}

$stmt->bind_param("isssssssssss", $new_id, $_POST['company_name'], $_POST['company_address'], $_POST['place'], $_POST['email_id'], $_POST['mobile_number'], $ifsc_code, $starting_account_number, $_POST['userid'], $ip_address, $thumbnail_image, $_POST['joining_date']);

if ($stmt->execute()) {
    echo json_encode([
        "message" => "Bank added successfully",
        "id" => $new_id,
        "ifsc_code" => $ifsc_code,
        "starting_account_number" => $starting_account_number
    ]);
} else {
    echo json_encode(["error" => "Failed to add bank: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
