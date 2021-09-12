<?php
function dieMessage($message = "null")
{

    echo "<div style='margin:auto;text-align: center;
    background: #58b3dfde;
    width: 60%;
    height: auto;
    min-height: 150px;
    font-size: 26px;
    padding: 30px 10px;
    margin-top: 60px;
    border-radius: 6px;
    border: 2px solid #66264a;
    font-family: iransans;
}'>$message</div>";
    die();
}

function dd($var)
{
    echo "<pre style='color: #9c4100; background: #fff; z-index: 999; position: relative; padding: 10px; margin: 10px; border-radius: 5px; border-left: 3px solid #c56705;'>";
    var_dump($var);
    echo "</pre>";
    die();
}

function isAjaxRequest()
{
    if (!empty($_SERVER["HTTP_X_REQUESTED_WITH"]) && strtolower($_SERVER["HTTP_X_REQUESTED_WITH"]) == "xmlhttprequest") {

        return true;
    }
    return false;
}
