<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include 'db.php'; // Include database connection

// Check if request is POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["error" => "Invalid request method"]);
    exit;
}

// Get form data
$account_id = $_POST['account_id'] ?? null;
$companyid = $_POST['companyid'] ?? null;
$name = $_POST['name'] ?? null;
$address = $_POST['address'] ?? null;
$place = $_POST['place'] ?? null;
$mobile_number = $_POST['mobile_number'] ?? null;
$email_id = $_POST['email_id'] ?? null;
$joined_date = $_POST['joined_date'] ?? null;

// Validate required fields
if (!$account_id || !$companyid) {
    echo json_encode(["error" => "Account ID and Company ID are required"]);
    exit;
}

// Debugging: Check if received correctly
error_log("Received account_id: " . $account_id);
error_log("Received companyid: " . $companyid);

// Check if account_id and companyid exist
$stmt = $conn->prepare("SELECT id, thumbnail_image FROM members WHERE account_id = ? AND companyid = ?");
$stmt->bind_param("ii", $account_id, $companyid);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($member_id, $existing_image);

if ($stmt->num_rows === 0) {
    echo json_encode(["error" => "Member not found"]);
    $stmt->close();
    exit;
}
$stmt->fetch();
$stmt->close();

// Prepare update query dynamically
$update_fields = [];
$params = [];
$param_types = "";

// Add fields to update if provided
if ($name) {
    $update_fields[] = "name = ?";
    $params[] = $name;
    $param_types .= "s";
}
if ($address) {
    $update_fields[] = "address = ?";
    $params[] = $address;
    $param_types .= "s";
}
if ($place) {
    $update_fields[] = "place = ?";
    $params[] = $place;
    $param_types .= "s";
}
if ($mobile_number) {
    $update_fields[] = "mobile_number = ?";
    $params[] = $mobile_number;
    $param_types .= "s";
}
if ($email_id) {
    $update_fields[] = "email_id = ?";
    $params[] = $email_id;
    $param_types .= "s";
}
if ($joined_date) {
    $update_fields[] = "joined_date = ?";
    $params[] = $joined_date;
    $param_types .= "s";
}

// **🔹 Handle Image Upload (if new image is provided)**
if (isset($_FILES['thumbnail_image']) && $_FILES['thumbnail_image']['error'] == 0) {
    $upload_dir = "uploads/";
    $filename = time() . "_" . basename($_FILES['thumbnail_image']['name']);
    $upload_path = $upload_dir . $filename;

    if (move_uploaded_file($_FILES['thumbnail_image']['tmp_name'], $upload_path)) {
        // Delete old image (if exists)
        if ($existing_image && file_exists($upload_dir . $existing_image)) {
            unlink($upload_dir . $existing_image);
        }

        // Add new image to update query
        $update_fields[] = "thumbnail_image = ?";
        $params[] = $filename;
        $param_types .= "s";
    } else {
        echo json_encode(["error" => "Image upload failed"]);
        exit;
    }
}

// **🔹 If no fields to update, exit**
if (empty($update_fields)) {
    echo json_encode(["error" => "No fields to update"]);
    exit;
}

// **🔹 Build final update query**
$update_fields_str = implode(", ", $update_fields);
$sql = "UPDATE members SET $update_fields_str WHERE account_id = ? AND companyid = ?";
$params[] = $account_id;
$params[] = $companyid;
$param_types .= "ii";

// Debugging: Check SQL before execution
error_log("SQL: $sql");

// **🔹 Prepare and execute update query**
$stmt = $conn->prepare($sql);
$stmt->bind_param($param_types, ...$params);

if ($stmt->execute()) {
    if ($stmt->affected_rows > 0) {
        echo json_encode(["message" => "Member updated successfully"]);
    } else {
        echo json_encode(["error" => "No rows updated. Data may be identical."]);
    }
} else {
    echo json_encode(["error" => "Failed to update member: " . $stmt->error]);
}

$stmt->close();
$conn->close();
?>
