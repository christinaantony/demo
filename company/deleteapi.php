<?php
header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type, Authorization');
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);
if (!isset($data['id'])) {
    echo json_encode(["error" => "ID is required"]);
    exit;
}

$stmt = $conn->prepare("DELETE FROM company WHERE id=?");
$stmt->bind_param("i", $data['id']);

if ($stmt->execute()) {
    echo json_encode(["message" => "Company deleted successfully"]);
} else {
    echo json_encode(["error" => $stmt->error]);
}
?>
