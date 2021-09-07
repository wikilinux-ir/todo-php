<?php

include "/srv/train/todo/config/helpers.php";
include "/srv/train/todo/tasks/tasks.php";

if (!isAjaxRequest()) {

    dieMessage("is not ajax request");

}

if (!isset($_POST["action"]) || empty($_POST["folderName"])) {

    dieMessage("");

}
switch ($_POST["action"]) {

    case "createFolder":
        echo createFolder($_POST["folderName"]);
        break;

    default:
        echo "action not valid";
}
