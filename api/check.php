<?php
include_once "db.php";

// 用count不用find，因為後者會回傳資料，降低效能，且帳密是機密資料，怕在回傳時有外洩問題

if ($Admin->count(['acc' => $_POST['acc'], 'pw' => $_POST['pw']]) > 0) {
    $_SESSION['login'] = $_POST['acc'];
    to("../admin.php");
} else {
    to("../index.php?do=login&error=帳號或密碼錯誤");
}
