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

        if ($reg === "email duplicate" || $reg === "not") {
            echo "<div class='error' >ایمیل تکراری است.اگر ایمیل متعلق به شماست از قسمت ورود تلاش کنید </div>";

        } else if ($reg == "register") {

            echo "<div class='success'>ثبت نام موفقیت آمیز بود</div>";

        }
    }
}

include_once "/srv/train/todo/tpl/auth.php";
