<?php

include_once "helpers.php";
try {
    $dbc = new PDO("mysql:host=" . HOST . ";dbname=todo", "root", "nu11device");
} catch (Exception $e) {

    dieMessage("connection is faild {$e->getMessage()}");
}
