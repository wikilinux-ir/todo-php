<?php

include "config/init.php";

$tasks = [];
if (isset($_GET["delete_folder"])) {
    deleteFolder($_GET["delete_folder"]);
    header("location: {$_SERVER["HTTP_REFERER"]}");
}
if (isset($_GET["folder_id"])) {
    $tasks = getTasks($_GET["folder_id"]);

} else {
    $tasks = getTasks();
}
// var_dump($tasks);
$folders = getFolders();

include "tpl/index-tpl.php";

// echo "mysql:host=" . HOST;
