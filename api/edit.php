<?php
include_once "db.php";

$table = $_POST['table'];
$DB = ${ucfirst($table)};
unset($_POST['table']);

/*
if (isset($_POST['id'])) {
    foreach ($_POST['id'] as $id) {
        $_POST['text'][$id] = '';
    }
}
*/

foreach ($_POST['id'] as  $key => $id) {
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        $DB->del($id);
    } else {
        $row = $DB->find($id);
        if (isset($row['text'])) {
            $row['text'] = $_POST['text'][$key];
        }
        switch ($table) {
            case "title":
                $row['display'] = (isset($_POST['display']) && $_POST['display'] == $id) ? 1 : 0;
                break;
            case "admin":
                $row['acc'] = $_POST['acc'][$key];
                $row['pw'] = $_POST['pw'][$key];
                break;
            case "menu":
                $row['href'] = $_POST['href'][$key];
                $row['display'] = (isset($_POST['display']) && in_array($id, $_POST['display'])) ? 1 : 0;
                break;
            default:
                $row['display'] = (isset($_POST['display']) && in_array($id, $_POST['display'])) ? 1 : 0;
        }

        $DB->save($row);
    }
}
to("../admin.php?do=$table");
