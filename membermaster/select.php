<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include 'db.php'; // Database connection

// Check if request is POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["error" => "Invalid request method"]);
    exit;
}

// Get form data
$companyid = $_POST['companyid'] ?? null;
$id = $_POST['id'] ?? null;

// Ensure `companyid` is required
if (!$companyid) {
    echo json_encode(["error" => "Company ID is required"]);
    exit;
}

// Build SQL query dynamically
$sql = "SELECT id, name, address, place, mobile_number, email_id, joined_date, account_id, companyid, pincode, thumbnail_image 
        FROM members WHERE companyid = ?"; // Always filter by companyid

$params = [$companyid];
$param_types = "i";

if ($id) {
    $sql .= " AND id = ?";
    $params[] = $id;
    $param_types .= "i";
}

$stmt = $conn->prepare($sql);

// Bind parameters dynamically
$stmt->bind_param($param_types, ...$params);

$stmt->execute();
$result = $stmt->get_result();

$members = [];
while ($row = $result->fetch_assoc()) {
    // Include full image path
    $row['thumbnail_image'] = $row['thumbnail_image'] ? "https://pfsaver.com/mds/member/uploads/" . $row['thumbnail_image'] : null;
    $members[] = $row;
}

// Return results
if (count($members) > 0) {
    echo json_encode(["members" => $members]);
} else {
    echo json_encode(["error" => "No members found"]);
}

$stmt->close();
$conn->close();
?>
