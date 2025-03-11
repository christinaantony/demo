<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(["error" => "Invalid request method"]);
    exit;
}

// Required Fields Check
$required_fields = ['companyid', 'name', 'address', 'pincode', 'mobile_number', 'email_id', 'joined_date', 'place'];
foreach ($required_fields as $field) {
    if (!isset($_POST[$field]) || empty($_POST[$field])) {
        echo json_encode(["error" => "Missing required field: $field"]);
        exit;
    }
}

$companyid = $_POST['companyid'];
$email_id = $_POST['email_id'];

// Check if Email Already Exists
$email_check = $conn->prepare("SELECT id FROM members WHERE email_id = ?");
$email_check->bind_param("s", $email_id);
$email_check->execute();
$email_check->store_result();

if ($email_check->num_rows > 0) {
    echo json_encode(["error" => "Email ID already exists"]);
    exit;
}
$email_check->close();

// Fetch `starting_account_number` from `company` Table
$stmt = $conn->prepare("SELECT starting_account_number FROM company WHERE id = ?");
$stmt->bind_param("i", $companyid);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $starting_account_number = (int)$row['starting_account_number'];
} else {
    echo json_encode(["error" => "Company (Bank) not found"]);
    exit;
}
$stmt->close();

// Fetch the Last Assigned `account_id` for the Bank
$stmt = $conn->prepare("SELECT MAX(account_id) AS last_account_id FROM members WHERE companyid = ?");
$stmt->bind_param("i", $companyid);
$stmt->execute();
$result = $stmt->get_result();

$last_account_id = null;
if ($result->num_rows > 0) {
    $last_account = $result->fetch_assoc();
    $last_account_id = $last_account['last_account_id'];
}
$stmt->close();

// Debugging Logs
error_log("Company ID: " . $companyid);
error_log("Starting Account Number: " . $starting_account_number);
error_log("Last Account ID: " . ($last_account_id ? $last_account_id : "None"));

// Determine New `account_id`
if ($last_account_id === null || empty($last_account_id) || (int)$last_account_id < $starting_account_number) {
    $account_id = $starting_account_number;
} else {
    $account_id = (int)$last_account_id + 1;
}

// Debugging Log
error_log("New Account ID: " . $account_id);

// Handle File Upload
$thumbnail_image = "";
if (isset($_FILES['thumbnail_image']) && $_FILES['thumbnail_image']['error'] == 0) {
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

// Insert Data into Members Table
$stmt = $conn->prepare("INSERT INTO members (companyid, account_id, name, address, pincode, mobile_number, email_id, joined_date, place, thumbnail_image, created_at) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");

$stmt->bind_param("iissssssss", $companyid, $account_id, $_POST['name'], $_POST['address'], $_POST['pincode'], $_POST['mobile_number'], $_POST['email_id'], $_POST['joined_date'], $_POST['place'], $thumbnail_image);

if ($stmt->execute()) {
    echo json_encode(["message" => "Member added successfully", "account_id" => $account_id]);
} else {
    echo json_encode(["error" => "Failed to insert member"]);
}

$stmt->close();
$conn->close();
?>
