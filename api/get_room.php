<?php
require_once "connectbook.php";
try {
    $sql_0 = "SELECT *
    FROM meetups.meet_room;";
    $sth_0 = $pdo->prepare($sql_0);
    $sth_0->execute();
    $row_0 = $sth_0->fetchAll(PDO::FETCH_ASSOC);

    $sql_1 = "SELECT room_id
    FROM meetups.favorites
    where member_id = 1
    and status = 1;";
    $sth_1 = $pdo->prepare($sql_1);
    $sth_1->execute();
    $row_1 = $sth_1->fetchAll(PDO::FETCH_ASSOC);

    $arr = [];
    foreach ($row_1 as $key => $val) {
        $arr[]=$val['room_id'];
    }
 
    echo json_encode(["meet_room" => $row_0, "favorites" => $arr]);

} catch (PDOException $e) {
    echo "資料庫連線失敗！錯誤訊息：", $e->getMessage();
    exit;
}
// SELECT * 
// FROM meetups.meet_room as t1 
// LEFT JOIN (
// SELECT * 
// FROM meetups.favorites
// where member_id=2

// ) as t2
// on t1.room_id = t2.room_id;