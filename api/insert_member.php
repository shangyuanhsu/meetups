<?php
require_once "connectbook.php";

$all_fetch = trim(file_get_contents("php://input"));
$decoded = json_decode($all_fetch, true);

$name = $decoded['name'];
$email = $decoded['email'];
$password = $decoded['password'];
$is_google = $decoded['is_google'];
$hash = password_hash($password, PASSWORD_DEFAULT);

// $2y$10$0f65mYQOTBWX4kVKMbBDaOtbH5mswfFUGStb0mYeW7sKZnyJ.sOZa

// if (password_verify($password, "$2y$10$0f65mYQOTBWX4kVKMbBDaOtbH5mswfFUGStb0mYeW7sKZnyJ.sOZa")) {
//     echo 'Password is valid!';
// } else {
//     echo 'Invalid password.';
// }


try {
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
            $sth_1->bindValue(":password", "0");
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

        echo json_encode($row_2['member_id']);
    } else {
        echo json_encode("已經註冊過了!");
    }
} catch (PDOException $e) {
    echo "資料庫連線失敗！錯誤訊息：", $e->getMessage();
    exit;
}
