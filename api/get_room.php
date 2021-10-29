<?php
require_once("connectbook.php");
try {
    $sql_0 = "SELECT * 
    FROM meetups.meet_room;";
    $sth_0 = $pdo->prepare($sql_0);
    $sth_0->execute();
    $row_0 = $sth_0->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($row_0);
} catch (PDOException $e) {
    echo "資料庫連線失敗！錯誤訊息：", $e->getMessage();
    exit;
}
