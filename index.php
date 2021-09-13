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
// var_dump($_SESSION['login']);

$user = (object) $_SESSION['login'];
$tasks = [];
$foldersId = $_GET["folder_id"];
$pageNumber = isset($_GET['page']) ? $_GET['page'] : 1;
if (isset($_GET["delete_folder"])) {
    deleteFolder($_GET["delete_folder"]);
    header("location: http://tra.in/todo/");
}
if (isset($foldersId)) {
    $tasks = getTasks(intval($_GET["sortBy"]), $pageNumber, $foldersId);

} else if (isset($_GET['search']) && !empty($_GET['search'])) {

    $tasks = searchTask($_GET['search']);

} else {
    $tasks = getTasks(intval($_GET["sortBy"]), $pageNumber);
}
$count = getPageCount($foldersId);
// var_dump($tasks);
$folders = getFolders();

include "tpl/index-tpl.php";
