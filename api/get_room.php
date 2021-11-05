<?php
session_start();
require_once "connectbook.php";

$uid = isset($_SESSION['uid']) ? $_SESSION['uid'] : 0;

try {

    $sql_0 = "SELECT t1.room_id,t1.title,t1.address,t1.description,t1.src,t1.time,t1.online,t2.status
    FROM meetups.meet_room as t1 
    LEFT JOIN (
    SELECT * 
    FROM meetups.favorites
    where member_id= :uid
    ) as t2
    on t1.room_id = t2.room_id
    order by t1.time desc;";
    $sth_0 = $pdo->prepare($sql_0);
    $sth_0->bindValue(":uid", $uid);
    $sth_0->execute();
    $row_0 = $sth_0->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(["meet_room" => $row_0]);
} catch (PDOException $e) {
    echo "資料庫連線失敗！錯誤訊息：", $e->getMessage();
    exit;
}
