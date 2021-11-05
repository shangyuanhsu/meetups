<?php
require_once "connectbook.php";

$all_fetch = trim(file_get_contents("php://input"));
$decoded = json_decode($all_fetch, true);

$email = filter_var($decoded['email'], FILTER_SANITIZE_EMAIL);
$password = $decoded['password'];
$is_google = $decoded['is_google'];
$hash = password_hash($password, PASSWORD_DEFAULT);

try {

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode("error3"); //信箱錯誤
        die;
    }

    if ($is_google == 0) {
        if (empty($password)) {
            echo json_encode("error4"); //密碼錯誤
            die;
        }
    }




    $sql_0 = "SELECT * FROM meetups.member where email = :email;";
    $sth_0 = $pdo->prepare($sql_0);
    $sth_0->bindValue(":email", $email);
    $sth_0->execute();
    $row_0 = $sth_0->fetch(PDO::FETCH_ASSOC);

    if (!empty($row_0)) {

        if ($is_google == 0) {
            if (password_verify($password,  $row_0['password'])) {

                echo json_encode(["member_id" => $row_0['member_id'], "member_name" => $row_0['name']]); // 密碼正確
            } else {
                echo json_encode("error1"); //密碼錯誤
            }
        } else {
            echo json_encode(["member_id" => $row_0['member_id'], "member_name" => $row_0['name']]); // 密碼正確
        }
    } else {
        echo json_encode("error2"); // 沒註冊
    }
} catch (PDOException $e) {
    echo "資料庫連線失敗！錯誤訊息：", $e->getMessage();
    exit;
}
