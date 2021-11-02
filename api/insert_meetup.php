<?php
require_once "connectbook.php";
try {

    $all_fetch = trim(file_get_contents("php://input"));
    $decoded = json_decode($all_fetch, true);
   

    echo json_encode($decoded  );
} catch (PDOException $e) {
    echo "資料庫連線失敗！錯誤訊息：", $e->getMessage();
    exit;
}
