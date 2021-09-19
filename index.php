<?php

use Hekmatinasser\Verta\Facades\Verta;

include "config/init.php";

if (isset($_GET['logout'])) {

    logOut($_SESSION['login']);
}

if (!isLogedIn()) {

    header("location: http://tra.in/todo/auth.php");
}
$user = (object) $_SESSION['login'];

$grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($user->email)));

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
$folders = getFolders();



// echo "<p style='direction:rtl'>$jda->mday $jda->month $jda->year  ساعت $jda->hours:$jda->minutes  </p>  ";
include "tpl/index-tpl.php";
