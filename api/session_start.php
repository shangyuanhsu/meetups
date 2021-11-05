<?php
session_start();

$all_fetch = trim(file_get_contents("php://input"));
$decoded = json_decode($all_fetch, true);
$uid = $decoded['member_id'];
$_SESSION['uid'] = $uid;

echo json_encode("ok");