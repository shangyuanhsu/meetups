<?php
session_start();
require_once "connectbook.php";

$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : 0;
$all_fetch = trim(file_get_contents("php://input"));
$decoded = json_decode($all_fetch, true);
$room_id = $decoded['room_id'];
$status = $decoded['status'];

if ($uid != 0) {
    if ($status == true) {
        echo json_encode("delete");
    }
    if ($status == false) {
        echo json_encode("new");
    }
} else {
    echo json_encode("error");
}
