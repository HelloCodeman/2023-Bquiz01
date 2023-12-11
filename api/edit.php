<?php
include_once "db.php";

$table = $_POST['table'];
$DB = ${ucfirst($table)};
unset($_POST['table']);

if (isset($_POST['id'])) {
    foreach ($_POST['id'] as $id) {
        $_POST['text'][$id] = '';
    }
}

foreach ($_POST['text'] as $id => $text) {
    if (isset($_POST['del']) && in_array($id, $_POST['del'])) {
        $DB->del($id);
    } else {
        $row = $DB->find($id);
        if (isset($row['text'])) {
            $row['text'] = $text;
        }
        $row['text'] = $text;
        if ($table == 'title') {
            $row['display'] = (isset($_POST['display']) && $_POST['display'] == $id) ? 1 : 0;
        } elseif ($table == 'admin') {
            unset($_POST['display']);
        } else {
            $row['display'] = (isset($_POST['display']) && in_array($id, $_POST['display'])) ? 1 : 0;
        }
        $DB->save($row);
    }
}

to("../admin.php?do=$table");
