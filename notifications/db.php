<?php
$host = "localhost";
$username = "ytshyzsw_pfsaver_user";
$password = "pfsaver_buzcatch";
$database = "ytshyzsw_student_dashboard";

$conn = new mysqli($host,$username,$password,$database);

if($conn -> connect_error) {
    die(json_encode(["error" => "Connection failed"]));
}
?>