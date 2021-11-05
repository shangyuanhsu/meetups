<?php
require_once "connectbook.php";

$all_fetch = trim(file_get_contents("php://input"));
$decoded = json_decode($all_fetch, true);

$name = $decoded['name'];
$email = filter_var($decoded['email'], FILTER_SANITIZE_EMAIL);
$password = $decoded['password'];
$is_google = $decoded['is_google'];
$hash = password_hash($password, PASSWORD_DEFAULT);

try {



    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode("errorE"); //信箱錯誤
        die;
    }

    if (empty($name) || strlen($name) > 30) {
        echo json_encode("errorN"); //名字錯誤
        die;
    }
    
    if (empty($password)) {
        echo json_encode("errorP"); //密碼錯誤
        die;
    }



    $sql_0 = "SELECT * FROM meetups.member where email = :email;";
    $sth_0 = $pdo->prepare($sql_0);
    $sth_0->bindValue(":email", $email);
    $sth_0->execute();
    $row_0 = $sth_0->fetch(PDO::FETCH_ASSOC);

    if (empty($row_0)) {
        $sql_1 = "INSERT INTO `meetups`.`member` (`name`, `email`, `password`, `is_google`) 
        VALUES (:name, :email, :password, :is_google);";
        $sth_1 = $pdo->prepare($sql_1);
        $sth_1->bindValue(":name", $name);
        $sth_1->bindValue(":email", $email);

        if ($is_google == 1) {
            $sth_1->bindValue(":password", null);
        } else {
            $sth_1->bindValue(":password", $hash);
        }
        $sth_1->bindValue(":is_google", $is_google);
        $sth_1->execute();


        $sql_2 = "SELECT * FROM meetups.member where email = :email;";
        $sth_2 = $pdo->prepare($sql_2);
        $sth_2->bindValue(":email", $email);
        $sth_2->execute();
        $row_2 = $sth_2->fetch(PDO::FETCH_ASSOC);

        echo json_encode($row_2['member_id']); // 順利註冊，回傳新創立的uid
    } else {
        echo json_encode("errorH"); // 已經註冊過
    }
} catch (PDOException $e) {
    echo "資料庫連線失敗！錯誤訊息：", $e->getMessage();
    exit;
}
