<?php
function dieMessage($message = null)
{

    echo $message;
    die();
}

function isAjaxRequest()
{
    if (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {

        return true;
    }
    return false;
}
