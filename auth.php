<?php
include_once "/srv/train/todo/config/init.php";

// include_once

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if ($_GET['action'] == "login") {

        $params = $_POST;
        if (login($params)) {

            header("location: http://tra.in/todo/");

        } else {
            var_dump(login($params), $_SESSION['login']);

            echo "ops";
        }

    } else if ($_GET['action'] == "register") {

        $params = $_POST;
        $reg = registerUser($params);
        echo $reg;
        var_dump($_POST, $reg);
        if ($reg === "emailD" || $reg === "not") {
            var_dump(registerUser($params));
            echo "ایمیل تکراری است.اگر ایمیل متعلق به شماست از قسمت ورود تلاش کنید";

        } else if ($reg == "register") {

            echo "ثبت نام موفقیت آمیز بود";

        }
    }
}

include_once "/srv/train/todo/tpl/auth.php";
