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
        $sql_0 = " DELETE FROM `meetups`.`favorites` 
        WHERE `room_id`=:room_id
        AND `member_id` = :member_id;";
        $sth_0 = $pdo->prepare($sql_0);
        $sth_0->bindValue(":room_id", $room_id);
        $sth_0->bindValue(":member_id", $uid);
        $sth_0->execute();

        echo json_encode(["status" => "remove"]);
    }
    if ($status == false) {
        $sql_1 = "INSERT INTO `meetups`.`favorites` (`room_id`, `member_id`, `status`) 
        VALUES (:room_id, :member_id,1);";
        $sth_1 = $pdo->prepare($sql_1);
        $sth_1->bindValue(":room_id", $room_id);
        $sth_1->bindValue(":member_id", $uid);
        $sth_1->execute();
        echo json_encode(["status" => "new"]);
    }
} else {
    echo json_encode(["status" => "errorLogin"]);
}
