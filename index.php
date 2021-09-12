<?php

include "config/init.php";

if (isset($_GET['logout'])) {

    logOut();
}

if (!isLogedIn()) {

    header("location: http://tra.in/todo/auth.php");
}

$tasks = [];
if (isset($_GET["delete_folder"])) {
    deleteFolder($_GET["delete_folder"]);
    header("location: http://tra.in/todo/");
}
if (isset($_GET["folder_id"])) {
    $tasks = getTasks($_GET["folder_id"]);

} else {
    $tasks = getTasks();
}
// var_dump($tasks);
$folders = getFolders();

include "tpl/index-tpl.php";
