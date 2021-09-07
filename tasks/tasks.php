<?php

function getUserId()
{
    return 1;
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

function getTasks($folderId = 1) 
{
    global $dbc;
    $userId = getUserId();
    $query = "SELECT * from tasks
     where user_id = {$userId}
     and folder_id = $folderId";

    $stmt = $dbc->prepare($query);
    $stmt->execute();
    $resutl = $stmt->fetchAll(PDO::FETCH_OBJ);

    return ($resutl);

}

function deleteFolder($folderId)
{

    global $dbc;
    $query = "delete from folders where id = " . $folderId;
    $stmt = $dbc->prepare($query);
    $stmt->execute();

}
