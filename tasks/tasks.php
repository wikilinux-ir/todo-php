<?php

include "/srv/train/todo/config/db.php";

function getUserId()
{
    return 2;
}

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

function checkExistFolder($folderName)
{
    global $dbc;
    $userId = getUserId();
    $query = "SELECT folderName from folders where user_id = {$userId} and folderName = :folderName";
    $stmt = $dbc->prepare($query);
    $stmt->execute([":folderName" => $folderName]);
    if ($stmt->rowCount() > 0) {
        return false;
    }
    return true;
}

function getTasks($folderId = "null")
{
    global $dbc;
    $userId = getUserId();

    // select query and get all records if folderid equal with null

    if ($folderId == "null") {
        $query = "SELECT * from tasks
     where user_id = {$userId}";
    }
    // get folder records if folderid not equal with null
    else {
        $query = "SELECT * from tasks
     where user_id = {$userId}
     and folder_id = :folderid";
    }
    $stmt = $dbc->prepare($query);
    $stmt->execute([":folderid" => $folderId]);
    $resutl = $stmt->fetchAll(PDO::FETCH_OBJ);

    return ($resutl);

}

function deleteFolder($folderId)
{

    global $dbc;
    $query = "delete from folders where id = :folderid";
    $stmt = $dbc->prepare($query);
    $stmt->execute([":folderid" => $folderId]);

}

function createFolder($folderName)
{
    if (!checkExistFolder($folderName)) {
        return "it,s duplicate";
    }
    global $dbc;
    $userId = getUserId();
    $query = "INSERT into folders (folderName,user_id,task_id)
     values(:foldername , $userId,$userId)";
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
