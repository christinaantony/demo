<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS, DELETE, PUT');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
include 'db.php'; // Include database connection
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Check for POST request
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["error" => "Invalid request method. Use POST"]);
    exit;
}

// Read JSON input
$data = json_decode(file_get_contents("php://input"), true);

// Validate input
if (empty($data['companyid'])) {
    echo json_encode(["error" => "companyid is required"]);
    exit;
}

$companyid = $data['companyid'];

// Fetch all MDS records for the given companyid
$stmt = $conn->prepare("SELECT mds_id, companyid, mds_name, total_salary, starting_date, number_of_installments, end_date,no_of_members,caption FROM mds WHERE companyid = ?");
$stmt->bind_param("i", $companyid);
$stmt->execute();
$result = $stmt->get_result();

// Check if data exists
if ($result->num_rows > 0) {
    $mds_records = [];
    while ($row = $result->fetch_assoc()) {
        $mds_records[] = $row;
    }
    echo json_encode($mds_records);
} else {
    echo json_encode(["error" => "No records found for the given companyid"]);
}

$stmt->close();
$conn->close();
?>
