<?php
require_once "connectbook.php";
require_once "config.php";
$uid = 1;
$title = $_POST['title'];
$text = $_POST['text'];
$address = $_POST['address'];
$online = $_POST['online'];
$NowTime = date("Y-m-d H:i:s");
$name = $uid . "_" . strtotime("$NowTime,now");

switch ($_FILES['file']['error']) {
    case UPLOAD_ERR_OK:
        $dir = "../src/assets/img";
        // $dir = "../img";
        if (file_exists($dir) == false) {
            mkdir($dir); //make directory
        }

        $from = $_FILES['file']['tmp_name'];
        $to = "$dir/" . $name . "." . explode("/", $_FILES['file']['type'])[1];
      
        if (copy($from, $to)) {

            // var_dump($name . "." . explode("/", $_FILES['file']['type'])[1]);
            echo json_encode("ok");
        } else {
            echo json_encode("error");
        }
        break;
    case UPLOAD_ERR_INI_SIZE:
        echo json_encode("檔案太大, 不得超過" . ini_get("upload_max_filesize"));
        break;
    case UPLOAD_ERR_FORM_SIZE:
        echo json_encode("檔案太大, 不得超過" . $_POST["MAX_FILE_SIZE"]);
        break;
    case UPLOAD_ERR_PARTIAL:
        echo json_encode("上傳過程發生錯誤, 請重送");
        break;
    case UPLOAD_ERR_NO_FILE:
        echo json_encode("您没選檔案");
        break;
    default:
        echo json_encode("['error']: ", $_FILES['file']['error']);
}

// echo "['error']: ", $_FILES['file']['error'], "<br>";
// echo "['name']: ", $_FILES['file']['name'], "<br>";
// echo "['tmp_name']: ", $_FILES['file']['tmp_name'], "<br>";
// echo "['type']: ", $_FILES['file']['type'], "<br>";
// echo "['size']: ", $_FILES['file']['size'], "<br>";
