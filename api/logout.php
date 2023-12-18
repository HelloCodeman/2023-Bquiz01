<?php
session_start();
unset($_SESSION['login']);
header("locaiotn:../index.php");

?>