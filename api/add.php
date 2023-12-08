<?php
include_once "db.php";

$DB = ${ucfirst($_POST['table'])};
$table = $_POST['table'];

if (isset($_FILES['img']['tmp_name'])) {
    move_uploaded_file($_FILES['img']['tmp_name'], "../img/" . $_FILES['img']['name']);
    $_POST['img'] = $_FILES['img']['name'];
}

$_POST['display'] = ($table == 'title') ? 0 : 1;

unset($_POST['table']);
$DB->save($_POST);

to("../admin.php?do=$table");
