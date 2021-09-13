<?php

include "config/init.php";

if (isset($_GET['logout'])) {

    logOut($_SESSION['login']);
}

if (isset($_COOKIE["login"])) {
    loginWithCookie($_COOKIE["login"]);
}
if (!isLogedIn()) {

    header("location: http://tra.in/todo/auth.php");
}
// setcookie("login", "salam", time() + 2 * 24 * 60 * 60, "/");
// var_dump($_COOKIE['login']);
$tasks = [];
if (isset($_GET["delete_folder"])) {
    deleteFolder($_GET["delete_folder"]);
    header("location: http://tra.in/todo/");
}
if (isset($_GET["folder_id"])) {
    $tasks = getTasks(intval($_GET["sortBy"]), $_GET["folder_id"]);

} else if (isset($_GET['search']) && !empty($_GET['search'])) {

    $tasks = searchTask($_GET['search']);

} else {
    $tasks = getTasks(intval($_GET["sortBy"]));
}
// var_dump($tasks);
$folders = getFolders();

include "tpl/index-tpl.php";
