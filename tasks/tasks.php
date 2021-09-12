<?php

include "/srv/train/todo/config/db.php";
include_once "/srv/train/todo/config/helpers.php";

function getUserId()
{
    // return isset($_SESSION['login']) ? intval($_SESSION['login']['id']) : false;
    $id = ($_SESSION['login']['id'] ?? null);
    return intval($id);
}
// define("USERID", getUserId());

function getFolders()
{

    global $dbc;
    $userId = getUserId();
    $query = "SELECT * from folders where user_id = {$userId}";
    $stmt = $dbc->prepare($query);
    $stmt->execute();
    $resutl = $stmt->fetchAll(PDO::FETCH_OBJ);

    return ($resutl);
}
// if exist folder return false //

function checkExistFolder($folderName)
{
    global $dbc;
    $userId = getUserId();
    // $folderName = $folderName == "all" ? 0 :
    $folderNameOrId = is_numeric($folderName) ? "id" : "folderName";
    $query = "SELECT folderName from folders where user_id = {$userId} and {$folderNameOrId} = :folderName";
    $stmt = $dbc->prepare($query);
    $stmt->execute([":folderName" => $folderName]);
    if ($stmt->rowCount() > 0) {
        return false;
    }
    return true;
}

// if exist task return false //

function checkExistTask($taskName)
{
    global $dbc;
    $userId = getUserId();
    $query = "SELECT title from tasks where user_id = {$userId} and title = :taskName";
    $stmt = $dbc->prepare($query);
    $stmt->execute([":taskName" => $taskName]);
    if ($stmt->rowCount() > 0) {
        return false;
    }
    return true;
}

function getTasks($orderByTime = 1, $folderId = "all")
{
    global $dbc;
    $userId = getUserId();

    // select query and get all records if folderid equal with null
    $orderQuery = $orderByTime == 1 ? latest_first : "#";
    if ($folderId == "all") {
        $query = "SELECT * from tasks
     where user_id = {$userId} " . $orderQuery;
    }
    // get folder records if folderid not equal with null
    else {
        $query = "SELECT * from tasks
        where user_id = {$userId}
        and folder_id = :folderid " . $orderQuery;

    }
    $stmt = $dbc->prepare($query);
    $stmt->execute([":folderid" => $folderId]);
    $resutl = $stmt->fetchAll(PDO::FETCH_OBJ);
    // dd($query);
    return ($resutl);

}

function checkFolderAndTaskOwener($folderId, $table, $column = "id")
{

    global $dbc;
    $userId = getUserId();
    $query = "SELECT user_id from $table where user_id = $userId
     and $column = $folderId";
    $stmt = $dbc->prepare($query);
    $stmt->execute();
    if ($stmt->rowCount() == 0) {
        dieMessage("شما مالک این پوشه نیستید");
    }
}
function deleteFolder($folderId)
{
    checkFolderAndTaskOwener($folderId, "folders");
    deleteTasks($folderId);
    global $dbc;
    $userId = getUserId();
    $query = "delete from folders where id = :folderid and user_id = $userId";
    $stmt = $dbc->prepare($query);
    $stmt->execute([":folderid" => $folderId]);

}

// remove task with folder

function deleteTasks($folderId)
{
    global $dbc;
    $userId = getUserId();
    $query = "delete from tasks where folder_id = :folderid and user_id = $userId";
    $stmt = $dbc->prepare($query);
    $stmt->execute([":folderid" => $folderId]);
}

function createFolder($folderName)
{

// if exist folder return and stop create folder

    if (!checkExistFolder($folderName)) {
        return "it,s duplicate";
    }
    global $dbc;
    $userId = getUserId();
    $query = "insert into `folders` (folderName , task_id , user_id) values (:foldername , $userId , $userId)";
    $stmt = $dbc->prepare($query);
    $stmt->execute([":foldername" => $folderName]);

    if ($stmt->rowCount() > 0) {
        $folders = getFolders();
        foreach ($folders as $folder) {
            if ($folder->folderName == $folderName) {

                return "true-" . $folder->id . "-" . $folder->folderName;
            }
        }}
    return 0;
}

function completeCheck($taskId, $status)
{
    global $dbc;
    $status = (strval($status) == "true") ? 1 : 0;
    $userId = getUserId();
    $query = "UPDATE tasks set isComplete = $status where id = :taskid";
    $stmt = $dbc->prepare($query);
    $stmt->execute([":taskid" => intval($taskId)]);
    return $status ? "true" : "false";
}

//only remove task single

function removeTask($taskId)
{

    global $dbc;
    $userId = getUserId();
    $query = "delete from tasks where id = :taskid and user_id = $userId";
    $stmt = $dbc->prepare($query);
    $stmt->execute([":taskid" => $taskId]);
    if ($stmt->rowCount() > 0) {
        return "true";
    }
    return "false";
}

function getTaskIdByName($taskName)
{

    global $dbc;
    $userId = getUserId();
    $query = "SELECT id from tasks where title = :taskName and user_id = $userId";
    $stmt = $dbc->prepare($query);
    $stmt->execute([":taskName" => $taskName]);
    if ($stmt->rowCount() > 0) {
        return "true";
    }
    return false;
}

function createTask($taskName, $folderId = 0)
{

    global $dbc;
    if (!checkExistTask($taskName)) {
        return "task is duplicate";
    }
    if (checkExistFolder($folderId)) {
        return "folder not found!";
    }
    $folderId = $folderId == "all" ? 0 : $folderId;
    $userId = getUserId();
    $query = "insert into tasks (title,folder_id,user_id) values(:taskName,:folderId,$userId)";
    $stmt = $dbc->prepare($query);
    $stmt->execute([":taskName" => $taskName, ":folderId" => $folderId]);
    return getTaskIdByName($taskName);

}

function searchTask($title)
{
    global $dbc;
    $userId = getUserId();
    $title = $title . "%";
    $query = "select * from tasks where title like :title and user_id = $userId";
    $stmt = $dbc->prepare($query);
    $stmt->execute([":title" => $title]);
    $resutl = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $resutl;
}
