<?php

include "/srv/train/todo/config/init.php";

// check requset type , e.g : ajax or http

if (!isAjaxRequest()) {

    dieMessage("is not ajax request");

}

//check action is set

if (!isset($_POST["action"])) {

    dieMessage("ops!! faild ");

}

// select action type

switch ($_POST["action"]) {

    case "createFolder":
        if (empty($_POST["folderName"]) || strlen($_POST["folderName"]) < 3) {

            dieMessage("folder name not valid");
        }

        echo (createFolder($_POST["folderName"]));

        break;
    case "changeTaskComplete":

        echo completeCheck($_POST["task"], $_POST["check"]);

        break;
    case "removeTask":

        echo removeTask($_POST["task"]);

        break;
    case "createTask":

        echo (createTask($_POST["taskName"], $_POST["folderId"]));

        break;
    default:
        echo "action not valid";
}
