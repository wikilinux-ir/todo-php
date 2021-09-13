<?php
include_once "/srv/train/todo/config/init.php";

function isLogedIn()
{
    return isset($_SESSION['login']) ? true : false;

}

function checkExistUser($email)
{
    global $dbc;
    $query = "SELECT * from users where email = :email";
    $stmt = $dbc->prepare($query);
    $stmt->execute([":email" => $email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $stmt->rowCount() > 0 ? $result : false;
}
function passwordIsTrue()
{

}
function registerUser($params)
{

    global $dbc;
    if (checkExistUser($params['email'])) {
        return "email duplicate";
    }
    $passwdHash = password_hash($params["password"], PASSWORD_BCRYPT);
    $query = "INSERT into users (username,email,password) values(:username,:email,'$passwdHash')";
    $stmt = $dbc->prepare($query);
    $stmt->execute([":email" => $params['email'], ":username" => $params['username']]);
    return $stmt->rowCount() > 0 ? "register" : "not";

}

function setCookieInDb()
{

    global $dbc;
    $userId = getUserId();
    $cookeiValue = $_COOKIE['login'];
    $query = "update users set cookie = '{$cookeiValue}' where id = $userId";
    $stmt = $dbc->prepare($query);
    $stmt->execute();

}

function login($params, $setCookei = null)
{

    $user = checkExistUser($params['email']);

    if (!checkExistUser($params['email'])) {

        return "ایمیل یا پسورد اشتباه است";
    }

    if (password_verify($params["password"], $user['password'])) {

        $_SESSION['login'] = $user;
        if ($setCookei == "set") {
            setcookie("login", md5($user["password"]) . md5($user["id"]), time() + 2 * 24 * 60 * 60, "/", "tra.in");
            setCookieInDb();
        }
        return true;
    }
    return null;
}

function logOut($user)
{
    // setcookie("login", md5($user["password"]) . md5($user["id"]), 1);
    global $dbc;
    $userId = $user['id'];
    $cookeiValue = null;
    // dd($userId);
    $query = "update users set cookie = NULL where id = $userId";
    $stmt = $dbc->prepare($query);
    $stmt->execute();
    unset($_SESSION['login']);
    session_destroy();
}
function loginWithCookie($cookei)
{
    global $dbc;
    $query = "SELECT * from users where cookie = '{$cookei}'";
    $stmt = $dbc->prepare($query);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    // dd($result);
    if ($stmt->rowCount() > 0) {
        $_SESSION['login'] = $result;
    }

}
