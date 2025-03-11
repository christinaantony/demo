<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

include 'db.php'; // Database connection

// Get form data (POST request)
$mds_id = isset($_POST['mds_id']) ? trim($_POST['mds_id']) : null;
$company_id = isset($_POST['company_id']) ? trim($_POST['company_id']) : null;

if ($mds_id && $company_id) {
    // Fetch MDS members where both mds_id and company_id match
    $stmt = $conn->prepare("SELECT * FROM mdsmembers WHERE mds_id = ? AND company_id = ?");
    $stmt->bind_param("ii", $mds_id, $company_id);
} else {
    // Fetch all MDS members if no filters are given
    $stmt = $conn->prepare("SELECT * FROM mdsmembers");
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $rows = [];
    while ($row = $result->fetch_assoc()) {
        $rows[] = $row;
    }
    echo json_encode(["data" => $rows]);
} else {
    echo json_encode(["error" => "No records found"]);
}

$stmt->close();
$conn->close();
?>
